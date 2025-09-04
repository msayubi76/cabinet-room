{{-- <!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Cabinet | Register</title>
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

                                <form class="mt-5 mb-5 login-input" method="post" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control"  placeholder="first Name"  name="fist_name" value="{{old('fist_name')}}"  required>
                                            @error('fist_name')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control"  placeholder="Last Name"  name="last_name" value="{{old('last_name')}}"  required>
                                            @error('last_name')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control"  placeholder="Address"  name="address" value="{{old('address')}}"  required>
                                            @error('address')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control"  placeholder="Phone Number"  name="mobile_no" value="{{old('mobile_no')}}"  required>
                                            @error('mobile_no')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control"  placeholder="City"  name="city" value="{{old('city')}}"  required>
                                            @error('city')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control"  placeholder="Region"  name="region" value="{{old('region')}}"  required>
                                            @error('region')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control"  placeholder="Email"  name="email" value="{{old('email')}}"  required>
                                        @error('email')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                                        @error('password')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="password confirmation" name="password_confirmation" required>
                                        @error('password_confirmation')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <button class="btn login-form__btn submit w-100" type="submit">Sign Up </button>
                                </form>
                                    <p class="mt-5 login-form__footer">If you have already account? <a  href="{{ route('login') }}" class="text-primary">Sign In </a> now</p>
                                    </p>
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
