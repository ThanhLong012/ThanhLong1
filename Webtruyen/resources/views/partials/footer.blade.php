<footer class="footer pt-90">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 col-md-12 col-xs-12">
                <!--Single Footer-->
                <div class="single_footer widget">
                    <div class="single_footer_widget_inner">
                        <div class="footer_logo">
                            <a href="3"><img src="{{ asset('public/uploads/story/'.$info->logo) }}" alt=""></a>
                        </div>
                        <div class="footer_content">
                            {!! $info->description !!}
                        </div>
                        
                    </div>
                </div>
                <!--Single Footer-->
            </div>
            
            <div class="col-lg-7 col-md-12 col-xs-12">
                <div class="block">
                    <div class="category_top_menu widget">
                <ul class="list_toggle">
                    @foreach ($genres as $item)
                    <li class="category_item"><a href="{{ route('genre', $item->slug) }}"> 
                        <span style="color:#fff" class="badge badge-info">{{ $item->name }}</a></span>
                    </li>
                    @endforeach
                        
                    </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="copyright_text">
                        <p>{{ $info->copyright }}</p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</footer>