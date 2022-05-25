<header class="header sticky-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="header_wrapper_inner">
                   
                    <div class="logo col-xs-12">
                        <a href="{{ route('index') }}">
                            <img src="{{ asset('public/uploads/story/'.$info->logo) }}" alt="" width="40%">
                        </a>
                    </div>
                    
                    
                    <div class="main_menu_inner">
                      
                        <div class="menu">
                            <nav>
                                <ul>
                                    <li class="active"><a href="#">Danh sách <i class="fa fa-angle-down"></i></a>
                                        <ul class="sub_menu">
                                            @foreach($categories as $cate)
                                            <li><a href="{{ route('category', $cate->slug) }}">{{ $cate->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="mega_parent"><a href="#">Thể loại <i class="fa fa-angle-down"></i></a>
                                        <ul class="mega_menu">
                                            @foreach($genres as $gen)
                                                <li class="mega_item"><a href="{{ route('genre', $gen->slug) }}">{{ $gen->name }}</a></li>
                                            @endforeach
                                           
                                        </ul>    
                                    </li>
                                    <li class="active"><a href="#">Tác giả<i class="fa fa-angle-down"></i></a>
                                        <ul class="sub_menu">
                                            @foreach($authors as $aut)
                                            <li><a href="{{ route('author', $aut->slug) }}">{{ $aut->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                   
                                 </ul>
                            </nav>
                        </div>
                        
                        <div class="mobile-menu d-lg-none">
                            <nav>
                                 <ul>
                                    <li class="active"><a href="#">Danh sách <i class="fa fa-angle-down"></i></a>
                                        <ul class="sub_menu">
                                            @foreach($categories as $cate)
                                            <li><a href="{{ route('category', $cate->slug) }}">{{ $cate->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li><a href="#">Thể loại</a>
                                        <ul>
                                            @foreach($genres as $gen)
                                                <li><a href="{{ route('genre', $gen->slug) }}">{{ $gen->name }}</a></li>
                                            @endforeach
                                                   
                                               
                                        </ul>    
                                    </li>
                                    <li><a href="#">Tác giả</a>
                                        <ul>
                                            @foreach($authors as $aut)
                                            <li><a href="{{ route('author', $aut->slug) }}">{{ $aut->name }}</a></li>
                                            @endforeach
                                                   
                                               
                                        </ul>    
                                    </li>
                                   
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="header_right_info d-flex">
                        <div class="search_box">
                            <div class="search_inner">
                                <form autocomplete="off" action="{{url('tim-kiem')}}" method="POST">
                                    @csrf
                                    <input placeholder="Tìm kiếm..." id="keywords" type="search" name="tukhoa">
                                    <div id="search_ajax"></div>
                                    <button type="submit"><i class="ion-ios-search"></i></button>
                                </form>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>