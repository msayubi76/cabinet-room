@extends('layouts.theme')
@section('title','Category')
@section('style')
    <!-- DataTables -->
    <link href="{{url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{url('libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet">
    <link href="{{url('libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet">
    <link href="{{url('libs/dropify/css/dropify.min.css')}}" rel="stylesheet">
    <style>
        .hide{
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid customer-search">
            <div class="loading_div"  id="loading" style="display: none">
                <div class="spinner-grow text-secondary  loading" role="status" ></div>
            </div>
            <!-- start page title -->
            <div class="card  w-100">
                <div class="card-body">
                    @include('alertsInfo')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row d-flex">
                                        <div class="col-lg-6  ">

                                            <h5 class="card-title">Sub Category Lists</h5>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="float-right d-print-none">
                                                @can('sub_category.create')
                                                    <a href="javascript:;" data-target="#create_modal" id="create_category_btn"    data-toggle="modal"  class="btn btn-primary float-right">Create Sub Category</a>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered w-100 user_table">
                                            <thead>
                                            <tr>
                                                <th>Sr. #</th>
                                                <th>Sub Category</th>
                                                <th>Category</th>
                                                <th>Detail</th>
                                                <th>Image</th>
                                                @if (Auth::user()->hasAnyPermission(['sub_category.update', 'sub_category.delete']) || Auth::user()->hasRole('Super Admin'))
                                                    <th>Action</th>
                                                @endif


                                            </tr>
                                            </thead>
                                            <?php $count=1;?>
                                            @foreach ($sub_categories as $value)
                                                <tr class="gradeX">
                                                    <td class="count"> {{$count++}}</td>
                                                    <td class="name">{{$value->name}}</td>
                                                    <td class="category">{{$value->getCategory?$value->getCategory->name:''}}</td>
                                                    <td  class="detail"  >{{$value->detail}}</td>
                                                    <td >
                                                        @if ($value->image)
                                                            <a href="{{url('site_images/sub_categories/'.$value->image)}}" class="image_link" title="View" target="_blank">
                                                                <img src="{{url('site_images/sub_categories/'.$value->image)}}" class="category_image" alt="{{$value->name}}" width="50px"  height="50px">
                                                            </a>
                                                        @endif 
                                                    </td>
                                                    @if (Auth::user()->hasAnyPermission(['sub_category.update', 'sub_category.delete']) || Auth::user()->hasRole('Super Admin'))
                                                        <td>
                                                            <div class="btn-group ">
                                                                <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="mdi mdi-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu view-dropdown-menu ">

                                                                    @can('sub_category.update')

                                                                        <a href="javascript:;" data-id="{{encrypt($value->id)}}" class="dropdown-item action_imgs edit_">
                                                                            <span class="mdi mdi-square-edit-outline edit-icon" > </span>Edit
                                                                        </a>

                                                                    @endcan
                                                                    @can('sub_category.delete')
                                                                        <a href="javascript:;" class=" delete dropdown-item action_imgs"
                                                                           data-id="{{encrypt($value->id)}}">
                                                                            <span class=" mdi mdi-minus-circle minus-icon"></span> Delete
                                                                        </a>

                                                                    @endcan

                                                                </div>
                                                            </div>
                                                        </td>
                                                    @endif
                                                </tr>


                                            @endforeach

                                            <tr class="hide"  >
                                                <td class="count"> {{$count++}}</td>
                                                <td class="name"></td>
                                                <td class="category" ></td>
                                                <td class="detail" ></td>
                                                <td  > 
                                                    <a  class="image_link" title="View" target="_blank">
                                                        <img  class="category_image"  width="150px">
                                                    </a>

                                                </td>
                                                @if (Auth::user()->hasAnyPermission(['sub_category.update', 'sub_category.delete']) || Auth::user()->hasRole('Super Admin'))
                                                    <td>
                                                        <div class="btn-group ">
                                                            <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="mdi mdi-chevron-down"></i>
                                                            </button>
                                                            <div class="dropdown-menu view-dropdown-menu ">

                                                                @can('sub_category.update')
                                                                    <a href="javascript:;"  class="dropdown-item  action_imgs edit_">
                                                                        <span class="mdi mdi-square-edit-outline edit-icon" > </span>Edit
                                                                    </a>

                                                                @endcan
                                                                @can('sub_category.delete')
                                                                    <a href="javascript:;" class=" delete dropdown-item action_imgs " >
                                                                        <span class=" mdi mdi-minus-circle minus-icon"></span> Delete
                                                                    </a>

                                                                @endcan

                                                            </div>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->


                    @can('sub_category.create')
                    <!-- /.create-dialog -->
                        <div class="modal fade" id="create_modal" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Create Sub Category</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="custom-validation " id="create_form" enctype="multipart/form-data" action="{{url('sub_category')}}" method="post"  >
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group ">
                                                        <label>Sub Category Name</label>
                                                        <input type="text" placeholder="Enter Category Name" autocomplete="off" id="create_name" name="name" class="form-control"
                                                                   required autofocus>
                                                        
                                                            <span class="text-danger" id="err_create_name">   </span>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group ">
                                                        <label>Select Category</label>
                                                        <select required class="form-control" name="category_id" id="category_id">
                                                            <option value="">Select Category</option>
                                                            @foreach ($categories as $item)
                                                                <option value="{{$item->id}}" >{{$item->name}}</option>
                                                            @endforeach
                                                        </select> 
                                                            <span class="text-danger" id="err_create_category_id">   </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group  ">
                                                        <label>Image</label>
                                                        <input type="file"  id="input-file-now" class="dropify" name="image" />
                                                        
                                                            <span class="text-danger" id="err_create_image">    </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group ">
                                                        <label>Sub Category Detail</label>
                                                        <textarea name="detail" id="detail" cols="30" rows="4" class="form-control"></textarea>
                                                            <span class="text-danger" id="err_create_detail">    </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-light float-right submit_create_form  waves-light">Submit </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>

                        </div>
                    @endcan
                    @can('sub_category.update')
                        <div class="modal fade" id="edit_modal" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Sub Category</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                    </div>
                                    <form action="javascript:;" method="post" enctype="multipart/form-data" id="edit_form">
                                        <div class="modal-body">
                                            <input type="hidden" name="id"  id="edit_id">
                                            <input type="hidden" name="old_image"  id="old_image">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Sub Category Name</label>
                                                        <input autocomplete="off" type="text" placeholder="Sub Category Name" id="edit_name" maxlength="20"
                                                               name="name" class="form-control " value="{{old('name')}}"  required autofocus>
                                                        <span class="text-danger " id="error_edit_name">  </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group ">
                                                        <label>Select Category</label>
                                                        <select class="form-control" name="category_id" id="edit_category_id">
                                                            <option value="">Select Category</option>
                                                            @foreach ($categories as $item)
                                                                <option value="{{$item->id}}" >{{$item->name}}</option>
                                                            @endforeach
                                                        </select> 
                                                            <span class="text-danger" id="err_edit_category_id">   </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group {{ $errors->has('category_sign') ? ' has-error' : '' }}">
                                                        <label>Image</label>
                                                        <input type="file" id="edit_image" class="dropify" name="image" /> 
                                                            <span class="text-danger" id="err_edit_image">    </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group ">
                                                        <label>Sub Category Detail</label>
                                                        <textarea name="detail" id="edit_detail" cols="30" rows="4" class="form-control"></textarea>
                                                            <span class="text-danger" id="err_edit_detail">    </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <button class="btn btn-md btn-primary m-t-n-xs float-right submit_edit_form" type="submit" >Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <!-- Required datatable js -->
    <script src="{{url('libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{url('libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{url('libs/jszip/jszip.min.js')}}"></script>
    <script src="{{url('libs/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{url('libs/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{url('libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{url('libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{url('libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{url('libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

    <!-- Datatable init js -->
    <script src="{{url('js/pages/datatables.init.js')}}"></script>

    <script src="{{url('libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{url("libs/parsleyjs/parsley.min.js")}}"></script>
    <script src="{{url('js/pages/form-validation.init.js')}}"></script>

    <script src="{{url('libs/dropzone/min/dropzone.min.js')}}"></script>
    <script src="{{url('libs/dropify/js/dropify.min.js')}}"></script>
    <script src="{{url('js/pages/form-fileuploads.init.js')}}"></script>

    


    <script>
  function updateSerial() {
            count=0;
            $(".count").each(function () {
                $(this).html(count);
                count++;
            });
        }

    $(document).on('click', '.submit_create_form', function(e){
        $("#create_form").submit();
        return true;
        e.preventDefault();
        var form = $('#create_form')[0];
        var formData = new FormData(form);
        var clonedRow = " ";
         clonedRow = $('tbody tr.hide').clone().removeClass('hide');
      //  var form = $("#create_form").serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: 'POST',
            data: formData,
            url: '{{url('sub_category')}}',
            processData: false,
            contentType: false,
            beforeSend: function () {
                $("#loading").show();
            },
        }).done(function (response) {
            $("#loading").hide();
            if (response.status) {
                table = $('#datatable-buttons').DataTable();
                swal.fire("Message", response.msg, "success");
                $('#create_modal').modal('toggle');
                $(clonedRow).find('.name').html(response.category.name); 
                $(clonedRow).find('.detail').html(response.category.detail);
                $(clonedRow).find('.category').html(response.category.get_category.name);
                
                
                $(clonedRow).find('.image_link').attr('href', "{{url('site_images/sub_categories')}}/"+response.category.image);
                $(clonedRow).find('.category_image').attr('src', "{{url('site_images/sub_categories')}}/"+response.category.image);

                $(clonedRow).find('.edit_').attr('data-id', response.category.item_id);
                $(clonedRow).find('.delete').attr('data-id', response.category.item_id);
                 $(document).find($('table tbody')).append(clonedRow);
              ///  $('#datatable-buttons').DataTable().rows().draw(false);

              $(".dropify-preview").css("display","none");
              $(".dropify-clear").css("opacity","0");

                $("#create_form")[0].reset();
                //table.draw();
            }

        }).fail(function (error) {
            $("#loading").hide();
            $.each(error.responseJSON.errors, function (key, item) {
                $("#err_create_" + key).text(item[0]);
                $("#err_create_" + key).text(item[0]);
            });
        });
    });


    $(document).on('click', '.edit_', function(){
        var id = $(this).data('id');
        editing_row = $(this).closest('tr');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: 'POST',
            url: '{{url('editSubCategory')}}/' + id,
            beforeSend: function () {
                $("#loading").show();
            },
        }).done(function (response) {
            $("#loading").hide();

            $("#edit_name").val(response.category.name);
            $("#edit_id").val(response.category.id);
            $("#edit_detail").val(response.category.detail);
            $("#old_image").val(response.category.image);
            $("#edit_category_id").val(response.category.category_id);

            $('#edit_modal').modal('toggle');

        }).fail(function (error) {
            $("#loading").hide();
            swal.fire("Cancelled", error.responseJSON.message, "error");
        });
    });


    $(document).on('click', '.submit_edit_form', function(e) {
        e.preventDefault();
        var form = $('#edit_form')[0];
        var formData = new FormData(form);

        var id = $("#edit_id").val();
        var name = $("#edit_name").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: 'POST',
            data: formData,
            url: '{{url('updateSubCategory')}}',
            processData: false,
            contentType: false,
            beforeSend: function () {
                $("#loading").show();
            },
        }).done(function (response) {
            $("#loading").hide();
             
            if (response.status == true && response.success == true) {
                swal.fire("Message", response.msg, "success");
                $('#edit_modal').modal('toggle');
                setTimeout(function() {
    location.reload();
}, 1000);return;

                $(editing_row).find('.name').html(response.category.name); 
                $(editing_row).find('.detail').html(response.category.detail);
                $(editing_row).find('.category').html(response.category.get_category.name);

                $(editing_row).find('.image_link').attr('href', "{{url('site_images/sub_categories')}}/"+response.category.image);
                $(editing_row).find('.category_image').attr('src', "{{url('site_images/sub_categories')}}/"+response.category.image);



                $("#edit_id").val("");
                $("#edit_name").val("");
                $("#edit_detail").val("");

                $('#edit_modal').modal('toggle');

                console.log(editing_row);


                $(editing_row).find('.name').html(name);
                swal.fire("Message", response.msg, "success");


            }
        }).fail(function (error) {
            $("#loading").hide();
            $.each(error.responseJSON.errors, function (key, item) {
                if (key == "name") {
                    $("#error_" + key).text(item[0]);
                    $("#error_" + key).parent().addClass('has-error');
                }
            });
        });
    });


    $(document).on('click', '.delete', function(e){
            var uid = $(this).data('id');
            var tr = "";
              tr = $(this).closest('tr');
              console.log(tr);

            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value)
            {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: 'post',
                    data: {'_method': 'DELETE'},
                    url: '{{url('sub_category/')}}/' + uid,
                    beforeSend: function() { 
                        $("#loading").show();
                    },
                }).done(function (response) {
                    $("#loading").hide();
                        Swal.fire("Deleted!",response.msg, "success");
                        var table = $('#datatable-buttons').DataTable();
                        table.row(tr).remove().draw();
                        updateSerial();
                }).fail(function (response) {
                    $("#loading").hide();
                    swal.fire("Cancelled",response.statusText, "error");
                });
            }
    })
});

 </script>
@endsection