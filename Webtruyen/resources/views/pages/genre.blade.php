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
                <li>{{ $genre->name }}</li>
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
                <div class="tav_menu_wrapper">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-7 col-sm-6">
                            <div class="tab_menu shop_menu">
                                <div class="tab_menu_inner">
                                    <ul class="nav" role="tablist">
                                        <li><a  class="active" data-toggle="tab" href="#shop_active" role="tab" aria-controls="shop_active" aria-selected="true"><i class="fa fa-th" aria-hidden="true"></i></a></li>

                                        <li><a data-toggle="tab" href="#category_active" role="tab" aria-controls="category_active" aria-selected="false"><i class="fa fa-list" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                                <div class="tab_menu_right">   
                                    @php
                                        $count = $story_genres->count();
                                    @endphp
                                    <p>Có {{ $count }} truyện</p>
                                </div>
                            </div>
                        </div>
                         
                    </div>
                </div> 
                <div class="tab_story_wrapper">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="shop_active" >
                            <div class="row">
                                @foreach ($story_genres as $item)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                    <div class="single__story">
                                        <div class="single_story__inner">
                                            <span class="new_badge">
                                                @php
                                                    if($item->story->status==0){
                                                        echo "New";
                                                    }elseif($item->story->status ==1){
                                                        echo "Full";
                                                    }else{
                                                        echo "Drop";
                                                    }

                                                @endphp
                                            </span>
                                            @if ($item->story->hot ==1)
                                            <div class="hot">Hot</div>
                                            @endif
                                            
                                        
                                    
                                            <div class="story_img">
                                            <a href="{{ route('story', $item->story->slug) }}">
                                                <img src="{{ asset('public/uploads/story/'.$item->story->image) }}" alt="">
                                            </a>
                                            </div>
                                            <div class="story__content text-center">
                                                <div class="story_desc_info">
                                                    <div class="story_title">
                                                        <h4><a href="{{ route('story', $item->story->slug) }}">{{ $item->story->name }}</a></h4>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                @endforeach
                              
                                        
                            </div>
                        </div>
                        <div class="tab-pane fade" id="category_active" role="tabpanel">
                            @foreach ($story_genres as $item)
                            @php
                                $story = $item->story;
                            @endphp
                            <div class="tab_story_bottom_wrapper">    
                                <div class="row">
                                   <div class="col-lg-3 col-md-5 col-sm-5">
                                        <div class="single_story__inner inner_shop">
                                            <div class="story_img">
                                                <a href="{{ route('story', $item->story->slug) }}">
                                                    <img src="{{ asset('public/uploads/story/'.$item->story->image) }}" alt="">
                                                </a>
                                            </div>

                                        </div> 
                                    </div> 
                                    <div class="col-lg-7 col-md-7 col-sm-7">
                                        <div class="story__content text-left">
                                            <div class="story_desc_info">
                                                <div class="story_title title_shop">
                                                    <h4><a href="{{ route('story', $item->story->slug) }}">{{ $item->story->name }}</a></h4>
                                                </div>
                                                
                                                <div class="story_content_shop">
                                                    <p><b>Tác giả: </b> {{ $story->author->name }}</p>
                                                    <p><b>Thể loại: </b>  @foreach($story->genres as $gen)
                                                                    {{$gen->name}},
                                                                @endforeach</p>
                                                    <p><b>Nguồn: </b> {{ $story->source}}</p>
                                                    <p><b>Trạng thái: </b> 
                                                        @if ($story->status == 0)
                                                            <span>Đang cập nhật</span>
                                                        @elseif($story->status ==1)
                                                            <span>Đã hoàn thành</span>
                                                        @else
                                                            <span>Ngừng cập nhật</span>
                                                        @endif</p>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-5 col-sm-5">
                                        <div class="single_story__inner inner_shop">
                                            <div class="story_img">
                                                <a href="#">
                                                    @php
                                                        $chapters = $item->chapter;
                                                        $chap_name = '';
                                                    @endphp
                                                    
                                                    @foreach ($chapters as $chap)
                                                    @php
                                                        $chap_name = $chap->name;
                                                    @endphp
                                                    @endforeach
                                                    {{ $chap_name }}
                                                
                                                </a>
                                            </div>

                                        </div> 
                                    </div> 
                                </div>
                            </div>
                            @endforeach
                           
                        </div>
                    </div>  
                   
                </div>
                <div class="shop_pagination">
                    <div class="row align-items-center">   
                        <div class="col-lg-4 col-md-6 col-sm-6">
                           
                        </div>
                        <div class="col-lg-6 offset-lg-2 col-md-6 col-sm-6">
                            {{$story_genres->links('pagination::bootstrap-4')}}         
                        </div>
                    </div>          
                </div>
            </div> 
            <div class="col-lg-3 col-md-8 col-12">
                <div class="category_sidebar">
                    <div class="block_categories">
                        <div class="category_top_menu widget">
                            <div class="widget_title">
                                <h3>Mô tả</h3>
                            </div>
                           <div>{{ $genre->description }}</div> 
                        </div>
                    </div>
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
                                <h3>Truyện {{ $genre->name }} đang hot</h3>
                            </div>
                            <ul class="list_toggle">
                                @php
                                $i = 0;
                            @endphp
                                @foreach ($story_hot_genre as $item)
                                @if ($item->story->hot == 1)
                                    @php
                                    $story = $item->story;
                                    $i++;
                                @endphp
                                <li><a href="{{ route('story', $story->slug) }}"><span class="number_story">{{ $i }}</span>{{ $story->name }}</a>
                                    <p style="font-style: italic;">
                                        @foreach($story->genres as $gen)
                                            {{$gen->name}};
                                        @endforeach
                                    </p>
                                </li>
                                @endif
                               
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
