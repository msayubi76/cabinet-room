@extends('layouts.theme')
@section('title', 'Home')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-sm-8 text-left">
                                <h4 class="card-title">Users Table</h4>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-4 text-right">
                                @can('create-user')


                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addUserModal">Add
                                    User</button>
                                    @endcan


                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Fist Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Type</th>
                                        <th>Profile</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table_id">
                                    @foreach ($users as $user)
                                        <tr id='row_{{ $user->id }}'>
                                            <td>{{ $user->fist_name }}</td>
                                            <td>{{ $user->last_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            {{-- <td>
                                                @if ($user->email_verified_at == null)
                                                    Not Approved
                                                @else
                                                    Approved
                                                @endif
                                            </td> --}}
                                            <td> @foreach($user->roles as $role)

                                                <span class="">{{ $role->name }}</span>


                                                @endforeach</td>
                                            <td>{{ $user->type }}</td>

                                            <td><img src="{{ $user->image_url }}" height="50px" width="50px"
                                                alt=""></td>
                                            <td>
                                                <div class="button-group">
                                                    <div class="btn-group">
                                                        <div class="btn-group">
                                                            <button id="btnGroupDrop1" type="button"
                                                                class="btn btn-primary dropdown-toggle py-0 px-2"
                                                                data-toggle="dropdown"></button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                href="javascript:openViewModal({{ json_encode($user) }})">View</a>
                                                                @can('update-user')
                                                                <a class="dropdown-item"
                                                                    href="javascript:openEditModal({{ json_encode($user) }})">Edit</a>
                                                                    @endcan
                                                                    @can('delete-user')
                                                                <a class="dropdown-item"
                                                                    href="javascript:openDeleteDialog({{ $user->id }})">Delete</a>
                                                                    @endcan
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" value="-1" id="deleteID">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete User
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" id="button-delete" class="btn btn-primary" onclick="deleteUser()">Yes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- add --}}
    <div class="modal fade" id="addUserModal">
        <div class="modal-dialog modal-m modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form class="form-valide" id="user-form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-2">
                                <img id="image_preview" src="{{ url('images/profile/default_image.png') }}" alt=""
                                   width="120" height="100" class="rounded-circle border border-dark" />
                            </div>
                        </div>
                        <div class="form-validation">
                            <div class="form-group row">

                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="fist_name" name="fist_name"
                                        placeholder="Fist Name" :value="old('fist_name')">
                                    <div id="fist_name_text" class="text-danger backend-error-text"></div>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        placeholder="Last Name" :value="old('last_name')">
                                    <div id="last_name_text" class="text-danger backend-error-text"></div>
                                </div>
                            </div>
                            <div class="form-group row">

                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="mobile_no" name="mobile_no"
                                        placeholder="Mobile No" :value="old('mobile_no')">
                                    <div id="mobile_no_text" class="text-danger backend-error-text"></div>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Address" :value="old('address')">
                                    <div id="address_text" class="text-danger backend-error-text"></div>
                                </div>
                            </div>
                            <div class="form-group row">

                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="city" name="city"
                                        placeholder="City" :value="old('city')">
                                    <div id="city_text" class="text-danger backend-error-text"></div>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="region" name="region"
                                        placeholder="Region" :value="old('region')">
                                    <div id="region_text" class="text-danger backend-error-text"></div>
                                </div>
                            </div>
                            <div class="form-group row">

                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Email" :value="old('email')">
                                    <div id="email_text" class="text-danger backend-error-text"></div>
                                </div>
                                <div class="col-md-6">
                                    <input type="file" class="form-control" id="profile" name="profile"
                                        placeholder="profile" :value="old('profile')">
                                    <div id="profile_text" class="text-danger backend-error-text"></div>
                                </div>
                            </div>
                            <div class="form-group row">

                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="password " :value="old('password')">
                                    <div id="password_text" class="text-danger backend-error-text"></div>
                                    @error('password')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="password"
                                        name="password_confirmation" placeholder=" Confirm it!">
                                    <div id="confirmed_text" class="text-danger"></div>
                                </div>
                            </div>
                            <h3 class="text-xl my-4 text-gray-600">Role</h3>
                            <div class="grid grid-cols-3 gap-4">
                              @foreach($roles as $role)

                                  <div class="flex flex-col justify-cente">
                                      <div class="flex flex-col">
                                          <label class="inline-flex items-center mt-3">
                                              <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="roles[]" value="{{$role->id}}"
                                              ><span class="ml-2 text-gray-700">{{ $role->name }}</span>
                                          </label>
                                      </div>
                                  </div>
                              @endforeach
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" id="button-save" onclick="submitUser(this)"
                                class="btn btn-primary">Add User</button>
                        </div>
                    </form>

                </div>


            </div>
        </div>
    </div>
    {{-- edit --}}
    <div class="modal fade" id="editModalUser">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-valide" id="edit-user-form" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="-1" id="user_id">
                        <input type="hidden" value="PUT" name="_method">

                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-2">

                                <img id="edit_image_preview" src="{{ url('images/profile/62a7764c8bf14.jpg') }}"
                                    alt="" width="120" class="rounded-circle border border-dark" />
                            </div>
                        </div>
                        <div class="form-validation">
                            <div class="form-group row">

                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="edit_fist_name" name="fist_name"
                                        placeholder="Enter a name.." value="">
                                    <div id="edit_fist_name_text" class="text-danger backend-error-text"></div>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="edit_last_name" name="last_name"
                                        placeholder="Enter a name.." value="">
                                    <div id="edit_last_name_text" class="text-danger backend-error-text"></div>
                                </div>
                            </div>
                            <div class="form-group row">

                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="edit_mobile_no" name="mobile_no"
                                        placeholder="Enter a name.." value="">
                                    <div id="edit_mobile_no_text" class="text-danger backend-error-text"></div>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="edit_address" name="address"
                                        placeholder="Enter a name.." value="">
                                    <div id="edit_address_text" class="text-danger backend-error-text"></div>
                                </div>
                            </div>
                            <div class="form-group row">

                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="edit_city" name="city"
                                        placeholder="Enter a name.." value="">
                                    <div id="edit_city_text" class="text-danger backend-error-text"></div>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="edit_region" name="region"
                                        placeholder="Enter a name.." value="">
                                    <div id="edit_region_text" class="text-danger backend-error-text"></div>
                                </div>
                            </div>
                            <div class="form-group row">

                                <div class="col-md-6">
                                    <input type="email" class="form-control" id="edit_email" name="email"
                                        placeholder="Enter a name.." value="">
                                    <div id="edit_email_text" class="text-danger backend-error-text"></div>
                                </div>
                                <div class="col-md-6">
                                    <input type="file" class="form-control" id="edit_profile" name="profile"
                                        placeholder="Enter a name.." value="">
                                    <div id="edit_profile_text" class="text-danger backend-error-text"></div>
                                </div>
                            </div>


                                <h3 class="text-xl my-4 text-gray-600">Role</h3>
                                <div class="grid grid-cols-3 gap-4">
                                  @foreach($roles as $role)
                                      <div class="flex flex-col justify-cente">
                                          <div class="flex flex-col">
                                              <label class="inline-flex items-center mt-3">
                                                  <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="roles[]" value="{{$role->id}}"
                                                  @if(count($user->roles->where('id',$role->id)))
                                                      checked
                                                  @endif
                                                  ><span class="ml-2 text-gray-700">{{ $role->name }}</span>
                                              </label>
                                          </div>
                                      </div>
                                  @endforeach



                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" id="button-update" onclick="editUser(this)"
                                class="btn btn-primary">Edit User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- view --}}
    <div class="modal fade" id="viewModalUser">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View User</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-valide" id="view-user-form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-2">
                                <img id="view_image_preview" src="{{ url('images/profile/default_image.png') }}"
                                    alt="" width="120" class="rounded-circle border border-dark" />
                            </div>
                        </div>
                        <div class="form-validation">
                            <div class="form-group row">
                                <div class="col-12 text-center">
                                    <label class=" col-form-label" id="view_fist_name" for="">
                                    </label>
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-12 text-center">
                                    <label class=" col-form-label" id="view_last_name" for="">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 text-center">
                                    <label class="col-lg-4 col-form-label" id="view_email" for="">
                                    </label>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        profile.onchange = evt => {
            const [file] = profile.files
            console.log('file', file);
            if (file) {
                image_preview.src = URL.createObjectURL(file)
            }
        }
        edit_profile.onchange = evt => {
            const [file] = edit_profile.files
            if (file) {
                edit_image_preview.src = URL.createObjectURL(file)
            }
        }





        function submitUser() {

            var form = $('#user-form')[0];
            $("#button-save").text('Loading...');

            const myFormData = new FormData(form);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                url: "/admin/users", // the endpoint
                type: "POST", // http method
                processData: false,
                contentType: false,
                data: myFormData,
                beforeSend: function() {
                    $('.backend-error-text').text('')
                    $("#button-save").prop("disabled", true);
                },
                success: function(data) {

                    $("#button-save").prop("disabled", false);
                    $("#button-save").text("Add User");
                    console.log('data', data);
                    if (data.status == false) {
                        swal({
                            title: "Error",
                            text: data.message,
                            icon: "error",
                        });
                        return;
                    }

                    swal({
                        title: "",
                        text: data.message,
                        icon: "success",
                    });

                    document.getElementById("user-form").reset();


                    const USER = JSON.stringify(data.user)


                    var string =
                        `<tr id="row_${data.user.id}">
                                <td>${data.user.fist_name}</td>
                                <td>${data.user.last_name}</td>
                                <td>${data.user.email}</td>
                                <td>${data.user.roles.name}</td>
                                <td>${data.user.type}</td>
                                <td><img src="${data.user.image_url}" alt="" height="50px" width="50px"></td>
                                <td>
                                    <div class="button-group">
                                        <div class="btn-group">
                                            <div class="btn-group"><button id="btnGroupDrop${data.user.id}" type="button"
                                                    class="btn btn-primary dropdown-toggle py-0 px-2" data-toggle="dropdown"></button>
                                                <div class="dropdown-menu"> <a class="dropdown-item" onclick="openViewModal(${data.user})">View</a>
                                                    <a class="dropdown-item" href="javascript:;" onclick='openEditModal(${USER})' >Edit</a><a
                                                        class="dropdown-item" href="javascript:;" onclick="openDeleteDialog(${data.user.id})">Delete</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>`
                    $("#table_id").append(string);

                    $('#addUserModal').modal('hide');

                },
                error: function(error) {
                    $("#button-save").prop("disabled", false);
                    $("#button-save").text("Add User");

                    var errorMessage = error.statusText;
                    var sweetMessage = error.statusText;
                    if (error.status == 422) {
                        errorMessage = handleValidationErrors(error)
                        sweetMessage = 'Invalid Data'
                    }
                    swal({
                        title: "Error",
                        text: sweetMessage,
                        icon: "error",
                    });


                },
            });
        }

        function editUser() {

            var form = $('#edit-user-form')[0];
            $("#button-update").text('Loading...');
            user_id = form.user_id.value;


            const myFormData = new FormData(form);



            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                url: "/admin/users/" + user_id, // the endpoint
                type: "POST", // http method
                processData: false,
                contentType: false,
                data: myFormData,
                beforeSend: function() {
                    $(form)
                    $('.backend-error-text').text('')
                    $("#button-update").prop("disabled", true);
                },
                success: function(data) {

                    $("#button-update").prop("disabled", false);
                    $("#button-update").text("Edit User");

                    if (data.status == false) {
                        swal({
                            title: "Error",
                            text: data.message,
                            icon: "error",
                        });
                        return;
                    }


                    swal({
                        title: "",
                        text: data.message,
                        icon: "success",
                    });

                    const USER = JSON.stringify(data.user)
                    $("#row_" + data.user.id).remove();
                    var string =
                        `<tr id="row_${data.user.id}">
                            <td>${data.user.fist_name}</td>
                            <td>${data.user.last_name}</td>
                            <td>${data.user.email}</td>

                            <td>${data.user.roles.name}</td>
                                <td>${data.user.type}</td>
                                <td><img src="${data.user.image_url}" alt="" height="50px" width="50px"></td>

                            <td>
                                <div class="button-group">
                                    <div class="btn-group">
                                        <div class="btn-group"><button id="btnGroupDrop${data.user.id}" type="button"
                                                class="btn btn-primary dropdown-toggle py-0 px-2" data-toggle="dropdown"></button>
                                            <div class="dropdown-menu"> <a class="dropdown-item" onclick="openViewModal(${data.user})">View</a>
                                                <a class="dropdown-item" href="javascript:;" onclick='openEditModal(${USER})'>Edit</a><a
                                                    class="dropdown-item" href="javascript:;" onclick="openDeleteDialog(${data.user.id})">Delete</a></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>`
                    $("#table_id").append(string);


                    $('#editModalUser').modal('hide');

                },
                error: function(error) {
                    $("#button-update").prop("disabled", false);
                    $("#button-update").text("Edit User");
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



                },
            });
        }


        function openEditModal(user) {

            console.log('openEditModal', user);

            document.getElementById('edit_fist_name').value = user.fist_name;
            document.getElementById('edit_last_name').value = user.last_name;
            document.getElementById('edit_mobile_no').value = user.mobile_no;
            document.getElementById('edit_address').value = user.address;
            document.getElementById('edit_city').value = user.city;
            document.getElementById('edit_region').value = user.region;
            document.getElementById('edit_email').value = user.email;
            document.getElementById('user_id').value = user.id;



            var image;
            if (user.image_url) {
                image = user.image_url;
            } else {
                image = base_url + '/storage/profile/62a7764c8bf14.jpg';
            }
            // document.getElementById('edit_profile').value = user.image_name;
            $('#edit_image_preview').attr('src', image)
            // document.getElementById('edit_image_preview').src = user.image_url;
            $("#editModalUser").modal()
        }

        function openViewModal(user) {
            // document.getElementById('view_name').value = user.name;
            // document.getElementById('view_email').value = user.email;
            document.getElementById("view_fist_name").innerHTML = user.fist_name;
            document.getElementById("view_last_name").innerHTML = user.last_name;
            // document.getElementById("view_mobile_no").innerHTML = user.mobile_no;
            // document.getElementById("view_address").innerHTML = user.address;
            // document.getElementById("view_city").innerHTML = user.city;
            // document.getElementById("view_region").innerHTML = user.region;
            // document.getElementById("view_profile").innerHTML = user.profile;

            document.getElementById("view_email").innerHTML = user.email;

            var image;
            if (user.image_url) {
                image = user.image_url;
            } else {
                image = base_url + '/storage/profile/default_image.png';
            }
            $('#view_image_preview').attr('src', image)
            $("#viewModalUser").modal()
        }

        function openDeleteDialog(id) {
            $("#deleteID").val(id);
            $("#deleteModal").modal('show');
        }

        function deleteUser() {
            $("#button-delete").text('Loading...');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: "/admin/users/" + $("#deleteID").val(), // the endpoint
                type: "DELETE", // http method
                processData: false,
                contentType: false,
                success: function(data) {
                    $("#button-delete").prop("disabled", false);
                    $("#button-delete").text("Yes");
                    if (data.status == false) {
                        swal({
                            title: "Error",
                            text: data.message,
                            icon: "error",
                        });
                        return;
                    }
                    $('.alert-success').html(data.success).fadeIn('slow');
                    // $('.alert-success').delay(3000).fadeOut('slow');
                    document.getElementById("row_" + $("#deleteID").val()).remove();
                    swal({
                        title: "",
                        text: data.message,
                        icon: "success",
                    });
                    $('#deleteModal').modal('hide');
                },
                error: function(error) {
                    $("#button-delete").prop("disabled", false);
                    $("#button-delete").text("Yes");
                    swal({
                        title: "Error",
                        text: sweetMessage,
                        icon: "error",
                    });

                    // toastr.error(errorMessage, "Error");
                    // hideLoader();
                },
            });
        }

        function handleValidationErrors(error, type = 'create') {
            let errors = error.responseJSON.errors;
            var errorMessage = error.responseJSON.message
            var element = '';
            $.each(errors, function(key, item) {
                element = key.split('.')
                if (element.length > 1) {
                    element = `${element[0]}_${element[1]}`
                } else {
                    element = `${element}`
                }
                // dataAttr = $(element).closest('.tab').data('id')
                // $(`.step-${dataAttr}`).addClass('backend-error')
                if (type == 'edit') {
                    console.log('edit', element);
                    $(`#edit_${element}_text`).text(item[0])

                } else if (type == 'create') {
                    $(`#${element}_text`).text(item[0])

                }
            });

            return errorMessage;
        }
        // function showLoader(message, options) {
        //   waitingDialog.show(message, options);
        // }
    </script>
@endsection
