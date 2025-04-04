<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function index()
    {
        $Role = Role::with('permissions')->paginate(10);
        $Permissions = Permission::with('roles')->get();
        $roleUserCounts = [];
        foreach ($Role as $role) {
            $roleUserCounts[$role->name] = User::role($role->name)->count();
        }
        return view('role-permission.index', compact('Role', 'Permissions', 'roleUserCounts'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required|unique:roles,name|max:255',
        ], [
            'role.unique' => 'Role already exists',
            'role.required' => 'Role name is required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => false]);
        }
        $role = Role::create(['name' => $request->role]);
        addLog(request()->getMethod(), request()->getRequestUri(), 200, 'Role created: ' . $request->role);
        return response()->json(['status' => true, 'msg' => 'Role created successfully']);
    }

    public function edit(Request $request, $id)
    {
        $Roles = Role::find($id);
        $rolePermission = $Roles->permissions;
        $PermissionArray[] = NULL;
        if ($rolePermission->first() != NULL) {
            $PermissionArray = $rolePermission->pluck('id')->toArray();
        }
        $AllPermission = Permission::whereNotNull('controller')->select('controller')
            ->selectRaw("CONCAT('[', GROUP_CONCAT(CASE WHEN permissions.controller IS NOT NULL THEN JSON_OBJECT('id',permissions.id,'name',permissions.name) END), ']') AS permission")
            ->groupBy('permissions.controller')
            ->get();
        return view('role-permission.edit', compact('AllPermission', 'Roles', 'PermissionArray',));
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->RoleName;
        if ($role->save()) {
            $ReqPermission = $request->permission;
            if (!isset($ReqPermission)) {
                $ReqPermission[] = NULL;
            }
            $permissions = Permission::whereIn('id', $ReqPermission)->get();
            $role->syncPermissions($permissions);
            return redirect()->route('role-permission.index')->with('success', 'Record has been updated');
        } else {
            return redirect()->route('role-permission.create')->with('error', 'Something went wrong');
        }
    }

    public function show(Request $request, $id)
    {
        $searchQuery = $request->input('search');
        $Roles = Role::with('permissions')->find($id);
        $users = User::role($Roles->name)
            ->where(function ($query) use ($searchQuery) {
                if (!empty($searchQuery)) {
                    $query->where('name', 'LIKE', '%' . $searchQuery . '%')
                        ->orWhere('email', 'LIKE', '%' . $searchQuery . '%');
                }
            })
            ->orderBy('id', 'desc')->paginate(10);
        if ($request->ajax()) {
            $view = view('role-permission.row', compact('users'))->render();
            $pagination = $users->appends($request->except('page'))->links()->toHtml();
            return response()->json(['html' => $view, 'pagination' => $pagination]);
        }
        return view('role-permission.view', compact('Roles', 'users'));
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->syncPermissions([]);
        $role->delete();
        addLog(request()->getMethod(), request()->getRequestUri(), 200, 'Role deleted: ' . $role->name);
        return redirect()->route('role-permission.index')->with('success', 'Role and its permissions deleted successfully.');
    }
}
