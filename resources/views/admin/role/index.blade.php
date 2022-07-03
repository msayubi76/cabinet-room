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
                                        <th>Assign Permiision</th>


                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table_id">
                                    @foreach ($roles as $role)
                                        <tr id='row_{{ $role->id }}'>
                                            <td style="width: 70%">{{ $role->name }}</td>
                                            <td><a href="{{url('attach-permission/'.$role->id)}}" class="btn btn-secondary">Attach Permission</a></td>



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
                                                                href="javascript:openEditModal({{ json_encode($role) }})">Edit</a>
                                                                <a class="dropdown-item" href="javascript:openDeleteDialog({{ $role->id }})">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>


                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Assighn Permiision</th>

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
    <div class="modal fade" id="deleteModal" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" value="-1" id="deleteID">
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
                        onclick="deleteRole()">Yes</button>
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
                                    <div  id="name_text" class="text-danger errors"></div>
                                </div>
                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" onclick="submitRole(this)" class="btn btn-primary ">Add Role</button>
                        </div>
                    </form>

                </div>


            </div>
        </div>
    </div>

  {{-- edit --}}
  <div class="modal fade" id="editModalRole">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Role</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-valide" id="edit-role-form" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="-1" id="role_id">
                    <input type="hidden" value="PUT" name="_method">

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

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button"  onclick="editRole(this)"  class="btn btn-primary">Edit User</button>
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
                                <label class="col-lg-4 col-form-label" id="view_guard_name" for="">
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
            var string = '<tr id="row_'+data.role.id + '" ><td>'+data.role.name+'</td> <td><a href="{{url('attach-permission/'.$role->id)}}" class="btn btn-secondary">Attach Permission</a></td><td><div class="button-group"><div class="btn-group"> <div class="btn-group"><button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle py-0 px-2" data-toggle="dropdown"></button><div class="dropdown-menu"> <a class="dropdown-item" onclick="openViewModal('+data.role+')">View</a> <a class="dropdown-item" onclick="openEditModal('+data.role+')">Edit</a><a class="dropdown-item" href="javascript:openDeleteDialog('+data.role.id+');">Delete</a></div></div></div></div></td></tr>';
            $("#table_id").append(string);


            $('#addRoleModal').modal('hide');


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
              toastr.error(errorMessage, "Error");
            hideLoader()



        },

    });
}

function editRole() {
    var form = $('#edit-role-form')[0];
    role_id = form.role_id.value;
    console.log('role id ', role_id);
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
            // alert(data);
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
            toastr.error(errorMessage, "Error");
            hideLoader();
        },
    });
}


function openDeleteDialog(id) {
    $("#deleteID").val(id);
    $("#deleteModal").modal('show');
 }

function deleteRole() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        url: "/roles/" + $("#deleteID").val(), // the endpoint
        type: "DELETE", // http method
        processData: false,
        contentType: false,
        success: function (data) {
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
        error: function (error) {
            alert(error.message);
        },
    });
}
function openEditModal(role) {
    document.getElementById('edit_name').value = role.name;

    document.getElementById('role_id').value = role.id;


    $("#editModalRole").modal()
}

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
    </script>

    @endsection
