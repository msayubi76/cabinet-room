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
                                    </div>
                                    <table id="datatable-buttons" class="table table-striped table-bordered ">
                                        <thead>
                                        <tr>
                                            <th>Sr. #</th>
                                            <td >Order NO</td>
                                            <th>Order Date</th>
                                            <th>Payment Status</th>
                                            <th>Order Status</th> 
                                            <th>Action</th> 
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $item)
                                          
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$item->getTransaction?$item->getTransaction->transaction_no:''}}</td>
                                                    
                                                    <td>{{$item->getTransaction?$item->getTransaction->transaction_date:''}}</td>

                                                    <td class="text-capitalize">{{$item->getTransaction?$item->getTransaction->payment_status:''}}</td>

                                                    <td class="text-capitalize">{{str_replace('_', ' ', $item->getTransaction?$item->getTransaction->order_status:'')}}</td>
                                                    <td><a href="{{url('customer/payment/detail/'.encrypt($item->getTransaction?$item->getTransaction->id:''))}}">Detail</a></td>
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
     
@endsection