@extends('layouts.theme')
@section('title', 'profile')
@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="tabs">
                       <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a  class="nav-link active" data-toggle="pill" href="#profile"  >Profile </a>
                        </li>
                    <li class="nav-item">
                        <a  class="nav-link" data-toggle="pill" href="#personal" >Update Profile</a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link" data-toggle="pill" href="#updatepassword" >Update Password</a>
                    </li>
                    </ul>
                    {{-- <h4>Personal Information</h4> --}}
                     </div>

                    <div class="tab-content  py-3">
                        <div class="tab-pane basic-form fade show active" id="profile">


                                <div class="card">
                                    <div class="card-body">
                                        <div class="media align-items-center mb-4">
                                            @if( isset(Auth::user()->image) && file_exists('images/profile/'.Auth::user()->image))
                                              <img class="mr-3 img-circle" src="{{ asset('images/profile/'.Auth::user()->image) }}" alt="{{ Auth::user()->image }}">
                                            @else
                                             <img class="mr-3 img-circle" src="{{ asset('images/profile/default_image.png') }}" width="80" height="80"  alt="...">

                                            @endif
                                            {{-- <img class="mr-3" src="images/avatar/11.png" width="80" height="80" alt=""> --}}
                                            {{-- <div class="media-body">
                                                <h3 class="mb-0"></h3>
                                                <p class="text-muted mb-0">Role :

                                                </p>
                                            </div> --}}
                                        </div>




                                        <h4 class="text-align-center">About Me</h4>
                                        <ul class="card-profile__info">
                                            <li class="mb-1"><strong class="text-dark mr-4">Name</strong> <span>{{ Auth::user()->name }}</span></li>
                                            <li class="mb-1"><strong class="text-dark mr-4">Role</strong> <span>{{ Auth::user()->type }}</span></li>
                                            <li><strong class="text-dark mr-4">Email</strong> <span>{{ Auth::user()->email }}</span></li>
                                            <li><strong class="text-dark mr-4">Email</strong> <span>{{ Auth::user()->password }}</span></li>
                                        </ul>


                                    </div>

                                </div>


                        </div>
                        <div class="tab-pane basic-form " id="personal">

                            <form action="{{route('updateinfo')}}" method="POST" id="adminIninfo">

                                <div class="form-group ">

                                    <input type="text" class="form-control" id="edit_name" name="name"
                                        placeholder="Enter a name.." value="{{ Auth::user()->name }}">
                                        <span class="text-dange error-text name_error"></span>
                                </div>
                                <div class="form-group ">

                                     <input type="file" class="form-control" id="edit_profile" name="profile"
                                    placeholder="Choose File" value="">
                                <div id="edit_profile_text" class="text-danger"></div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="mail" name="email"
                                        placeholder="Your valid email.." value="{{ Auth::user()->email }}">
                                        <span class="text-dange error-text email_error"></span>

                                </div>
                              <button type="submit" name="submit" class="btn btn-dark">save</button>
                        </form>

                        </div>
                        <div class="tab-pane basic-form " id="updatepassword">
                         <form action="{{route('changePassword')}}" method="POST" id="changepassword">
                            <div class="form-group ">
                                  <input type="text" class="form-control" id="oldpassword" placeholder="Old Password" name="oldpassword">
                                    <span class="text-dange error-text oldpassword_error"></span>
                                </div>
                                <div class="form-group ">

                                    <input type="text" class="form-control" id="newpassword" placeholder="New Password" name="newpassword">
                                    <span class="text-dange error-text newpassword_error"></span>
                                </div>
                                <div class="form-group ">

                                    <input type="text" class="form-control" id="cnewpassword" placeholder="Confirm Password" name="cnewpassword">
                                    <span class="text-dange error-text cnewpassword_error"></span>
                                </div>
                                <button type="submit" class="btn btn-dark">update Passowrd</button>
                        </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>









  @endsection
