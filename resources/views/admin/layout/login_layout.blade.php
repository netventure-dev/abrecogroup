<!doctype html>
<html lang="en">

    <head>
        @php
        $general = App\Models\General::first();
        $logo =  $general->logo;
        $fav =  $general->favicon;
    @endphp
        <meta charset="utf-8" />
        <title>Login A3 Logics Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('storage/'.@$fav)}}">

        <!-- owl.carousel css -->
        <link rel="stylesheet" href="{{asset('assets/libs/owl.carousel/assets/owl.carousel.min.css')}}">

        <link rel="stylesheet" href="{{asset('assets/libs/owl.carousel/assets/owl.theme.default.min.css')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        @yield('css_after')
    </head>

    <body class="auth-body-bg">
        
        <div>
            @yield('content')
            <!-- end container-fluid -->
        </div>

        <!-- JAVASCRIPT -->
        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

        <!-- owl.carousel js -->
        <script src="{{asset('assets/libs/owl.carousel/owl.carousel.min.js')}}"></script>

        <!-- auth-2-carousel init -->
        <script src="{{asset('assets/js/pages/auth-2-carousel.init.js')}}"></script>
        
        <!-- App js -->
        <script src="{{asset('assets/js/app.js')}}"></script>
        @yield('js_after')
    </body>
</html>
