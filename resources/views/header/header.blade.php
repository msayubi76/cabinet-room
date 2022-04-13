<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{url('/')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{url('site_images/logo.jpeg')}}" alt="" height="58">
                    </span>
                    <span class="logo-lg">
                        <img src="{{url('site_images/logo.jpeg')}}" alt="" height="55">
                    </span>
                </a>
                <a href="{{url('/')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{url('site_images/logo.jpeg')}}"alt="" height="58">
                    </span>
                    <span class="logo-lg">
                        <img src="{{url('site_images/logo.jpeg')}}" alt="" height="58">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="mdi mdi-menu"></i>
            </button>


 
        </div>



        <div class="d-flex">




            <div class="dropdown d-none d-lg-inline-block ml-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="mdi mdi-fullscreen"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if (Auth::user()->image)
                        <img class="rounded-circle header-profile-user" src="{{url('site_images/users/'.Auth::user()->image)}}"
                        alt="Header Avatar">
                        @else
                        <img class="rounded-circle header-profile-user" src="{{url('site_images/logo.jpeg')}}"
                        alt="Header Avatar">
                    @endif
                    

                    
                    <span class="d-none d-xl-inline-block ml-1">{{Auth::user()->name}}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a class="dropdown-item" href="{{url('edit/profile/'.encrypt(Auth::id()))}}"><i class="dripicons-user text-muted mr-2"></i> Profile</a>
                    <a class="dropdown-item" data-target="#modal_change_password" data-toggle="modal"  
                    id="change_password_he"
                    href="javascript:;" ><i class="dripicons-wallet text-muted mr-2"></i>Change Password</a>
                    {{--<a class="dropdown-item d-block" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a>--}}
                    {{--<a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>--}}
                    @if (Route::has('login'))
                        @auth
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item"
                            href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                <i class="dripicons-exit text-muted mr-2"></i> Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endauth
                    @endif
                </div>
            </div>
 

        </div>
    </div>
    
</header>
<div class="modal fade" id="modal_change_password" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Change Password</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        </div>
        <div class="modal-body">
            <p class="text-success text-center " id="success_msg">  </p>    
            <form  
            {{-- action="{{url('save-change-password')}}"  --}} id="change_password_form"
             method="POST"> 
                @csrf 
                <input type="hidden" value="{{encrypt(Auth::user()->id)}}" name="id">
                    <div class="row">
                                <div class="col-md-12">
                                   
                                    <div class="form-group mb-1">
                                        <label for="old-passwor" class="control-label">Old Password</label>
                                        <input autocomplete="off" name="current_password" type="password" id="old-password" class="form-control {{ $errors->has('current_password') ? ' has-error' : '' }}"  placeholder="Old Password">
                                    </div>
                                    <span class="text-danger " id="error_current_password">  </span>                                
                                </div>
                               <div class="col-md-12">
                                    <div class="form-group mb-1">
                                        <label for="new-password" class="control-label">New Password</label>
                                        <input autocomplete="off" name="new_password" type="password" id="new-password" class="form-control {{ $errors->has('new_password') ? ' has-error' : '' }}"  placeholder="New Password">
                                    </div>
                                   
                                    <span class="text-danger " id="error_new_password">  </span>  
                                </div>
                                <div class="col-md-12">
                                <div class="form-group mb-1">
                                    <label for="change-password" class="control-label">Confirm Password</label>
                                    <input autocomplete="off"  name="password_confirmation" type="password" id="confirm-new-password"  class="form-control {{ $errors->has('password_confirmation') ? ' has-error' : '' }}"  placeholder="Confirm Password">
                                </div>
                                
                                <span class="text-danger " id="error_password_confirmation">  </span>  
                                 </div>
                    </div>                                          
                    <button type="submit" class="btn btn-success pull-right mt-1 " id="change_password">Change</button> 
            </form>
        </div> 
    </div>
    <!-- /.modal-content -->
    </div>      
</div>