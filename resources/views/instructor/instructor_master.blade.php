<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, shrink-to-fit=9">
        <meta name="description" content="Gambolthemes">
        <meta name="author" content="Gambolthemes">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title> @yield('title') :: Learning Management System</title>
        <!-- Favicon Icon -->
        <link rel="icon" type="image/png" href="{{ asset('instructor/assets/images/fav.png')}}">
        <!-- Stylesheets -->
        <link href="http://fonts.googleapis.com/css?family=Roboto:400,700,500" rel="stylesheet">
        <link href="{{ asset('instructor/assets/vendor/unicons-2.0.1/css/unicons.css') }}" rel="stylesheet">
        <link href="{{ asset('instructor/assets/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('instructor/assets/css/vertical-responsive-menu1.min.css')}}" rel="stylesheet">
        <link href="{{ asset('instructor/assets/css/instructor-dashboard.css')}}" rel="stylesheet">
        <link href="{{ asset('instructor/assets/css/instructor-responsive.css')}}" rel="stylesheet">
        <link href="{{ asset('instructor/assets/css/responsive.css')}}" rel="stylesheet">
        <link href="{{ asset('instructor/assets/css/night-mode.css')}}" rel="stylesheet">
        <!-- Vendor Stylesheets -->
        <link href="{{ asset('instructor/assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
        <link href="{{ asset('instructor/assets/vendor/OwlCarousel/assets/owl.carousel.css')}}" rel="stylesheet">
        <link href="{{ asset('instructor/assets/vendor/OwlCarousel/assets/owl.theme.default.min.css')}}" rel="stylesheet">
        <link href="{{ asset('instructor/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('instructor/assets/vendor/semantic/semantic.min.css')}}">
        <!-- <link href="{{ asset('backend/assets/css/styles.css') }}" rel="stylesheet" /> -->
        <link href=" {{ asset('backend/assets/toaster/toastr.css') }}" rel="stylesheet" />
        
    </head>
    <body>
        <!-- Header Start -->
        @include('instructor.body.header')
        <!-- Header End -->
        <!-- Left Sidebar Start -->
        @include('instructor.body.sidebar')
        <!-- Left Sidebar End -->
        <!-- Body Start -->
        <div class="wrapper">
            <!-- <div class="sa4d25">
                <div class="container-fluid">	 -->
            @yield('instructor')
            <!-- </div> -->
            <!-- </div> -->
            @include('instructor.body.footer')
        </div>
        <!-- Body End -->
        <script src="{{ asset('instructor/assets/js/vertical-responsive-menu.min.js')}}"></script>
        <script src="{{ asset('instructor/assets/js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{ asset('instructor/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('instructor/assets/vendor/OwlCarousel/owl.carousel.js')}}"></script>
        <script src="{{ asset('instructor/assets/vendor/semantic/semantic.min.js')}}"></script>
        <!-- <script src="{{ asset('instructor/assets/js/custom1.js')}}"></script> -->
        <script src="{{ asset('instructor/assets/js/custom.js')}}"></script>
        <script src="{{ asset('instructor/assets/js/night-mode.js')}}"></script>
        <!-- sweetalert2 -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('backend/assets/sweetalert-code/code.js') }}"></script>
        <!-- toaster -->
        <script type="text/javascript" src="{{ asset('backend/assets/toaster/toastr.min.js') }}"></script>
        <script>
            @if (Session::has('message'))
                var type = "{{ Session::get('alert-type', 'info') }}";
                var message = "{{ Session::get('message') }}";
            
                switch (type) {
                    case 'info':
                    case 'success':
                    case 'warning':
                    case 'error':
                        toastr[type](message);
                        break;
                }
            @endif
        </script>
    </body>
</html>
