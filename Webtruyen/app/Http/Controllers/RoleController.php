<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Traits\Delete;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admincp.role.index', compact('roles'));
    }
    public function create()
    {
        $permissionParent = Permission::where('parent_id', 0)->get();
        return view('admincp.role.add', compact('permissionParent'));
    }
    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);
        $data = $request->all();
        $roles= $role->syncPermissions($data['permission_id']);
        return redirect('role/create')->with('message', 'Thêm vai trò thành công');
    }
    public function edit($id)
    {
        $permissionParent = Permission::where('parent_id', 0)->get();
        $role = Role::find($id);
        $permissionChecked = $role->permissions;
        return view('admincp.role.edit', compact('permissionParent', 'role', 'permissionChecked'));
    }
    public function update(Request $request, $id)
    {
        Role::find($id)->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);
        $role = Role::find($id);
        $data = $request->all();
        $roles= $role->syncPermissions($data['permission_id']);
        return redirect('role')->with('message', 'Update vai trò thành công');
    }
    public function destroy($id)
    {
        $role = Role::find($id)->delete();
        return redirect('role')->with('message', 'Xóa vai trò thành công');
        
    }
}
