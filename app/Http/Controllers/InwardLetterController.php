<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
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

class InwardLetterController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::where('is_deleted', 0)->get();
        $subjects = Subject::where('is_deleted', 0)->get();
        $branches = Branch::where('is_deleted', 0)->get();
        $query = Letter::with('branch')->where('is_deleted', 0)->where('type', 'inward');
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
                'html' => view('inward.row', compact('data', 'i'))->render(),
                'pagination' => $data->appends($request->except('page'))->links()->toHtml(),
                'i' => $i,
            ]);
        }
        return view('inward.index', compact('data', 'departments', 'subjects', 'branches', 'i'));
    }

    public function create()
    {
        $subjects = Subject::where('is_deleted', 0)->get();
        $departments = Department::where('is_deleted', 0)->get();
        $existingNumbers = Letter::pluck('letter_no')->toArray();
        do {
            $unique = rand(100000, 999999);
        } while (in_array($unique, $existingNumbers));
        return view('inward.create', compact('departments', 'subjects', 'unique'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $max_size = config('app.max_upload_size');
            $max_uploads = config('app.max_uploads');
            $validator = Validator::make($request->all(), [
                'letter_no' => 'nullable|unique:letter,letter_no',
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
            $data = new Letter();
            $data->type = 'Inward';
            $data->inward_no = 'IN/' . Carbon::now()->format('Y/m/d') . '/' . $request->letter_no;
            $data->letter_type = $request->letter_type;
            $data->received_by = $request->received_by;
            $data->received_from = $request->received_from;
            $data->subject_id = $request->subject_id;
            $data->department_id = $request->department_id;
            $data->branch_id = $request->branch_id;
            $data->description = $request->description;
            $data->date = $request->date;
            $data->comment = $request->comment;
            $data->status = $request->status;
            $data->authority_name = $request->authority_name;
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
            return response()->json(['status' => true, 'msg' => 'Inward letter added successfully.', 'url' => route('inward-letter.index')]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 'false', 'msg' => $th->getMessage()]);
        }
    }

    public function edit($id)
    {
        $id = base64UrlDecode($id);
        $data = Letter::where('id', $id)->with('mediafiles')->first();
        $subjects = Subject::where('is_deleted', 0)->get();
        $departments = Department::where('is_deleted', 0)->get();
        $branches = Branch::where('department_id', $data->department_id)->where('is_deleted', 0)->get();
        return view('inward.edit', compact('data', 'subjects', 'departments', 'branches'));
    }

    public function update(Request $request, $id)
    {
        $id = base64UrlDecode($id);
        try {
            DB::beginTransaction();
            $max_uploads = config('app.max_uploads');
            $max_size = config('app.max_upload_size');
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
            $data = Letter::find($id);
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
            return response()->json(['status' => true, 'msg' => 'Inward letter updated successfully.', 'url' => route('inward-letter.index')]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 'false', 'msg' => $th->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $id = base64UrlDecode($id);
        try {
            DB::beginTransaction();
            $data = Letter::find($id);
            $data->is_deleted = 1;
            $data->save();
            DB::commit();
            return redirect()->back()->with('success', 'Inward letter deleted successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function GetLetterActivity($id)
    {
        $id = base64UrlDecode($id);
        $activity = LetterLog::where('letter_id', $id)->with('user')->orderBy('created_at')->get();
        $view = view('components.status-model', compact('activity'))->render();
        return response()->json(['html' => $view]);
    }

    public function GetCommentModel(Request $request, $id)
    {
        $type = $request->type ?? 'letter';
        $view = view('components.add-comment-model', compact('id', 'type'))->render();
        return response()->json(['html' => $view]);
    }

    public function AddLetterComment(Request $request)
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
            $letter = Letter::find($id);
            if (!$letter) {
                return response()->json(['status' => false, 'msg' => 'Something went wrong.']);
            }
            $data = new LetterComment();
            $data->letter_id = $id;
            $data->comment = $request->comment;
            $data->created_by = auth()->id();
            $data->save();
            if ($request->hasFile('media_files')) {
                $files = $request->file('media_files');
                foreach ($files as $key => $file) {
                    $filename = uniqid() . '_' . $key . '.' . $file->getClientOriginalExtension();;
                    $file->move(public_path('uploads/letter'), $filename);
                    $File = new LetterFiles();
                    $File->letter_id = $id;
                    $File->file_name = $file->getClientOriginalName();
                    $File->file_path = 'public/uploads/letter/' . $filename;
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

    public function GetFollowupModel(Request $request, $id)
    {
        $type = $request->type ?? 'letter';
        $view = view('components.add-followup-model', compact('id', 'type'))->render();
        return response()->json(['html' => $view]);
    }

    public function AddFollowup(Request $request)
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
            $letter = Letter::find($id);
            if (!$letter) {
                return response()->json(['status' => false, 'msg' => 'Something went wrong.']);
            }
            $data = new LetterLog();
            $data->letter_id = $id;
            $data->remark = $request->remark;
            $data->officer_name = $request->officer_name;
            $data->officer_designation = $request->officer_designation;
            $data->created_by = auth()->id();
            $data->save();
            if ($request->hasFile('media_files')) {
                $files = $request->file('media_files');
                foreach ($files as $key => $file) {
                    $filename = uniqid() . '_' . $key . '.' . $file->getClientOriginalExtension();;
                    $file->move(public_path('uploads/letter'), $filename);
                    $File = new LetterFiles();
                    $File->letter_id = $id;
                    $File->file_name = $file->getClientOriginalName();
                    $File->file_path = 'public/uploads/letter/' . $filename;
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

    public function RemoveFile($id)
    {
        try {
            DB::beginTransaction();
            $file = LetterFiles::find($id);
            if ($file) {
                $allFiles = LetterFiles::where('file_path', $file->file_path)->where('file_name', $file->file_name)->get();
                foreach ($allFiles as $allFile) {
                    $allFile->is_deleted = 1;
                    $allFile->save();
                    Helper::DeleteFile($allFile->file_path);
                }
            } else {
                return response()->json(['status' => false, 'msg' => 'File not found.']);
            }
            DB::commit();
            return response()->json(['status' => true, 'msg' => 'File deleted successfully.']);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
        }
    }

    public function show($id)
    {
        $id = base64UrlDecode($id);
        $data = Letter::where('id', $id)->with('mediafiles')->first();
        $comments = LetterComment::where('letter_id', $id)->where('is_deleted', 0)->get();
        return view('inward.view', compact('data', 'comments'));
    }
}
