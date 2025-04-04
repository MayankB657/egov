<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Letter;
use App\Models\LetterFiles;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class InwardLetterController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $data = Letter::where('is_deleted', 0)->with('branch')
            ->where(function ($query) use ($searchQuery) {
                if (!empty($searchQuery)) {
                    $query->where('letter.inward_no', 'like', '%' . $searchQuery . '%')
                        ->orWhere('letter.inward_no', 'like', '%' . $searchQuery . '%');
                }
            })->orderBy('id', 'desc')->paginate(10);
        $i = (request()->input('page', 1) - 1) * 10;
        if ($request->ajax()) {
            $view = view('inward.row', compact('data', 'i'))->render();
            $pagination = $data->appends($request->except('page'))->links()->toHtml();
            return response()->json(['html' => $view, 'pagination' => $pagination, 'i' => $i]);
        }
        return view('inward.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 10);
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
            $validator = Validator::make($request->all(), [
                'letter_no' => 'nullable|unique:letter,letter_no',
                'media_files' => 'nullable|array|max:5',
                'media_files.*' => "file|mimes:pdf,jpg,jpeg,png|max:$max_size",
            ], [
                'letter_no.unique' => 'Letter number already exists.',
                'media_files.max' => 'You can upload a maximum of 5 files.',
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
            if ($request->letter_type == 'Letter') {
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
            } elseif ($request->letter_type == 'Courier') {
                $data->courier_name = $request->courier_name;
                $data->tracking_id = $request->tracking_id;
            } elseif ($request->letter_type == 'Email') {
                $data->email = $request->email;
            }
            $data->save();
            if ($request->hasFile('media_files')) {
                $files = $request->file('media_files');
                foreach ($files as $key => $file) {
                    $filename = Str::limit($file->getClientOriginalName(), 20, '') . '_' . $key . uniqid();
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
}
