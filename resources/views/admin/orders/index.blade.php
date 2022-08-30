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
                                <h4 class="card-title">Customers Orders </h4>
                            </div>
                            {{-- <div class="col-lg-4 col-md-6 col-sm-4 text-right">
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addcategory">Add
                                    Category</button>
                            </div> --}}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration" id="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table_id">
                                    @foreach ($orders as $order)
                                        <tr id='row_{{ $order->id }}'>
                                            <td>{{ $order->users->fist_name }} {{ $order->users->last_name }}</td>
                                            <td>{{ $order->payments->payment }}</td>
                                            <td>
                                                <span
                                                class="badge badge-{{ $order->order_status == 'padding' ? 'success' : 'warning' }}">
                                                {{ $order->order_status == 'padding' ? 'not-padding' : 'padding' }}</span>
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
                                                                    onclick="openViewModal({{ $order }})">View</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:openEditModal({{ json_encode($order) }})">Edit</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:openDeleteDialog({{ $order->id }})">Delete</a>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Category
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Category?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" id="button-delete" class="btn btn-primary"
                        onclick="deleteCategory()">Yes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- add --}}
    <div class="modal fade" id="addorder">
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
                                <label class="col-lg-4 col-form-label" for="name">Name <span
                                        class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Category name.." :value="old('name')">
                                <div id="name_text" class="text-danger backend-error-text"></div>
                            </div>
                            <div class="form-group ">
                                <label class="col-lg-4 col-form-label" for="name">Image <span
                                        class="text-danger">*</span>
                                </label>
                                <input type="file" class="form-control" id="category_image" name="category_image"
                                    placeholder="category_image" :value="old('category_image')">
                                <div id="profile_text" class="text-danger backend-error-text"></div>
                            </div>
                            <div class="form-group ">
                                <label class="col-lg-4 col-form-label form-check-label" for="name">
                                    <input type="checkbox" class="form-check-input" checked name="is_active"
                                        value="1">status </label>
                                <div id="is_active_text" class="text-danger backend-error-text"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" id="button-save" onclick="submitCategory(this)"
                                class="btn btn-primary">Add Category</button>
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
                        <input type="hidden" value="-1" id="category_id">
                        <input type="hidden" value="PUT" name="_method">
                        <div class="form-validation">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-2">
                                    <img id="edit_image_preview" src="{{ url('images/profile/62a7764c8bf14.jpg') }}"
                                        alt="" width="120" class="rounded-circle border border-dark" />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-lg-4 col-form-label" for="name">Name <span
                                        class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="edit_name" name="name"
                                    placeholder="Enter a name.." value="">
                                <div id="edit_name_text" class="text-danger backend-error-text"></div>
                            </div>
                            <div class="form-group ">
                                <label class="col-lg-4 col-form-label" for="name">Image <span
                                        class="text-danger">*</span>
                                </label>
                                <input type="file" class="form-control" id="edit_category_image"
                                    name="category_image" placeholder="Enter a name.." value="">
                                <div id="edit_category_image_text" class="text-danger backend-error-text"></div>
                            </div>
                            <div class="form-group ">
                                <label class="col-lg-4 col-form-label form-check-label" for="name">
                                    <input type="checkbox" id="edit_is_active" name="is_active" value=""> Status
                                </label>
                                <div id="edit_is_active" class="text-danger backend-error-text"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" id="button-update" onclick="editCategory(this)"
                                class="btn btn-primary">Edit Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @section('scripts')
    <script>
        category_image.onchange = evt => {
            const [file] = category_image.files
            console.log('file', file);
            if (file) {
                image_preview.src = URL.createObjectURL(file)
            }
        }
        edit_category_image.onchange = evt => {
            const [file] = edit_category_image.files
            if (file) {
                edit_image_preview.src = URL.createObjectURL(file)
            }
        }


        function submitCategory() {
            var form = $('#category-form')[0];
            $("#button-save").text('Loading...');
            const myFormData = new FormData(form);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                url: "/admin/category", // the endpoint
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
                    console.log(data)
                    $("#button-save").prop("disabled", false);
                    $("#button-save").text("Add Category");

                    if (data.status == false) {
                        swal({
                            title: "Error",
                            text: data.message,
                            icon: "error",
                        });
                        return;
                    }
                    console.log('data', data);
                    swal({
                        title: "",
                        text: data.message,
                        icon: "success",

                    });

                    document.getElementById("category-form").reset();

                    const CATRGORY = JSON.stringify(data.category)
                    var string =
                        `<tr id="row_${data.category.id}">
               <td>${data.category.name}</td>
               <td><img src="${data.category.image_url}" height="50px" width="50px" alt=""></td>
               <td class="text-center"><span class="badge badge-${ data.category.is_active == '1' ? 'success' : 'warning' }">${(data.category.is_active == '1' ? 'active' : 'not-active')}</td>

               <td>
                   <div class="button-group">
                       <div class="btn-group">
                           <div class="btn-group"><button id="btnGroupDrop${data.category.id}" type="button"
                                   class="btn btn-primary dropdown-toggle py-0 px-2" data-toggle="dropdown"></button>
                               <div class="dropdown-menu"> <a class="dropdown-item" onclick="openViewModal(${data.category})">View</a>
                                   <a class="dropdown-item" href="javascript:;" onclick='openEditModal(${CATRGORY})'>Edit</a><a
                                       class="dropdown-item" href="javascript:openDeleteDialog(${data.category.id});">Delete</a></div>
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
                    $("#button-save").text("Add Category");
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
                    alert(error);


                },
            });
        }

        function openEditModal(category) {

            document.getElementById('edit_name').value = category.name;
            document.getElementById('edit_is_active').value = category.is_active == '1' ? 'checked' : '';

            document.getElementById('category_id').value = category.id;
            var image;
            if (category.image_url) {
                image = category.image_url;
            } else {
                image = base_url + '/storage/profile/62a7764c8bf14.jpg';
            }
            // document.getElementById('edit_profile').value = user.image_name;
            $('#edit_image_preview').attr('src', image)
            // document.getElementById('edit_image_preview').src = user.image_url;

            $("#editcategory").modal()
        }

        function editCategory() {
            var form = $('#edit-category-form')[0];
            $("#button-update").text('Loading...');
            category_id = form.category_id.value;


            const myFormData = new FormData(form);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                url: "/admin/category/" + category_id, // the endpoint
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
                    $("#button-update").prop("disabled", false);
                    $("#button-update").text("Edit Category");

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
                    const CATEGORY = JSON.stringify(data.category)
                    $("#row_" + data.category.id).remove();
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
                                   <a class="dropdown-item" href="javascript:;" onclick='openEditModal(${CATEGORY})'>Edit</a><a
                                       class="dropdown-item" href="javascript:openDeleteDialog(${data.category.id});">Delete</a></div>
                           </div>
                       </div>
                   </div>
               </td>
           </tr>`
                    $("#table_id").append(string);


                    $('#editcategory').modal('hide');


                },
                error: function(error) {
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
@endsection --}}
