<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Components\Recusive;

class PermissionController extends Controller
{
    public function getModule($parent_id)
    {  
        $data = Permission::all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->Recusive($parent_id);
        return $htmlOption;
    }
    public function create()
    {
        $htmlOption = $this->getModule($parent_id = '');
        return view('admincp.permission.add', compact('htmlOption'));
    }
    public function create_module(Request $request)
    {
        $data = $request->all();
        Permission::create([
            'name' => $data['name'],
        ]);
    }
    public function save(Request $request)
    {
        $module = Permission::find($request->parent_id);
        foreach($request->module_children as $value){
            Permission::create([
                'name' => $module->name.' '.$value,
                'parent_id' => $request->parent_id,     
            ]);
        }
        return redirect('permission')->with('message', 'Thêm quyền thành công');
    }

}
