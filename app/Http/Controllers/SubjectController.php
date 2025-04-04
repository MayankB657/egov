<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $data = Subject::where('is_deleted', 0)
            ->where(function ($query) use ($searchQuery) {
                if (!empty($searchQuery)) {
                    $query->where('subject.name', 'like', '%' . $searchQuery . '%');
                }
            })->orderBy('id', 'desc')->paginate(10);
        $i = (request()->input('page', 1) - 1) * 10;
        if ($request->ajax()) {
            $view = view('subject.row', compact('data', 'i'))->render();
            $pagination = $data->appends($request->except('page'))->links()->toHtml();
            return response()->json(['html' => $view, 'pagination' => $pagination, 'i' => $i]);
        }
        return view('subject.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $departments = Department::where('is_deleted', 0)->get();
        return view('subject.create', compact('departments'));
    }

    public function getBranches($department_id)
    {
        $branches = Branch::where('department_id', $department_id)->where('is_deleted', 0)->get();
        return response()->json(['branches' => $branches]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = new Subject();
            $data->name = $request->name;
            $data->department_id = $request->department_id;
            $data->branch_id = $request->branch_id;
            $data->created_by = auth()->id();
            $data->save();
            DB::commit();
            return response()->json(['status' => true, 'msg' => 'Subject created successfully.', 'url' => route('subject.index')]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
        }
    }

    public function edit($id)
    {
        $id = base64UrlDecode($id);
        $data = Subject::find($id);
        $departments = Department::where('is_deleted', 0)->get();
        $branches = Branch::where('department_id', $data->department_id)->where('is_deleted', 0)->get();
        return view('subject.edit', compact('departments', 'data', 'branches'));
    }

    public function update(Request $request, $id)
    {
        $id = base64UrlDecode($id);
        try {
            DB::beginTransaction();
            $data = Subject::find($id);
            $data->name = $request->name;
            $data->department_id = $request->department_id;
            $data->branch_id = $request->branch_id;
            $data->save();
            DB::commit();
            return response()->json(['status' => true, 'msg' => 'Subject updated successfully.', 'url' => route('subject.index')]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $id = base64UrlDecode($id);
        try {
            DB::beginTransaction();
            $data = Subject::find($id);
            $data->is_deleted = 1;
            $data->save();
            DB::commit();
            return redirect()->back()->with('success', 'Subject deleted successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
