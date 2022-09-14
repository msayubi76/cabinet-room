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
                                <h4 class="card-title">SubCategories Table</h4>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-4 text-right">
                                @can('create-category')
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addcategory">Add
                                    SubCategory</button>
                                @endcan

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration" id="table">
                                <thead>
                                    <tr>
                                        <th>SubCategory Name</th>
                                        <th>Category Name</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table_id">
                                    @foreach ($sub_categories as $cate)
                                        <tr id='row_{{ $cate->id }}'>
                                            <td>{{ $cate->name }}</td>
                                            <td>{{ $cate->category?$cate->category->name:'' }}</td>
                                            <td><img src="{{ $cate->image_url }}" height="50px" width="50px"
                                                    alt=""></td>

                                            <td class="text-center">

                                                <span
                                                    class="badge badge-{{ $cate->is_active == '1' ? 'success' : 'warning' }}">
                                                    {{ $cate->is_active == '1' ? 'active' : 'not-active' }}
                                                </span>


                                            </td>



                                            <td>
                                                <div class="button-group">
                                                    <div class="btn-group">
                                                        <div class="btn-group">
                                                            <button id="btnGroupDrop1" type="button"
                                                                class="btn btn-primary dropdown-toggle py-0 px-2"
                                                                data-toggle="dropdown"></button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    onclick="openViewModal({{ $cate }})">View</a>
                                                                    @can('update-category')
                                                                <a class="dropdown-item"
                                                                    href="javascript:openEditModal({{ json_encode($cate) }})">Edit</a>
                                                                    @endcan

                                                                    @can('delete-category')
                                                                <a class="dropdown-item"
                                                                    href="javascript:openDeleteDialog({{ $cate->id }})">Delete</a>
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

                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Sub Category
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this SubCategory?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" id="button-delete" class="btn btn-primary"
                        onclick="deleteSubCategory()">Yes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- add --}}
    <div class="modal fade" id="addcategory">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add SubCategory</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form class="form-valide" id="subcategory-form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-2">
                                <img id="image_preview" src="{{ url('images/profile/default_image.png') }}" alt=""
                                    width="120" height="100" class="rounded-circle border border-dark" />
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <label for=""> Cateogry</label>

                                <select name="category_id" class="form-control" id="">
                                    <option value="">-- Select Category --</option>
                                    @foreach ($category as $catitem)

                                            <option value="{{ $catitem->id }}">{{ $catitem->name }}</option>

                                    @endforeach
                                </select>
                                <div id="category_id_text" class="text-danger backend-error-text"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="name">Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Category Name" :value="old('name')">
                                <div id="name_text" class="text-danger backend-error-text"></div>
                            </div>


                        </div>


                        <div class="row">
                            <div class="col-md-6 my-2">
                                <label class="form-label form-check-label" for="name"
                                    style="margin-top: 35px; margin-left:30px;">

                                    <input type="checkbox" class="form-check-input" checked name="is_active"
                                        value="1">Active </label>
                                <div id="is_active_text" class="text-danger backend-error-text"></div>
                            </div>
                            <div class="col-md-6 my-2">
                                <label class="form-label" for="name">Image <span class="text-danger">*</span>
                                </label>
                                <input type="file" class="form-control" id="sub_category_image"
                                    name="sub_category_image" placeholder="sub_category_image"
                                    :value="old('sub_category_image')">
                                <div id="sub_category_image_text" class="text-danger backend-error-text"></div>
                            </div>


                        </div>
                        <div class="modal-footer my-3">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" id="button-save" onclick="submitSubCategory(this)"
                                class="btn btn-primary">Add SubCategory</button>
                        </div>
                    </form>

                </div>


            </div>
        </div>
    </div>

    {{-- edit --}}
    <div class="modal fade" id="editsubcategory">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Sub Category</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-valide" id="edit-subcategory-form" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="-1" id="sub_category_id">
                        <input type="hidden" value="PUT" name="_method">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-2">

                                <img id="edit_image_preview" src="{{ url('images/profile/62a7764c8bf14.jpg') }}"
                                    alt="" width="120" height="100" class="rounded-circle border border-dark" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 ">
                                <label for=""> Cateogry</label>

                                <select name="category_id" class="form-control" id="categories">
                                    <option value="">-- Select Category --</option>
                                    @foreach ($category as $catitem)
                                        <option value="{{ $catitem->id }}">{{ $catitem->name }}</option>
                                    @endforeach
                                </select>
                                <div id="edit_category_id_text" class="text-danger backend-error-text"></div>
                            </div>
                            <div class="col-md-6  ">

                                <label class="form-label" for="name">Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="edit_name" name="name"
                                    placeholder="Enter a Name" value="">
                                <div id="edit_name_text" class="text-danger backend-error-text"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6  my-2">
                                <label class="form-label form-check-label" for="name"
                                style="margin-top: 35px; margin-left:30px;">

                                <input type="checkbox" class="form-check-input" id="edit_is_active" name="is_active"
                                value="{{old('is_active')}}" @if(old('is_active', true)) checked @endif>Active </label>

                                <div id="edit_is_active" class="text-danger backend-error-text"></div>

                            </div>

                            <div class="col-md-6 my-2 ">
                                <label class="form-label" for="name">Image <span class="text-danger">*</span>
                                </label>
                                <input type="file" class="form-control" id="edit_sub_category_image"
                                    name="sub_category_image" placeholder="Enter a name.." value="">
                                <div id="edit_sub_category_image_text" class="text-danger backend-error-text"></div>

                            </div>




                        </div>
                        <div class="modal-footer my-3">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" id="button-update" onclick="editSubCategory(this)"
                                class="btn btn-primary">Edit Sub Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        sub_category_image.onchange = evt => {
            const [file] = sub_category_image.files
            console.log('file', file);
            if (file) {
                image_preview.src = URL.createObjectURL(file)
            }
        }
        edit_sub_category_image.onchange = evt => {
            const [file] = edit_sub_category_image.files
            if (file) {
                edit_image_preview.src = URL.createObjectURL(file)
            }
        }


        function submitSubCategory() {
            var form = $('#subcategory-form')[0];
            $("#button-save").text('Loading...');



            const myFormData = new FormData(form);
            const formDataObj = {};

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                url: "/admin/subcategory", // the endpoint
                type: "POST", // http method
                processData: false,
                contentType: false,
                data: myFormData,
                beforeSend: function() {
                    $(form)
                    $('.backend-error-text').text('')
                    $("#button-save").prop("disabled", true);
                },
                success: function(data) {

                    $("#button-save").prop("disabled", false);
                    $("#button-save").text("Add SubCategory");
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

                    document.getElementById("subcategory-form").reset();

                    const SUBCATEGORY = JSON.stringify(data.sub_category)
                    var string =
                        `<tr id="row_${data.sub_category.id}">
                <td>${data.sub_category.name}</td>
                <td>${data.sub_category.category.name}</td>
                <td><img src="${data.sub_category.image_url}" alt="" height="50px" width="50px"></td>
                <td class="text-center"><span class="badge badge-${ data.sub_category.is_active == '1' ? 'success' : 'warning' }">${(data.sub_category.is_active == '1' ? 'active' : 'not-active')}</td>

                <td>
                    <div class="button-group">
                        <div class="btn-group">
                            <div class="btn-group"><button id="btnGroupDrop${data.sub_category.id}" type="button"
                                    class="btn btn-primary dropdown-toggle py-0 px-2" data-toggle="dropdown"></button>
                                <div class="dropdown-menu"> <a class="dropdown-item" onclick="openViewModal(${data.sub_category})">View</a>
                                    <a class="dropdown-item" href="javascript:;" onclick='openEditModal(${SUBCATEGORY})'>Edit</a><a
                                        class="dropdown-item" href="javascript:openDeleteDialog(${data.sub_category.id});">Delete</a></div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>`
                    $("#table_id").append(string);


                    $('#addcategory').modal('hide');


                },
                error: function(error) {
                    $(form)
                    $("#button-save").prop("disabled", false);
                    $("#button-save").text("Add SubCategory")
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

        function openDeleteDialog(id) {
            $("#deleteID").val(id);
            $("#deleteModal").modal('show');
        }

        function deleteSubCategory() {
            $("#button-delete").text('Loading... ');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: "/admin/subcategory/" + $("#deleteID").val(), // the endpoint
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



                },
            });
        }

        function openEditModal(subcategory) {

            document.getElementById('edit_name').value = subcategory.name;

            $('#edit_is_active').val(subcategory.is_active)
            // $('#edit_is_active').prop('checked', subcategory.is_active == 1 ? true : false)
            if($("#edit_is_active").prop('checked', subcategory.is_active == 1 )){
          $("#edit_is_active").val('TRUE');
     }else{
          $("#edit_is_active").val('FALSE');
     }




            document.getElementById('sub_category_id').value = subcategory.id;
            document.getElementById('categories').value = subcategory.category_id;
            var image;
            if (subcategory.image_url) {
                image = subcategory.image_url;
            } else {
                image = base_url + '/storage/subcategories/62a7764c8bf14.jpg';
            }
            // document.getElementById('edit_profile').value = user.image_name;
            $('#edit_image_preview').attr('src', image)
            // document.getElementById('edit_image_preview').src = user.image_url;
            $("#editsubcategory").modal()


        }

        function editSubCategory() {
            var form = $('#edit-subcategory-form')[0];
            $("#button-update").text('Loading...');
            sub_category_id = form.sub_category_id.value;
            const myFormData = new FormData(form);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                url: "/admin/subcategory/" + sub_category_id, // the endpoint
                type: "POST",
                processData: false,
                contentType: false,
                data: myFormData,
                beforeSend: function() {
                    $(form)
                    $('.backend-error-text').text('')
                    $("#button-update").prop("disabled", true)

                },
                success: function(data) {
                    console.log(data);
                    $("#button-update").prop("disabled", false);
                    $("#button-update").text("Edit SubCategory");

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
                    const SUBCATEGORY = JSON.stringify(data.sub_category)

                    $("#row_" + data.sub_category.id).remove();

                    var string =
                        `<tr id="row_${data.sub_category.id}">
                <td>${data.sub_category.name}</td>
                <td>${data.sub_category.category.name}</td>
                <td><img src="${data.sub_category.image_url}" alt="" height="50px" width="50px"></td>
                <td class="text-center"><span class="badge badge-${ data.sub_category.is_active == '1' ? 'success' : 'warning' }">${(data.sub_category.is_active == '1' ? 'active' : 'not-active')}</td>

<td>
                    <div class="button-group">
                        <div class="btn-group">
                            <div class="btn-group"><button id="btnGroupDrop${data.sub_category.id}" type="button"
                                    class="btn btn-primary dropdown-toggle py-0 px-2" data-toggle="dropdown"></button>
                                <div class="dropdown-menu"> <a class="dropdown-item" onclick="openViewModal(${data.sub_category})">View</a>
                                    <a class="dropdown-item" href="javascript:;" onclick='openEditModal(${SUBCATEGORY})'>Edit</a><a
                                        class="dropdown-item" href="javascript:openDeleteDialog(${data.sub_category.id});">Delete</a></div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>`
                    $("#table_id").append(string);

                    $('#editsubcategory').modal('hide');


                },
                error: function(error) {
                    $(form)
                    $("#button-update").prop("disabled", false);
                    $("#button-update").text("Edit SubCategory");
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
    </script>
@endsection
