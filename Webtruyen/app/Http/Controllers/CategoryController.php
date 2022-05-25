<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\Recusive;
use Illuminate\Support\Str;
use App\Models\Category;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('admincp.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategory($parent_id)
    {
        $data = Category::all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->Recusive($parent_id);
        return $htmlOption;
    }
    public function create()
    {
        $htmlOption = $this->getCategory($parent_id = '');
        return view('admincp.category.create', compact('htmlOption'));
        
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
            'name'=>'required|unique:categories',
            'description' => 'required',
            'keyword' => 'required',

        ],
        [
            'name.required' =>'Tên danh mục không được để trống',
            'name.unique' =>'Tên danh mục đã tồn tại',
            'description.required' =>'Mô tả không được để trống',
            'keyword.required' =>'Từ khóa không được để trống',

        ]);
        $category = new Category;
        $category->name = $request->name;
        $category->slug = str::slug($request->name);
        $category->description = $request->description;
        $category->keyword = $request->keyword;
        $category->parent_id = $request->parent_id;
        $category->status = $request->status;
        $category->save();
        return redirect()->back()->with('message', 'Thêm danh mục thành công');
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
        $category = Category::find($id);
        $htmlOption = $this->getCategory($category->parent_id);
        return view('admincp.category.edit', compact('htmlOption', 'category'));
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
            'name'=>'required',
            'description' => 'required',
            'keyword' => 'required',

        ],
        [
            'name.required' =>'Tên danh mục không được để trống',
            'description.required' =>'Mô tả không được để trống',
            'keyword.required' =>'Từ khóa không được để trống',

        ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = str::slug($request->name);
        $category->description = $request->description;
        $category->keyword = $request->keyword;
        $category->parent_id = $request->parent_id;
        $category->status = $request->status;
        $category->save();
        return redirect('category')->with('message', 'Cập nhật danh mục thành công');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id)->delete();
        return redirect('category')->with('message', 'Xóa danh mục thành công!');
    }
}
