@extends('layouts.website_theme')
@section('web_title','Customer Registration')
  
@section('website_content')
<style>
    .parsley-required{
        color: red;
    }
    .parsley-errors-list li {
        color: red !important;
    }

    .parsley-error {
        border: 1px solid red  !important;
    }
</style>
 
    <div class="container-fluid user-registrition">
        <div class="  w-100">
            <div class="card-body user-card">
                <div class="card">
                     <div class="card-body">
                         <div class="row">
                             <div class="col-md-12 col-xl-12">
                                 <div  >
                                     <div class="card-body text-uppercase">

                                         <h5 class="card-title">Customer Registration</h5>
                                         @include('alertsInfo')
                                         <form class="custom-validation" action="{{url('customer/save') }}" method="post">
                                             @csrf
                                             <input type="hidden" name="user_type" value="customer">
                                             <input type="hidden" name="time_zone" id="time_zone">
                                             <div class="row">
                                                 <div class="col-md-6 text-uppercase">
                                                     <div class="form-group text-uppercase">
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
                                                         <input class="form-control" parsley-type="email" required placeholder="Email" name="email" type="text" value="{{old('email')}}">
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
                                                 
                                             </div>
                                             <div class="row">

                                                 <div class="col-md-12">
                                                     <div class="form-group  text-right text-uppercase">
                                                         
                                                             <button type="submit" class="btn
                                                            btn-success waves-effect waves-light text-uppercase">
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
 @include('footer.website_footer')
@endsection

@section('website_script')
    <script src="{{url("libs/parsleyjs/parsley.min.js")}}"></script>
 
    <script src="{{url('js/pages/form-validation.init.js')}}"></script>
    <script>
        var tz = moment.tz.guess(); 
        $("#time_zone").val(tz);
    </script>
 @endsection
  
