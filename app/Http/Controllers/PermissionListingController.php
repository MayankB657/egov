<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class PermissionListingController extends Controller
{
    public function index(Request $request)
    {
        $RoleList = Role::all();
        $searchQuery = $request->input('search');
        $data = Permission::where(function ($query) use ($searchQuery) {
            if (!empty($searchQuery)) {
                $query->where('permissions.controller', 'like', '%' . $searchQuery . '%')
                    ->orWhere('permissions.name', 'like', '%' . $searchQuery . '%');
            }
        })->orderBy('id', 'desc')->paginate(10);
        $i = (request()->input('page', 1) - 1) * 10;
        if ($request->ajax()) {
            $view = view('permission-listing.row', compact('data', 'i'))->render();
            $pagination = $data->appends($request->except('page'))->links()->toHtml();
            return response()->json(['html' => $view, 'pagination' => $pagination, 'i' => $i]);
        }
        return view('permission-listing.index', compact('data', 'RoleList'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            if (isset($request->resource) && $request->resource == 'on') {
                $resource = [
                    $request->permission_name . '.index',
                    $request->permission_name . '.create',
                    $request->permission_name . '.store',
                    $request->permission_name . '.edit',
                    $request->permission_name . '.update',
                    $request->permission_name . '.destroy',
                    $request->permission_name . '.show'
                ];
                foreach ($resource as $key => $value) {
                    $Res_permission = new Permission();
                    $Res_permission->name = $value;
                    $Res_permission->controller = $request->controller_name;
                    $Res_permission->save();
                    $Res_permission->syncRoles($request->roles);
                }
            } else {
                $permission = new Permission();
                $permission->name = $request->permission_name;
                $permission->controller = $request->controller_name;
                if ($permission->save()) {
                    $permission->syncRoles($request->roles);
                }
            }
            DB::commit();
            return response()->json(['status' => true,'msg'=>'Record has been updated']);
            // return redirect()->route('permission-listing.index')->with('success', 'Record has been updated');
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
            // return redirect()->route('permission-listing.index')->with('error', 'Dont insert duplicate Permission');
        }
    }

    public function edit($id)
    {
        $data = Permission::find($id);
        return view('permission-listing.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Permission::find($id);
        $data->controller = $request->controller;
        $data->name = $request->name;
        if ($data->save()) {
            return redirect()->route('permission-listing.index')->with('success', 'Record updated successfully.');
        } else {
            return redirect()->route('permission-listing.edit', $id)->with('error', 'Something went to wrong, please try again!.');
        }
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return redirect()->back()->with('success', 'Permissions deleted successfully.');
    }
}
