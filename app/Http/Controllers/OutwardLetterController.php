<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Letter;
use App\Models\LetterComment;
use App\Models\LetterFiles;
use App\Models\LetterLog;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class OutwardLetterController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::where('is_deleted', 0)->get();
        $subjects = Subject::where('is_deleted', 0)->get();
        $branches = Branch::where('is_deleted', 0)->get();
        $query = Letter::with('branch')->where('is_deleted', 0)->where('type', 'outward');
        $onlyOut = $request->onlyout ?? false;
        $inout = $request->inout ?? false;
        if ($onlyOut) {
            $query->where('inward_no', null);
        }
        if ($inout) {
            $query->where('inward_no', '!=', null);
        }
        if ($request->has('date')) {
            [$startDate, $endDate] = explode(' - ', $request->date);
            $start = Carbon::parse($startDate)->startOfDay();
            $end = Carbon::parse($endDate)->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
        }
        if ($search = $request->input('search')) {
            $query->where('inward_no', 'like', "%{$search}%")
                ->orWhere('outward_no', 'like', "%{$search}%")
                ->orWhere('letter_no', 'like', "%{$search}%");
        }
        foreach (['subject_id', 'department_id', 'branch_id', 'status', 'letter_type'] as $field) {
            if ($value = $request->input($field)) {
                $query->where($field, $value);
            }
        }
        $data = $query->orderByDesc('id')->paginate(10);
        $i = ($request->input('page', 1) - 1) * 10;
        if ($request->ajax()) {
            return response()->json([
                'html' => view('outward.row', compact('data', 'i'))->render(),
                'pagination' => $data->appends($request->except('page'))->links()->toHtml(),
                'i' => $i,
            ]);
        }
        return view('outward.index', compact('data', 'departments', 'subjects', 'branches', 'i'));
    }

    public function create()
    {
        $departments = Department::where('is_deleted', 0)->get();
        $subjects = Subject::where('is_deleted', 0)->get();
        $branches = Branch::where('is_deleted', 0)->get();
        $inwards = Letter::where('is_deleted', 0)->where('outward_no', null)->where('type', 'inward')->get();
        $existingNumbers = Letter::pluck('letter_no')->toArray();
        do {
            $unique = rand(100000, 999999);
        } while (in_array($unique, $existingNumbers));
        return view('outward.create', compact('departments', 'subjects', 'branches', 'inwards', 'unique'));
    }

    public function GetOutwardContent($id)
    {
        $data = Letter::find($id);
        $departments = Department::where('is_deleted', 0)->get();
        $subjects = Subject::where('is_deleted', 0)->get();
        $branches = Branch::where('department_id', $data->department_id)->where('is_deleted', 0)->get();
        if ($data) {
            $view = view('components.exsting-outward-card', compact('data', 'subjects', 'departments', 'branches'))->render();
            return response()->json(['status' => true, 'html' => $view]);
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $isExistingOutward = $request->has('inward_id');
            $inward = $isExistingOutward ? Letter::find(base64UrlDecode($request->inward_id)) : null;
            $max_size = config('app.max_upload_size');
            $validator = Validator::make($request->all(), [
                'media_files' => 'nullable|array|max:5',
                'media_files.*' => "file|mimes:pdf,jpg,jpeg,png|max:$max_size",
            ], [
                'media_files.max' => 'You can upload a maximum of 5 files.',
                'media_files.*.file' => 'Each upload must be a valid file.',
                'media_files.*.mimes' => 'Allowed file types: pdf, jpg, jpeg, png.',
                'media_files.*.max' => "Each file must not exceed " . ($max_size / 1024) . "MB.",
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status' => false]);
            }
            if ($isExistingOutward == false) {
                $validator = Validator::make($request->all(), [
                    'letter_no' => 'nullable|unique:letter,letter_no',
                ], [
                    'letter_no.unique' => 'Letter number already exists.',
                ]);
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors(), 'status' => false]);
                }
            }
            $data = new Letter();
            $data->type = 'outward';
            $data->inward_no = $isExistingOutward ? $inward->inward_no : null;
            $letterNumber = $isExistingOutward ? $inward->letter_no : $request->letter_no;
            $data->outward_no = 'OUT/' . Carbon::now()->format('Y/m/d') . '/' . $letterNumber;
            $data->letter_type = $request->letter_type;
            $data->subject_id = $request->subject_id;
            $data->department_id = $request->department_id;
            $data->branch_id = $request->branch_id;
            if ($request->letter_type == 'Letter' || $request->letter_type == "VIP Letter") {
                $data->letter_no = $request->letter_no;
            } elseif ($request->letter_type == 'File') {
                $data->rack_no = $request->rack_no;
            }
            if ($isExistingOutward) {
                $data->received_by = $request->received_by;
                $data->received_from = $request->received_from;
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
                $inward->outward_no = $data->outward_no;
                $inward->status = $request->status;
                $inward->save();
            }
            $data->description = $request->description;
            $data->date = $request->date;
            $data->comment = $request->comment;
            $data->status = $request->status;
            $data->authority_name = $request->authority_name;
            $data->created_by = auth()->id();
            $data->save();
            if ($isExistingOutward) {
                $exstingFiles = LetterFiles::where('is_deleted', 0)->where('letter_id', $inward->id)->get();
                foreach ($exstingFiles as $file) {
                    $File = new LetterFiles();
                    $File->letter_id = $data->id;
                    $File->file_name = $file->file_name;
                    $File->file_path = $file->file_path;
                    $File->save();
                }
                $exstingLogs = LetterLog::where('letter_id', $inward->id)->where('is_deleted', 0)->get();
                foreach ($exstingLogs as $log) {
                    $extlog = new LetterLog();
                    $extlog->letter_id = $data->id;
                    $extlog->status = $log->status;
                    $extlog->officer_name = $log->officer_name;
                    $extlog->officer_designation = $log->officer_designation;
                    $extlog->remark = $log->remark;
                    $extlog->created_by = $log->created_by;
                    $extlog->created_at = $log->created_at;
                    $extlog->updated_at = $log->updated_at;
                    $extlog->save();
                }
                $exstingComments = LetterComment::where('letter_id', $inward->id)->where('is_deleted', 0)->get();
                foreach ($exstingComments as $comment) {
                    $extcomment = new LetterComment();
                    $extcomment->letter_id = $data->id;
                    $extcomment->comment = $comment->comment;
                    $extcomment->created_by = $comment->created_by;
                    $extcomment->created_at = $comment->created_at;
                    $extcomment->updated_at = $comment->updated_at;
                    $extcomment->save();
                }
            }
            $log = new LetterLog();
            $log->letter_id = $data->id;
            $log->status = $data->status;
            $log->created_by = auth()->id();
            $log->save();
            if ($request->hasFile('media_files')) {
                $files = $request->file('media_files');
                foreach ($files as $key => $file) {
                    $filename = uniqid() . '_' . $key . '.' . $file->getClientOriginalExtension();;
                    $file->move(public_path('uploads/letter'), $filename);
                    $File = new LetterFiles();
                    $File->letter_id = $data->id;
                    $File->file_name = $file->getClientOriginalName();
                    $File->file_path = 'public/uploads/letter/' . $filename;
                    $File->save();
                }
            }
            DB::commit();
            return response()->json(['status' => true, 'msg' => 'Outward letter created successfully.', 'url' => route('outward-letter.index')]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 'false', 'msg' => $th->getMessage()]);
        }
    }

    public function show($id)
    {
        $id = base64UrlDecode($id);
        $data = Letter::where('id', $id)->with('mediafiles')->first();
        $comments = LetterComment::where('letter_id', $id)->where('is_deleted', 0)->get();
        return view('outward.view', compact('data', 'comments'));
    }

    public function edit($id)
    {
        $id = base64UrlDecode($id);
        $data = Letter::where('id', $id)->with('mediafiles')->first();
        $subjects = Subject::where('is_deleted', 0)->get();
        $departments = Department::where('is_deleted', 0)->get();
        $branches = Branch::where('department_id', $data->department_id)->where('is_deleted', 0)->get();
        $comments = LetterComment::where('letter_id', $id)->where('is_deleted', 0)->get();
        return view('outward.edit', compact('data', 'subjects', 'departments', 'branches', 'comments'));
    }

    public function update(Request $request, $id)
    {
        $id = base64UrlDecode($id);
        try {
            DB::beginTransaction();
            $max_uploads = config('app.max_uploads');
            $max_size = config('app.max_upload_size');
            $data = Letter::find($id);
            $isExistingOutward = $data->inward_no != null ? true : false;
            $inward = $isExistingOutward ? Letter::find(base64UrlDecode($request->inward_id)) : null;
            $validator = Validator::make($request->all(), [
                'letter_no' => [
                    'nullable',
                    Rule::unique('letter', 'letter_no')->where(function ($query) use ($id, $inward) {
                        $query->whereNot('id', $id);
                        if ($inward) {
                            $query->whereNot('id', $inward->id);
                        }
                    }),
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
            $data->letter_type = $request->letter_type;
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
            $data->authority_name = $request->authority_name;
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
                $log = new LetterLog();
                $log->letter_id = $data->id;
                $log->status = $data->status;
                $log->created_by = auth()->id();
                $log->save();
            }
            if ($request->hasFile('media_files')) {
                $files = $request->file('media_files');
                foreach ($files as $key => $file) {
                    $filename = uniqid() . '_' . $key . '.' . $file->getClientOriginalExtension();;
                    $file->move(public_path('uploads/letter'), $filename);
                    $File = new LetterFiles();
                    $File->letter_id = $data->id;
                    $File->file_name = $file->getClientOriginalName();
                    $File->file_path = 'public/uploads/letter/' . $filename;
                    $File->save();
                }
            }
            DB::commit();
            return response()->json(['status' => true, 'msg' => 'Outward letter updated successfully.', 'url' => route('outward-letter.index')]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 'false', 'msg' => $th->getMessage()]);
        }
    }
}
