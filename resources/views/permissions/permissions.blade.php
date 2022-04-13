@extends('layouts.theme')
@section('title','Permissions')
@section('style')
    <link href="{{url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid customer-search">
            <!-- start page title -->
            <div class="card  w-100">
                <div class="card-body">
                    @include('alertsInfo')
                    <div class="row d-flex">
                        <div class="col-lg-6  ">
                            <h3>Permission Lists </h3>

                        </div>
                        <div class="col-lg-6">
                            <div class="float-right d-print-none">
                                @can('permission.create')
                                <a class="btn btn-soft-primary" href="{{url('permission/create')}}">
                                    Create Permission</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <br>
                    <table class="table mb-0 customer-list" id="dataTable">
                        <thead>
                        <tr>
                            <th>Sr. #</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($permissions as $value)
                            <tr class="gradeX">
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>   {{$value->name}}</td>
                                <td>
                                    @can('permission.update')
                                    <a class="btn btn-soft-primary" href="{{url('permission/'.encrypt($value->id).'/edit')}}">
                                        Edit</a>
                                        @endcan
                                        @can('permission.delete')
                                    <a href="javascript:;" class=" delete btn btn-soft-danger"
                                       data-id="{{encrypt($value->id)}}">
                                        Delete</a>
                                        @endcan
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{url('libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <script>
        $(function () {
            $('#dataTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": true,
            });
        });
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
                    url: '{{url('permission/')}}/' + uid,
                }).done(function (response) {
                    console.log(response);
                    if(response.status){

                        Swal.fire("Deleted!",response.success, "success");
                        var table = $('#dataTable').DataTable();
                        table.row(tr).remove().draw();
                    }else{
                        swal.fire("Cancelled",response.responseJSON.message, "error");
                    }
 

                }).fail(function (response) {
                    swal.fire("Cancelled",response.responseJSON.message, "error");
                });
            }
        })
        });


    </script>
@endsection

