@extends('layouts.theme')
@section('title','Roles')
@section('style')
    <!-- DataTables -->
    <link href="{{url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{url('libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid customer-search">
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

                                            <h5 class="card-title">Role Lists</h5>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="float-right d-print-none">
                                                @can('role.create')
                                                    <a class="btn btn-primary" href="{{url('role/create')}}">
                                                        Add role</a>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="table-responsive">
                                        <table id="datatable2" class="table table-striped table-bordered w-100 user_table">
                                            <thead>
                                            <tr>
                                                <th>Sr. #</th>
                                                <th>Name</th>
                                                <th>Permissions</th>
                                                @if (Auth::user()->hasAnyPermission(['role.update', 'role.delete']) || Auth::user()->hasRole('Super Admin'))

                                                    <th>Action</th>
                                                @endif


                                            </tr>
                                            </thead>
                                            <?php $count=1;?>
                                            @foreach ($roles as $value)
                                                @if($value->name!="Super Admin")
                                                    <tr class="gradeX">
                                                        <td>
                                                            {{$count++}}
                                                        </td>
                                                        <td class="text-capitalize"> {{$value->name}}</td>
                                                        <td>
                                                            @foreach ($value->permissions as $permission)
                                                                <span class="badge badge-boxed  badge-success">  {{ $permission->name}} </span>
                                                            @endforeach
                                                        </td>




                                                        @if (Auth::user()->hasAnyPermission(['role.update', 'role.delete']) || Auth::user()->hasRole('Super Admin'))
                                                            <td>
                                                                <div class="btn-group ">
                                                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="mdi mdi-chevron-down"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu view-dropdown-menu ">

                                                                        @can('role.update')
                                                                            <a class="dropdown-item" href="{{url('role/'.encrypt($value->id).'/edit')}}">
                                                                                <span class="mdi mdi-square-edit-outline edit-icon" > </span> Edit</a>
                                                                        @endcan
                                                                        @can('role.delete')
                                                                                <a href="javascript:;" class=" delete dropdown-item"
                                                                                   data-id="{{encrypt($value->id)}}">
                                                                                    <span class=" mdi mdi-minus-circle minus-icon"></span> Delete
                                                                                </a>

                                                                        @endcan

                                                                    </div>
                                                                </div>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endif

                                            @endforeach

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

        $('.delete').click(function () {
            var uid = $(this).data('id');
            var tr = $(this).closest('tr');
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
                    url: '{{url('role/')}}/' + uid,
                }).done(function (responce) {
                    console.log(responce);
                    if(responce.status){

                        Swal.fire("Deleted!",responce.success, "success");
                        var table = $('#dataTable').DataTable();
                        table.row(tr).remove().draw();
                    }else{
                        swal.fire("Cancelled",responce.responseJSON.message, "error");
                    } 
                }).fail(function (responce) {
                    swal.fire("Cancelled",responce.responseJSON.message, "error");
                });
            }
        })
        });


    </script>
@endsection

