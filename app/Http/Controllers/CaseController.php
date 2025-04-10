<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\TopicComments;
use App\Models\TopicFiles;
use App\Models\TopicLogs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CaseController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::where('is_deleted', 0)->get();
        $subjects = Subject::where('is_deleted', 0)->get();
        $branches = Branch::where('is_deleted', 0)->get();
        $query = Topic::where('is_deleted', 0);
        if ($search = $request->input('search')) {
            $query->where('rack_no', 'like', "%{$search}%")
                ->orWhere('letter_no', 'like', "%{$search}%");
        }
        foreach (['subject_id', 'department_id', 'branch_id', 'status'] as $field) {
            if ($value = $request->input($field)) {
                $query->where($field, $value);
            }
        }
        if ($request->has('date')) {
            [$startDate, $endDate] = explode(' - ', $request->date);
            $start = Carbon::parse($startDate)->startOfDay();
            $end = Carbon::parse($endDate)->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
        }
        $data = $query->orderByDesc('id')->paginate(10);
        $i = ($request->input('page', 1) - 1) * 10;
        if ($request->ajax()) {
            return response()->json([
                'html' => view('case.row', compact('data', 'i'))->render(),
                'pagination' => $data->appends($request->except('page'))->links()->toHtml(),
                'i' => $i,
            ]);
        }
        return view('case.index', compact('data', 'departments', 'subjects', 'branches', 'i'));
    }

    public function create()
    {
        $subjects = Subject::where('is_deleted', 0)->get();
        $departments = Department::where('is_deleted', 0)->get();
        $existingNumbers = Topic::pluck('letter_no')->toArray();
        do {
            $unique = rand(100000, 999999);
        } while (in_array($unique, $existingNumbers));
        return view('case.create', compact('departments', 'subjects', 'unique'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $max_size = config('app.max_upload_size');
            $max_uploads = config('app.max_uploads');
            $validator = Validator::make($request->all(), [
                'letter_no' => 'nullable|unique:topic,letter_no',
                'media_files' => "nullable|array|max:$max_uploads",
                'media_files.*' => "file|mimes:pdf,jpg,jpeg,png|max:$max_size",
            ], [
                'letter_no.unique' => 'Letter number already exists.',
                'media_files.max' => 'You can upload a maximum of ' . $max_uploads . ' files.',
                'media_files.*.file' => 'Each upload must be a valid file.',
                'media_files.*.mimes' => 'Allowed file types: pdf, jpg, jpeg, png.',
                'media_files.*.max' => "Each file must not exceed " . ($max_size / 1024) . "MB.",
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status' => false]);
            }
            $data = new Topic();
            $data->topic_type = $request->letter_type;
            $data->received_by = $request->received_by;
            $data->received_from = $request->received_from;
            $data->subject_id = $request->subject_id;
            $data->department_id = $request->department_id;
            $data->branch_id = $request->branch_id;
            $data->description = $request->description;
            $data->date = $request->date;
            $data->comment = $request->comment;
            $data->status = $request->status;
            $data->holder_name = $request->holder_name;
            $data->concerned_officer = $request->concerned_officer;
            $data->created_by = auth()->id();
            if ($request->letter_type == 'Letter' || $request->letter_type == "VIP Letter") {
                $data->letter_no = $request->letter_no;
            } elseif ($request->letter_type == 'File') {
                $data->rack_no = $request->rack_no;
            }
            if ($request->received_from == "People's Representative") {
                $data->received_from_name = $request->received_from_name2;
            } else {
                $data->received_from_name = $request->received_from_name;
            }
            if ($request->received_by == 'By hand') {
                $data->by_hand_name = $request->by_hand_name;
            } elseif ($request->received_by == 'Courier') {
                $data->courier_name = $request->courier_name;
                $data->tracking_id = $request->tracking_id;
            } elseif ($request->received_by == 'Email') {
                $data->email = $request->email;
            }
            $data->save();
            $log = new TopicLogs();
            $log->topic_id = $data->id;
            $log->status = $data->status;
            $log->created_by = auth()->id();
            $log->save();
            if ($request->hasFile('media_files')) {
                $files = $request->file('media_files');
                foreach ($files as $key => $file) {
                    $filename = uniqid() . '_' . $key . '.' . $file->getClientOriginalExtension();;
                    $file->move(public_path('uploads/case'), $filename);
                    $File = new TopicFiles();
                    $File->topic_id = $data->id;
                    $File->file_name = $file->getClientOriginalName();
                    $File->file_path = 'public/uploads/case/' . $filename;
                    $File->save();
                }
            }
            DB::commit();
            return response()->json(['status' => true, 'msg' => 'Case added successfully.', 'url' => route('case.index')]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 'false', 'msg' => $th->getMessage()]);
        }
    }

    public function show($id)
    {
        $id = base64UrlDecode($id);
        $data = Topic::where('id', $id)->with('mediafiles')->first();
        $comments = TopicComments::where('topic_id', $id)->where('is_deleted', 0)->get();
        return view('case.view', compact('data', 'comments'));
    }

    public function edit($id)
    {
        $id = base64UrlDecode($id);
        $data = Topic::where('id', $id)->with('mediafiles')->first();
        $subjects = Subject::where('is_deleted', 0)->get();
        $departments = Department::where('is_deleted', 0)->get();
        $branches = Branch::where('department_id', $data->department_id)->where('is_deleted', 0)->get();
        return view('case.edit', compact('data', 'subjects', 'departments', 'branches'));
    }

    public function update(Request $request, $id)
    {
        $id = base64UrlDecode($id);
        try {
            DB::beginTransaction();
            $max_size = config('app.max_upload_size');
            $max_uploads = config('app.max_uploads');
            $validator = Validator::make($request->all(), [
                'letter_no' => [
                    'nullable',
                    Rule::unique('letter', 'letter_no')->ignore($id),
                ],
                'media_files' => "nullable|array|max:$max_uploads",
                'media_files.*' => "file|mimes:pdf,jpg,jpeg,png|max:$max_size",
            ], [
                'letter_no.unique' => 'Letter number already exists.',
                'media_files.max' => 'You can upload a maximum of ' . $max_uploads . ' files.',
                'media_files.*.file' => 'Each upload must be a valid file.',
                'media_files.*.mimes' => 'Allowed file types: pdf, jpg, jpeg, png.',
                'media_files.*.max' => "Each file must not exceed " . ($max_size / 1024) . "MB.",
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status' => false]);
            }
            $data = Topic::find($id);
            $data->topic_type = $request->letter_type;
            $data->received_by = $request->received_by;
            $data->received_from = $request->received_from;
            $data->subject_id = $request->subject_id;
            $data->department_id = $request->department_id;
            $data->branch_id = $request->branch_id;
            $data->description = $request->description;
            $data->date = $request->date;
            $data->comment = $request->comment;
            $status_changed = $data->status != $request->status;
            $data->status = $request->status;
            $data->holder_name = $request->holder_name;
            $data->concerned_officer = $request->concerned_officer;
            if ($request->letter_type == 'Letter' || $request->letter_type == "VIP Letter") {
                $data->letter_no = $request->letter_no;
            } elseif ($request->letter_type == 'File') {
                $data->rack_no = $request->rack_no;
            }
            if ($request->received_from == "People's Representative") {
                $data->received_from_name = $request->received_from_name2;
            } else {
                $data->received_from_name = $request->received_from_name;
            }
            if ($request->received_by == 'By hand') {
                $data->by_hand_name = $request->by_hand_name;
            } elseif ($request->received_by == 'Courier') {
                $data->courier_name = $request->courier_name;
                $data->tracking_id = $request->tracking_id;
            } elseif ($request->received_by == 'Email') {
                $data->email = $request->email;
            }
            $data->save();
            if ($status_changed) {
                $log = new TopicLogs();
                $log->topic_id = $data->id;
                $log->status = $data->status;
                $log->created_by = auth()->id();
                $log->save();
            }
            if ($request->hasFile('media_files')) {
                $files = $request->file('media_files');
                foreach ($files as $key => $file) {
                    $filename = uniqid() . '_' . $key . '.' . $file->getClientOriginalExtension();;
                    $file->move(public_path('uploads/case'), $filename);
                    $File = new TopicFiles();
                    $File->topic_id = $data->id;
                    $File->file_name = $file->getClientOriginalName();
                    $File->file_path = 'public/uploads/case/' . $filename;
                    $File->save();
                }
            }
            DB::commit();
            return response()->json(['status' => true, 'msg' => 'Case updated successfully.', 'url' => route('case.index')]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 'false', 'msg' => $th->getMessage()]);
        }
    }

    public function GetCaseActivity($id)
    {
        $id = base64UrlDecode($id);
        $activity = TopicLogs::where('topic_id', $id)->with('user')->orderBy('created_at')->get();
        $view = view('components.status-model', compact('activity'))->render();
        return response()->json(['html' => $view]);
    }

    public function AddCaseComment(Request $request)
    {
        try {
            $max_uploads = config('app.max_uploads');
            $max_size = config('app.max_upload_size');
            $validator = Validator::make($request->all(), [
                'media_files' => "nullable|array|max:$max_uploads",
                'media_files.*' => "file|mimes:pdf,jpg,jpeg,png|max:$max_size",
            ], [
                'media_files.max' => 'You can upload a maximum of ' . $max_uploads . ' files.',
                'media_files.*.file' => 'Each upload must be a valid file.',
                'media_files.*.mimes' => 'Allowed file types: pdf, jpg, jpeg, png.',
                'media_files.*.max' => "Each file must not exceed " . ($max_size / 1024) . "MB.",
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status' => false]);
            }
            DB::beginTransaction();
            $id = base64UrlDecode($request->id);
            $letter = Topic::find($id);
            if (!$letter) {
                return response()->json(['status' => false, 'msg' => 'Something went wrong.']);
            }
            $data = new TopicComments();
            $data->topic_id = $id;
            $data->comment = $request->comment;
            $data->created_by = auth()->id();
            $data->save();
            if ($request->hasFile('media_files')) {
                $files = $request->file('media_files');
                foreach ($files as $key => $file) {
                    $filename = uniqid() . '_' . $key . '.' . $file->getClientOriginalExtension();;
                    $file->move(public_path('uploads/case'), $filename);
                    $File = new TopicFiles();
                    $File->topic_id = $id;
                    $File->file_name = $file->getClientOriginalName();
                    $File->file_path = 'public/uploads/case/' . $filename;
                    $File->save();
                }
            }
            DB::commit();
            return response()->json(['status' => true, 'msg' => 'Comment added successfully.']);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
        }
    }

    public function AddCaseFollowup(Request $request)
    {
        try {
            $max_uploads = config('app.max_uploads');
            $max_size = config('app.max_upload_size');
            $validator = Validator::make($request->all(), [
                'media_files' => "nullable|array|max:$max_uploads",
                'media_files.*' => "file|mimes:pdf,jpg,jpeg,png|max:$max_size",
            ], [
                'media_files.max' => 'You can upload a maximum of ' . $max_uploads . ' files.',
                'media_files.*.file' => 'Each upload must be a valid file.',
                'media_files.*.mimes' => 'Allowed file types: pdf, jpg, jpeg, png.',
                'media_files.*.max' => "Each file must not exceed " . ($max_size / 1024) . "MB.",
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status' => false]);
            }
            DB::beginTransaction();
            $id = base64UrlDecode($request->id);
            $letter = Topic::find($id);
            if (!$letter) {
                return response()->json(['status' => false, 'msg' => 'Something went wrong.']);
            }
            $data = new TopicLogs();
            $data->topic_id = $id;
            $data->remark = $request->remark;
            $data->officer_name = $request->officer_name;
            $data->officer_designation = $request->officer_designation;
            $data->created_by = auth()->id();
            $data->save();
            if ($request->hasFile('media_files')) {
                $files = $request->file('media_files');
                foreach ($files as $key => $file) {
                    $filename = uniqid() . '_' . $key . '.' . $file->getClientOriginalExtension();;
                    $file->move(public_path('uploads/case'), $filename);
                    $File = new TopicFiles();
                    $File->topic_id = $id;
                    $File->file_name = $file->getClientOriginalName();
                    $File->file_path = 'public/uploads/case/' . $filename;
                    $File->save();
                }
            }
            DB::commit();
            return response()->json(['status' => true, 'msg' => 'Followup added successfully.']);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
        }
    }
}
