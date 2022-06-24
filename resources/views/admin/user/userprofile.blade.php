@extends('layouts.theme')
@section('title', 'profile')
@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center mb-4">
                        @if( isset(Auth::user()->image) && file_exists('images/profile/'.Auth::user()->image))
                          <img class="mr-3" src="{{ asset('images/profile/'.Auth::user()->image) }}" alt="{{ Auth::user()->image }}">
                        @else
                         <img class="mr-3" src="{{ asset('images/profile/62a78f89223fd.jpg') }}" width="80" height="80"  alt="...">
                        @endif
                        {{-- <img class="mr-3" src="images/avatar/11.png" width="80" height="80" alt=""> --}}
                        <div class="media-body">
                            <h3 class="mb-0">{{ Auth::user()->name }}</h3>
                            <p class="text-muted mb-0">Role : {{ Auth::user()->type }}

                            </p>
                        </div>
                    </div>



                    <h4>About Me</h4>
                    <ul class="card-profile__info">
                        <li class="mb-1"><strong class="text-dark mr-4">Mobile</strong> <span>01793931609</span></li>
                        <li><strong class="text-dark mr-4">Email</strong> <span>{{ Auth::user()->email }}</span></li>
                    </ul>

                </div>

            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="tabs">
                        <h4>Personal Information</h4>
                     </div>

                    <div class="basic-form">
                        <form>

                                <div class="form-group ">
                                    <label>name</label>
                                    <input type="text" class="form-control" id="edit_name" name="name"
                                        placeholder="Enter a name.." value="">
                                </div>
                                <div class="form-group ">
                                    <label>Profile</label>
                                     <input type="file" class="form-control" id="edit_profile" name="profile"
                                    placeholder="Choose File" value="">
                                <div id="edit_profile_text" class="text-danger"></div>
                                </div>
                              <button type="submit" class="btn btn-dark">save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-3"></div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="tabs">
                       <h4>Update Password</h4>
                    </div>

                    <div class="basic-form">
                        <form>

                                <div class="form-group ">

                                    <input type="password" class="form-control" placeholder="Old Password">
                                </div>
                                <div class="form-group ">

                                    <input type="password" class="form-control" placeholder="New Password">
                                </div>
                                <div class="form-group ">

                                    <input type="password" class="form-control" placeholder="Conform Password">
                                </div>
                                <button type="submit" class="btn btn-dark">update Passowrd</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection
