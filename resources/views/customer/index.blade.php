@extends('layouts.theme')
@section('title',$title)
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
        <div class="container-fluid  ">
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
                                            <h5 class="card-title">{{$type}}</h5>
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
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php $count=1;?>
                                                @foreach ($cars as $car)
                                                    <tr class="gradeX"> 
                                                        <td>{{$count++}}</td>
                                                        <td>{{$car->getTransactionsSelline?$car->getTransactionsSelline->getProduct?$car->getTransactionsSelline->getProduct->chassis_no:'':''}}</td>
                                                        <td>{{$car->getTransactionsSelline?$car->getTransactionsSelline->getProduct?$car->getTransactionsSelline->getProduct->model:'':''}}</td>
                                                        <td>{{$car->getTransactionsSelline?$car->getTransactionsSelline->getProduct?$car->getTransactionsSelline->getProduct->package:'':''}}</td>
                                                        <td>
                                                        <a href="{{url('product/'.encrypt($car->getTransactionsSelline?$car->getTransactionsSelline->getProduct?$car->getTransactionsSelline->getProduct->id:'':''))}}">
                                                            <span class="fa fa-eye  "> </span> View
                                                        </a>
                                                        </td>
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

     
@endsection