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
                                <h4 class="card-title">Categories Table</h4>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-4 text-right">
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addcategory">Add
                                    Category</button>

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration" id="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table_id">
                                    @foreach ($categories as $category)
                                        <tr id='row_{{ $category->id }}'>
                                            <td>{{ $category->name }}</td>
                                            <td><img src="{{asset('/storage/category/' . $category->profile)}}" alt=""></td>

                                           <td> {{$category->is_active == '1' ? 'Hidden':'Show' }}</td>



                                            <td>
                                                <div class="button-group">
                                                    <div class="btn-group">
                                                        <div class="btn-group">
                                                            <button id="btnGroupDrop1" type="button"
                                                                class="btn btn-primary dropdown-toggle py-0 px-2"
                                                                data-toggle="dropdown"></button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    onclick="openViewModal({{ $category }})">View</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:openEditModal({{ json_encode($category) }})">Edit</a>
                                                                <a class="dropdown-item" href="javascript:openDeleteDialog({{ $category->id }})">Delete</a>
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

                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Category
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Category?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">No</button>
                    <button type="button" id="button-delete" class="btn btn-primary"
                        onclick="deleteCategory()">Yes</button>
                </div>
            </div>
        </div>
    </div>
 {{-- add --}}
 <div class="modal fade" id="addcategory">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="form-valide" id="category-form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-2">
                            <img id="image_preview" src="{{ url('images/profile/default_image.png') }}" alt=""
                                width="120" class="rounded-circle border border-dark" />
                        </div>
                    </div>
                    <div class="form-validation">
                        <div class="form-group ">

                            <label class="col-lg-4 col-form-label" for="name">Name <span class="text-danger">*</span>
                            </label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Category name.." :value="old('name')">
                                <div id="name_text" class="text-danger backend-error-text"></div>
                           </div>

                        <div class="form-group ">
                           <label class="col-lg-4 col-form-label" for="name">Image <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control" id="profile" name="profile"
                            placeholder="profile" :value="old('profile')">
                        <div id="profile_text" class="text-danger backend-error-text"></div>

                        </div>
                        <div class="form-group ">


                            <label class="col-lg-4 col-form-label form-check-label" for="name">

                                <input type="checkbox" class="form-check-input" name="is_active" value="">status </label>
                                <div id="image_text" class="text-danger backend-error-text"></div>

                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button"  id="button-save" onclick="submitCategory(this)" class="btn btn-primary">Add Category</button>
                    </div>
                </form>

            </div>


        </div>
    </div>
</div>

 {{-- edit --}}
 <div class="modal fade" id="editcategory">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-valide" id="edit-category-form" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-validation">

                            <input type="hidden" value="-1" id="category_id">
                            <input type="hidden" value="PUT" name="_method">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-2">

                                    <img id="edit_image_preview" src="{{ url('images/profile/62a7764c8bf14.jpg') }}" alt=""
                                        width="120" class="rounded-circle border border-dark" />
                                </div>
                            </div>

                            <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="name">Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="edit_name" name="name"
                                    placeholder="Enter a name.." value="">
                                <div id="edit_name_text" class="text-danger backend-error-text"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="name">Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                        <input type="file" class="form-control" id="edit_profile" name="profile"
                        placeholder="Enter a name.." value="">
                    <div id="edit_profile_text" class="text-danger backend-error-text"></div>
                        </div>
                    </div>
                    <div class="form-group ">


                        <label class="col-lg-4 col-form-label" for="name">staus <span class="text-danger">*</span>
                        </label>

                            <input type="checkbox" id="edit_is_active" name="is_active"  value="">
                            <div id="edit_is_active" class="text-danger backend-error-text"></div>

                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="button-update" onclick="editCategory(this)"  class="btn btn-primary">Edit Category</button>
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


  function submitCategory() {
    var form = $('#category-form')[0];
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
        url: "/admin/category", // the endpoint
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
            console.log(data)
            $("#button-save").prop("disabled", false);
            $("#button-save").text("Add Category");

            console.log('data',data);
            swal({
                title: "",
                text: data.message,
                icon: "success",

              });
            $(form)
                .find('[type="button"]')
                .prop("disabled", false);
            document.getElementById("category-form").reset();
            dataarray.push(data);
            var index = (dataarray.length)-1;

            var string =
            `<tr id="row_${data.category.id}">
                <td>${data.category.name}</td>
                <td><img src="'${data.category.profile}'" alt=""></td>
                <td>${(data.category.is_active == '1' ? "Hidden" : "Show")}</td>

                <td>
                    <div class="button-group">
                        <div class="btn-group">
                            <div class="btn-group"><button id="btnGroupDrop${data.category.id}" type="button"
                                    class="btn btn-primary dropdown-toggle py-0 px-2" data-toggle="dropdown"></button>
                                <div class="dropdown-menu"> <a class="dropdown-item" onclick="openViewModal(${data.category})">View</a>
                                    <a class="dropdown-item" href="javascript:openEditIndexModal(${index})">Edit</a><a
                                        class="dropdown-item" href="javascript:openDeleteDialog(${data.category.id});">Delete</a></div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>`
            $("#table_id").append(string);


            $('#addcategory').modal('hide');


        },
        error: function (error) {
            $(form)
            $("#button-save").prop("disabled", false);
            $("#button-save").text("Add Category");
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

 function deleteCategory() {
    $("#button-delete").text('Loading... ');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        url: "/admin/category/" + $("#deleteID").val(), // the endpoint
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
dataarray=[];
function openEditIndexModal(index) {

document.getElementById('edit_name').value = dataarray[index].category.name;
document.getElementById('edit_is_active').value = dataarray[index].category.is_active == '1' ? 'checked':'';

document.getElementById('category_id').value = dataarray[index].category.id;

$("#editcategory").modal()
}
function openEditModal(category) {

    document.getElementById('edit_name').value = category.name;
    document.getElementById('edit_is_active').value = category.is_active == '1' ? 'checked':'';

    document.getElementById('category_id').value = category.id;

    $("#editcategory").modal()
}

function editCategory() {
    var form = $('#edit-category-form')[0];
    $("#button-update").text('Loading...');
    category_id = form.category_id.value;
    console.log('category_id', category_id);

    const myFormData = new FormData(form);
    const formDataObj = {};
    myFormData.forEach((value, key) => (formDataObj[key] = value));
    console.log(formDataObj);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        url: "/admin/category/" + category_id, // the endpoint
        type:"POST",
        processData: false,
        contentType: false,
        data: myFormData,
        beforeSend: function () {
            $(form)
            $('.backend-error-text').text('')
            $("#button-update").prop("disabled", true)

        },
        success: function (data) {
            $("#button-update").prop("disabled", false);
            $("#button-update").text("Edit Category");

            console.log(data)

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
                var index =(dataarray.length)-1;
             $("#row_"+data.category.id).remove();
             var string =
            `<tr id="row_${data.category.id}">
                <td>${data.category.name}</td>
                <td><img src="'${data.category.profile}'" alt=""></td>
                <td>${(data.category.is_active == '1' ? "Hidden" : "Show")}</td>

                <td>
                    <div class="button-group">
                        <div class="btn-group">
                            <div class="btn-group"><button id="btnGroupDrop${data.category.id}" type="button"
                                    class="btn btn-primary dropdown-toggle py-0 px-2" data-toggle="dropdown"></button>
                                <div class="dropdown-menu"> <a class="dropdown-item" onclick="openViewModal(${data.category})">View</a>
                                    <a class="dropdown-item" href="javascript:openEditIndexModal(${index})">Edit</a><a
                                        class="dropdown-item" href="javascript:openDeleteDialog(${data.category.id});">Delete</a></div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>`
            $("#table_id").append(string);


            $('#editcategory').modal('hide');


        },
        error: function (error) {
            $(form)
            $("#button-update").prop("disabled", false);
            $("#button-update").text("Edit Category");
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
