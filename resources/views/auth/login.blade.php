<!DOCTYPE html>
<html lang="en">


    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>JDM | Login</title>
        <meta name="robots" content="noindex, follow" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{url('site_images/logo.jpeg')}}">
        
        <!-- CSS
        ============================================ -->
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{url('website/css/vendor/bootstrap.min.css')}}">
        <!-- Fontawesome -->
        <link rel="stylesheet" href="{{url('website/css/vendor/font-awesome.css')}}">
        <!-- Fontawesome Star -->
        <link rel="stylesheet" href="{{url('website/css/vendor/fontawesome-stars.css')}}">
        <!-- Ion Icon -->
        <link rel="stylesheet" href="{{url('website/css/vendor/ion-fonts.css')}}">
        <!-- Slick CSS -->
        <link rel="stylesheet" href="{{url('website/css/plugins/slick.css')}}">
        <!-- Animation -->
        <link rel="stylesheet" href="{{url('website/css/plugins/animate.css')}}">
        <!-- jQuery Ui -->
        <link rel="stylesheet" href="{{url('website/css/plugins/jquery-ui.min.css')}}">
        <!-- Lightgallery -->
        <link rel="stylesheet" href="{{url('website/css/plugins/lightgallery.min.css')}}">
        <!-- Nice Select -->
        <link rel="stylesheet" href="{{url('website/css/plugins/nice-select.css')}}">
    
        <!-- Vendor & Plugins CSS (Please remove the comment from below vendor.min.css & plugins.min.css for better website load performance and remove css files from the above) -->
        <!--
        <script src="assets/js/vendor/vendor.min.js"></script>
        <script src="assets/js/plugins/plugins.min.js"></script>
        -->
    
        <!-- Main Style CSS (Please use minify version for better website load performance) -->
        <link rel="stylesheet" href="{{url('website/css/style.css')}}">
        <!--<link rel="stylesheet" href="assets/css/style.min.css">-->
    <style>
        .is-invalid{
            border: 1px solid red !important;
        }
        .login-form label,.login-form h4 {
            color: #000000;
        }

        .login-form  input {
            border: 1px solid #dc4768;
        }

        .login-form { 
            padding: 45px;
        }

        .login-form button {background: #dc4768;}

        .login-form button:hover {
            background: #000000;
        }
        .uren-login-register_area{
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 15px;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            z-index: 1;
        }
    </style>
    </head>
    

<body style="
background-image: url({{url('images/login.jpg')}});no-repeat center;
background-size: cover;">
    <div class="uren-login-register_area" style="    background: #000000b0;
    height: 100vh;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-4 mx-auto">
                   
                     
                    <!-- Login Form s-->
                    <form  method="post"   action="{{ route('login') }}" >
                        @csrf
                        <div class="login-form text-uppercase">
                            
                             
                            <h4 class="login-title text-uppercase">Login</h4>
                            <div class="row">
                                <div class="col-md-12 col-12 text-uppercase">
                                    <label class="text-uppercase text-uppercase">Username*</label>
                                    <input id="username" type="text" class="  @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}" required placeholder="Enter Username" autocomplete="off">

                                    @error('username')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-12 mb--20">
                                    <label class="text-uppercase text-uppercase">Password</label> 
                                    <input id="userpassword" type="password" class=" @error('password') is-invalid @enderror"
                                           name="password" required placeholder="Enter password" autocomplete="current-password">
                                    @error('password')
                                    <span class="text-danger text-uppercase" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                {{-- <div class="col-md-8 text-uppercase">
                                    <div class="check-box text-uppercase">
                                        <input type="checkbox" id="remember_me">
                                        <label for="remember_me">Remember me</label>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-4">
                                    <div class="forgotton-password_info text-uppercase">
                                        <a href="#"> Forgotten pasward?</a>
                                    </div>
                                </div> --}}
                                <div class="col-md-12 text-uppercase">
                                   <div class="form-inline">
                                    <button type="submit" class="uren-login_btn m-2 ">Login</button>
                                    <a style="margin: 0px 0px 0px auto !important;" class=" m-2" href="{{url('customer/create')}}">Register</a>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
     <!-- JS
============================================ -->

    <!-- jQuery JS -->
    <script src="{{url('website/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <!-- Modernizer JS -->
    <script src="{{url('website/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    <!-- Popper JS -->
    <script src="{{url('website//js/vendor/popper.min.js')}}"></script>
    <!-- Bootstrap JS -->
    <script src="{{url('website/js/vendor/bootstrap.min.js')}}"></script>

    <!-- Slick Slider JS -->
    <script src="{{url('website/js/plugins/slick.min.js')}}"></script>
    <!-- Barrating JS -->
    <script src="{{url('website/js/plugins/jquery.barrating.min.js')}}"></script>
    <!-- Counterup JS -->
    <script src="{{url('website/js/plugins/jquery.counterup.js')}}"></script>
    <!-- Nice Select JS -->
    <script src="{{url('website/js/plugins/jquery.nice-select.js')}}"></script>
    <!-- Sticky Sidebar JS -->
    <script src="{{url('website/js/plugins/jquery.sticky-sidebar.js')}}"></script>
    <!-- Jquery-ui JS -->
    <script src="{{url('website/js/plugins/jquery-ui.min.js')}}"></script>
    <script src="{{url('website/js/plugins/jquery.ui.touch-punch.min.js')}}"></script>
    <!-- Lightgallery JS -->
    <script src="{{url('website/js/plugins/lightgallery.min.js')}}"></script>
    <!-- Scroll Top JS -->
    <script src="{{url('website/js/plugins/scroll-top.js')}}"></script>
    <!-- Theia Sticky Sidebar JS -->
    <script src="{{url('website/js/plugins/theia-sticky-sidebar.min.js')}}"></script>
    <!-- Waypoints JS -->
    <script src="{{url('website/js/plugins/waypoints.min.js')}}"></script>
    <!-- jQuery Zoom JS -->
    <script src="{{url('website/js/plugins/jquery.zoom.min.js')}}"></script>

    <!-- Vendor & Plugins JS (Please remove the comment from below vendor.min.js & plugins.min.js for better website load performance and remove js files from avobe) -->
     

    <!-- Main JS -->
    <script src="{{url('website/js/main.js')}}"></script>
</body>
</html>