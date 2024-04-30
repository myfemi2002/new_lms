<!DOCTYPE html> 
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
      <title>Learning Management System</title>
      <!-- Favicon -->
      <link rel="shortcut icon" type="image/x-icon" href="{{ asset('page_login/assets/img/favicon.svg')}}">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{ asset('page_login/assets/css/bootstrap.min.css')}}">
      <!-- Fontawesome CSS -->
      <link rel="stylesheet" href="{{ asset('page_login/assets/plugins/fontawesome/css/fontawesome.min.css')}}">
      <link rel="stylesheet" href="{{ asset('page_login/assets/plugins/fontawesome/css/all.min.css')}}">
      <!-- Owl Carousel CSS -->
      <link rel="stylesheet" href="{{ asset('page_login/assets/css/owl.carousel.min.css')}}">
      <link rel="stylesheet" href="{{ asset('page_login/assets/css/owl.theme.default.min.css')}}">
      <!-- Feathericon CSS -->
      <link rel="stylesheet" href="{{ asset('page_login/assets/plugins/feather/feather.css')}}">
      <!-- Main CSS -->
      <link rel="stylesheet" href="{{ asset('page_login/assets/css/style.css')}}">
      <link href="{{ asset('backend/dist/css/style.min.css') }}" rel="stylesheet" />
      <link href=" {{ asset('backend/assets/toaster/toastr.css') }}" rel="stylesheet" />
   </head>
   <body>
      <!-- Main Wrapper -->
      <div class="main-wrapper log-wrap">
         <div class="row">
            <!-- Login Banner -->
            <div class="col-md-6 login-bg">
               <div class="owl-carousel login-slide owl-theme">
                  <div class="welcome-login">
                     <div class="login-banner">
                        <img src="{{ asset('page_login/assets/img/login-img.png')}}" class="img-fluid" alt="Logo">
                     </div>
                     <div class="mentor-course text-center">
                        <h2>Welcome to <br>Learning Management System.</h2>
                        <p>A digital platform designed to streamline and enhance the process of learning and training</p>
                     </div>
                  </div>
                  <div class="welcome-login">
                     <div class="login-banner">
                        <img src="{{ asset('page_login/assets/img/login-img.png')}}" class="img-fluid" alt="Logo">
                     </div>
                     <div class="mentor-course text-center">
                        <h2>Welcome to <br>Learning Management System.</h2>
                        <p>A robust platform designed to facilitate and streamline the management, delivery, and tracking of educational content.</p>
                     </div>
                  </div>
                  <div class="welcome-login">
                     <div class="login-banner">
                        <img src="{{ asset('page_login/assets/img/login-img.png')}}" class="img-fluid" alt="Logo">
                     </div>
                     <div class="mentor-course text-center">
                        <h2>Welcome to <br>Learning Management System.</h2>
                        <p>A comprehensive software application designed to facilitate the administration, documentation, tracking, and delivery of educational courses or training programs. It provides a centralized platform for educators and organizations to create, manage, and distribute content, as well as monitor learner progress and performance.</p>
                     </div>
                  </div>
               </div>
            </div>
            <!-- /Login Banner -->
            <div class="col-md-6 login-wrap-bg">		
				
                <!-- Login -->
                <div class="login-wrapper">
                    <div class="loginbox">
                        <div class="img-logo">
                            <!-- <img src="{{ asset('page_login/assets/img/logo.svg')}}" class="img-fluid" alt="Logo"> -->
                            <div class="back-home">
                                <a href="/">Back to Home</a>
                            </div>
                        </div>
                        <h1>Sign up</h1>
                        <form method="POST" action="{{ route('register') }}">@csrf

                                    <!-- Display validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                            <div class="input-block">
                                <label class="form-control-label">Full Name</label>
                                <input id="name" type="text" name="name" class="form-control" placeholder="Enter your Full Name" required>
                            </div>
                            <div class="input-block">
                                <label class="form-control-label">Email</label>
                                <input id="email" type="email" name="email" class="form-control" placeholder="Enter your email address" required>
                            </div>
                            <div class="input-block">
                                <label class="form-control-label">Password</label>
                                <div class="pass-group" id="passwordInput">																	
                                    <input type="password" name="password" class="form-control pass-input" placeholder="Enter your password" required>
                                    <span class="toggle-password feather-eye"></span>
                                    <span class="pass-checked"><i class="feather-check"></i></span>
                                </div>

                                <div  class="password-strength" id="passwordStrength">
                                    <span id="poor"></span>
                                    <span id="weak"></span>
                                    <span id="strong"></span>
                                    <span id="heavy"></span>
                                </div>
                                <div id="passwordInfo"></div>	
                            </div>

                            
            <!-- Add password confirmation field -->
            <div class="input-block">
                <label class="form-control-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control pass-input" placeholder="Confirm your password" required>
            </div>
            

<!-- Add IDs to your checkbox and submit button -->
<div class="form-check remember-me">
    <label class="form-check-label mb-0">
        <input id="agreeCheckbox" class="form-check-input" type="checkbox" name="remember">
        I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy.</a>
    </label>
</div>

<div class="d-grid">
    <button id="submitButton" class="btn btn-primary btn-start" type="submit" disabled>Create Account</button>
</div>
                        </form>
                    </div>
                </div>
                <!-- /Login -->
                
            </div>
         </div>
      </div>
      <!-- /Main Wrapper -->
      <!-- jQuery -->
      <script src="{{ asset('page_login/assets/js/jquery-3.7.1.min.js') }}"></script>
      <!-- Bootstrap Core JS -->
      <script src="{{ asset('page_login/assets/js/bootstrap.bundle.min.js')}}"></script>
      <!-- Owl Carousel -->
      <script src="{{ asset('page_login/assets/js/owl.carousel.min.js')}}"></script>	
      		<!-- Validation-->
		<script src="{{ asset('page_login/assets/js/validation.js')}}"></script>	
      <!-- Custom JS -->
      <script src="{{ asset('page_login/assets/js/script.js')}}"></script>
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

<!-- Add this script at the end of your body section -->
<script>
    $(document).ready(function () {
        $('#agreeCheckbox').change(function () {
            if (this.checked) {
                $('#submitButton').prop('disabled', false);
            } else {
                $('#submitButton').prop('disabled', true);
            }
        });
    });
</script>

      
   </body>
</html>
