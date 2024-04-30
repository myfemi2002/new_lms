<!DOCTYPE html> 
<html lang="en">
	<head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Dreams LMS</title>
		
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
								<h2>Welcome to <br>DreamsLMS Courses.</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
							</div>
						</div>
						<div class="welcome-login">
							<div class="login-banner">
								<img src="{{ asset('page_login/assets/img/login-img.png')}}" class="img-fluid" alt="Logo">
							</div>
							<div class="mentor-course text-center">
								<h2>Welcome to <br>DreamsLMS Courses.</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
							</div>
						</div>
						<div class="welcome-login">
							<div class="login-banner">
								<img src="{{ asset('page_login/assets/img/login-img.png')}}" class="img-fluid" alt="Logo">
							</div>
							<div class="mentor-course text-center">
								<h2>Welcome to <br>DreamsLMS Courses.</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
							</div>
						</div>
					</div>
				</div>
				<!-- /Login Banner -->
				
				<div class="col-md-6 login-wrap-bg">		
				
					<!-- Login -->
					<div class="login-wrapper">
						<div class="loginbox">
							<div class="w-100">
								<div class="img-logo">
									<img src="{{ asset('page_login/assets/img/logo.svg')}}" class="img-fluid" alt="Logo">
									<div class="back-home">
										<a href="/">Back to Home</a>
									</div>
								</div>
								<h1>Sign into Your Account</h1>                            
                                <small class="form-control-feedback">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </small>
                                    <small class="form-control-feedback">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </small>

								<form method="POST" action="{{ route('login') }}">@csrf
									<div class="input-block">
										<label class="form-control-label">Email</label>
										<input type="email" name="email" class="form-control" placeholder="Enter your email address">
									</div>
									<div class="input-block">
										<label class="form-control-label">Password</label>
										<div class="pass-group">
											<input type="password" name="password" class="form-control pass-input" placeholder="Enter your password">
											<span class="feather-eye toggle-password"></span>
										</div>
									</div>
									<div class="forgot">
										<span><a class="forgot-link" href="forgot-password.html">Forgot Password ?</a></span>
									</div>
									<div class="remember-me">
										<label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> Remember me  
											<input  id="remember_me" type="checkbox"  name="remember">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="d-grid">
										<button class="btn btn-primary btn-start" type="submit">Sign In</button>
									</div>
								</form>
							</div>
						</div>
						<div class="google-bg text-center">
							<span><a href="#">Or sign in with</a></span>
							<div class="sign-google">
								<ul>
									<li><a href="#"><img src="{{ asset('page_login/assets/img/net-icon-01.png')}}" class="img-fluid" alt="Logo"> Sign In using Google</a></li>
									<li><a href="#"><img src="{{ asset('page_login/assets/img/net-icon-02.png')}}" class="img-fluid" alt="Logo">Sign In using Facebook</a></li>
								</ul>
							</div>
							<p class="mb-0">New User ? <a href="register.html">Create an Account</a></p>
						</div>
					</div>
					<!-- /Login -->
					
				</div>
				
			</div>
		   
	   </div>
	   <!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="{{ asset('page_login/assets/js/jquery-3.7.1.min.js')}}"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="{{ asset('page_login/assets/js/bootstrap.bundle.min.js')}}"></script>

		<!-- Owl Carousel -->
		<script src="{{ asset('page_login/assets/js/owl.carousel.min.js')}}"></script>	
		
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

		
	</body>
</html>