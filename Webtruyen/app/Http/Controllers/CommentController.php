<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Story;
use App\Models\Chapter;
use App\Models\Author;
use App\Models\Category;
use App\Models\Genre;
use App\Models\StoryCategory;
use App\Models\StoryGenre;
use App\Models\Rating;
use App\Models\Viewer;
use App\Models\Comment;

use App\Http\Requests\RequestLogin;

use Session;
session_start();

class CommentController extends Controller
{
    public function reply_comment(Request $request, $story_id){
        $data = $request->all();
        $user = Session::get('user');
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->story_id = $story_id;
        $comment->parent_id = $request->comment_id;
        $comment->viewer_id = $user->id;
        $comment->save();
        return redirect()->back()->with('message', 'Trả lời bình luận thành công');
    }


    public function send_comment(Request $request){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
            
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        
        $comment = new Comment();
        $user = Session::get('user');
        $comment->content = $request->content;
        $comment->story_id = $request->story_id;
        $comment->created_at = $today;
        $comment->viewer_id = $user->id;
        $comment->save();
    }
}
