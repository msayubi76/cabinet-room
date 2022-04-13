@extends('layouts.theme')
@section('title', "Order Detail")
@section('style')
    <link href="{{url('libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet">
    <link href="{{url('libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    
    <link href="{{url('libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('libs/dropify/css/dropify.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{url('libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" /> 
@endsection
@section('content')
<style>
    .view-document {
    text-align: center;
    padding: 20px;
}
.view-document i {
    font-size: 65px;
}
</style>
<div class="page-content">
    <div class="container-fluid">
        @include('alertsInfo')
        <!-- start page title -->

        <!-- end page title -->

        <div class="row">
            <div class="col-md-12 col-lg-12 mx-auto">
               
                 
                <div class="card d-print-none  p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <p ><strong>Payments History</strong></p>
                        </div>
                        <div class="col-md-6 text-right">
                            <p ><strong>Total Amount Paid:  </strong>{{$transaction->getPayments->sum('amount') .' '. $currency_type}}</p>
                        </div>
                        <div class="col-md-12">
                        <table class="table table-hover">
                            <tr>
                                <th><strong>Sr No</strong></th>
                                <th><strong>Amount</strong></th>
                                <th><strong>Remarks</strong></th>
                                <th><strong>Date</strong></th>
                            </tr>
                            
                            
                            @foreach ($transaction->getPayments as $item)
                            <tr>
                                 
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->amount .' '. $currency_type}}</td>
                                <td>{{$item->remarks}}</td>
                                <td>{{date("Y-m-d ", strtotime($item->payment_date))}}</td>
                            </tr>
                            @endforeach

                            @if (count($transaction->getPayments) == 0)
                                <tr class="text-center"><td colspan="4">Payment not added</td></tr>
                            @endif
                            
                        </table>
                        </div>
                    </div>

                </div>
             
                 
            </div>
        </div>
        
    </div> <!-- container-fluid -->
</div>
@endsection
@section('script')
<script src="{{url('libs/tippy.js/tippy.all.min.js')}}"></script>
<script src="{{url('js/pages/tooltipster.init.js')}}"></script>

<script src="{{url('libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script src="{{url('js/pages/lightbox.init.js')}}"></script> 


@endsection