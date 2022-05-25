<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admincp.user.index', compact('users'));
    }
    public function create()
    {
        $roles = Role::all();
        return view('admincp.user.add', compact('roles'));
    }
    public function store(Request $request)
    {
        $dataInsert = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        $user = User::create($dataInsert);
        $data = $request->all();
        $user->assignRole($data['role_id']);

        return redirect('user/create')->with('message', 'Thêm user thành công');
    }
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $roleOfUser = $user->roles;
        return view('admincp.user.edit', compact('user', 'roles', 'roleOfUser' ));
    }
    public function update(Request $request, $id)
    {
        $dataUpdate = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        User::find($id)->update($dataUpdate);
        $user = User::find($id);
        $data = $request->all();
        $user->syncRoles($data['role_id']);
        return redirect('user')->with('message', 'Update user thành công');
    }
    public function delete($id)
    {
        $user = User::find($id)->delete();

        return redirect('user')->with('message', 'Xóa user thành công');
    }

}
