@extends('layouts.theme')
@section('title','Products')
@section('style')
    <!-- DataTables -->
    <link href="{{url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{url('libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet">
  
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

                                            <h5 class="card-title">Product Lists</h5>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="float-right d-print-none">
                                                @can('product.create')
                                                    <a href="{{url('product/create')}}"   class="btn btn-primary float-right">Create Product</a>
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
                                                <td  >Chasis No</td>
                                                <th>Model</th>
                                                <th>Package</th>
                                                <th>Image</th>
                                                @if (Auth::user()->hasAnyPermission(['product.update', 'product.delete', 'product.view']) || Auth::user()->hasRole('Super Admin'))
                                                    <th>Action</th>
                                                @endif 
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php $count=1;?>
                                                @foreach ($list as $value)
                                                    <tr class="gradeX">
                                                        <td> {{$count++}}</td>
                                                        <td  >{{$value->chassis_no }}</td>
                                                        <td  >{{$value->model}}</td>
                                                        <td >{{$value->package}}</td>
                                                        <td >
                                                            <img class="img-fluid" alt="" 
                                                            src=" {{url('site_images/feature_image/'.$value->feature_image)}}" 
                                                            style="height: 80px !important;"  >
                                                        </td>
                                                        
                                                        @if (Auth::user()->hasAnyPermission(['product.update', 'product.delete', 'product.view']) || Auth::user()->hasRole('Super Admin'))
                                                            <td>
                                                                <div class="btn-group ">
                                                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="mdi mdi-chevron-down"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu view-dropdown-menu ">
    
                                                                        @can('product.view')
    
                                                                            <a href="{{url('product/'.encrypt($value->id))}}"  class="dropdown-item action_imgs  ">
                                                                                <span class="fa fa-eye  " > </span> View
                                                                            </a>
    
                                                                        @endcan
                                                                        @can('product.update')
    
                                                                            <a href="{{url('product/'.encrypt($value->id).'/edit')}}"  class="dropdown-item action_imgs  ">
                                                                                <span class="mdi mdi-square-edit-outline edit-icon" > </span>Edit
                                                                            </a>
    
                                                                        @endcan
                                                                        @can('product.delete')
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
    
                                                 
                                               </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->


                    @can('category.create')
                    <!-- /.create-dialog -->
                        <div class="modal fade" id="create_modal" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Create Category</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                    </div>
                                    <div class="modal-body">
                                        <form   class="custom-validation " id="create_form" action="javascript:;" method="post"  >
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                                        <label>Category Name</label>
                                                        <input type="text" placeholder="Enter Category Name" autocomplete="off" id="create_name" name="name" class="form-control"
                                                               value="{{old('name')}}"   required autofocus>
                                                        
                                                            <span class="text-danger" id="err_create_name">   </span>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group {{ $errors->has('category_sign') ? ' has-error' : '' }}">
                                                        <label>Category Sign</label>
                                                        <input type="text" autocomplete="off" placeholder="Category Sign" id="create_category_sign" name="category_sign" class="form-control"
                                                        value="{{old('category_sign')}}" maxlength="3"   autofocus>
                                                            <span class="text-danger" id="err_category_sign">    </span>
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
                    @can('category.update')
                        <div class="modal fade" id="edit_modal" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Category</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id"  id="edit_id">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Category Name</label>
                                                    <input autocomplete="off" type="text" placeholder="Enter Category Name" id="edit_name" maxlength="20"
                                                           name="name" class="form-control " value="{{old('name')}}"  required autofocus>
                                                    <span class="text-danger " id="error_name">  </span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button class="btn btn-md btn-primary m-t-n-xs float-right edit_form" type="submit" >Save</button>
                                            </div>
                                        </div>
                                    </div>
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
  


    <script>
        
    $(document).on('click', '.delete', function(e){
            var uid = $(this).data('id');
              tr = $(this).closest('tr');

            
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
                    url: '{{url('product/')}}/' + uid,
                    beforeSend: function() { 
                        $("#loading").show();
                    },
                }).done(function (response) {
                    $("#loading").hide();
                        Swal.fire("Deleted!",response.msg, "success");
                        var table = $('#datatable-buttons').DataTable();
                        table.row(tr).remove().draw();

                }).fail(function (response) {
                    $("#loading").hide();
                    swal.fire("Cancelled",response.statusText, "error");
                });
            }
    })
});

 </script>
@endsection