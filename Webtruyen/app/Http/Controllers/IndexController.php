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
use App\Models\Viewed;
use App\Models\Comment;
use Illuminate\Support\Str;

use App\Http\Requests\RequestLogin;

use Session;
session_start();

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh');
		Session::put('today',$today->toDayDateTimeString());

        // SEO
        $meta_desc = 'Đọc truyện online, truyện hay';
        $meta_keywords = 'Truyện ngôn tình,truyện đam mỹ,tiểu thuyết';
        $meta_title = 'Đọc truyện online';
        $url_canonical = $request->url();

        $categories = Category::orderBy('name', 'ASC')->get();
        $genres = Genre::orderBy('name', 'ASC')->get();
        $new_update = Chapter::orderBy('created_at', 'DESC')->take(25)->get();
        $story_full = Story::where('status', '1')->orderBy('id', 'DESC')->take(12)->get();
        $chapters = Chapter::all();

        $user = Session::get('user');
        $story_viewed = '';
        if($user != null){
            $story_viewed = Viewed::where('viewer_id', $user->id)->orderby('id', 'DESC')->get();
        }
        
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if($sort_by=='kytu_za'){
                $story_full = Story::where('status', '1')->orderBy('name', 'DESC')->paginate(12)->appends(request()->query());
            }elseif($sort_by=='kytu_az'){
                $story_full = Story::where('status', '1')->orderBy('name', 'ASC')->paginate(12)->appends(request()->query());
            }

        }else{
            $story_full = Story::where('status', '1')->orderBy('id', 'DESC')->paginate(12);
        }

        return view('pages.home', compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'categories', 
        'genres', 'new_update', 'story_full', 'story_viewed', 'chapters'));

    }
    public function danh_sach(Request $request, $slug)
    {
        $meta_desc = 'Đọc truyện online, truyện hay';
        $meta_keywords = 'Truyện ngôn tình,truyện đam mỹ,tiểu thuyết';
        $meta_title = 'Đọc truyện online';
        $url_canonical = $request->url();
        
        $category = Category::where('slug', $slug)->first();
        $story_categories = StoryCategory::where('category_id', $category->id)->orderBy('id','DESC')->paginate(12);
        $story_hot = Story::where('hot','1')->orderby('view','DESC')->take(10)->get();

        return view('pages.category', compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'category', 'story_hot', 
        'story_categories'));
    }
    public function the_loai(Request $request, $slug)
    {
        $meta_desc = 'Đọc truyện online, truyện hay';
        $meta_keywords = 'Truyện ngôn tình,truyện đam mỹ,tiểu thuyết';
        $meta_title = 'Đọc truyện online';
        $url_canonical = $request->url();
        
        $genre = Genre::where('slug', $slug)->first();
        $story_genres = StoryGenre::where('genre_id', $genre->id)->paginate(12);

        $story_hot_genre = StoryGenre::where('genre_id', $genre->id)->take(10)->get();
        return view('pages.genre', compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'genre', 'story_hot_genre', 
        'story_genres'));
    }
    public function truyen(Request $request, $slug)
    {
        $meta_desc = 'Đọc truyện online, truyện hay';
        $meta_keywords = 'Truyện ngôn tình,truyện đam mỹ,tiểu thuyết';
        $meta_title = 'Đọc truyện online';
        $url_canonical = $request->url();
        
        $story = Story::where('slug', $slug)->first();
        $story->view = $story->view + 1;
        $story->save();
        $author_id = $story->author_id;
        $related_story = Story::where('author_id', $author_id)->whereNotIn('slug', [$slug])->take(6)->get();
        $story_hot = Story::where('hot','1')->orderby('view','DESC')->take(10)->get();

        $rate = Rating::where('story_id', $story->id)->avg('rating');
        $rate = round($rate, 1);
        $count_rating = Rating::where('story_id', $story->id)->count();
        $rating = round($rate);
        $chapters = Chapter::where('story_id', $story->id)->paginate(20);
        $new_chapter = Chapter::where('story_id', $story->id)->orderby('id', 'DESC')->take(5)->get();

        $comment = Comment::where('story_id',$story->id)->where('parent_id', 0)->get();
        
        $comment_rep = Comment::where('story_id',$story->id)->where('parent_id','>',0)->get();
        $count_comment = Comment::where('story_id',$story->id)->get();
        $length = count($count_comment);
        return view('pages.story', compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'story', 'related_story', 'story_hot',
                    'rating', 'count_rating', 'chapters', 'rate', 'comment', 'length', 'comment_rep', 'new_chapter'));
    }
    public function chapter(Request $request, $story, $slug)
    {
        $meta_desc = 'Đọc truyện online, truyện hay';
        $meta_keywords = 'Truyện ngôn tình,truyện đam mỹ,tiểu thuyết';
        $meta_title = 'Đọc truyện online';
        $url_canonical = $request->url();
        
        $story = Story::where('slug', $story)->first();
        $chapter = Chapter::where('story_id', $story->id)->where('slug', $slug)->first();
        $chapter->view = $chapter->view + 1;
        $chapter->save();
        
        $user = Session::get('user');
        if($user != null){
            $story_viewed = Viewed::where('viewer_id', $user->id)->where('story_id', $story->id)->orderby('id', 'DESC')->get();
            if ($story_viewed->count() > 0) {
                foreach ($story_viewed as $item) {
                    Viewed::where(['viewer_id' => $user->id, 'story_id' => $story->id])->update([
                        'chapter_id' => $chapter->id
                    ]);
                }
            }else{
                $viewed = new Viewed;
                $viewed->story_id = $story->id;
                $viewed->chapter_id = $chapter->id;
                $viewed->viewer_id = $user->id;
                $viewed->save();
            }
        }
       
        $list_chapter = Chapter::where('story_id', $story->id)->get();

        $next_chapter = Chapter::where('story_id',$story->id)->where('id','>',$chapter->id)->min('slug');

    	$max_id =  Chapter::where('story_id',$story->id)->orderBy('id','DESC')->first();
    	$min_id =  Chapter::where('story_id',$story->id)->orderBy('id','ASC')->first();
    	
    	$previous_chapter = Chapter::where('story_id',$story->id)->where('id','<',$chapter->id)->max('slug');

        return view('pages.chapter', compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'story', 
        'chapter', 'list_chapter', 'next_chapter','max_id', 'min_id','previous_chapter' ));
    }
    public function insert_rating(Request $request)
    {
        $rating = new Rating();
        $rating->story_id = $request->story_id;
        $rating->rating = $request->index;
        $rating->save();
        echo "done";
    }
    public function tac_gia(Request $request, $slug)
    {
        $meta_desc = 'Đọc truyện online, truyện hay';
        $meta_keywords = 'Truyện ngôn tình,truyện đam mỹ,tiểu thuyết';
        $meta_title = 'Đọc truyện online';
        $url_canonical = $request->url();
        
        $author = Author::where('slug', $slug)->first();
        $list_story = Story::where('author_id', $author->id)->paginate(12);
        $story_hot = Story::where('hot','1')->orderby('view','DESC')->take(10)->get();
    
        return view('pages.author', compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'author', 'story_hot', 
        'list_story'));
    }
    public function load_more(Request $request){
        $data = $request->all();
        if($data['id']>0){
            $story_hot = Story::where('hot','1')->where('id','<',$data['id'])->orderby('id','DESC')->take(12)->get(); 
        }else{
            $story_hot = Story::where('hot','1')->orderby('id','DESC')->take(12)->get(); 
        }
        $output ='';
        if(!$story_hot->isEmpty()){
            $output.= '
            <div class="tab-pane active show fade" id="fresh_fruit" role="tabpanel">
                <div class="row">
    
            ';
           
            foreach($story_hot as $key => $sto){
                $last_id = $sto->id;
                if($sto->status == 0){
                    $status = "New";
                }elseif($sto->status ==1){
                    $status = "Full";
                }else{
                    $status = "Drop";
                }
                
                
                $output.='
                <div class="col-lg-2">
                <div class="single__story">
                    <div class="single_story__inner">
                        <span class="new_badge">'.$status.'</span>
                        '; 
                        if ($sto->hot ==1){
                            
                            $output.='<div class="hot">Hot</div>';
                        }
                        $output.='
                        <div class="story_img">
                        <a href="'.route('story', $sto->slug).'">
                             <img src="'.asset('public/uploads/story/'.$sto->image).'" alt="">
                        </a>
                        </div>
                        <div class="story__content text-center">
                            <div class="story_desc_info">
                                <div class="story_title">
                                    <h4><a href="'.route('story', $sto->slug).'">'. $sto->name.'</a></h4>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                
            }

            $output.= '
        </div>
        </div>';
             $output .= '
             
                <div id="load_more" >
                    <button type="button" name="load_more_button" class="btn btn-primary form-control" data-id="'.$last_id.'" id="load_more_button">Xem thêm
                    </button>
                </div>
            ';
        }else{
            $output .= '
                <div id="load_more" >
                    <button type="button" name="load_more_button" class="btn btn-default form-control">Dữ liệu đang cập nhật thêm...
                    </button>
                </div>
            ';
        }
        echo $output;
    }

    // Đăng ký, đăng nhập
    public function dang_ky(Request $request)
    {
        $meta_desc = 'Đọc truyện online, truyện hay';
        $meta_keywords = 'Truyện ngôn tình,truyện đam mỹ,tiểu thuyết';
        $meta_title = 'Đọc truyện online';
        $url_canonical = $request->url();
        return view('pages.register', compact('meta_desc', 'meta_keywords', 'meta_title','url_canonical'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password'=>'required|min:6|max:32',
            'passwordAgain'=>'required|same:password',
            
        ],
        [
            'name.required' =>'Họ tên không được để trống!',
            'email.required' =>'Email không được để trống!',
            'password.required' =>'Mật khẩu không được để trống!',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.max' => 'Mật khẩu chỉ được tối đa 32 ký tự',
            'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same'=> 'Mật khẩu nhập lại không đúng',
        ]);
        $dataInsert = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => md5($request->password),
        ];
        $viewer = Viewer::create($dataInsert);
        Session::put('user_id',$viewer->id);
        Session::put('viewer',$viewer);
        return redirect('/dang-nhap')->with('message', 'Thêm tài khoản thành công');
    }

    public function dang_nhap(Request $request)
    {
        $meta_desc = 'Đăng nhập';
        $meta_keywords = 'Đăng nhập';
        $meta_title = 'Đăng nhập';
        $url_canonical = $request->url();
        return view('pages.login', compact('meta_desc', 'meta_keywords', 'meta_title','url_canonical'));

    }
    public function login(RequestLogin $request)
    {
        $remember = $request->has('remember_me') ? true : false;
        $email = $request->email;
        $password = md5($request->password);
        $result = Viewer::where(['email' => $email, 'password' => $password])->first();
        if($result){
            Session::put('user_id',$result->id);
            Session::put('user',$result);

            return redirect('/');
        }else{
            return redirect('/dang-nhap')->with('message', 'Tài khoản hoặc mật khẩu không chính xác!');
        }
    }
    public function logout()
    {
        Session::flush();
        return redirect('/dang-nhap');
    }
   
    public function tim_kiem(Request $request){
        $data = $request->all();
        //seo
        $meta_desc = 'Tìm kiếm truyện';
        $meta_keywords = 'Tìm kiếm truyện';
        $meta_title = 'Tìm kiếm truyện';
        $url_canonical = $request->url();
        //end seo
        $story_hot = Story::where('hot','1')->orderby('view','DESC')->take(10)->get();
        $keyword = $data['tukhoa'];
    	$tukhoa = Str::slug($data['tukhoa']);
    	$author = Author::where('slug','LIKE', $tukhoa)->first();
    	
        $story_author = '';
        $stories = '';
        if(isset($author) && $author != null){
            $story_author = Story::where('author_id', $author->id)->paginate(12);
        }else{
            $stories = Story::where('slug','LIKE','%'.$tukhoa.'%')->orWhere('content','LIKE','%'.$tukhoa.'%')->paginate(12);
        }
    	return view('pages.search', compact('meta_desc','meta_keywords','url_canonical','meta_title','keyword','tukhoa', 
        'stories', 'story_hot', 'story_author'));
    }
    
    public function autocomplete_ajax(Request $request){
        $data = $request->all();
        if ($data['query']) {
            $story = Story::where('name', 'LIKE', '%'.$data['query'].'%')->get();

            $output = '
            <ul class="dropdown-menu" style="display:block;">'
            ;

            foreach ($story as $key => $tr) {
                $output .= '
             <li class="li_search_ajax"><a href="#">'.$tr->name.'</a></li>
             ';
            }

            $output .= '</ul>';
            echo $output;
        }
    }
}
