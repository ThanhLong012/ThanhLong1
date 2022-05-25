<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\StoryCategory;
use App\Models\Story;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Chapter;
use Auth;
use Illuminate\Support\Str;


class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stories = Story::orderBy('id', 'DESC')->get();
        $chapters = Chapter::all();
        
        return view('admincp.story.index', compact('stories', 'chapters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        $genres = Genre::all();
        return view('admincp.story.create', compact('authors', 'categories', 'genres'));
        
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
            'name'=>'required',
            'image' => 'required',
            'content' => 'required',
            'source' => 'required',
            'keyword' => 'required',
            'author_id' => 'required',
            'category_id' => 'required',
            'genre_id' => 'required',

        ],
        [
            'name.required' =>'Tên truyện không được để trống',
            'keyword.required' =>'Từ khóa không được để trống',
            'image.required' =>'Hình ảnh không được để trống',
            'content.required' =>'Nội dung không được để trống',
            'source.required' =>'Nguồn truyện không được để trống',
            'author_id.required' =>'Tác giả không được để trống',
            'category_id.required' =>'Danh mục không được để trống',
            'genre_id.required' =>'Thể loại không được để trống',

        ]);
        $story = new Story;
        $story->name = $request->name;
        $story->user_id = Auth::id();
        $story->author_id = $request->author_id;
        $story->name = $request->name;
        $story->slug = str::slug($request->name);
        $story->source = $request->source;
        $story->content = $request->content;
        $story->keyword = $request->keyword;
        $story->status = $request->status;
        $story->hot = $request->hot;

        // Thêm ảnh
        $get_image = $request->image;
        $path = 'public/uploads/story/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);
        $story->image = $new_image;
        $story->save();
        $story->categories()->attach($request->category_id);
        $story->genres()->attach($request->genre_id);
        return redirect()->back()->with('message', 'Thêm truyện thành công');
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
        $story = Story::find($id);
        $authors = Author::all();
        $categories = Category::all();
        $genres = Genre::all();
        $story_categories = $story->categories;
        $story_genres = $story->genres;
        return view('admincp.story.edit', compact('story', 'authors', 'categories', 'story_categories', 'story_genres'));

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
            'content' => 'required',
            'source' => 'required',
            'keyword' => 'required',
            'author_id' => 'required',
            'category_id' => 'required',
            'genre_id' => 'required',
        ],
        [
            'name.required' =>'Tên truyện không được để trống',
            'keyword.required' =>'Từ khóa không được để trống',   
            'content.required' =>'Nội dung không được để trống',
            'source.required' =>'Nguồn truyện không được để trống',
            'author_id.required' =>'Tác giả không được để trống',
            'category_id.required' =>'Danh mục không được để trống',
            'genre_id.required' =>'Thể loại không được để trống',
        ]);
        $story = Story::find($id);
        $story->categories()->sync($request->category_id);
        $story->name = $request->name;
        $story->user_id = Auth::id();
        $story->author_id = $request->author_id;
        $story->name = $request->name;
        $story->slug = str::slug($request->name);
        $story->source = $request->source;
        $story->content = $request->content;
        $story->keyword = $request->keyword;
        $story->status = $request->status;
        $story->hot = $request->hot;
        $story->categories()->sync($request->category_id);
        $story->genres()->sync($request->genre_id);
        // Thêm ảnh
        $get_image = $request->image;
        if($get_image){
            $path = 'public/uploads/story/'.$story->image;
            if(file_exists($path)){
                unlink($path);
            }
            $path = 'public/uploads/story/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $story->image = $new_image;
        }
        $story->save();
        return redirect()->back()->with('message', 'Cập nhật truyện thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $story = Story::find($id);
        $path = 'public/uploads/story/'.$story->image;
        if(file_exists($path)){
            unlink($path);
        }
        $story->categories()->detach($story->category_id);
        $story->genres()->detach($story->genre_id);
        // $chapter = Chapter::whereIn('story_id',$id)->get();
        // if($chapter->count()>0){
        //     $chapter->delete();
        // }
        Story::find($id)->delete();
        return redirect('story')->with('message', 'Xóa truyện thành công!');

    }
}
