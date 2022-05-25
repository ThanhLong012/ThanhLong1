@extends('layout')
@section('content')
<div class="breadcrumb_container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">     
                <nav>
            <ul>
                <li>
                    <a href="{{ route('index') }}">Home/ </a>
                </li>
                <li>
                    <a href="{{ route('story', $story->slug) }}"> {{ $story->name }}/ </a>
                </li>
                <li> {{ $chapter->name }}</li>
            </ul>
        </nav>
            </div>
        </div> 
    </div>        
</div>
<div class="shop_wrapper ptb-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="section_title text-center">
                            <h3> {{ $story->name }} </h3>
                            <p>{{ $chapter->name }}
                                @if ($chapter->subname != null)
                                    :
                                @endif
                                {{ $chapter->subname }}</p>
                        </div>
                        <div class="section_title text-center">
                            <div class="buttons-chap">
                                <a href="{{url('chuong/'.$chapter->story->slug.'/'.$previous_chapter)}}" class="{{$chapter->id==$min_id->id ? 'isDisabled' : ''}}"><i class="ti-angle-left"></i> Chương trước</a>
                                
                                <select name="select-chapter" class="custom-select select-chapter">
                                    <option value=""><i class="ti-angle-right"></i>--Mục lục--</option>
                                    @foreach($list_chapter as $key => $chap)
                                    <option value="{{ route('chapter', [$story->slug,$chap->slug]) }}">{{$chap->name}}</option>
                                    @endforeach
    
                                  </select> 
                                <a href="{{url('chuong/'.$chapter->story->slug.'/'.$next_chapter)}}" class="{{$chapter->id==$max_id->id ? 'isDisabled' : ''}}">Chương sau <i class="ti-angle-right"></i></a>  

                            </div> 
                            
                        </div>
                        <div class="section_content text-justify">
                            {!! $chapter->content !!}
                        </div>
                        <div class="section_title text-center">
                            <div class="buttons-chap">
                                <a href="{{url('chuong/'.$chapter->story->slug.'/'.$previous_chapter)}}" class="{{$chapter->id==$min_id->id ? 'isDisabled' : ''}}"><i class="ti-angle-left"></i> Chương trước</a>
                                
                                <select name="select-chapter" class="custom-select select-chapter">
                                    <option value=""><i class="ti-angle-right"></i>Mục lục</option>
                                    @foreach($list_chapter as $key => $chap)
                                    <option value="{{ route('chapter', [$story->slug,$chap->slug]) }}"><a href="">{{$chap->name}}</a></option>
                                    @endforeach
    
                                  </select> 
                                <a href="{{url('chuong/'.$chapter->story->slug.'/'.$next_chapter)}}" class="{{$chapter->id==$max_id->id ? 'isDisabled' : ''}}">Chương sau <i class="ti-angle-right"></i></a>  

                            </div> 
                            
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
    $('.select-chapter').on('change',function(){

       $('.waiting').text('Đang chuyển chương vui lòng chờ xíu....');
      
       var url = $(this).val();

       if(url){


         window.location = url;
         
       }
       return false;
    });

    current_chapter();

    function current_chapter(){
       var url  = window.location.href; 

       $('.select-chapter').find('option[value="'+url+'"]').attr("selected",true);
    }
  </script>
@endsection
