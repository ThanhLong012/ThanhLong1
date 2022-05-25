<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\Recusive;
use Illuminate\Support\Str;
use App\Models\Genre;
class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::orderBy('id', 'DESC')->get();
        return view('admincp.genre.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getGenre($parent_id)
    {
        $data = Genre::all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->Recusive($parent_id);
        return $htmlOption;
    }
    public function create()
    {
        $htmlOption = $this->getGenre($parent_id = '');
        return view('admincp.genre.create', compact('htmlOption'));
        
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
            'name'=>'required|unique:genres',
            'description' => 'required',
            'keyword' => 'required',

        ],
        [
            'name.required' =>'Tên thể loại không được để trống',
            'name.unique' =>'Tên thể loại đã tồn tại',
            'description.required' =>'Mô tả không được để trống',
            'keyword.required' =>'Từ khóa không được để trống',

        ]);
        $genre = new Genre;
        $genre->name = $request->name;
        $genre->slug = str::slug($request->name);
        $genre->description = $request->description;
        $genre->keyword = $request->keyword;
        $genre->parent_id = $request->parent_id;
        $genre->status = $request->status;
        $genre->save();
        return redirect()->back()->with('message', 'Thêm thể loại thành công');
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
        $genre = Genre::find($id);
        $htmlOption = $this->getGenre($genre->parent_id);
        return view('admincp.genre.edit', compact('htmlOption', 'genre'));
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
            'name.required' =>'Tên thể loại không được để trống',
            'description.required' =>'Mô tả không được để trống',
            'keyword.required' =>'Từ khóa không được để trống',

        ]);
        $genre = Genre::find($id);
        $genre->name = $request->name;
        $genre->slug = str::slug($request->name);
        $genre->description = $request->description;
        $genre->keyword = $request->keyword;
        $genre->parent_id = $request->parent_id;
        $genre->status = $request->status;
        $genre->save();
        return redirect('genre')->with('message', 'Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $genre = Genre::find($id)->delete();
        return redirect('genre')->with('message', 'Xóa danh mục thành công!');
    }
}
