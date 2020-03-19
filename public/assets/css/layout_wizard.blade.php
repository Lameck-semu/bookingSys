<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
<title>Clinical App</title> 
<!-- For-Mobile-Apps-and-Meta-Tags -->
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Clinical Care Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, SmartPhone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //For-Mobile-Apps-and-Meta-Tags -->
<!-- Custom Theme files -->
<!-- <link href="{{ asset('css/bootstrap.css')}}" type="text/css" rel="stylesheet" media="all"> -->
<link href="{{('css/simplelightbox.css')}}" rel='stylesheet' type='text/css'>  
<link rel="stylesheet" href="{{ asset('css/jquery-ui.css')}}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/style11.css')}}" /><!-- menu style sheet -->
<link href="{{ asset('css/style.css')}}" type="text/css" rel="stylesheet" media="all"> 
<link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" />
<link href="{{asset ('css/gsdk-bootstrap-wizard.css')}}" rel="stylesheet" />
<!-- //Custom Theme files -->
<!-- font-awesome icons -->
<link href="{{ asset('css/font-awesome.css')}}" rel="stylesheet" type="text/css" media="all" /> 
<!-- //font-awesome icons -->

<!-- web-fonts -->  
<link href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
@yield('style')
<!-- //web-fonts -->
</head>
<body class="bg">
	<div class="overlay overlay-simplegenie " >
			<button type="button" class="overlay-close"><i class="fa fa-times" aria-hidden="true"></i></button>
			<nav>
				<ul>
					<li><a href="{{ route('main') }}">Home</a></li>
					<li><a href="{{ route('about') }}">About</a></li>
					<li><a href="{{ route('doctors') }}">Doctors</a></li>
					<li><a href="{{ route('appointment') }}">Appointment</a></li>
					<li><a href="{{ route('departments') }}">Departments</a></li>
					<li><a href="{{ route('contact') }}">Contact</a></li>
				</ul>
			</nav>
		</div>			
		<section class="header-w3ls " > 
			<h1 ><a href="{{ route('main') }}">Clinical Care</a></h1>
			<button id="trigger-overlay" type="button"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
			<div class="bottons-agileits-w3layouts" >
			<a class="page-scroll" href="#myModal2" data-toggle="modal"><i class="fa fa-sign-in" aria-hidden="true"></i>Login</a>.
			<a class="page-scroll" href="#myModal3" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Register</a>
			<a class="page-scroll" href="#myModal4" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Find us</a>
			</div>
	
		<div class="clearfix"> </div>
		</section>
<!-- //menu -->
<!-- modal -->
	<div class="modal about-modal w3-agileits fade" id="myModal2" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
				</div> 
				<div class="modal-body login-page "><!-- login-page -->     
									<div class="login-top sign-top">
										<div class="agileits-login">
										<h5>Login</h5>
										<form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="email" type="email" class="email{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="password" type="password" class="password{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                               </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>

										</div>  
									</div>
						</div>  
				</div> <!-- //login-page -->
			</div>
		</div>
	<!-- //modal --> 
	<!-- modal -->
	<div class="modal about-modal w3-agileits fade" id="myModal3" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
				</div> 
				<div class="modal-body login-page "><!-- login-page -->     
									<div class="login-top sign-top">
										<div class="agileits-login">
										<h5>Register</h5>
										
					<form method="POST" action="{{ route('register') }}">
                        @csrf


                            <div class="col-md-12">
                                <input id="name" type="text" class="{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                       

                  

                            <div class="col-md-12">
                                <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                       


                            <div class="col-md-6">
                                <input id="password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                    


                            <div class="col-md-12">
                                <input id="password-confirm" type="password"  name="password_confirmation" placeholder="Confirm Password" required>
                            </div>
                       

                        
                           <div class="w3ls-submit"> 
								<input type="submit" value="Register">  	
							</div>	
                     
                    </form>

										</div>  
									</div>
						</div> 

						 
				</div> <!-- //login-page -->
			</div>
		</div>
	<!-- //modal --> 
	<!-- modal -->
	<div class="modal about-modal w3-agileits fade" id="myModal4" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
				</div> 
				<div class="modal-body login-page "><!-- login-page -->     
									<div class="login-top sign-top">
										<div class="agileits-login">
											<h5>Social Media</h5>
										<ul class="social-nav model-3d-0 footer-social w3_agile_social">
						<li><a href="#" class="facebook">
							  <div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
							  <div class="back"><i class="fa fa-facebook" aria-hidden="true"></i></div></a></li>
						<li><a href="#" class="twitter"> 
							  <div class="front"><i class="fa fa-twitter" aria-hidden="true"></i></div>
							  <div class="back"><i class="fa fa-twitter" aria-hidden="true"></i></div></a></li>
						<li><a href="#" class="instagram">
							  <div class="front"><i class="fa fa-instagram" aria-hidden="true"></i></div>
							  <div class="back"><i class="fa fa-instagram" aria-hidden="true"></i></div></a></li>
						<li><a href="#" class="pinterest">
							  <div class="front"><i class="fa fa-linkedin" aria-hidden="true"></i></div>
							  <div class="back"><i class="fa fa-linkedin" aria-hidden="true"></i></div></a></li>
					</ul>

										</div>  
									</div>
						</div>  
				</div> <!-- //login-page -->
			</div>
		</div>
	<!-- //modal --> 
<!-- banner --><br><br><br><br>
<div class="inner-banner-agileits-w3layouts">
</div>
<!-- //banner -->

@yield('content')


<!-- js -->
<script type='text/javascript' src="{{ asset('js/jquery-2.2.4.min.js')}}"></script>
<!-- //js -->
<script src="j{{ asset('s/jquery.nicescroll.js')}}"></script>
<script src="{{ asset('js/scripts.js')}}"></script>
<!-- Calendar -->
				<script src="{{ asset('js/jquery-ui.js')}}"></script>
				  <script>
						  $(function() {
							$( "#datepicker,#datepicker1,#datepicker2,#datepicker3" ).datepicker();
						  });
				  </script>
			<!-- //Calendar -->

<!--responsiveslides js-->
<script src="{{ asset('js/responsiveslides.min.js')}}"></script>
			<script>
						// You can also use "$(window).load(function() {"
						$(function () {
						  // Slideshow 4
						  $("#slider4").responsiveSlides({
							auto: true,
							pager:true,
							nav:false,
							speed: 500,
							namespace: "callbacks",
							before: function () {
							  $('.events').append("<li>before event fired.</li>");
							},
							after: function () {
							  $('.events').append("<li>after event fired.</li>");
							}
						  });
					
						});
			</script>
			<script>
							// You can also use "$(window).load(function() {"
							$(function () {
							  // Slideshow 3
							  $("#slider3").responsiveSlides({
								auto: true,
								pager:false,
								nav: true,
								speed: 500,
								namespace: "callbacks",
								before: function () {
								  $('.events').append("<li>before event fired.</li>");
								},
								after: function () {
								  $('.events').append("<li>after event fired.</li>");
								}
							  });
						
							});
						  </script>

<!--//responsiveslides js-->
<!-- stats -->
	<script src="{{ asset('js/jquery.waypoints.min.js')}}"></script>
	<script src="{{ asset('js/jquery.countup.js')}}"></script>
		<script>
			$('.counter').countUp();
		</script>
<!-- //stats -->
<!--jarallax -->

			<script src="j{{ asset ('s/jarallax.js')}}"></script>
	<script src="{{ asset ('js/SmoothScroll.min.js')}}"></script>
	<script type="text/javascript">
		/* init Jarallax */
		$('.jarallax').jarallax({
			speed: 0.5,
			imgWidth: 1366,
			imgHeight: 768
		})
	</script>
<!-- //jarallax -->
<!--menu script-->
<script type="text/javascript" src="{{ asset('js/modernizr-2.6.2.min.js')}}"></script>
<script src="{{ asset('js/classie.js')}}"></script>
<script src="{{ asset('js/demo1.js')}}"></script>


				<script type="text/javascript" src="{{ asset('js/simple-lightbox.min.js')}}"></script>
				<script>
					$(function(){
						var gallery = $('.agileinfo-gallery-row a').simpleLightbox({navText:		['&lsaquo;','&rsaquo;']});
					});
				</script>
<!--//menu script-->
<!-- banner -->
<script type='text/javascript' src="{{ asset('js/jquery.easing.1.3.js')}}"></script>
<!-- //banner -->
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!--js for bootstrap working-->
	<script src="{{ asset('js/bootstrap.js')}}"></script>
<!-- //for bootstrap working -->
<script src="{{ asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('js/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script>

	<!--  Plugin for the Wizard -->
	<script src="{{ asset('js/gsdk-bootstrap-wizard.js')}}"></script>

	<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
	<script src="{{ asset('js/jquery.validate.min.js')}}"></script>
	
 @yield('js')
</body>
</html>