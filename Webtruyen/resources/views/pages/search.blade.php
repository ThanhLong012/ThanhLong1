@extends('layout')
@section('content')
<div class="breadcrumb_container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">     
                <nav>
            <ul>
                <li>
                    <a href="{{ route('index') }}">Home /</a>
                </li>
                <li>Tìm kiếm với từ khóa "{{ $keyword }}"</li>
            </ul>
        </nav>
            </div>
        </div> 
    </div>        
</div>

@if (isset($stories) && $stories != null)
<div class="shop_wrapper ptb-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-12">
                <div class="tav_menu_wrapper">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-7 col-sm-6">
                            <div class="tab_menu shop_menu">
                                @php
                                        $count = $stories->count();
                                    @endphp
                                    <p>Có {{ $count }} truyện</p>
                            </div>
                        </div>
                        
                    </div>
                </div> 
                <div class="tab_story_wrapper">
                    <div class="tab-content">
                       
                        <div class="tab-pane fade show active" id="shop_active" >
                            <div class="row">
                                @foreach ($stories as $item)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                    <div class="single__story">
                                        <div class="single_story__inner">
                                            <span class="new_badge">
                                                @php
                                                    if($item->status==0){
                                                        echo "New";
                                                    }elseif($item->status ==1){
                                                        echo "Full";
                                                    }else{
                                                        echo "Drop";
                                                    }

                                                @endphp
                                            </span>
                                            @if ($item->hot ==1)
                                            <div class="hot">Hot</div>
                                            @endif
                                                
                                           
                                            <div class="story_img">
                                            <a href="{{ route('story', $item->slug) }}">
                                                <img src="{{ asset('public/uploads/story/'.$item->image) }}" alt="">
                                            </a>
                                            </div>
                                            <div class="story__content text-center">
                                                <div class="story_desc_info">
                                                    <div class="story_title">
                                                        <h4><a href="{{ route('story', $item->slug) }}">{{ $item->name }}</a></h4>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                @endforeach
                              
                                        
                            </div>
                        </div>
                        
                    </div>  
                   
                </div>
                <div class="shop_pagination">
                    <div class="row align-items-center">   
                        <div class="col-lg-4 col-md-6 col-sm-6">
                           
                        </div>
                        <div class="col-lg-6 offset-lg-2 col-md-6 col-sm-6">
                            {{$stories->links('pagination::bootstrap-4')}}         
                        </div>
                    </div>          
                </div>
            </div> 
            <div class="col-lg-3 col-md-8 col-12">
                <div class="category_sidebar">
                    <div class="block_categories">
                        <div class="category_top_menu widget">
                            
                           <div>Danh sách truyện có liên quan đến từ khóa "{{ $keyword }}"</div> 
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
@endif 
@if (isset($story_author) && $story_author != null)
<div class="shop_wrapper ptb-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-12">
                <div class="tav_menu_wrapper">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-7 col-sm-6">
                            <div class="tab_menu shop_menu">
                                <div class="tab_menu_right">   
                                    @php
                                        $count = $story_author->count();
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
                                @foreach ($story_author as $story)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                    <div class="single__story">
                                        <div class="single_story__inner">
                                            <span class="new_badge">
                                                @php
                                                    if($story->status==0){
                                                        echo "New";
                                                    }elseif($story->status ==1){
                                                        echo "Full";
                                                    }else{
                                                        echo "Drop";
                                                    }

                                                @endphp
                                            </span>
                                            @if ($story->hot ==1)
                                            <div class="hot">Hot</div>
                                            @endif
                                                
                                           
                                            <div class="story_img">
                                            <a href="{{ route('story', $story->slug) }}">
                                                <img src="{{ asset('public/uploads/story/'.$story->image) }}" alt="">
                                            </a>
                                            </div>
                                            <div class="story__content text-center">
                                                <div class="story_desc_info">
                                                    <div class="story_title">
                                                        <h4><a href="{{ route('story', $story->slug) }}">{{ $story->name }}</a></h4>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                @endforeach
                              
                                        
                            </div>
                        </div>
                       
                    </div>  
                   
                </div>
                <div class="shop_pagination">
                    <div class="row align-items-center">   
                        <div class="col-lg-4 col-md-6 col-sm-6">
                           
                        </div>
                        <div class="col-lg-6 offset-lg-2 col-md-6 col-sm-6">
                            {{$story_author->links('pagination::bootstrap-4')}}         
                        </div>
                    </div>          
                </div>
            </div> 
            <div class="col-lg-3 col-md-8 col-12">
                <div class="category_sidebar">
                    <div class="block_categories">
                        <div class="category_top_menu widget">
                           
                           <div>Danh sách truyện có liên quan đến từ khóa "{{ $keyword }}"</div> 
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
@endif
@endsection
