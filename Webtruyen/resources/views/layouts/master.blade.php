<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    @yield('title')
    <title>Web đọc truyện</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link href="{{ asset('public/vendor/jquery-ui/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('public/vendor/datatables/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/vendor/morris/morris.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('public/vendor/selectFX/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{ asset('public/vendor/jqvmap/dist/jqvmap.min.css')}}">
    <link href="{{ asset('public/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('public/vendor/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('public/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/vendor/themify-icons/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('public/vendor/select2/select2.min.css') }}" rel="stylesheet">
   

    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
    @yield('css')
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>


    <!-- Left Panel -->

    @include('includes.sidebar')

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        @include('includes.header')
        @yield('content')
    </div>

    <!-- Right Panel -->

    <script src="{{ asset('public/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('public/vendor/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{ asset('public/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('public/vendor/sweetalert2/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('public/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('public/vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('public/vendor/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('public/vendor/raphael-min.js') }}"></script>
    <script src="{{ asset('public/vendor/morris/morris.min.js') }}"></script>
    <script src="{{ asset('public/vendor/jquery/jquery.autocomplete.min.js') }}"></script>

    {{-- <script src="{{ asset('public/vendor/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('public/vendor/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ asset('public/vendor/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script> --}}
   


    <script src="{{ asset('public/js/main.js')}}"></script>
    {{-- <script src="{{ asset('public/js/dashboard.js')}}"></script>
    <script src="{{ asset('public/js/widgets.js')}}"></script> --}}
    @yield('js')

    
       <script>
           var $ob = jQuery.noConflict();
           $ob(function() {
                $ob("#myTable").DataTable();

            });
            $ob(document).ready(function() {
        $ob('.js-example-basic-multiple').select2();
    });
        
        
        
       
    </script>
    <script type="text/javascript">
        var url = '{{ env('APP_URL') }}';

       var options = {
            filebrowserImageBrowseUrl: url+'laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: url+'laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: url+'laravel-filemanager?type=Files',
            filebrowserUploadUrl: url+'laravel-filemanager/upload?type=Files&_token='
          };
      
        

    </script>


   
       

</body>

</html>
