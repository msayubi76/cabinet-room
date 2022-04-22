@extends('layouts.theme')
@section('title','Create User')
@section('style')
    <link href="{{url('libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid user-registrition">
        <div class="  w-100">
            <div class="card-body user-card">
                <div class="card">
                     <div class="card-body">
                         <div class="row">
                             <div class="col-md-12 col-xl-12">
                                 <div class="card">
                                     <div class="card-body">

                                         <h5 class="card-title">User Registration</h5>
                                         <p class="card-title-desc">Create User for running your business and assign role to access your business model</p>
                                        @include('alertsInfo')
                                         <form class="custom-validation" action="{{url('user') }}" method="post">
                                             @csrf
                                             <div class="row">
                                                 <div class="col-md-6">
                                                     <div class="form-group ">
                                                         <label class="control-label">Name</label>
                                                         <input class="form-control" required placeholder="Name" name="name" type="text" value="{{old('name')}}">
                                                         @if ($errors->has('name'))
                                                         <div class="invalid-feedback"  style="display: block">{{ $errors->first('name') }}</div>
                                                         @endif

                                                     </div>
                                                 </div>
                                                 <div class="col-md-6">
                                                     <div class="form-group ">
                                                         <label class="control-label">User Name</label>
                                                         <input class="form-control" required placeholder="User name" name="username" type="text" value="{{old('username')}}">
                                                         @if ($errors->has('username'))
                                                             <div class="invalid-feedback"  style="display: block">{{ $errors->first('username') }}</div>
                                                         @endif

                                                     </div>
                                                 </div>
                                             </div>

                                             <div class="row">
                                                 <div class="col-md-6">
                                                     <div class="form-group ">
                                                         <label class="control-label">E-Mail Address</label>
                                                         <input class="form-control" parsley-type="email" required  placeholder="Email" name="email" type="text" value="{{old('email')}}">
                                                         @if ($errors->has('email'))
                                                             <div class="invalid-feedback"  style="display: block">{{ $errors->first('email') }}</div>
                                                         @endif

                                                     </div>
                                                 </div>
                                                 <div class="col-md-6">
                                                     <div class="form-group ">
                                                         <label class="control-label">Phone/Mobile Number</label>
                                                         <input class="form-control" required placeholder="Mobile Number" name="phone" type="text" value="{{old('phone')}}">
                                                         @if ($errors->has('phone'))
                                                             <div class="invalid-feedback"  style="display: block">{{ $errors->first('phone') }}</div>
                                                         @endif

                                                     </div>
                                                 </div>
                                             </div>

                                             <div class="row">
                                                 <div class="col-md-6">
                                                     <div class="form-group ">
                                                         <label class="control-label">Password</label>
                                                         <input class="form-control" required id="pass2" placeholder="Password" name="password" type="password" value="{{old('password')}}">
                                                         @if ($errors->has('password'))
                                                             <div class="invalid-feedback"  style="display: block">{{ $errors->first('password') }}</div>
                                                         @endif

                                                     </div>
                                                 </div>
                                                 <div class="col-md-6">
                                                     <div class="form-group ">
                                                         <label class="control-label">Confirm Password</label>
                                                         <input class="form-control"  data-parsley-equalto="#pass2" required placeholder="Confirm Password" name="password_confirmation" type="password" value="{{old('password_confirmation')}}">
                                                         @if ($errors->has('password_confirmation'))
                                                             <div class="invalid-feedback"  style="display: block">{{ $errors->first('password_confirmation') }}</div>
                                                         @endif

                                                     </div>
                                                 </div>
                                             </div>

                                             <div class="row">
                                                 <div class="col-md-6">
                                                     <div class="form-group ">
                                                         <label class="control-label">Full Address</label>
                                                         <input class="form-control"   placeholder="Address" name="address" type="text" value="{{old('address')}}">
                                                         @if ($errors->has('address'))
                                                             <div class="invalid-feedback"  style="display: block">{{ $errors->first('address') }}</div>
                                                         @endif

                                                     </div>
                                                 </div>
                                                 <div class="col-md-6">
                                                     <div class="form-group ">
                                                         <label class="control-label">Select Role</label>
                                                         <select data-placeholder="Select Role" required  id="roles" name ="roles" class="form-control select2"  >
                                                             <option value="">Select Role</option>
                                                             @foreach ($roles as $role)
                                                                 @if ($role->id != 1)
                                                                     <option    value="{{$role->id}}" @if(old('roles')==$role->id) selected @endif>{{$role->name}}</option>
                                                                 @endif
                                                             @endforeach
                                                         </select>
                                                     </div>

                                                 </div>
                                             </div>
                                             <div class="row">

                                                 <div class="col-md-12">
                                                     <div class="form-group  text-right">
                                                        <a href="{{url('user')}}" class="btn btn-danger">Cancel</a>
                                                             <button type="submit" class="btn
                                                            btn-light waves-effect waves-light">
                                                                 Submit
                                                             </button>
                                                             
                                                        
                                                     </div>
                                                 </div>
                                             </div>

                                         </form>

                                     </div>
                                 </div>
                             </div> <!-- end col -->


                         </div> <!-- end row -->

                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{url("libs/parsleyjs/parsley.min.js")}}"></script>
<script src="{{url('libs/select2/js/select2.min.js')}}"></script>   
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone.min.js"></script>
    <script>
        $(".select2").select2({
            minimumResultsForSearch: -1,
            placeholder: function(){
                $(this).data('placeholder');
            }
        });
    </script>
@endsection
