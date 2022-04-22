@extends('layouts.theme')
@section('title','Customer')
@section('style')
    <link href="{{url('libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" /> 
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid user-registrition">
        <div class="card-body user-card"> 
            <div class="card"> 
                 <div class="card-body">
                    <h3 class="text-center">Change Password</h3> 
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        @include('alertsInfo')
                    <form action="{{url('save-change-password')}}" method="POST"> 
                        @csrf 
                        <input type="hidden" value="{{encrypt(Auth::user()->id)}}" name="id">
                            <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-1">
                                                <label for="old-passwor" class="control-label">Old Password</label>
                                                <input autocomplete="off" name="current_password" type="password" id="old-password" class="form-control {{ $errors->has('current_password') ? ' has-error' : '' }}"  placeholder="Old Password">
                                            </div>
                                            @if ($errors->has('current_password')) <div class="errMsg"> <span>{{ $errors->first('current_password') }}</span> </div> @endif
                                        
                                        </div>
                                       <div class="col-md-12">
                                            <div class="form-group mb-1">
                                                <label for="new-password" class="control-label">New Password</label>
                                                <input autocomplete="off" name="new_password" type="password" id="new-password" class="form-control {{ $errors->has('new_password') ? ' has-error' : '' }}"  placeholder="New Password">
                                            </div>
                                            @if ($errors->has('new_password')) <div class="errMsg"> <span>{{ $errors->first('new_password') }}</span> </div> @endif
                                    
                                        </div>
                                        <div class="col-md-12">
                                        <div class="form-group mb-1">
                                            <label for="change-password" class="control-label">Confirm Password</label>
                                            <input autocomplete="off"  name="password_confirmation" type="password" id="confirm-new-password"  class="form-control {{ $errors->has('password_confirmation') ? ' has-error' : '' }}"  placeholder="Confirm Password">
                                        </div>
                                        @if ($errors->has('password_confirmation'))  <div class="errMsg"> <span>{{ $errors->first('password_confirmation') }}</span> </div> @endif
                                    </div>
                            </div>                                          
                            <button type="submit" class="btn btn-success pull-right mt-1">Change</button> 
                    </form>
                    </div>
                </div>
                 </div>
            </div>
        </div>
    </div>
</div>

 
@endsection