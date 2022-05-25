<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $information = Information::orderBy('id', 'DESC')->get();
        return view('admincp.information.index', compact('information'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.information.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=>'required',
            'logo' => 'required',
            'description' => 'required',
            'copyright' => 'required',

        ],
        [
            'title.required' =>'Tiêu đề không được để trống',
            'logo.required' =>'Logo không được để trống',
            'description.required' =>'Mô tả không được để trống',
            'copyright.required' =>'Copyright không được để trống',

        ]);

        $infor = new Information;
        $infor->title = $request->title;
        $infor->description = $request->description;
        $infor->copyright = $request->copyright;
        $infor->status = $request->status;
      
        // Thêm ảnh
        $get_image = $request->logo;
        $path = 'public/uploads/story/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);
        $infor->logo = $new_image;
        $infor->save();

        return redirect('information')->with('message', 'Thêm thông tin website thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = Information::find($id);
        return view('admincp.information.edit', compact('info'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'=>'required',
            'description' => 'required',
            'copyright' => 'required',

        ],
        [
            'title.required' =>'Tiêu đề không được để trống',
            'description.required' =>'Mô tả không được để trống',
            'copyright.required' =>'Copyright không được để trống',

        ]);
        $info = Information::find($id);
        $info->title = $request->title;
        $info->description = $request->description;
        $info->copyright = $request->copyright;
        $info->status = $request->status;
        $get_image = $request->logo;
        if($get_image){
            $path = 'public/uploads/story/'.$info->image;
            if(file_exists($path)){
                unlink($path);
            }
            $path = 'public/uploads/story/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $info->logo = $new_image;
        }
        $info->save();
        return redirect('information')->with('message', 'Cập nhật thông tin website thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $infor = Information::find($id);
        $path = 'public/uploads/story/'.$infor->logo;
        if(file_exists($path)){
            unlink($path);
        }
        Information::find($id)->delete();
        return redirect('information')->with('message', 'Xóa thành công!');
    }
}
