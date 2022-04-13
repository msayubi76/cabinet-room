@extends('layouts.theme')
@section("title","Home")
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Welocome to Dashboard</h4> 
                    </div>
                    @include('alertsInfo')
                </div>
            </div>
            <!-- end page title -->
  
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection

@section('script')
    <!--Morris Chart-->

    <script src="{{url('libs/morris.js/morris.min.js')}}"></script>
    <script src="{{url('libs/raphael/raphael.min.js')}}"></script>
    <script src="{{url('libs/jquery-knob/jquery.knob.min.js')}}"></script>
    <script src="{{url('libs/metrojs/release/MetroJs.Full/MetroJs.min.js')}}"></script>

    <script src="{{url('js/pages/dashboard.init.js')}}"></script>

@endsection