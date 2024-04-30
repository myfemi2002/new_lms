<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="TechyDevs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Newinfo -  Education</title>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{ asset('frontend/assets/images/favicon.png') }}">


    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/line-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/tooltipster.bundle.css') }}">
    
  

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plyr.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">   
    <link rel="stylesheet" href="{{ asset('backend/assets/toaster/toastr.css') }}">

    
    <!-- end inject -->
</head>
<body>

<!-- start cssload-loader -->
<div class="preloader">
    <div class="loader">
        <svg class="spinner" viewBox="0 0 50 50">
            <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
        </svg>
    </div>
</div>
<!-- end cssload-loader -->

<!--======================================
        START HEADER AREA
    ======================================-->
    @include('frontend.body.header')
<!--======================================
        END HEADER AREA
======================================-->

<!--================================
         START HERO AREA
=================================-->
<!--================================
        END HERO AREA
=================================-->

    @yield('home_content')


<!-- ================================
         END FOOTER AREA
================================= -->
@include('frontend.body.footer')
<!-- ================================
          END FOOTER AREA
================================= -->

<!-- start scroll top -->
<div id="scroll-top">
    <i class="la la-arrow-up" title="Go top"></i>
</div>
<!-- end scroll top -->




<!-- template js files -->
<script src="{{ asset('frontend/assets/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/isotope.js') }}"></script>
<script src="{{ asset('frontend/assets/js/waypoint.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/fancybox.js') }}"></script>
<script src="{{ asset('frontend/assets/js/datedropper.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/emojionearea.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/tooltipster.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.lazy.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/main.js') }}"></script>

<script src="{{ asset('frontend/assets/js/plyr.js') }}"></script>

<script>
    var player = new Plyr('#player');
</script>


<!--validation JavaScript -->
        <script src="{{ asset('backend/assets/validation/validate.min.js')}}"></script>
        <!--handlebars JavaScript -->
        <script src="{{ asset('backend/assets/handlebars/handlebars.js')}}"></script>
        <!--notify cdnjs -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
        {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- sweetalert2 --}}
        {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
        <script src="{{ asset('backend/assets/sweetalert-code/code.js') }}"></script>
        {{-- toaster --}}
        <script  type="text/javascript" src="{{ asset('backend/assets/toaster/toastr.min.js') }}"></script>
        <script>
            @if (Session::has('message'))
            var type = "{{ Session::get('alert-type','info') }}"
            switch (type) {
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
            }
            @endif
        </script>

        @include('frontend.body.script')



</body>
</html>
