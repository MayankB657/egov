<?php

namespace App\Http\Controllers;

use App\Imports\DepartmentImport;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $data = Department::where('is_deleted', 0)
            ->where(function ($query) use ($searchQuery) {
                if (!empty($searchQuery)) {
                    $query->where('department.name', 'like', '%' . $searchQuery . '%')
                        ->orWhere('department.email', 'like', '%' . $searchQuery . '%');
                }
            })->orderBy('id', 'desc')->paginate(10);
        $i = (request()->input('page', 1) - 1) * 10;
        if ($request->ajax()) {
            $view = view('department.row', compact('data', 'i'))->render();
            $pagination = $data->appends($request->except('page'))->links()->toHtml();
            return response()->json(['html' => $view, 'pagination' => $pagination, 'i' => $i]);
        }
        return view('department.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('department.create');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = new Department();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->contact = $request->contact;
            $data->created_by = auth()->id();
            $data->save();
            DB::commit();
            return response()->json(['status' => true, 'msg' => 'Department created successfully.', 'url' => route('department.index')]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
        }
    }

    public function edit($id)
    {
        $data = Department::find($id);
        return view('department.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = Department::find($id);
            $data->name = $request->name;
            $data->email = $request->email;
            $data->contact = $request->contact;
            $data->save();
            DB::commit();
            return response()->json(['status' => true, 'msg' => 'Department updated successfully.', 'url' => route('department.index')]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $data = Department::find($id);
            $data->is_deleted = 1;
            $data->save();
            DB::commit();
            return redirect()->route('department.index')->with('success', 'Department deleted successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('department.index')->with('error', $th->getMessage());
        }
    }

    public function AddDepartment(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = new Department();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->contact = $request->contact;
            $data->created_by = auth()->id();
            $data->save();
            DB::commit();
            return response()->json(['status' => true, 'data' => $data]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
        }
    }

    public function import(Request $request)
    {
        try {
            $request->validate([
                'excel_file' => 'required|mimes:xlsx,xls,csv'
            ]);
            Excel::import(new DepartmentImport, $request->file('excel_file'));
            return response()->json(['status' => true, 'msg' => 'Department importing successfully in background.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
        }
    }
}
