<?php

namespace App\Http\Controllers;

use App\Models\PermissionCategory;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;


class UserManagementController extends Controller
{
    public function userRoleLists()
    {
        $role_permissions = Role::with('permissions')->get();
        // return $role_permissions;
        return view('backend.user_role_list', compact('role_permissions'));
    }
    public function userRole(Request $request)
    {
        if ($request->role) {
            $role = Role::findByName($request->role);
            $permissions = $role->getPermissionNames()->toArray();
        } else {
            $role = [];
            $permissions = [];
        }
        $permissionCategory = PermissionCategory::orderBy('type')->get();
        $permissionCategorys = $permissionCategory->groupBy('type');
        return view('backend.user_role', compact('permissionCategorys', 'permissions', 'role'));
    }

    public function UserRoleUpdate(Request $request)
    {
        // return true;
        $role = Role::where('name', $request->role)->firstOrNew();
        $role->name = $request->role;
        $role->save();
        $role->syncPermissions($request->permission);
        // return redirect()->route('user.user-create');
        return response()->json([
            'status' => 'success',
            'user_list_url' => route('admin.user_role_list'),
            'message' => 'User Roll Complete Successfully',
        ]);
    }
}
