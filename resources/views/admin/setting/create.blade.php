@extends('layouts.theme')
@section('title', 'Home')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                  @if ($errors->any())
            <div class="text-danger">
                <strong>Whoops!</strong><br> There were some<strong> problems</strong> with your input.<br><br>

            </div>
                @endif
                    <h4 class="card-title">Pages Setting</h4>

                    <div class="basic-form">
                        <form action="{{route('settings.store')}}"  method="Post" id="product-form" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group mb-8">
                                <label for=""> About Us Page</label>
                                <textarea class="form-control h-150px mysummernote" id="" name="about_us_detail" rows="6" placeholder="Write here.......">
                                   </textarea>
                                   @error('about_us_detail')
                                   <div class="text-danger">{{ $message }}</div>
                               @enderror
                            </div>
                            <div class="form-group mb-8">
                                <label for=""> Contact Us Page</label>
                                <textarea class="form-control h-150px mysummernote" id="" name="contact_us_detail" rows="6" placeholder="Write here.......">
                                   </textarea>
                                   @error('contact_us_detail')
                                   <div class="text-danger">{{ $message }}</div>
                               @enderror
                            </div>
                            <div class="form-group row ">

                                <div class="col-md-6 mb-8">
                                    <label for=""> Name</label>
                                    <input type="text" class="form-control input-default" placeholder="Etere Name" :value="old('name')" name="name">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="col-md-6 mb-8">
                                    <label for=""> Mobile Number</label>
                                    <input type="text" class="form-control input-default" placeholder="Mobile Number" :value="old('mobile_no1')" name="mobile_no1">
                                    @error('mobile_no1')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                                </div>


                               </div>
                               <div class="form-group row ">
                                <div class="col-md-6 mb-8">
                                    <label for=""> Email</label>
                                    <input type="text" class="form-control input-default" placeholder="Email" :value="old('email')" name="email">
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="col-md-6 mb-8">
                                    <label for=""> Mobile Number</label>
                                    <input type="text" class="form-control input-default" placeholder="Mobile Number" :value="old('mobile_no2')" name="mobile_no2">
                                    @error('mobile_no2')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                                </div>


                               </div>
                               <div class="form-group row mb-8">

                               <div class="col-lg-12  mb-8">
                                <label for="">Address</label>
                                <input type="text" class="form-control input-default" placeholder="Address" :value="old('address')" name="address">
                                @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>
                               </div>

                            <div class="form-group mb-8">
                                <label for="">Privacy And Policy Page</label>
                                <textarea class="form-control h-150px mysummernote" id="" name="privacyAndPolicyDetail" rows="6" placeholder="Write here.......">
                                   </textarea>
                                   @error('privacyAndPolicyDetail')
                                   <div class="text-danger">{{ $message }}</div>
                               @enderror
                            </div>









                               <div class="modal-footer">
                               <a href="{{url('/admin/settings')}}"  type="button" class="btn btn-secondary"> Close </a>
                               <button type="submit"  id="button-save"  class="btn btn-primary">Add Setting</button>
                            </div><br>



                            </form>
                    </div>
                </div>
            </div>
        </div>
 </div>
</div>

@endsection

