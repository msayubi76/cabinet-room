<!DOCTYPE HTML>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>RKHardware | Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom Theme files -->
    <link href="{{ asset('form-assets/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
    <!-- Custom Theme files -->
    <script type="text/javascript" src="{{ asset('form-assets/js/jquery.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('form-assets/css/stylelogin.css') }}">

    <!--Google Fonts-->
    <link href="{{ asset('form-assets/css/family.css') }}" rel='stylesheet' type='text/css'>


</head>

<body>
    <!--login start here-->

    <div class="login">
        <h2>RkHardware | Login</h2>

        <form method="post" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="email" class="user active" placeholder="Email" :value="old('email')" />
                @error('email')
                    <span class="text-danger" role="alert"
                        style="

            text-align: center;
                color: rgb(219, 0, 0);
            margin-left: 40px;">
                        {{ $message }}
                    </span>
                @enderror
                <input type="password" name="password" class="lock active" placeholder="Password"
                    :value="old('password')" />
            </div>
            @error('password')
                <span class="text-danger" role="alert"
                    style="

            text-align: center;
            color: rgb(219, 0, 0);
            margin-left: 40px;">
                    {{ $message }}
                </span>
            @enderror

            <div class="forgot" style="margin-top: 5px;">

                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
                <div class="login-para">
                    @if (Route::has('password.request'))
                        <p><a href="{{ route('password.request') }}">
                                Forgot Password?
                            </a></p>
                    @endif
                    {{-- <p><a href="#"> Forgot Password? </a></p> --}}
                </div>
                <div class="clear"> </div>
            </div>
            <div class="login-bwn">
                <input type="submit" value="Log in" style="border-color: #fb7d1a; background-color: #fb7d1a; "/>
            </div>
        </form>
        <!--<div class="login-bottom">
            <h3>Login</h3>
            <p>With your social media account</p>
            <div class="social-icons text-center">
                <div class="button">
                     
                    {{-- <a class="fa" href="{{ route('facebook-auth') }}"> <i class="anc-fa"> </i>
                        <span>Facebook</span>
                        <div class="clear"> </div>
                    </a> --}}
                    <a class="go" href="{{ route('google-auth') }}"><i class="anc-go"> </i><span>Google+</span>
                        <div class="clear"> </div>
                    </a>
                    <div class="clear"> </div>
                </div>
                <h4>Don,t have an Account? <a href="{{ route('register') }}"> Register Now!</a></h4>
                <div class="reg-bwn"><a href="{{ route('register') }}">REGISTER</a></div>
            </div>
        </div>-->
    </div>
    <div style="text-align:center; margin-top:10px;">
        <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8011246932591811"
            data-ad-slot="9844648019" data-ad-format="auto"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
        <script async src="{{ asset('form-assets/js/adsbygoogle.js') }}"></script>
    </div>


    <!--login end here-->
</body>

</html>
