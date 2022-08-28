{{-- <!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Cabinet | Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('admin-assets/assets/images/favicon.png') }}">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
    <link href="{{ url('admin-assets/css/style.css') }}" rel="stylesheet">

</head>

<body class="h-100">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->





    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href="index.html">
                                    <h4>Rosella</h4>
                                </a>
                                <!-- Session Status -->
                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                <form class="mt-5 mb-5 login-input" method="post" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" id="email" name="email" :value="old('email')" class="form-control" placeholder="Email">
                                        @error('email')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password"  id="password" name="password"  class="form-control" placeholder="Password">
                                        @error('password')
                                        <span class="text-danger text-uppercase" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox"
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                            name="remember">
                                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                    </label>
                                    <div class="form-group">
                                        @if (Route::has('password.request'))
                                            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                                href="{{ route('password.request') }}">
                                                {{ __('Forgot your password?') }}
                                            </a>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn login-form__btn submit w-100">Sign In</button>

                                </form>
                                <p class="mt-5 login-form__footer">Dont have account? <a href="{{ route('register')}}"
                                        class="text-primary">Sign Up</a> now</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{ url('admin-assets/plugins/common/common.min.js') }}"></script>
    <script src="{{ url('admin-assets/js/custom.min.js') }}"></script>
    <script src="{{ url('admin-assets/js/settings.js') }}"></script>
    <script src="{{ url('admin-assets/js/gleek.js') }}"></script>
    <script src="{{ url('admin-assets/js/styleSwitcher.js') }}"></script>
</body>

</html> --}}

/*--
Author: DesignMaz
Author URL: https://www.designmaz.net
License URL: https://www.designmaz.net/licence/
--*/
<!DOCTYPE HTML>
<html>
<head>
<title>Free Responsive Flat Login Form Widget Template | Designmaz</title>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!-- Custom Theme files -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="{{asset('admin-assets/css/stylelogin.css')  }}">
<!--Google Fonts-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<!--Google Fonts-->
<script>var __links = document.querySelectorAll('a');function __linkClick(e) { parent.window.postMessage(this.href, '*');} ;for (var i = 0, l = __links.length; i < l; i++) {if ( __links[i].getAttribute('data-t') == '_blank' ) { __links[i].addEventListener('click', __linkClick, false);}}</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>$(document).ready(function(c) {
	$('.sinup-close').on('click', function(c){
		$('.setting').fadeOut('slow', function(c){
	  		$('.setting').remove();
		});
	});
});
</script>
<!---Google Analytics Designmaz.net-->
<script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create', 'UA-35751449-15', 'auto');ga('send', 'pageview');</script>

</head>
<body>
<!--login start here-->
<h1>Flat New Login Form</h1>
<div class="login">
	<h2>Login</h2>
	<form>
		<input type="text" class="user active" value="User name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'User name';}"/>
		<input type="password" class="lock active" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}"/>
	</form>
	<div class="forgot">
		 <div class="login-check">
 			 <label class="checkbox"><input type="checkbox" name="checkbox" checked><i> </i> Remember Me</label>

 		  </div>
 		  <div class="login-para">
 			<p><a href="#"> Forgot Password? </a></p>
 		 </div>
		<div class="clear"> </div>
	</div>
	<div class="login-bwn">
	   <input type="submit" value="Log in" />
	</div>
	<div class="login-bottom">
		<h3>Login</h3>
		<p>With your social media account</p>
	 <div class="social-icons">
		<div class="button">
			<a class="tw" href="#"> <i class="anc-tw"> </i> <span>Twitter</span>
			<div class="clear"> </div></a>
			<a class="fa" href="#"> <i class="anc-fa"> </i> <span>Facebook</span>
			<div class="clear"> </div></a>
			<a class="go" href="#"><i class="anc-go"> </i><span>Google+</span>
			<div class="clear"> </div></a>
				<div class="clear"> </div>
		</div>
		<h4>Don,t have an Account? <a href="#"> Register Now!</a></h4>
		<div class="reg-bwn"><a href="#">REGISTER</a></div>
	</div>
  </div>
</div>
<div style="text-align:center; margin-top:10px;">
				<ins class="adsbygoogle"
style="display:block"
data-ad-client="ca-pub-8011246932591811"
data-ad-slot="9844648019"
data-ad-format="auto"></ins> <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				</div>

<div class="copyright">
	<p>Template by <a href="https://www.designmaz.net/" target="_blank"> DesignMaz </a></p>
</div>
<!--login end here-->
</body>
</html>

