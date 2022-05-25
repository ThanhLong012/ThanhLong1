<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::orderBy('id', 'DESC')->get();
        return view('admincp.author.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.author.create');
        
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
            'name'=>'required|unique:authors',
            'description' => 'required',
            'keyword' => 'required',
        ],
        [
            'name.required' =>'Tên tác giả không được để trống',
            'name.unique' =>'Tên tác giả đã tồn tại',
            'description.required' =>'Mô tả không được để trống',
            'keyword.required' =>'Từ khóa không được để trống',

        ]);
        $author = new Author;
        $author->name = $request->name;
        $author->slug = str::slug($request->name);
        $author->description = $request->description;
        $author->keyword = $request->keyword;
        $author->save();
        return redirect()->back()->with('message', 'Thêm tác giả thành công');
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
        $author = Author::find($id);
        return view('admincp.author.edit', compact('author'));
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
            'name.required' =>'Tên tác giả không được để trống',
            'description.required' =>'Mô tả không được để trống',
            'keyword.required' =>'Từ khóa không được để trống',

        ]);
        $author = Author::find($id);
        $author->name = $request->name;
        $author->slug = str::slug($request->name);
        $author->description = $request->description;
        $author->keyword = $request->keyword;
        $author->save();
        return redirect('author')->with('message', 'Cập nhật tác giả thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Author::find($id)->delete();
        return redirect('author')->with('message', 'Xóa tác giả thành công!');
    }
}
