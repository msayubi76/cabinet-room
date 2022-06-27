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
                                <h4 class="card-title">Roles Table</h4>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-4 text-right">
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addRoleModal">Add
                                    Role</button>

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Guard Name</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr id='row_{{ $role->id }}'>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->guard_name }}</td>

                                            <td>
                                                <div class="button-group">
                                                    <div class="btn-group">
                                                        <div class="btn-group">
                                                            <button id="btnGroupDrop1" type="button"
                                                                class="btn btn-primary dropdown-toggle py-0 px-2"
                                                                data-toggle="dropdown"></button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    onclick="openViewModal({{ $role }})">View</a>
                                                                <a class="dropdown-item"
                                                                    onclick="openEditModal({{ $role }})">Edit</a>
                                                                <a class="dropdown-item" data-toggle="modal"
                                                                    data-target="#deleteModal_{{ $role->id }}">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="deleteModal_{{ $role->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Delete Role
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this Role?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">No</button>
                                                        <button type="button" class="btn btn-primary"
                                                            onclick="delete({{ $role->id }})">Yes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Guard Name</th>

                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- add --}}
    <div class="modal fade" id="addRoleModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Role</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form class="form-valide" id="role-form" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-validation">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="name">Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="name form-control" id="name" name="name"
                                        placeholder="Enter a name.." :value="old('name')">
                                    <div id="name_text" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="guard_name">Guard Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="name form-control" id="guard_name" name="guard_name"
                                        placeholder="Enter a name.." :value="old('guard_name')">
                                    <div id="guard_name_text" class="text-danger"></div>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" onclick="submitRole(this)" class="btn btn-primary add_role">Add Role</button>
                        </div>
                    </form>

                </div>


            </div>
        </div>
    </div>

 {{-- edit --}}
 <div class="modal fade" id="EditModalRole">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit role</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-valide" id="edit-role-form" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-validation">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="name">Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="edit_name" name="name"
                                    placeholder="Enter a name.." value="">
                                <div id="edit_name_text" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="guard_name">Guard Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="edit_guard_name" name="guard_name"
                                    placeholder="Enter a name.." value="">
                                <div id="edit_guard_name_text" class="text-danger"></div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" onclick="editRole(this)" class="btn btn-primary">Edit Role</button>
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
                            <img id="view_image_preview" src="{{ url('images/profile/default_image.png') }}" alt=""
                                width="120" class="rounded-circle border border-dark" />
                        </div>
                    </div>
                    <div class="form-validation">
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <label class=" col-form-label" id="view_name" for="">
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
    //      $(document).ready(function () {
    //     $(document).on('click','.add_role', function (e) {
    //         e.preventDefault();

    //         var data = {
    //             'name' : $ ('.name').val(),
    //         }
    //         $.ajax({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
    //     },
    //     url: "/roles", // the endpoint
    //     type: "POST", // http method
    //     processData: false,
    //     contentType: false,
    //     data: data,
    //     success: function (response) {
    //         console.log(response);
    //     }

    //     });
    // });

    function submitRole() {
    var form = $('#role-form')[0];
    console.log('form ', form);

    const myFormData = new FormData(form);
    const formDataObj = {};
    myFormData.forEach((value, key) => (formDataObj[key] = value));
    console.log(formDataObj);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        url: "/roles", // the endpoint
        type: "POST", // http method
        processData: false,
        contentType: false,
        data: myFormData,
        beforeSend: function () {
            $(form)
                .find('[type="button"]')
                .prop("disabled", true);
        },
        success: function (data) {
            console.log('data',data);
            swal({
                title: "",
                text: data.message,
                icon: "success",
              });
            $(form)
                .find('[type="button"]')
                .prop("disabled", false);
            document.getElementById("role-form").reset();

        },
        error: function (error) {
            $(form)
                .find('[type="button"]')
                .prop("disabled", false);
            var errorMessage = error.statusText;
            var sweetMessage = error.statusText;
            if (error.status == 422) {
                errorMessage = handleValidationErrors(error)
                sweetMessage ='Invalid Data'
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
}

function editRole() {
    var form = $('#edit-role-form')[0];
    role_id = form.role_id.value;
    console.log('role id ', role_id.value);
    const myFormData = new FormData(form);
    const formDataObj = {};
    myFormData.forEach((value, key) => (formDataObj[key] = value));
    console.log(formDataObj);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        url: "/roles/" + role_id, // the endpoint
        type: "POST", // http method
        processData: false,
        contentType: false,
        data: myFormData,
        beforeSend: function () {
            $(form)
                .find('[type="button"]')
                .prop("disabled", true);
        },
        success: function (data) {
            alert(data);
            $(form)
                .find('[type="button"]')
                .prop("disabled", false);
                swal({
                    title: "",
                    text: data.message,
                    icon: "success",
                  });
        },
        error: function (error) {
            $(form)
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
}

function deleteRole(id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        url: "/roles/" + id, // the endpoint
        type: "DELETE", // http method
        processData: false,
        contentType: false,
        success: function (data) {
            $('.alert-success').html(data.success).fadeIn('slow');
            $('.alert-success').delay(3000).fadeOut('slow');
            alert(data);
            document.getElementById("row_" + id).remove();
        },
        error: function (error) {
            alert(error);

            // toastr.error(errorMessage, "Error");
            // hideLoader();
        },
    });
}
    </script>

    @endsection
