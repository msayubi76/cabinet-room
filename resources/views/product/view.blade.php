@extends('layouts.theme')
@section('title','Product Detail')
@section('style')
    <link href="{{url('libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{url('libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" /> 
@endsection

@section('content')
<style>
    table tr td{
        text-transform: capitalize;
    }
    
    @media only screen and (min-width: 1500px) { 
        .main-img-div{
            max-width: 190px !important;
            min-width: 190px !important;
        }
    }
</style>
    <div class="page-content">
        <div class="container-fluid ">
            <div class="card w-100"  >
                <div class="card-body  " >
                    <div class="top-headings text-center">
                        <h2>Product Detail</h2>
                        <p><strong>Date:</strong> {{date('d-M-y h:i A')}} </p>
                    </div>
                <div class="row">
                    <div class="col-lg-12 col-xl-12 print-div pr-0 d-print-none">
                        <div class="float-right ">
                            <a href="javascript:window.print()" class="btn btn-info"><i class="fa fa-print"></i></a>
                        </div>
                    </div>
                </div>
                </div>

                <div style="padding: 0px 14px;">
                    <h3  >Product Detail</h3> 
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table   class="table mb-0">
                                <tbody>
                                    <tr> 
                                        <td><strong>Category: </strong>{{$product->getCategory?$product->getCategory->name:''}}</td>
                                        <td><strong>Sub Category: </strong>{{$product->getSubCategory?$product->getSubCategory->name:''}}</td>
                                       
                                        <td><strong>Price: </strong>
                                             
                                            @if (Auth::user()->hasRole('Super Admin'))
                                                {{$product->price .' '. $product->currency_type}}
                                                @elseif(Auth::user()->hasRole('Customer'))
                                                {{ 
                                                    $product->getTransactionsSelline?
                                                        $product->getTransactionsSelline->getTransaction?
                                                            $product->getTransactionsSelline->getTransaction->customer_total_amount .' '.$product->currency_type
                                                            :''
                                                    :''
                                                }}
                                            @endif
                                        
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td><strong>Chassis No: </strong>{{$product->chassis_no}}</td>
                                        <td><strong>CC: </strong>{{$product->cc}}</td>
                                        <td><strong>Make: </strong>{{$product->make}}</td>
                                        
                                        
                                        
                                    </tr>
                                    <tr>
                                        <td><strong>Model: </strong>{{$product->model}}</td>
                                        <td><strong>Model: </strong>{{$product->model}}</td>
                                        <td><strong>Package: </strong>
                                            {{$product->package}}
                                        </td>
                                      
                                       
                                        
                                        
                                    </tr> 
                                    <tr>
                                        <td><strong>Year: </strong>{{$product->year}}</td>
                                        <td><strong>Seats: </strong> {{$product->seats}}</td>
                                        <td><strong>Hybrid / Petrol/Diesel: </strong>{{$product->hybrid_petrol_diesel}}</td>
                                       
                                       
                                    </tr>
                                    <tr>
                                        <td><strong>2Wd / 4Wd: </strong>{{$product->_wd_4wd}}</td>
                                        <td><strong>Mileage: </strong>{{$product->mileage}}</td>
                                        <td><strong>Transmission: </strong>{{$product->transmission}}</td>
                                       
                                       
                                    </tr>
                                    <tr>
                                        <td><strong>Power Window: </strong>{{$product->power_window}}</td>
                                        <td  ><strong>Power Stearing: </strong>{{$product->power_stearing}}</td>
                                        <td><strong>Ac /Aac: </strong>{{$product->ac_aac}}</td>
                                       
                                    </tr>
                                    <tr>
                                        <td ><strong>Navigation / Tc/Dvd: </strong>{{$product->navigation_tc_dvd}}</td>
                                        <td ><strong>Steering Audio Controls: </strong>{{$product->steering_audio_controls}} </td>
                                        <td><strong>Cruise Controls: </strong>{{$product->cruise_controls}}</td>
                                       
                                    </tr>
                                    <tr>
                                        <td><strong>Paddle Shifters: </strong>{{$product->paddle_shifters}}</td>
                                        <td><strong>Key Start / Push Start: </strong>{{$product->key_start_push_start}}</td>
                                        <td><strong>Alloys: </strong>{{$product->alloys}}</td>
                                       
                                    </tr> 

                                    <tr>
                                        <td><strong>Fog: </strong>{{$product->fog}}</td>
                                        <td><strong>Rear Spoiler: </strong>{{$product->rear_spoiler}}</td>
                                        <td><strong>Aero Kit: </strong>{{$product->aero_kit}}</td>
                                       
                                    </tr>
                                    <tr>
                                        <td><strong>Leather Seats: </strong>{{$product->leather_seats}}</td>
                                        <td><strong>Back Camera: </strong>{{$product->back_camera}}</td>
                                        <td><strong>Bumper Sensors: </strong>{{$product->bumper_sensors}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td><strong>Sunroof Penoramic: </strong>{{$product->sunroof_penoramic}}</td>
                                        <td><strong>Retractable Side Mirrors: </strong>{{$product->retractable_side_mirrors}}</td>
                                        <td><strong>Keyless Entry: </strong>{{$product->keyless_entry}}</td>
                                       
                                    </tr> 
                                    <tr>
                                        <td><strong>Back Tyre: </strong>{{$product->back_tyre}}</td>
                                        <td><strong>Air Bag: </strong>{{$product->abs}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><strong>Description: </strong></td> 
                                    </tr>
                                    <tr>
                                        <td  colspan="3">
                                            {{$product->description}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                    
                     
                </div>
            </div>
            <div class="card w-100 d-print-none" id="customer-files">
                <div class="card-body customer-files" >
                    <div class="row">
                        <div class="col-md-12">
                            <p ><strong>Feature Image: </strong></p>
                        </div>
                        <div class="col-md-4">
                            <img class="img-fluid" alt="" 
                            src=" {{url('site_images/feature_image/'.$product->feature_image)}}" 
                            style="height: 120px !important;"  >
                        </div>
                    </div>
                    <div class="files-div"> 
                        <div class="col-md-12">
                            <p ><strong>Other Images: </strong></p>
                        </div>
                            <div class="row"> 
                                    @forelse ($files as $file)
                                        <div class="col-lg-2 col-xl-2 col-md-3 col-sm-6 col-6 main-img-div">
                                            <div class="card">
                                                @if ($file->file_type != 'image')
                                                <a  class="" href="{{ url('site_images/products/'.$file->file)}}" title="Preview"  target="_blank" >
                                                <div class="view-document">
                                                    <i class="dripicons-document-remove "></i>
                                                </div>
                                                </a>
                                                @endif
                                            
                                                @if ($file->file_type == 'image')
                                                    <a class="image-popup-no-margins" href="{{ url('site_images/products/'.$file->file)}}" title="View" >
                                                    <img class="img-fluid" alt=""  src=" {{url('site_images/products/'.$file->file)}}" style="height: 118px !important;"  width="100%">
                                                    </a>
                                                @endif
                                                <div class="py-2 text-center">
                                                    <a href="{{ url('site_images/products/'.$file->file)}}" download class="text-muted font-600">Download</a>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        
                                    <div class="col-md-12">
                                        <p>No file uploaded.</p>
                                    </div>
                                    @endforelse
                                      
                                     
                            </div>
                    </div>
                </div>
            </div> 
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
@section('script')
<script src="{{url('libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script src="{{url('js/pages/lightbox.init.js')}}"></script>
@endsection
 
