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
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addcategory">Add
                                    SubCategory</button>

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
                                    @foreach ($categories as $cate)
                                        <tr id='row_{{ $cate->id }}'>
                                            <td>{{ $cate->name }}</td>
                                            <td>{{$cate->category->name}}</td>
                                            <td><img src="{{asset('/storage/subcategory/' . $cate->profile)}}" alt=""></td>

                                           <td> {{$cate->is_active == '1' ? 'Hidden':'Show' }}</td>



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
                                                                <a class="dropdown-item"
                                                                    href="javascript:openEditModal({{ json_encode($cate) }})">Edit</a>
                                                                <a class="dropdown-item" href="javascript:openDeleteDialog({{ $cate->id }})">Delete</a>
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

                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Sub Category
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this SubCategory?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">No</button>
                    <button type="button" id="btndelete" class="btn btn-primary"
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
                                width="120" class="rounded-circle border border-dark" />
                        </div>
                    </div>
                    <div class="form-validation">
                        <div class="form-group ">
                        <label for=""> Cateogry</label>

                        <select name="category_id" class="form-control" id="">
                            <option value="">-- Select Category --</option>
                            @foreach ($category as $catitem )

                            @if($catitem)
                                <option value="{{$catitem->id}}">{{($catitem->name)}}</option>
                            @endif
                            @endforeach
                        </select>
                        </div>
                        <div class="form-group ">

                            <label class="col-lg-4 col-form-label" for="name">Name <span class="text-danger">*</span>
                            </label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Category Name" :value="old('name')">
                                <div id="name_text" class="text-danger"></div>
                           </div>

                        <div class="form-group ">
                           <label class="col-lg-4 col-form-label" for="name">Image <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control" id="profile" name="profile"
                            placeholder="profile" :value="old('profile')">
                        <div id="profile_text" class="text-danger"></div>

                        </div>
                        <div class="form-group ">


                            <label class="col-lg-4 col-form-label form-check-label" for="name">

                                <input type="checkbox" class="form-check-input" name="is_active" value="">status </label>
                                <div id="is_active_text" class="text-danger"></div>

                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button"  id="btnsave" onclick="submitSubCategory(this)" class="btn btn-primary">Add SubCategory</button>
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
                    <input type="hidden" value="-1" id="subcategory_id">
                            <input type="hidden" value="PUT" name="_method">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-2">
                            <img id="edit_image_preview" src="{{ url('images/profile/62a7764c8bf14.jpg') }}" alt=""
                                        width="120" class="rounded-circle border border-dark" />
                        </div>
                    </div>
                    <div class="form-validation">
                        <div class="form-group ">
                        <label for=""> Cateogry</label>

                        <select name="category_id" class="form-control" id="">
                            <option value="">-- Select Category --</option>
                            @foreach ($category as $catitem )

                            @if($catitem)
                                <option value="{{$catitem->id}}">{{($catitem->name)}}</option>
                            @endif
                            @endforeach
                        </select>
                        </div>
                        <div class="form-group ">

                            <label class="col-lg-4 col-form-label" for="name">Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="edit_name" name="name"
                            placeholder="Enter a Name" value="">
                        <div id="edit_name_text" class="text-danger"></div>
                           </div>

                        <div class="form-group ">
                           <label class="col-lg-4 col-form-label" for="name">Image <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control" id="edit_profile" name="profile"
                            placeholder="Enter a name.." value="">
                        <div id="edit_profile_text" class="text-danger"></div>

                        </div>
                        <div class="form-group ">


                            <label class="col-lg-4 col-form-label form-check-label" for="name">

                                <input type="checkbox" id="edit_is_active" name="is_active"  value="">
                            <div id="edit_is_active" class="text-danger"></div>

                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="btnupdate" onclick="editSubCategory(this)"  class="btn btn-primary">Edit Sub Category</button>
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


  function submitSubCategory() {
    var form = $('#subcategory-form')[0];
    console.log('form ', form);
    var spinner = '<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>';
    $("#btnsave").html(spinner);

    const myFormData = new FormData(form);
    const formDataObj = {};
    myFormData.forEach((value, key) => (formDataObj[key] = value));
    console.log(formDataObj);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        url: "/admin/subcategory", // the endpoint
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
            console.log(data)
            $("#btnsave").text("Add subCategory");

            console.log('data',data);
            swal({
                title: "",
                text: data.message,
                icon: "success",

              });
            $(form)
                .find('[type="button"]')
                .prop("disabled", false);
            // document.getElementById("category-form").reset();
            //   $(".odd").hide();
            dataarray.push(data);
            var index = (dataarray.length)-1;
            var string = '<tr id="row_'+data.subcategory.id + '" ><td>'+data.subcategory.name+'</td><td>'+data.subcategory.category_id+'</td><td><img src="'+data.subcategory.profile+'" alt=""></td><td>'+(data.subcategory.is_active == '1' ? "Hidden" : "Show") +'</td><td><div class="button-group"><div class="btn-group"> <div class="btn-group"><button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle py-0 px-2" data-toggle="dropdown"></button><div class="dropdown-menu"> <a class="dropdown-item" onclick="openViewModal('+data.subcategory+')">View</a> <a class="dropdown-item"  href="javascript:openEditIndexModal('+index+')">Edit</a><a class="dropdown-item" href="javascript:openDeleteDialog('+data.subcategory.id+');">Delete</a></div></div></div></div></td></tr>';

            $("#table_id").append(string);

            $('#addcategory').modal('hide');


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
              setTimeout(() => {

            $("#name_text").html("");
            $("#profile_text").html("");


            $("#btnsave").text("Add SubCategory");
            }, 6000);

        },
    });
}

function openDeleteDialog(id) {
    $("#deleteID").val(id);
    $("#deleteModal").modal('show');
 }

function deleteSubCategory() {
    var spinner = '<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>';
    $("#btndelete").html(spinner);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        url: "/admin/subcategory/" + $("#deleteID").val(), // the endpoint
        type: "DELETE", // http method
        processData: false,
        contentType: false,
        success: function (data) {
            $("#btndelete").text("Yes");
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
dataarray = [];
function openEditIndexModal(index) {

document.getElementById('edit_name').value = dataarray[index].subcategory.name;
document.getElementById('edit_is_active').value =dataarray[index].subcategory.is_active == '1' ? 'checked':'';

document.getElementById('subcategory_id').value = dataarray[index].subcategory.id;

$("#editsubcategory").modal()
}
function openEditModal(subcategory) {

    document.getElementById('edit_name').value = subcategory.name;
    document.getElementById('edit_is_active').value = subcategory.is_active == '1' ? 'checked':'';

    document.getElementById('subcategory_id').value = subcategory.id;

    $("#editsubcategory").modal()
}

function editSubCategory() {
    var form = $('#edit-subcategory-form')[0];
    var spinner = '<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>';
    $("#btnupdate").html(spinner);
    subcategory_id = form.subcategory_id.value;
    console.log('subcategory_id', subcategory_id);

    const myFormData = new FormData(form);
    const formDataObj = {};
    myFormData.forEach((value, key) => (formDataObj[key] = value));
    console.log(formDataObj);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        url: "/admin/subcategory/" + subcategory_id, // the endpoint
        type:"POST",
        processData: false,
        contentType: false,
        data: myFormData,
        beforeSend: function () {
            $(form)
                .find('[type="button"]')
                .prop("disabled", true);

        },
        success: function (data) {
            $("#btnupdate").text("Edit Sub Category");

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
            var index = (dataarray.length)-1;
             $("#row_"+data.subcategory.id).remove();

            var string = '<tr id="row_'+data.subcategory.id + '" ><td>'+data.subcategory.name+'</td><td>'+data.subcategory.category_id+'</td><td><img src="'+data.subcategory.profile+'" alt=""></td><td>'+(data.subcategory.is_active == '1' ? "Hidden" : "Show") +'</td><td><div class="button-group"><div class="btn-group"> <div class="btn-group"><button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle py-0 px-2" data-toggle="dropdown"></button><div class="dropdown-menu"> <a class="dropdown-item" onclick="openViewModal('+data.subcategory+')">View</a> <a class="dropdown-item"  href="javascript:openEditIndexModal('+index+')">Edit</a><a class="dropdown-item" href="javascript:openDeleteDialog('+data.subcategory.id+');">Delete</a></div></div></div></div></td></tr>';
            $("#table_id").append(string);

            $('#editsubcategory').modal('hide');


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
              setTimeout(() => {

                $("#edit_name_text").html("");
                $("#edit_is_active_text").html("");

                $("#btnupdate").text("Edit Sub category");
                }, 6000);

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
