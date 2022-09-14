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
                                <h4 class="card-title">Permission Table</h4>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-4 text-right">
                                @can('create-permission')
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addpermissionmodal">Add
                                    Permission</button>
                                    @endcan

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration" id="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Display Name</th>
                                        <th>Module Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table_id">
                                    @foreach ($permissions as $permission)
                                        <tr id='row_{{ $permission->id }}'>
                                            <td>{{ $permission->name }}</td>
                                            <td>{{ $permission->display_name }}</td>
                                            <td>{{ $permission->module_name }}</td>

                                            <td>
                                                <div class="button-group">
                                                    <div class="btn-group">
                                                        <div class="btn-group">
                                                            <button id="btnGroupDrop1" type="button"
                                                                class="btn btn-primary dropdown-toggle py-0 px-2"
                                                                data-toggle="dropdown"></button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    onclick="openViewModal({{ $permission }})">View</a>
                                                                    @can('update-permission')
                                                                <a class="dropdown-item"
                                                                    href="javascript:openEditModal({{ json_encode($permission) }})">Edit</a>
                                                                    @endcan
                                                                    @can('delete-permission')
                                                                <a class="dropdown-item" href="javascript:openDeleteDialog({{ $permission->id }})">Delete</a>
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

    <div class="modal fade" id="deleteModal" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" value="-1" id="deleteID">

                    <h5 class="modal-title" id="exampleModalLongTitle">Delete permission
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this permission?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">No</button>
                    <button type="button" id="button-delete" class="btn btn-primary"
                        onclick="deletePermission()">Yes</button>
                </div>
            </div>
        </div>
    </div>
 {{-- add --}}
 <div class="modal fade" id="addpermissionmodal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Permission</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="form-valide" id="permission-form" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-validation">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="name">Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter a Name" :value="old('name')">
                                <div id="name_text" class="text-danger backend-error-text"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="display_name">Display Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="display_name" name="display_name"
                                    placeholder="Enter a Display Name" :value="old('display_name')">
                                <div id="display_name_text" class="text-danger backend-error-text"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="module_name">Module Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="module_name" name="module_name"
                                    placeholder="Enter a Module Name " :value="old('module_name')">
                                <div id="module_name_text" class="text-danger backend-error-text"></div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="button-save" onclick="submitPermission(this)" class="btn btn-primary">Add Permission</button>
                    </div>
                </form>

            </div>


        </div>
    </div>
</div>

 {{-- edit --}}
 <div class="modal fade" id="editModalPermission">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Permission</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-valide" id="edit-permission-form" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-validation">
                        <div class="form-group row">
                            <input type="hidden" value="-1" id="permission_id">
                            <input type="hidden" value="PUT" name="_method"> {{-- salahuddin added --}}

                            <label class="col-lg-4 col-form-label" for="name">Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="edit_name" name="name"
                                    placeholder="Enter a name.." value="">
                                <div id="edit_name_text" class="text-danger backend-error-text"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="display_name">Display Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="edit_display_name" name="display_name"
                                    placeholder="Enter a display_name.." value="">
                                <div id="edit_display_name_text" class="text-danger backend-error-text"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="module_name">Module Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="edit_module_name" name="module_name"
                                    placeholder="Enter a module_name.." value="">
                                <div id="edit_module_name_text" class="text-danger backend-error-text"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="button-update" onclick="editPermission(this)"  class="btn btn-primary">Edit Permission</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>


var dataarray =[];
  function submitPermission() {
    var form = $('#permission-form')[0];
    $("#button-save").text('Loading...');
    console.log('form ', form);


    const myFormData = new FormData(form);
    const formDataObj = {};
    myFormData.forEach((value, key) => (formDataObj[key] = value));
    console.log(formDataObj);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        url: "/admin/permissions", // the endpoint
        type: "POST", // http method
        processData: false,
        contentType: false,
        data: myFormData,
        beforeSend: function () {
            $(form)
            $('.backend-error-text').text('')
            $("#button-save").prop("disabled", true);
        },
        success: function (data) {
            $("#button-save").prop("disabled", false);
            $("#button-save").text("Add Permission");
            console.log('data',data);
            swal({
                title: "",
                text: data.message,
                icon: "success",

              });
            $(form)
                .find('[type="button"]')
                .prop("disabled", false);
            document.getElementById("permission-form").reset();
            const PERMISSION = JSON.stringify(data.permission)
            var string =
            `<tr id="row_${data.permission.id}">
                <td>${data.permission.name}</td>
                <td>${data.permission.display_name}</td>
                <td>${data.permission.module_name}</td>

                <td>
                    <div class="button-group">
                        <div class="btn-group">
                            <div class="btn-group"><button id="btnGroupDrop${data.permission.id}" type="button"
                                    class="btn btn-primary dropdown-toggle py-0 px-2" data-toggle="dropdown"></button>
                                <div class="dropdown-menu"> <a class="dropdown-item" onclick="openViewModal(${data.permission})">View</a>
                                    <a class="dropdown-item" href="javascript:;" onclick='openEditModal(${PERMISSION})'>Edit</a><a
                                        class="dropdown-item" href="javascript:openDeleteDialog(${data.permission.id});">Delete</a></div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>`
            $("#table_id").append(string);

            $('#addpermissionmodal').modal('hide');


        },
        error: function (error) {
            $(form)
            $("#button-save").prop("disabled", false);
            $("#button-save").text("Add Permission");
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

        },
    });
}

function openDeleteDialog(id) {
    $("#deleteID").val(id);
    $("#deleteModal").modal('show');
 }

 function deletePermission() {
    $("#button-delete").text('Loading...');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        url: "/admin/permissions/" + $("#deleteID").val(), // the endpoint
        type: "DELETE", // http method
        processData: false,
        contentType: false,
        success: function (data) {
            $("#button-delete").prop("disabled", false);
            $("#button-delete").text("Yes");
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
            $("#button-delete").prop("disabled", false);
            $("#button-delete").text("Yes");
            alert(error);


        },
    });
}
dataarray =[];
function openEditIndexModal(index) {

document.getElementById('edit_name').value = dataarray[index].permission.name;
    document.getElementById('edit_display_name').value = dataarray[index].permission.display_name;
    document.getElementById('edit_module_name').value = dataarray[index].permission.module_name;
    document.getElementById('permission_id').value = dataarray[index].permission.id;
   $("#editModalPermission").modal()

}
function openEditModal(permission) {

    document.getElementById('edit_name').value = permission.name;
    document.getElementById('edit_display_name').value = permission.display_name;
    document.getElementById('edit_module_name').value = permission.module_name;
    document.getElementById('permission_id').value = permission.id;


    $("#editModalPermission").modal()
}

function editPermission() {
    var form = $('#edit-permission-form')[0];
    $("#button-update").text('Loading...');
    permission_id = form.permission_id.value;
    console.log('permission_id', permission_id);

    const myFormData = new FormData(form);
    const formDataObj = {};
    myFormData.forEach((value, key) => (formDataObj[key] = value));
    console.log(formDataObj);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        url: "/admin/permissions/" + permission_id, // the endpoint
        type:"POST", // salahuyddin changed
        processData: false,
        contentType: false,
        data: myFormData,
        beforeSend: function () {
            $(form)
            $('.backend-error-text').text('')
            $("#button-update").prop("disabled", true);

        },
        success: function (data) {
            $("#button-update").prop("disabled", false);
            $("#button-update").text("Edit Permission");

            $(form)
                .find('[type="button"]')
                .prop("disabled", false);
                swal({
                    title: "",
                    text: data.message,
                    icon: "success",
                });
                $(form)
                .find('[type="button"]')
                .prop("disabled", false);
                dataarray.push(data);
                var index = (dataarray.length)-1;
             $("#row_"+data.permission.id).remove();
             var string =
            `<tr id="row_${data.permission.id}">
                <td>${data.permission.name}</td>
                <td>${data.permission.display_name}</td>
                <td>${data.permission.module_name}</td>

                <td>
                    <div class="button-group">
                        <div class="btn-group">
                            <div class="btn-group"><button id="btnGroupDrop${data.permission.id}" type="button"
                                    class="btn btn-primary dropdown-toggle py-0 px-2" data-toggle="dropdown"></button>
                                <div class="dropdown-menu"> <a class="dropdown-item" onclick="openViewModal(${data.permission})">View</a>
                                    <a class="dropdown-item" href="javascript:openEditIndexModal(${index})">Edit</a><a
                                        class="dropdown-item" href="javascript:openDeleteDialog(${data.permission.id});">Delete</a></div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>`
            $("#table_id").append(string);

            $('#editModalPermission').modal('hide');


        },
        error: function (error) {
            $(form)
            $("#button-update").prop("disabled", false);
            $("#button-update").text("Edit Permission");
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
