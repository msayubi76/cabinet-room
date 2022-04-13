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
            <div class="col-md-12 col-lg-10 mx-auto">
               
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                                <h4 class="text-center">Order Detail</h4>
                            </div>
                            
                                @if (  Auth::user()->hasRole('Customer') ||  Auth::user()->hasRole('Super Admin') || Auth::user()->hasAnyPermission(['product.view']))
                                    <div class="col-md-4 col-sm-4  text-right d-print-none"> 
                                        <a  
                                        <?PHp $type == 'part'? $page = "jdm_part": $page = "product"; ?>
                                        href="{{url($page.'/'.encrypt($product->id))}}"  


                                        data-toggle="tooltip" data-placement="top"  
                                        > <span class="   tippy-btn" title="Open Product Detail" data-tippy-placement="top"><strong>Product Detail</strong></span></a>
                                    </div>
                                @endif 
                        </div>
                        <div class="row pb-3 border-bottom mb-3">
                            <div class="col-md-4 col-sm-4 "> 
                                <label>JDM Trading</label>
                                <p class="mb-0">
                                    Nagoyashi, Mindori-Ku-Shikayama 2-1-1 Royal Shikayama A503, Japan <br/>
                                    <b>Cell:</b> 080-4548-4686<br/>
                                    <b>Ph:</b> 052-755-0916<br/>
                                    <b>Fax:</b> 052-717-7427<br/> 
                                    <b>Email:</b> info@jdm-trading.com
                                </p> 
                            </div>
                            <div class="col-md-4 col-sm-4 ">

                                @if ($transaction->shipping_detail)
                                    <label>Shipping Detail</label> 
                                    <p class="mb-0">{{$transaction->shipping_detail}}</p>
                                @endif
 
                            </div>
                            <div class="col-md-4 d-print-none">
                                <div>
                                    <label>Product Imange</label> 
                                </div>
                                <img class="img-fluid" alt="" 
                                src=" {{url('site_images/feature_image/'.$product->feature_image)}}" 
                                style="height: 120px !important;"  >
                            </div>


                             

                        </div>
                        <div class="row"> 
                            <div class="col-md-4"> 
                                <p class="mb-0"><strong>Customer Information</strong></p>
                                <p  class="mb-0"><strong>Name</strong>: {{$transaction->getCustomer?$transaction->getCustomer->name:''}}</p>
                                <p class="mb-0"><strong>Address</strong>:
                                    {{$transaction->getCustomer?$transaction->getCustomer->address:''}}
                                </p>
                                <p class="mb-0"><b>Phone: </b>  {{$transaction->getCustomer?$transaction->getCustomer->phone:''}}</p>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="float-right text-right">
                                    <p class="mb-0"><strong>Order Date</strong>:  {{date('d-M-Y',strtotime($transaction->transaction_date))}}</p>
                                    <p class="mb-0"><b>Order Time</b>: {{date('h:i: A',strtotime($transaction->transaction_date))}}</p>
                                    <p class="mb-0"><b>Order ID :</b>  {{$transaction->transaction_no}}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-2">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-sm mb-0">
                                        <thead >
                                            <tr >
                                                <th class="pb-2 pt-2" ><strong>Sr No</strong></th> 
                                                <th class="pb-2 pt-2" ><strong>Item</strong></th>  
                                                
                                                @if (Auth::user()->hasRole('Super Admin') )
                                                <th class="pb-2 pt-2" ><strong>Sale Price</strong></th> 
                                                <th class="pb-2 pt-2" ><strong>Actual Sale Price</strong></th> 
                                                <th class="pb-2 pt-2" ><strong>Customer Sale Price</strong></th> 
                                                @elseif(   Auth::user()->hasRole('Customer') )
                                                    <th class="pb-2 pt-2" ><strong>Price</strong></th> 
                                                @endif
                                                

                                                <th class="pb-2 pt-2" ><strong>Total</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <tr>
                                                <th>1</th>
                                                
                                               
                                                <td class="text-capitalize">  
                                                        {{ $product_name}} 
                                                </td>
                                                @if (Auth::user()->hasRole('Super Admin') )
                                                    <td  >{{$transaction->getTransactionsSelline?$transaction->getTransactionsSelline->sale_price.' '. $product->currency_type:''}}</td>
                                                    <td  >{{$transaction->getTransactionsSelline?$transaction->getTransactionsSelline->actual_sale_price.' '. $product->currency_type:''}}</td>
                                                @endif
                                                <td  >{{$transaction->getTransactionsSelline?$transaction->getTransactionsSelline->customer_sale_price.' '. $product->currency_type:''}}</td>
                                                
                                                @if (Auth::user()->hasRole('Super Admin') )
                                                    <th> {{$transaction->total .' '. $product->currency_type}}</th>
                                                    @elseif (Auth::user()->hasRole('Customer') )
                                                        <th> {{$transaction->customer_total_amount .' '. $product->currency_type}}</th> 
                                                    @endif
                                                
                                            </tr>
                                            
                                        </tbody>
                                            <tfoot> 
                                               
                                                <tr>
                                                    <th></th>
                                                  
                                                    @if (Auth::user()->hasRole('Super Admin') )
                                                    <th></th> 
                                                    <th></th>  
                                                    @endif
                                                    <th></th> 
                                                    <th><strong>Total</strong></th>
                                                    @if (Auth::user()->hasRole('Super Admin') )
                                                    <th> {{$transaction->total.' '. $product->currency_type}}</th>
                                                    @elseif (Auth::user()->hasRole('Customer') )
                                                        <th> {{$transaction->customer_total_amount.' '. $product->currency_type}}</th> 
                                                    @endif
                                                </tr>
                                            </tfoot>

                                    </table>


                                </div>                                            
                            </div>                                        
                        </div>

                        
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-6 ">
                                <h5 class="mt-4">Terms And Condition :</h5>
                                <ul class="pl-3">
                                    <li><small>All accounts are to be paid within 7 days from receipt of invoice. </small></li>
                                    <li><small>To be paid by cheque or credit card or direct payment online.</small></li>
                                    <li><small> If account is not paid within 7 days the credits details supplied as confirmation<br> of work undertaken will be charged the agreed quoted fee noted above.</small></li>                                            
                                </ul>
                            </div>  
                            <div class="col-lg-6 col-md-6">


                            </div>  
                        </div>
                        <hr>
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-12 col-xl-4 ml-auto align-self-center">
                                <div class="text-center text-muted"><small>Thank you very much for doing business with us. Thanks !</small></div>
                            </div>
                            <div class="col-lg-12 col-xl-4">
                                <div class="float-right d-print-none">
                                    <a href="javascript:window.print()" class="btn btn-info"><i class="fa fa-print"></i></a>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </div>
                @if (Auth::user()->hasRole('Super Admin') )
                <div class="card d-print-none  p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <p ><strong>Payments History</strong></p>
                        </div>
                        <div class="col-md-6 text-right">
                            <p ><strong>Total Amount Paid:  </strong>{{$transaction->getPayments->sum('amount') .' '. $product->currency_type}}</p>
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
                                <td>{{$item->amount .' '. $product->currency_type}}</td>
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
                @endif
                <div class=" d-print-none card p-3">
                    
                    <p ><strong>Documents: </strong></p>
                        <div class="row"> 
                             
                                @foreach ($files as $file)
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-6 ">
                                        <div class="card">
                                            @if ($file->file_type != 'image')
                                            <a  class="" href="{{ url('site_images/product_documents/'.$file->file)}}" title="Preview"  target="_blank" >
                                            <div class="view-document">
                                                <i class="dripicons-document-remove "></i>
                                            </div>
                                            </a>
                                            @endif
                                           
                                            @if ($file->file_type == 'image')
                                                <a class="image-popup-no-margins" href="{{ url('site_images/product_documents/'.$file->file)}}" 
                                                    data-toggle="tooltip" data-placement="bottom" title="View"
                                                     >
                                                <img class="img-fluid" alt="" style="height: 118px; !important;"  src=" {{url('site_images/product_documents/'.$file->file)}}"  width="100%">
                                                </a>
                                            @endif
                                            <div class="py-2 text-center">
                                                <a href="{{ url('site_images/product_documents/'.$file->file)}}" download class="text-muted 
                                                    font-600"
                                                    data-toggle="tooltip" data-placement="bottom" title="Download Image">Download</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @if (count($transaction->getMedia) == 0)
                                <p class="text-center w-100">Documents not uploaded.</p>
                                @endif
                               
                            
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