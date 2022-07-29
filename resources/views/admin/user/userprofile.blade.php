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



                                <form action="" method=""  id="">


                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-2">
                                            <img id="edit_image_preview" src="{{ url('images/profile/62a7764c8bf14.jpg') }}" alt=""
                                                width="120" class="rounded-circle border border-dark" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="edit_fist_name" name="fist_name"
                                            placeholder="Enter a name.." value="{{ Auth::user()->fist_name }}" readonly>

                                         </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="edit_last_name" name="last_name"
                                            placeholder="Enter a name.." value="{{ Auth::user()->last_name }}" readonly>

                                        </div>

                                         </div>
                                         <div class="form-group row">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="edit_address" name="address"
                                                placeholder="Enter a Address.." value="{{ Auth::user()->address }}" readonly>

                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="edit_city" name="city"
                                                placeholder="Enter a city.." value="{{ Auth::user()->city }}" readonly>
                                                </div>

                                             </div>
                                             <div class="form-group row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="edit_region" name="region"
                                                    placeholder="Enter a region.." value="{{ Auth::user()->region }}" readonly>

                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="edit_mobile_no" name="mobile_no"
                                                    placeholder="Enter a mobile_no.." value="{{ Auth::user()->mobile_no }}" readonly>

                                                </div>

                                                 </div>

                                    <div class="form-group">
                                        <input type="email" class="form-control" id="mail" name="email"
                                            placeholder="Your valid email.." value="{{ Auth::user()->email }}" readonly>
                                            <div id="edit_email_text" class="text-danger"></div>
                                        </div>

                            </form>


                        </div>
                        <div class="tab-pane basic-form " id="personal">

                            <form action="{{route('updateinfo')}}" method="POST"  id="adminIninfo">
                                @csrf
                                {{-- <input type="hidden" value="-1" id="user_id"> --}}
                                <input type="hidden" value="PUT" name="_method">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-2">
                                        <img id="edit_image_preview" src="{{ url('images/profile/62a7764c8bf14.jpg') }}" alt=""
                                            width="120" class="rounded-circle border border-dark" />
                                    </div>
                                </div>
                                <div class="form-validation">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="edit_fist_name" name="fist_name"
                                        placeholder="Enter a name.." value="{{ Auth::user()->fist_name }}">
                                        <div id="edit_fist_name_text" class="text-danger backend-error-text"></div>
                                     </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="edit_last_name" name="last_name"
                                        placeholder="Enter a name.." value="{{ Auth::user()->last_name }}">
                                        <div id="edit_last_name_text" class="text-danger backend-error-text"></div>
                                    </div>

                                     </div>
                                     <div class="form-group row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="edit_address" name="address"
                                            placeholder="Enter a Address.." value="{{ Auth::user()->address }}">
                                            <div id="edit_address_text" class="text-danger backend-error-text"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="edit_city" name="city"
                                            placeholder="Enter a city.." value="{{ Auth::user()->city }}">
                                            <div id="edit_city_text" class="text-danger backend-error-text"></div> </div>

                                         </div>
                                         <div class="form-group row">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="edit_region" name="region"
                                                placeholder="Enter a region.." value="{{ Auth::user()->region }}">
                                                <div id="edit_region_text" class="text-danger backend-error-text"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="edit_mobile_no" name="mobile_no"
                                                placeholder="Enter a mobile_no.." value="{{ Auth::user()->mobile_no }}">
                                                <div id="edit_mobile_no_text" class="text-danger backend-error-text"></div>
                                            </div>

                                             </div>
                                <div class="form-group ">

                                     <input type="file" class="form-control" id="edit_profile" name="profile"
                                    placeholder="Choose File" value="">
                                    <div id="edit_fist_profile_text" class="text-danger backend-error-text"></div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="edit_email" name="email"
                                        placeholder="Enter a name.." value="{{ Auth::user()->email }}">
                                    <div id="edit_email_text" class="text-danger backend-error-text"></div>

                                    </div>
                              <button type="submit" name="submit"  class="btn btn-dark">save</button>
                                </div>
                        </form>

                        </div>
                        <div class="tab-pane basic-form " id="updatepassword">
                         <form action="{{route('changePassword')}}" method="POST" id="changepassword">
                            {{-- <input type="hidden" value="PUT" name="_method"> --}}
                            <div class="form-validation">

                            <div class="form-group ">
                                  <input type="text" class="form-control" id="oldpassword" placeholder="Old Password" name="oldpassword">

                                  <div id="edit_oldpassword_text" class="text-danger"></div></div>
                                <div class="form-group ">

                                    <input type="password" class="form-control" id="password" placeholder="New Password" name="password">
                                    <div id="edit_password_text" class="text-danger"></div></div>
                                <div class="form-group ">

                                    <input type="password" class="form-control" id="password" placeholder="Confirm Password" name="password_confirmation">
                                    <div id="edit_password_confirmation_text" class="text-danger"></div></div>
                                </div>
                                <button type="submit" class="btn btn-dark">update Passowrd</button>
                            </div>

                        </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


  @endsection
  @section('scripts')
  <script>

    (function($) {
        "use strict"




    })(jQuery);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(function(){
/* UPDATE ADMIN PERSONAL INFO */
$('#adminIninfo').on('submit', function(e){
    e.preventDefault();
    $.ajax({
       url:$(this).attr('action'),
       method:$(this).attr('method'),
       data:new FormData(this),
       processData:false,
       dataType:'json',
       contentType:false,
       beforeSend: function () {
            $('#adminIninfo')
            $('.backend-error-text').text('')
                .prop("disabled", true);
        },
        success: function (data) {

            $('#adminIninfo')
                .find('[type="button"]')
                .prop("disabled", false);
                swal({
                    title: "",
                    text: data.message,
                    icon: "success",
                  });
        },
        error: function (error) {
            $('#adminIninfo')
                .find('[type="button"]')
                .prop("disabled", false);
            var errorMessage = error.statusText;
            var sweetMessage = error.statusText;
            if (error.status == 422) {
                errorMessage = handleValidationErrors(error, 'edit')
                sweetMessage = 'Invalid Data'
            }
            swal({
                title: "Error",
                text: sweetMessage,
                icon: "error",
              });
            // toastr.error(errorMessage, "Error");
            // hideLoader();
        },
    });
    });
});
function handleValidationErrors(error, type = 'create') {
    let errors = error.responseJSON.errors;
    var errorMessage = error.responseJSON.message
    var element = '';
    $.each(errors, function (key, item) {
        element = key.split('.')
        if (element.length > 1) {
            element = `${element[0]}_${element[1]}`
        } else {
            element = `${element}`
        }
        // dataAttr = $(element).closest('.tab').data('id')
        // $(`.step-${dataAttr}`).addClass('backend-error')
        if (type == 'edit') {
            console.log('edit',element);
            $(`#edit_${element}_text`).text(item[0])
        } else if (type == 'create') {
            $(`#${element}_text`).text(item[0])
        }
    });

    return errorMessage;
}

$('#changepassword').on('submit', function(e){
     e.preventDefault();
     $.ajax({
        url:$(this).attr('action'),
        method:$(this).attr('method'),
        data:new FormData(this),
        processData:false,
        dataType:'json',
        contentType:false,
        beforeSend: function () {
            $('#changepassword')
                .find('[type="button"]')
                .prop("disabled", true);
        },
        success: function (data) {

            $('#changepassword')
                .find('[type="button"]')
                .prop("disabled", false);
                swal({
                    title: "",
                    text: data.msg,
                    icon: "success",
                  });
        },
        error: function (error) {
            $('#adminIninfo')
                .find('[type="button"]')
                .prop("disabled", false);
            var errorMessage = error.statusText;
            var sweetMessage = error.statusText;
            if (error.status == 422) {
                errorMessage = handleValidationErrors(error, 'edit')
                sweetMessage = 'Invalid Data'
            }
            swal({
                title: "Error",
                text: sweetMessage,
                icon: "error",
              });
            // toastr.error(errorMessage, "Error");
            // hideLoader();
        },
    });
    });



</script>
  @endsection
