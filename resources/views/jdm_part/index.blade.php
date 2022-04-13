@extends('layouts.theme')
@section('title','Jdm Parts')
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

                                            <h5 class="card-title">Parts Lists</h5>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="float-right d-print-none">
                                                @can('jdm_part.create')
                                                    <a href="{{url('jdm_part/create')}}"   class="btn btn-primary float-right">Create Part</a>
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
                                                <td>Name</td>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Category</th>
                                                <th>Image</th>
                                                @if (Auth::user()->hasAnyPermission(['jdm_part.update', 'jdm_part.delete', 'jdm_part.view']) || Auth::user()->hasRole('Super Admin'))
                                                    <th>Action</th>
                                                @endif 
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php $count=1;?>
                                                @foreach ($jdm_parts as $jdm_part)
                                                <?php 
                                                    $product = $jdm_part->product; 
                                                    $category = $jdm_part->getCategory?$jdm_part->getCategory->name:""; 
                                                ?>
                                                    <tr class="gradeX">
                                                        <td> {{$count++}}</td>
                                                        <td  >{{$jdm_part->name }}</td>
                                                        <td  >{{$product}}</td>
                                                        <td >{{$jdm_part->price.' '.$jdm_part->currency_type}}</td>
                                                        <td>{{ $category }}</td>
                                                        <td >
                                                            <img class="img-fluid" alt="" 
                                                            src=" {{url('site_images/feature_image/'.$jdm_part->feature_image)}}" 
                                                            style="height: 50px !important;"  >
                                                        </td>
                                                        
                                                        @if (Auth::user()->hasAnyPermission(['jdm_part.update', 'jdm_part.delete', 'jdm_part.view']) || Auth::user()->hasRole('Super Admin'))
                                                            <td>
                                                                <div class="btn-group ">
                                                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="mdi mdi-chevron-down"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu view-dropdown-menu ">
                                                                        @can('jdm_part.show')
    
                                                                            <a href="{{url('jdm_part/'.encrypt($jdm_part->id))}}"  class="dropdown-item action_imgs  ">
                                                                                <span class="fa fa-eye" > </span>View
                                                                            </a>

                                                                        @endcan
                                                                        
                                                                        @can('jdm_part.view') 
                                                                            <a href="{{url('jdm_part/'.encrypt($jdm_part->id))}}"  
                                                                                class="dropdown-item action_imgs  ">
                                                                                <span class="fa fa-eye" > </span> View
                                                                            </a> 
                                                                        @endcan
                                                                        @can('jdm_part.update') 
                                                                        <a href="{{url('jdm_part/'.encrypt($jdm_part->id).'/edit')}}"  class="dropdown-item action_imgs  ">
                                                                            <span class="mdi mdi-square-edit-outline edit-icon" > </span> Edit
                                                                        </a> 
                                                                    @endcan
                                                                        @can('jdm_part.delete')
                                                                            <a href="javascript:;" class=" delete dropdown-item action_imgs"
                                                                               data-id="{{encrypt($jdm_part->id)}}">
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
                    url: '{{url('jdm_part/')}}/' + uid,
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