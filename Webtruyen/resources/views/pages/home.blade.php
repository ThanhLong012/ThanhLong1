@extends('layout')
@section('content')
<div class="list_story pt-90">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="list_story_head d-flex justify-content-between mb-30">
                    <div class="section_title space_2 text-left">
                        <h3>Truyện hot</h3>
                    </div>
                </div>
            </div>
              
        </div>
        <div class="tab-content" id="story_hot"></div>
    </div>
</div>

<div class="list_story pt-90">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section_title text-left">
                    <h3> Truyện mới cập nhật </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 col-md-12">
                           
                <table class="table table-striped">
                    <tbody>
                        @foreach ($new_update as $item)
                        <tr>
                            @php
                                $story = $item->story;
                                    
                                @endphp
                            <th scope="row"><a href="{{ route('story', $story->slug) }}">{{ $item->story->name }}</a></th>
                            <td>
                                
                                @foreach($story->genres as $gen)
                                <span style="color:#fff" class="badge badge-info">{{$gen->name}}</span>
                                @endforeach
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->created_at->diffForHumans() }}</td>
                            </tr>
                            
                        @endforeach
                        
                    </tbody>
                </table>
                    
            </div>
            
            <div class="col-lg-3 col-md-8">
                <div class="category_sidebar">
                    @if ($story_viewed != null && isset($story_viewed))
                    <div class="block_categories">
                        <div class="category_top_menu widget">
                            <div class="widget_title">
                                <h3>Truyện đang đọc</h3>
                            </div>
                         
                        
                          
                           <table class="table table-striped">
                            <tbody>
                                @foreach ($story_viewed as $item)
                                @php
                                $story = $item->story;
                                    
                                @endphp
                                <tr>
                                    <th scope="row"><a href="{{ route('story', $story->slug) }}">{{ $item->story->name }}</a></th>
                                    <td><a href="{{ route('chapter', [$story->slug,$item->chapter->slug]) }}">Đọc tiếp: {{  $item->chapter->name }}</a></td>
                                    
                                </tr>
                                    
                                @endforeach
                                
                            </tbody>
                        </table>
                          
                            
                            
                           
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
                </div>
                   
            </div>
               
            
        </div>
    </div>
</div>
<div class="list_story pt-90">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-7 col-sm-6">
                <div class="section_title text-left">
                    <h3> Truyện đã hoàn thành </h3>
                </div>
            </div>
            <div class="col-lg-6 col-md-5 col-sm-6">
                <div class="Relevance">
                    <span>Sắp xếp theo:</span>
                    <div class="dropdown dropdown-shop">
                        <form>
                            {{ csrf_field() }}
                            <select name="drop" id="sort">
                                <option value="{{Request::url()}}?sort_by=none">--Lọc theo--</option>  
                                <option value="{{Request::url()}}?sort_by=kytu_az">Thứ tự từ A đến Z</option>
                                <option value="{{Request::url()}}?sort_by=kytu_za">Thứ tự từ Z đến A</option>
                            </select>
                        </form>
                    </div>
                </div>    
            </div> 
        </div>
      
        <div class="row">
            @php
                $count = 0;
            @endphp
            @foreach ($story_full as $story)
                
                <div class="col-lg-2">
                    <div class="single__story">
                        <div class="single_story__inner">
                            <span class="new_badge">Full</span>
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
                                    <div class="story_title">
                                        @foreach ($chapters as $chap)
                                            @php
                                                if ($chap->story_id == $story->id){
                                                    $count++;
                                                }
                                            @endphp
                                            @endforeach
                                            <p class="badge badge-info">Full - {{ $count }} chương</p>
                                            @php
                                            $count =0;
                                        @endphp
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-lg-6 offset-lg-2 col-md-6 col-sm-6">
            {{$story_full->links('pagination::bootstrap-4')}}         
        </div>
             
    </div>
</div>
@endsection
