





<!DOCTYPE HTML>
<html>
<head>
    <title>Cabinet | Register</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Custom Theme files -->
<link href="{{ asset('form-assets/css/style.css') }}" rel="stylesheet" type="text/css" media="all"/>
<!-- Custom Theme files -->
<script type="text/javascript" src="{{ asset('form-assets/js/jquery.min.js') }}"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="{{asset('form-assets/css/stylelogin.css')  }}">

<!--Google Fonts-->
<link href="{{ asset('form-assets/css/family.css') }}" rel='stylesheet' type='text/css'>
<!--Google Fonts-->


</head>
<body>
<!--login start here-->

<div class="login">
	<h2>Cabinet | Register</h2>

	<form  method="post" action="{{ route('register') }}">
        @csrf

        <div>
            <input type="text" name="fist_name" class="user active" placeholder="First Name" :value="old('fist_name')"/>
            @error('fist_name')
            <span class="text-danger" role="alert" style="

                text-align: center;
                    color: rgb(219, 0, 0);
                margin-left: 40px;">
                {{ $message }}
            </span>
            @enderror
        </div>



            <input type="text" name="last_name" class="user active" placeholder="Last Name" :value="old('last_name')"/>
            @error('last_name')
            <span class="text-danger" role="alert" style="

            text-align: center;
                color: rgb(219, 0, 0);
            margin-left: 40px;">
            {{ $message }}
        </span>
            @enderror



        <input type="text" name="email" class="email active" placeholder="Email" :value="old('email')"/>
        @error('email')
        <span class="text-danger" role="alert" style="

                text-align: center;
                    color: rgb(219, 0, 0);
                margin-left: 40px;">
                {{ $message }}
            </span>
        @enderror
		<input type="password" name="password" class="lock active" placeholder="Password" :value="old('password')"/>
        @error('password')
        <span class="text-danger" role="alert" style="

        text-align: center;
            color: rgb(219, 0, 0);
        margin-left: 40px;">
        {{ $message }}
    </span>
        @enderror
        <input type="password" name="password_confirmation" class="lock active" placeholder="Password Confirmation "/>
        @error('password_confirmation')
        <span class="text-danger" role="alert" style="

        text-align: center;
            color: rgb(219, 0, 0);
        margin-left: 40px;">
        {{ $message }}
    </span>
        @enderror

	<div class="forgot">
		 <div class="login-check">
 			 <label class="checkbox"><input type="checkbox" name="checkbox" checked><i> </i> Remember Me</label>

 		  </div>
    </div>

		<div class="clear"> </div>

	<div class="login-bwn">
	   <input type="submit" value="Sign Up" />
	</div>
</form>
	<div class="login-bottom">
	
	 <div class="social-icons">
		
		<h4>If you have already account? <a  href="{{ route('login') }}"></a></h4>
		<div class="reg-bwn"><a href="{{ route('login') }}">Sing In</a></div>
	</div>
  </div>
</div>
<div style="text-align:center; margin-top:10px;">
				<ins class="adsbygoogle"
style="display:block"
data-ad-client="ca-pub-8011246932591811"
data-ad-slot="9844648019"
data-ad-format="auto"></ins> <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
<script async src="{{ asset('form-assets/js/adsbygoogle.js') }}"></script>
				</div>

<!--login end here-->
</body>
</html>




