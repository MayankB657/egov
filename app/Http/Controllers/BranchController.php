<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $data = Branch::where('is_deleted', 0)
            ->where(function ($query) use ($searchQuery) {
                if (!empty($searchQuery)) {
                    $query->where('branch.name', 'like', '%' . $searchQuery . '%')
                        ->orWhere('branch.contact', 'like', '%' . $searchQuery . '%')
                        ->orWhere('branch.address', 'like', '%' . $searchQuery . '%')
                        ->orWhere('branch.email', 'like', '%' . $searchQuery . '%');
                }
            })->orderBy('id', 'desc')->paginate(10);
        $i = (request()->input('page', 1) - 1) * 10;
        if ($request->ajax()) {
            $view = view('branch.row', compact('data', 'i'))->render();
            $pagination = $data->appends($request->except('page'))->links()->toHtml();
            return response()->json(['html' => $view, 'pagination' => $pagination, 'i' => $i]);
        }
        return view('branch.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $departments = Department::where('is_deleted', 0)->get();
        return view('branch.create', compact('departments'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = new Branch();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->contact = $request->contact;
            $data->address = $request->address;
            $data->department_id = $request->department_id;
            $data->created_by = auth()->id();
            $data->save();
            DB::commit();
            return response()->json(['status' => true, 'msg' => 'Branch created successfully.', 'url' => route('branch.index')]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
        }
    }

    public function edit($id)
    {
        $id = base64UrlDecode($id);
        $data = Branch::find($id);
        $departments = Department::where('is_deleted', 0)->get();
        return view('branch.edit', compact('departments', 'data'));
    }

    public function update(Request $request, $id)
    {
        $id = base64UrlDecode($id);
        try {
            DB::beginTransaction();
            $data = Branch::find($id);
            $data->name = $request->name;
            $data->email = $request->email;
            $data->contact = $request->contact;
            $data->address = $request->address;
            $data->department_id = $request->department_id;
            $data->save();
            DB::commit();
            return response()->json(['status' => true, 'msg' => 'Branch updated successfully.', 'url' => route('branch.index')]);
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
            $data = Branch::find($id);
            $data->is_deleted = 1;
            $data->save();
            DB::commit();
            return redirect()->back()->with('success', 'Branch deleted successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function AddBranch(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = new Branch();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->contact = $request->contact;
            $data->address = $request->address;
            $data->department_id = $request->department_id;
            $data->created_by = auth()->id();
            $data->save();
            DB::commit();
            return response()->json(['status' => true, 'data' => $data]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
        }
    }
}
