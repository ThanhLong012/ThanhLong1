@extends('layout')
@section('content')
<div class="breadcrumb_container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">     
                <nav>
            <ul>
                <li>
                    <a href="{{ route('index') }}">Home ></a>
                </li>
                <li>{{ $story->name }}</li>
            </ul>
        </nav>
            </div>
        </div> 
    </div>        
</div>
<div class="shop_wrapper ptb-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="section_title text-left">
                            <h3> Thông tin truyện </h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="single_story__inner inner_shop">
                            <div class="story_img">
                                <a href="#">
                                    <img src="{{ asset('public/uploads/story/'.$story->image) }}" alt="">
                                </a>
                            </div>
                            <div class="story__content text-left">
                                <div class="story_desc_info">
                                    <div class="story_info">
                                        <p><b>Tác giả: </b> {{ $story->author->name }}</p>
                                        <p><b>Thể loại: </b>  @foreach($story->genres as $gen)
                                                        <span style="color:#fff" class="badge badge-info">{{$gen->name}}</span>
                                                    @endforeach</p>
                                        <p><b>Nguồn: </b> {{ $story->source}}</p>
                                        <p><b>Trạng thái: </b> 
                                            @if ($story->status == 0)
                                                <span>Đang cập nhật</span>
                                            @elseif($story->status ==1)
                                                Full
                                            @else
                                                <span>Ngừng cập nhật</span>
                                            @endif</p>

                                    </div>
                                   
                                </div>
                            </div>

                        </div>   
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <div class="product__details_content">
                            <div class="demo_product text-center">
                                <h3>{{ $story->name }}</h3> 
                            </div>
                            <div class="product_comments_block text-center">
                                <div class="star_content clearfix">
                                    <ul class="list-inline rating"  title="Average Rating">
                                        @for($count=1; $count<=10; $count++)
                                        @php
                                            if($count <= $rating){
                                                $color = 'color:#ffcc00;';
                                            }
                                            else {
                                                $color = 'color:#ccc;';
                                            }
                                        
                                        @endphp
                                    
                                    <li title="star_rating" id="{{$story->id}}-{{$count}}" 
                                        data-index="{{$count}}"  
                                        data-story_id="{{$story->id}}" 
                                        data-rating="{{$rating}}" class="rating" 
                                        style="cursor:pointer; {{$color}} font-size:20px;">&#9733;</li>
                                    @endfor
                                        
        
                                    </ul>
                                   
                                    <p style="font-style: italic">Đánh giá {{ $rate }}/10 từ {{ $count_rating }} lượt</p>
                                    <p style="font-style: italic">Lượt xem: {{ $story->view }}</p>
                                </div> 
                                 
                            </div>
                            
                            <div class="product_information">
                                {!! $story->content !!}
                            </div>  
                            <div class="section_title text-left ptb-30">
                                <h3> Các chương mới nhất</h3>
                                <ul class="list_chapter">
                                    @foreach ($new_chapter as $chapter)
                                   
                                    <li class="chapter_item"><a href="{{ route('chapter', [$story->slug,$chapter->slug]) }}"><i style=" margin-right:10px;" class="ti-star"></i>{{ $chapter->name }}  @if ($chapter->subname != null) : @endif {{ $chapter->subname }}</a>
        
                                    </li>
                                    @endforeach
                                    
                                    </ul>  
                            </div>
                            
                        </div>
                    </div>   
                </div>
                <div class="row ptb-30">
                    <div class="col-12">
                        <div class="section_title text-left">
                            <h3> Danh sách chương </h3>
                        </div>
                        <div class="block_chapter">
                            <table class="table table-striped">
                                <tbody>
                                    @foreach ($chapters as $item)
                                    <tr>
                                        <td><a href="{{ route('chapter', [$story->slug,$item->slug]) }}">{{ $item->name }} @if ($item->subname != null) : @endif {{ $item->subname }}</a></td>
                                        <td>{{ $item->created_at->diffForHumans() }}</td>
                                        </tr>
                                        
                                    @endforeach
                                    
                                </tbody>
                            </table>
                             
                          </div>
                          <div class="shop_pagination">
                            <div class="row align-items-center">   
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                   
                                </div>
                                <div class="col-lg-6 offset-lg-2 col-md-6 col-sm-6">
                                    {{$chapters->links('pagination::bootstrap-4')}}         
                                </div>
                            </div>          
                        </div> 
                    </div>
                </div>
                <div class="row ptb-30">
                    <div class="col-12">
                        <div class="section_title text-left">
                            <h3> Danh sách bình luận </h3>
                        </div>
                        <div class="blog_replay_wrapper">
                            <form>
                                {{ csrf_field() }}
                                <input type="hidden" name="comment_story_id" class="comment_story_id" value="{{ $story->id }}">
                                <div id="comment_show"></div>
                            </form>
                            @if(session('message'))
                            <div class="alert alert-success">
                                {{session('message')}}
                            </div>
                            @endif
                            <h4>Có {{ $length }} bình luận</h4>
                            @foreach($comment as $key => $comm)
            
                                <div class="single_blog_replay mb-50">
                                    <div class="replay_img">
                                        <a href="#"><img src="{{  url('/public/img/user.png') }}" alt=""></a>    
                                    </div>
                                    <div class="replay-info-wrapper">
                                        <div class="replay-info">
                                            <div class="replay-name-date">
                                                <h4><a href="#">{{ $comm->viewer->name }}</a></h4>
                                                <span>{{ $comm->created_at }}</span>    
                                            </div>
                                            <div class="replay-btn">
                                                <form action="{{ route('reply_comment', ['story_id' => $story->id]) }}"  method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="comment_id" class="comment_story_id" value="{{ $comm->id }}">
                                                <a href="" data-toggle="collapse" data-target="#Returning_viewer_{{ $comm->id }}" aria-expanded="true" >Reply</a>
                                                <div id="Returning_viewer_{{ $comm->id }}" class="collapse" data-parent="#accordion">
                                                    <textarea class="form-control reply_comment_{{ $comm->id }}" rows="5" cols="50" name="content"></textarea>
                                                    <div class="add_button mt-15">
                                                        <button type="submit" class="btn-reply-comment" >Reply</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>    
                                        </div>
                                        <p>{{ $comm->content }}</p>    
                                    </div>    
                                </div>
                                @foreach($comment_rep as $key => $rep_comment)  
                                    @if($rep_comment->parent_id==$comm->id)  
                                 <div class="single_blog_replay two mb-50">
                                    <div class="replay_img">
                                        <a href="#"><img src="{{  url('/public/img/user.png') }}" alt=""></a>    
                                    </div>
                                    <div class="replay-info-wrapper">
                                        <div class="replay-info">
                                            <div class="replay-name-date">
                                                <h4><a href="#">{{ $rep_comment->viewer->name }}</a></h4>
                                                <span>{{ $rep_comment->created_at }}</span>    
                                            </div>
                                            <div class="replay-btn">
                                                <a href="#">Reply</a>
                                            </div>    
                                        </div>
                                        <p>{{ $rep_comment->content }}</p>    
                                    </div>    
                                </div>
                                @endif
                                @endforeach
                            @endforeach
                            
                        
                        </div>
                        @php
                            $user = Session::get('user');
                        @endphp
                        @if ($user != NULL)
                        <div class="review">
                            <p><a href="#" data-toggle="collapse" data-target="#Returning_viewer" aria-expanded="true">Bình luận</a></p>
                            <div id="Returning_viewer" class="collapse" data-parent="#accordion">
                                <div class="card-bodyfive">
                                    <div class="col-lg-9">
                                        <form action="#"> 
                                            <input type="hidden" name="comment_story_id" class="comment_story_id" value="{{ $story->id }}">
                                            {{ csrf_field() }}
                                            <div class="Returning_cart_body mb-20">
                                                <textarea name="content" class="content" id="" cols="10" rows="5" placeholder="Nội dung bình luận..."></textarea>  
                                            </div> 
                                            <div class="add_button">
                                                <button type="button" data-id_story="{{$story->id}}" class="send-comment" name="comment"> Comment</button>
                                            </div>
                                            <div id="notify_comment"></div>
                                        </form>          
                                    </div>
                                </div>
                            </div>       
                        </div>
                        @else
                        <div class="review">
                            <p class="text text-danger">Đăng nhập để bình luận!</p>       
                        </div>
                        @endif
                          
                        <div class="fb-comments" data-href="{{ URL::current() }}" data-width="100%" data-numposts="10"></div>
                        <div class="fb-like" data-href="{{ URL::current() }}" data-width="" data-layout="button" data-action="like" data-size="small" data-share="true"></div>
                    </div>
                </div>
                
                
            </div>      
            
            @if ($related_story)
                
            @endif
            <div class="col-lg-3 col-md-8 col-12">
                <div class="category_sidebar">
                    @if (isset($related_story) && $related_story != null)
                    <div class="block_categories">
                        <div class="category_top_menu widget">
                            <div class="widget_title">
                                <h3>Truyện cùng tác giả</h3>
                            </div>
                            <ul class="list_toggle">
                               
                                @foreach ($related_story as $item)
                               
                               <li class="category_item"><a href="{{ route('story', $item->slug) }}">{{ $item->name }}</a>
    
                                </li>
                                @endforeach
                                   
                                </ul>   
                        </div>
                    </div>
                    @endif
                   
                    <div class="block_categories">
                        <div class="category_top_menu widget">
                            <div class="widget_title">
                                <h3>Thể loại</h3>
                            </div>
                            <ul class="list_toggle">
                               
                                @foreach ($genres as $item)
                               
                               <li class="category_item"><a href="{{ route('genre', $item->slug) }}">{{ $item->name }}</a>
    
                                </li>
                                @endforeach
                                   
                                </ul>   
                        </div>
                    
                    </div>
                    <div class="block_categories">
                        <div class="category_top_menu widget">
                            <div class="widget_title">
                                <h3>Truyện đang hot</h3>
                            </div>
                            <ul class="list_toggle">
                                @php
                                $i = 0;
                            @endphp
                                @foreach ($story_hot as $item)
                                @php
                                $i++;
                            @endphp
                                <li><a href="{{ route('story', $item->slug) }}"><span class="number_story">{{ $i }}</span>{{ $item->name }}</a>
                                    <p style="font-style: italic;">
                                        @foreach($item->genres as $gen)
                                            {{$gen->name}};
                                        @endforeach
                                    </p>
                                </li>
                                @endforeach
                                   
                                </ul> 
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('.send-comment').click(function(){
            var story_id = $('.comment_story_id').val();
            var content = $('.content').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
              url:"{{url('/send-comment')}}",
              method:"POST",
              data:{story_id:story_id,content:content, _token:_token},
              success:function(data){
                
                $('#notify_comment').html('<span class="text text-success">Bình luận thành công!</span>');
                $('#notify_comment').fadeOut(9000);
                $('.content').val('');
                location.reload()
              }
            });
        });
        
    });
</script>
<script type="text/javascript">
    function remove_background(story_id)
    {
        for(var count = 1; count <= 10; count++)
        {
            $('#'+story_id+'-'+count).css('color', '#ccc');
        }
    }
    //hover chuột đánh giá sao
   $(document).on('mouseenter', '.rating', function(){
      var index = $(this).data("index");
      var product_id = $(this).data('story_id');

      remove_background(story_id);
      for(var count = 1; count<=index; count++)
      {
       $('#'+story_id+'-'+count).css('color', '#ffcc00');
      }
    });
   //nhả chuột ko đánh giá
   $(document).on('mouseleave', '.rating', function(){
      var index = $(this).data("index");
      var story_id = $(this).data('story_id');
      var rating = $(this).data("rating");
      remove_background(story_id);
      //alert(rating);
      for(var count = 1; count<=rating; count++)
      {
       $('#'+story_id+'-'+count).css('color', '#ffcc00');
      }
     });

    //click đánh giá sao
    $(document).on('click', '.rating', function(){
          var index = $(this).data("index");
          var story_id = $(this).data('story_id');
            var _token = $('input[name="_token"]').val();
          $.ajax({
           url:"{{url('insert-rating')}}",
           method:"get",
           data:{index:index, story_id:story_id,_token:_token},
           success:function(data)
           {
            if(data == 'done')
            {
             alert("Bạn đã đánh giá "+index +" trên 10");
             location.reload()

            }
            else
            {
             alert("Lỗi đánh giá");
            }
           }
    });
          
    });
</script>
@endsection