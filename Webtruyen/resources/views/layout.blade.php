<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Đọc truyện online, đọc truyện hay</title>
    <meta name="description" content="{{ $meta_desc }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{ $meta_keywords }}"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <link  rel="canonical" href="{{ $url_canonical }}" />
    <meta name="author" content="">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    
    <!-- all css here -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/animate.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/chosen.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/material-design-iconic-font.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/meanmenu.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/bundle.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/responsive.css')}}">
    <script src="{{ asset('public/assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('public/vendor/themify-icons/themify-icons.css')}}">

</head>
<body>
    @include('partials.topbar')
    <div class="organic_food_wrapper">
        @include('partials.header')
        @yield('content') 
        @include('partials.footer')
    </div>
           
  
    <!-- all js here -->
    <script src="{{ asset('public/assets/js/vendor/jquery-1.12.0.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/popper.js')}}"></script>
    <script src="{{ asset('public/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/jquery.meanmenu.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/jquery.counterup.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/waypoints.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/ajax-mail.js')}}"></script>
    <script src="{{ asset('public/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/plugins.js')}}"></script>
    <script src="{{ asset('public/assets/js/main.js')}}"></script>



    @yield('js')
    {{-- Plugin Comment Facebook --}}
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v13.0" nonce="QHlylRBQ"></script>
    <!--end -->
    <script type="text/javascript">
        $(document).ready(function(){
    
            $('#sort').on('change',function(){
                var url = $(this).val();
                  if (url) { 
                      window.location = url;
                  }
                return false;
            });
    
        }); 
    </script>
     <script type="text/javascript">
        $('#keywords').keyup(function(){
            var query = $(this).val();
              if(query != '')
                {
                 var _token = $('input[name="_token"]').val();
                 $.ajax({
                  url:"{{url('/autocomplete-ajax')}}",
                  method:"POST",
                  data:{query:query, _token:_token},
                  success:function(data){
                   $('#search_ajax').fadeIn();  
                    $('#search_ajax').html(data);
                  }
                 });
  
                }else{
                  $('#search_ajax').fadeOut();  
                }
            });
  
            $(document).on('click', '.li_search_ajax', function(){  
                $('#keywords').val($(this).text());  
                $('#search_ajax').fadeOut();  
            }); 
        </script>
    <script type="text/javascript">
        load_more();
        function load_more(id = ''){
            $.ajax({
                url:'{{url('/load-more')}}',
                method:"get",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{id:id},
                success:function(data){
                    $('#load_more_button').remove();
                    $('#story_hot').append(data); 
                    var id = [];
    
                }
            }); 
        }
        $(document).on('click','#load_more_button',function(){
            var id = $(this).data('id');
            $('#load_more_button').html('<b>Loading...</b>');
            load_more(id);
        })
    
    </script>
</body>


</html>
