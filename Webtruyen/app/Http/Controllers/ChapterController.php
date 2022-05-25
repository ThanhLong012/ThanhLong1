<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\Chapter;
use App\Models\Viewed;
use Carbon\Carbon;
use Illuminate\Support\Str;


class ChapterController extends Controller
{
    public function index()
    {
        $chapters = Chapter::orderBy('id', 'DESC')->get();
        return view('admincp.chapter.index', compact('chapters'));

    }
    public function show($slug)
    {
        $story = Story::where('slug', $slug)->first();
        $chapters = Chapter::where('story_id', $story->id)->get();
        return view('admincp.chapter.list', compact('story', 'chapters'));
    }

    public function create($id)
    {
        $story = Story::find($id);
        $list_chapter = Chapter::where('story_id', $id)->get();
        $count = $list_chapter->count();
        return view('admincp.chapter.create', compact('story', 'count'));
    }
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required',
        ],
        [
            'content.required' =>'Nội dung không được để trống',
            

        ]);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        
       
        $data = $request->all();
        $chapter = new Chapter;
        $chapter->story_id = $id;
        $chapter->name = $data['name'];
        $chapter->subname = $data['subname'];
        $chapter->slug = str::slug($data['name']);
        $chapter->created_at = $today;
        $chapter->content = $data['content'];

        $chapter->save();

        return redirect()->back()->with('message', 'Thêm chương mới thành công');
    }
    public function edit($id)
    {
        $chapter = Chapter::find($id);
        return view('admincp.chapter.edit', compact('chapter'));

    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required',
        ],
        [
            'content.required' =>'Nội dung không được để trống',
        ]);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $chapter = Chapter::find($id);
        $chapter->name = $request->name;
        $chapter->subname = $request->subname;
        $chapter->slug = str::slug($request->name);
        $chapter->updated_at = $today;
        $chapter->content = $request->content;
        $chapter->save();

        return redirect('chapter')->with('message', 'Cập nhật chương truyện thành công');
    }
    public function destroy($id)
    {
        $chapter = Chapter::find($id)->delete();
        Viewed::where('chapter_id', $chapter->id)->delete();
        return redirect('chapter')->with('message', 'Xóa chương truyện thành công!');

    }

}
