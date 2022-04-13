@extends('layouts.theme')
@section('title','Edit Product')
@section('style') 
<link href="{{url('libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet">
    <link href="{{url('libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" /> 
@endsection

@section('content')
<style>
    .parsley-errors-list{
        width: 100%;
    }
    .view-document {
        position: absolute;
        top: 0px;
        right: 0px;
        background: #e8e8e8;
        padding: 2px 8px;
    }
    
    .view-document a {
        color: red;
        font-size: 11px;
    }
</style>
<div class="page-content">
  <div class="container-fluid  ">
      <div class="card  w-100">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="box box-info">
                  <div class="box-header with-border">
                    <h3 class="box-title">Edit Product</h3> 
                  </div>
                  <div class="box-body">
                      
                    @include('alertsInfo')
                        <form role="form" class="custom-validation" action="{{url('product/'.encrypt($product->id))}}" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="_token" value="{{csrf_token()}}" >
                          <input type="hidden" name="_method" value="PUT">
                           
                            <div class="form-row mb-3">
                                <div class="col-md-4 ">
                                    <p for="category_id">Select Category</p>
                                    <div class="form-group ">
                                      
                                        <select required  class="form-control {{ $errors->has('category_id') ? ' has-error' : '' }}" name="category_id" id="category_id">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $item)
                                                <option value="{{$item->id}}" {{$product->category_id == $item->id? 'selected':''}} >{{$item->name}}</option>
                                            @endforeach
                                        </select> 
                                        @if ($errors->has('category_id')) <div class="errMsg"> <span>{{ $errors->first('category_id') }}</span> </div> @endif
                                    </div> 
                                </div>
                                <div class="col-md-4 ">
                                    <p for="category_id">Select Sub Category</p>
                                    <div class="form-group ">
                                        <select required class="form-control {{ $errors->has('sub_category_id') ? ' has-error' : '' }}" 
                                            name="sub_category_id" id="sub_category_id">
                                            <option value="">Select Sub Category</option>
                                            @foreach ($sub_categories as $sub_category)
                                                <option value="{{$sub_category->id}}" {{$product->sub_category_id == $sub_category->id?'selected':''}} >{{$sub_category->name}}</option>
                                            @endforeach
                                        </select> 
                                        @if ($errors->has('sub_category_id')) <div class="errMsg"> <span>{{ $errors->first('sub_category_id') }}</span> </div> @endif
                                    </div> 
                                </div>
                                <div class="col-md-4 ">
                                    <p for="country">Select Country</p>
                                    <div class="form-group ">
                                      
                                        <select class="form-control {{ $errors->has('country') ? ' has-error' : '' }}" 
                                            required name="country" id="country">
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $key => $country)
                                                <option value="{{$key}}" {{$product->country == $key?'selected':''}} >{{$country}}</option>
                                            @endforeach
                                        </select> 
                                        @if ($errors->has('country')) <div class="errMsg"> <span>{{ $errors->first('country') }}</span> </div> @endif
                                    </div> 
                                </div>
                                <div class="col-md-4 ">
                                    <p for="first_name">Make</p>
                                    <div class="input-group  {{ $errors->has('make') ? ' has-error' : '' }}">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="typcn typcn-user-outline"></i>
                                            </span>
                                        </div>
                                        <input  required    type="text" class="form-control {{ $errors->has('make') ? ' parsley-error' : '' }}" id="make"
                                               name="make" placeholder="Make"  value="{{$product->make }}"  >
              
                                    </div>
                                    @if ($errors->has('make')) <div class="errMsg"> <span>{{ $errors->first('make') }}</span> </div> @endif
              
                                </div>

                                <div class="col-md-4 ">
                                    <p for="currency_type">Currency Type</p>
                                    <div class="input-group  {{ $errors->has('currency_type') ? ' has-error' : '' }}">
                                        <select    class="form-control  {{ $errors->has('currency_type') ? ' parsley-error' : '' }}" name="currency_type" id="hybrid_petrol_diesel"  >
                                            <option value="">Select</option>
                                            <option {{$product->currency_type=='$'?'selected="selected"':''}}  value="$">Dollar</option> 
                                            <option  {{$product->currency_type=='¥'?'selected="selected"':''}} value="¥">Yen </option>
                                        </select>
                                    </div>
                                    @if ($errors->has('currency_type')) <div class="errMsg"> <span>{{ $errors->first('currency_type') }}</span> </div> @endif
                                </div>

                                <div class="col-md-4 ">
                                    <p for="sale_price">Sale Price</p>
                                    <div class="input-group  {{ $errors->has('sale_price') ? ' has-error' : '' }}">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="typcn typcn-user-outline"></i>
                                            </span>
                                        </div>
                                        <input   required   class="form-control {{ $errors->has('price') ? ' parsley-error' : '' }}" id="price"
                                               name="price" placeholder="Sale Price"  value="{{$product->price}}"  >
                
                                    </div>
                                    @if ($errors->has('price')) <div class="errMsg"> <span>{{ $errors->first('price') }}</span> </div> @endif
                
                                </div>
                                <div class="col-md-4 ">
                                  <p for="first_name">Purchase Price</p>
                                  <div class="input-group  {{ $errors->has('purchase_price') ? ' has-error' : '' }}">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="typcn typcn-user-outline"></i>
                                          </span>
                                      </div>
                                      <input     class="form-control {{ $errors->has('purchase_price') ? ' parsley-error' : '' }}" id="purchase_price"
                                             name="purchase_price" placeholder="Purchase Price"  value="{{$product->purchase_price}}"  >
                                  </div>
                                  @if ($errors->has('purchase_price')) <div class="errMsg"> <span>{{ $errors->first('purchase_price') }}</span> </div> @endif
                
                              </div>
                                
                              
                                <div class="col-md-4    ">
                                    <p for="model">Model</p>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i
                                                        class="typcn typcn-user-outline"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="modal"
                                               name="model" placeholder="model" value="{{$product->model}}"  >
                                    </div>
                                </div>
                                <div class="col-md-4   ">
                                  <p for="first_name">Package</p>
                                  <div class="input-group  {{ $errors->has('package') ? ' has-error' : '' }}">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="typcn typcn-user-outline"></i>
                                          </span>
                                      </div>
                                      <input type="text" class="form-control {{ $errors->has('package') ? ' parsley-error' : '' }}" id="package"
                                             name="package" placeholder="Package"  value="{{$product->package}}"  >
            
                                  </div>
                                  @if ($errors->has('package')) <div class="errMsg"> <span>{{ $errors->first('package') }}</span> </div> @endif
            
                              </div> 
            
                                <div class="col-md-4   ">
                                    <p for="year">Year</p>
                                    <div class="input-group   {{ $errors->has('year') ? ' has-error' : '' }}">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="typcn typcn-user-outline"></i></span>
                                        </div>
                                        <input   type="text" class="form-control {{ $errors->has('year') ? ' parsley-error' : '' }}"
                                         id="year" name="year" placeholder="Year" value="{{$product->year}}">
                                    </div>
                                    @if ($errors->has('year')) <div class="errMsg"> <span>{{ $errors->first('year') }}</span> </div> @endif
                                </div>
                                <div class="col-md-4  mt-2   {{ $errors->has('hybrid_petrol_diesel') ? ' has-error' : '' }}">
                                    <p for="hybrid_petrol_diesel">Type</p>
                                    <select    class="form-control selectm {{ $errors->has('hybrid_petrol_diesel') ? ' parsley-error' : '' }}" name="hybrid_petrol_diesel" id="hybrid_petrol_diesel"  >
                                        <option value="">Select</option>
                                        <option  {{$product->hybrid_petrol_diesel=='hybrid'?'selected="selected"':''}} value="hybrid">Hybrid</option>
                                        <option {{$product->hybrid_petrol_diesel=='petrol'?'selected="selected"':''}}  value="petrol">Petrol</option>
                                        <option {{$product->hybrid_petrol_diesel=='diesel'?'selected="selected"':''}}  value="diesel">Diesel</option>
                                    </select>
                                    @if ($errors->has('hybrid_petrol_diesel')) <div class="errMsg"> <span>{{ $errors->first('hybrid_petrol_diesel') }}</span> </div> @endif
                                </div>
                                 
                                <div class="col-md-4 mt-2 ">
                                    <p for="2wd_4wd">2wd/4wd</p>
                                    <div class="input-group {{ $errors->has('_wd_4wd') ? ' has-error' : '' }} ">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="typcn typcn-user-outline"></i></span>
                                    </div>
                                    <select    class="form-control selectm {{ $errors->has('_wd_4wd') ? ' parsley-error' : '' }}" 
                                      name="_wd_4wd" id="_wd_4wd" >
                                      <option value="">Select</option>
                                      <option  {{$product->_wd_4wd=='2wd'?'selected="selected"':''}} value="2wd">2wd</option>
                                      <option {{$product->_wd_4wd=='4wd'?'selected="selected"':''}}  value="4wd">4wd</option> 
                                  </select>
                                    
                                         
                                    </div>
                                    @if ($errors->has('2wd_4wd')) <div class="errMsg"> <span>{{ $errors->first('2wd_4wd') }}</span> </div> @endif
            
                                </div> 
                                 
                                <div class="col-md-4  mt-2  ">
                                  <p for="seats">Seats</p>
                                  <div class="input-group  {{ $errors->has('seats') ? ' has-error' : '' }}">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i  class="typcn typcn-user-outline"></i>
                                          </span>
            
                                      </div>
            
                                      <input  min="0"   type="number" class="form-control {{ $errors->has('seats') ? ' parsley-error' : '' }}" id="seats" name="seats" 
                                      value="{{$product->seats}}"  placeholder="Seats" >
                                  </div>
                                  @if ($errors->has('seats')) <div class="errMsg"> <span>{{ $errors->first('seats') }}</span> </div> @endif
                              </div>
                             
                                <div class="col-md-4   mt-2 ">
                                    <p for="validationTooltip02">CC</p>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i  class="typcn typcn-user-outline"></i>
                                            </span>
                                            
                                        </div>
            
                                        <input  class="form-control" id="cc" name="cc" value="{{$product->cc}}"
                                               placeholder="CC" >
                                    </div>
                                </div>
                                <div class="col-md-4  mt-2 ">
                                    <p for="abs">AB</p>
                                    <div class="input-group  {{ $errors->has('ab') ? ' has-error' : '' }}">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                                        </div>
                                        <input   class="form-control {{ $errors->has('ab') ? ' parsley-error' : '' }}"
                                        id="ab" value="{{$product->ab}}" name="ab"
                                              placeholder="ab"  >
                                    </div>
                                    @if ($errors->has('ab')) <div class="errMsg"> <span>{{ $errors->first('ab') }}</span> </div> @endif
                                </div> 
                                <div class="col-md-4  mt-2 ">
                                    <p for="color">Color</p>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i
                                                        class="typcn typcn-mail"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$product->color}}" name="color" id="color"
                                         placeholder="Color"  >
                                    </div>
                                </div>
            
                                <div class="col-md-4  mt-2 ">
                                    <p for="mileage">Mileage</p>
                                    <div class="input-group  {{ $errors->has('mileage') ? ' has-error' : '' }}">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-calendar"></i></span>
                                        </div>
                                        <input   type="text"  class="form-control {{ $errors->has('mileage') ? ' parsley-error' : '' }}" 
                                        name="mileage" value="{{$product->mileage}}" placeholder="Mileage" id="mileage"  autocomplete="off">
                                    </div>
                                    @if ($errors->has('mileage')) <div class="errMsg"> <span>{{ $errors->first('mileage') }}</span> </div> @endif
                                </div>
                                <div class="col-md-4  mt-2 {{ $errors->has('transmission') ? ' has-error' : '' }}">
                                    <p for="transmission">Transmission</p>
                                    <input   type="text"  class="form-control {{ $errors->has('transmission') ? ' parsley-error' : '' }}" 
                                    name="transmission" value="{{$product->transmission}}" placeholder="Transmission" id="transmission"  autocomplete="off">
                                    
                                    @if ($errors->has('transmission')) <div class="errMsg"> <span>{{ $errors->first('transmission') }}</span> </div> @endif
            
                                </div> 
            
                                <div class="col-md-4   mt-2 {{ $errors->has('power_window') ? ' has-error' : '' }}">
                                    <p for="power_window">Power Window</p> 
                                      <input   type="text"  class="form-control {{ $errors->has('power_window') ? ' parsley-error' : '' }}" 
                                      name="power_window" value="{{$product->power_window}}" placeholder="Power Window"
                                       id="power_window"  autocomplete="off">
                                      
                                    @if ($errors->has('power_window')) <div class="errMsg"> <span>{{ $errors->first('power_window') }}</span> </div> @endif
            
                                </div>
            
                                <div class="col-md-4 mt-2  power_stearing  {{ $errors->has('power_stearing') ? ' has-error' : '' }}">
                                    <p for="power_stearing">Power Stearing</p>
            
                                    <input   type="text"  class="form-control {{ $errors->has('power_stearing') ? ' parsley-error' : '' }}" 
                                    name="power_stearing" value="{{$product->power_stearing}}" placeholder="Power Stearing"
                                     id="power_stearing"  autocomplete="off">
             
                                    @if ($errors->has('power_stearing')) <div class="errMsg"> <span>{{ $errors->first('power_stearing') }}</span> </div> @endif
                                </div>
            
                                <div class="col-md-4 mt-2  ">
                                    <p for="customer_status">Ac/AAc</p>
             
                                          
            
                                           <select    class="form-control selectm {{ $errors->has('ac_aac') ? ' parsley-error' : '' }}" 
                                            name="ac_aac" id="ac_aac" >
                                            <option value="">Select</option>
                                            <option {{$product->ac_aac =='ac'?'selected="selected"':''}} value="ac">AC</option>
                                            <option {{$product->ac_aac =='aac'?'selected="selected"':''}}  value="aac">AAC</option> 
                                        </select>
                                         
                                </div> 
            
                                <div class="col-md-4  mt-2 ">
                                    <p for="occupation">Navigation/Tc/Dvd</p>
                                    <div class="input-group  ">
                                      <select    class="form-control selectm {{ $errors->has('navigation_tc_dvd') ? ' parsley-error' : '' }}" 
                                        name="navigation_tc_dvd" id="navigation_tc_dvd" >
                                        <option value="">Select</option>
                                        <option {{$product->navigation_tc_dvd =='navigation'?'selected="selected"':''}} value="navigation">Navigation</option>
                                        <option {{$product->navigation_tc_dvd =='tc'?'selected="selected"':''}}  value="tc">TC</option> 
                                        <option {{$product->navigation_tc_dvd =='dvd'?'selected="selected"':''}}  value="dvd">DVD</option> 
                                    </select>
                                    </div>
                                    @if ($errors->has('navigation_tc_dvd')) <div class="errMsg"> <span>{{ $errors->first('navigation_tc_dvd') }}</span> </div> @endif
            
                                </div>
                                <div class="col-md-4  mt-2 ">
                                    <p for="steering_audio_controls">Steering Audio Controls</p>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i
                                                        class="typcn typcn-user-outline"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="steering_audio_controls" name="steering_audio_controls" 
                                        value="{{$product->steering_audio_controls}}"
                                               placeholder="Steering Audio Controls"  >
                                    </div>
                                </div>
                                <div class="col-md-4 mt-2  ">
                                    <p for="cruise_controls">Cruise Controls</p>
                                    <div class="input-group  {{ $errors->has('cruise_controls') ? ' has-error' : '' }}">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                                        </div>
                                        <input   class="form-control {{ $errors->has('cruise_controls') ? ' parsley-error' : '' }}"
                                         id="cruise_controls" value="{{$product->cruise_controls}}" name="cruise_controls"
                                               placeholder="Cruise Controls"  >
                                    </div>
                                    @if ($errors->has('cruise_controls')) <div class="errMsg"> <span>{{ $errors->first('cruise_controls') }}</span> </div> @endif
            
                                </div> 
            
                                <div class="col-md-4 mt-2  ">
                                    <p for="paddle_shifters">Paddle Shifters</p>
                                    <div class="input-group }">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class=" mdi mdi-currency-gbp"></i></span>
                                        </div>
                                        <input   class="form-control  " id="paddle_shifters"
                                               placeholder="Paddle Shifters" value="{{$product->paddle_shifters}}" name="paddle_shifters"  >
                                    </div>
                                </div>
                                <div class="col-md-4 mt-2  ">
                                    <p for="key_start_push_start">Key Start/ Push Start</p>
                                    <select    class="form-control selectm {{ $errors->has('key_start_push_start') ? ' parsley-error' : '' }}" 
                                      name="key_start_push_start" id="key_start_push_start" >
                                      <option value="">Select</option>
                                      <option {{$product->key_start_push_start =='key_start'?'selected="selected"':''}} value="key_start">Key Start</option>
                                      <option {{$product->key_start_push_start =='push_start'?'selected="selected"':''}}  value="push_start">Push Start</option> 
                                  </select> 
                                    @if ($errors->has('key_start_push_start')) <div class="errMsg"> <span>{{ $errors->first('key_start_push_start') }}</span> </div> @endif
                                </div>
            
                                <div class="col-md-4  mt-2 ">
                                  <p for="alloys">Alloys</p>
                                  <div class="input-group  {{ $errors->has('alloys') ? ' has-error' : '' }}">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                                      </div>
                                      <input   class="form-control {{ $errors->has('alloys') ? ' parsley-error' : '' }}"
                                       id="alloys" value="{{$product->alloys}}" name="alloys"
                                             placeholder="Alloys"  >
                                  </div>
                                  @if ($errors->has('alloys')) <div class="errMsg"> <span>{{ $errors->first('alloys') }}</span> </div> @endif
                              </div> 
                                <div class="col-md-4  mt-2 ">
                                  <p for="fog">Fog</p>
                                  <div class="input-group  {{ $errors->has('fog') ? ' has-error' : '' }}">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                                      </div>
                                      <input   class="form-control {{ $errors->has('fog') ? ' parsley-error' : '' }}"
                                      id="fog" value="{{$product->fog}}" name="fog"  placeholder="Fog"  >
                                  </div>
                                  @if ($errors->has('fog')) <div class="errMsg"> <span>{{ $errors->first('fog') }}</span> </div> @endif
                              </div>
                                <div class="col-md-4 mt-2  ">
                                  <p for="alloys">Rear Spoiler</p>
                                  <div class="input-group  {{ $errors->has('rear_spoiler') ? ' has-error' : '' }}">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                                      </div>
                                      <input   class="form-control {{ $errors->has('rear_spoiler') ? ' parsley-error' : '' }}"
                                      id="rear_spoiler" value="{{$product->rear_spoiler}}" name="rear_spoiler"
                                            placeholder="Rear Spoiler"  >
                                  </div>
                                  @if ($errors->has('rear_spoiler')) <div class="errMsg"> <span>{{ $errors->first('rear_spoiler') }}</span> </div> @endif
                              </div>
                              <div class="col-md-4 mt-2  ">
                                  <p for="door_visors">Door Visors</p>
                                  <div class="input-group  {{ $errors->has('door_visors') ? ' has-error' : '' }}">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                                      </div>
                                      <input   class="form-control {{ $errors->has('door_visors') ? ' parsley-error' : '' }}"
                                      id="door_visors" value="{{$product->door_visors}}" name="door_visors"
                                            placeholder="Door Visors"  >
                                  </div>
                                  @if ($errors->has('door_visors')) <div class="errMsg"> <span>{{ $errors->first('door_visors') }}</span> </div> @endif
                              </div> 
                                <div class="col-md-4  mt-2 ">
                                  <p for="aero_kit">Aero Kit</p>
                                  <div class="input-group  {{ $errors->has('aero_kit') ? ' has-error' : '' }}">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                                      </div>
                                      <input   class="form-control {{ $errors->has('aero_kit') ? ' parsley-error' : '' }}"
                                      id="aero_kit" value="{{$product->aero_kit}}" name="aero_kit"
                                            placeholder="Aero Kit"  >
                                  </div>
                                  @if ($errors->has('aero_kit')) <div class="errMsg"> <span>{{ $errors->first('aero_kit') }}</span> </div> @endif
                              </div>
                                <div class="col-md-4  mt-2 ">
                                  <p for="leather_seats">Leather Aeats</p>
                                  <div class="input-group  {{ $errors->has('leather_seats') ? ' has-error' : '' }}">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                                      </div>
                                      <input   class="form-control {{ $errors->has('leather_seats') ? ' parsley-error' : '' }}"
                                      id="leather_seats" value="{{$product->leather_seats}}" name="leather_seats"
                                            placeholder="Leather Aeats"  >
                                  </div>
                                  @if ($errors->has('leather_seats')) <div class="errMsg"> <span>{{ $errors->first('leather_seats') }}</span> </div> @endif
                              </div>
                              <div class="col-md-4 mt-2  ">
                                  <p for="back_camera">Back Camera</p>
                                  <div class="input-group  {{ $errors->has('back_camera') ? ' has-error' : '' }}">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                                      </div>
                                      <input   class="form-control {{ $errors->has('back_camera') ? ' parsley-error' : '' }}"
                                      id="back_camera" value="{{$product->back_camera}}" name="back_camera"
                                            placeholder="Back Camera"  >
                                  </div>
                                  @if ($errors->has('back_camera')) <div class="errMsg"> <span>{{ $errors->first('back_camera') }}</span> </div> @endif
                              </div> 
                                <div class="col-md-4  mt-2 ">
                                  <p for="bumper_sensors">Bumper Sensors</p>
                                  <div class="input-group  {{ $errors->has('bumper_sensors') ? ' has-error' : '' }}">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                                      </div>
                                      <input   class="form-control {{ $errors->has('bumper_sensors') ? ' parsley-error' : '' }}"
                                      id="bumper_sensors" value="{{$product->bumper_sensors}}" name="bumper_sensors"
                                            placeholder="Bumper Sensors"  >
                                  </div>
                                  @if ($errors->has('bumper_sensors')) <div class="errMsg"> <span>{{ $errors->first('bumper_sensors') }}</span> </div> @endif
                              </div>
                                <div class="col-md-4  mt-2 ">
                                  <p for="sunroof_penoramic">Sunroof</p>
                                  <div class="input-group  {{ $errors->has('sunroof_penoramic') ? ' has-error' : '' }}">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                                      </div>
                                      <input   class="form-control {{ $errors->has('sunroof_penoramic') ? ' parsley-error' : '' }}"
                                      id="sunroof_penoramic" value="{{$product->sunroof_penoramic}}" name="sunroof_penoramic"
                                            placeholder="Sunroof"  >
                                  </div>
                                  @if ($errors->has('sunroof_penoramic')) <div class="errMsg"> <span>{{ $errors->first('alloys') }}</span> </div> @endif
                              </div>
                              <div class="col-md-4  mt-2 ">
                                  <p for="retractable_side_mirrors">Retractable Side Mirrors</p>
                                  <div class="input-group  {{ $errors->has('retractable_side_mirrors') ? ' has-error' : '' }}">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                                      </div>
                                      <input   class="form-control {{ $errors->has('retractable_side_mirrors') ? ' parsley-error' : '' }}"
                                      id="retractable_side_mirrors" value="{{$product->retractable_side_mirrors}}" name="retractable_side_mirrors"
                                            placeholder="Retractable Side Mirrors"  >
                                  </div>
                                  @if ($errors->has('retractable_side_mirrors')) <div class="errMsg"> <span>{{ $errors->first('retractable_side_mirrors') }}</span> </div> @endif
                              </div> 
                                <div class="col-md-4  mt-2 ">
                                  <p for="keyless_entry">Keyless Entry</p>
                                  <div class="input-group  {{ $errors->has('keyless_entry') ? ' has-error' : '' }}">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                                      </div>
                                      <input   class="form-control {{ $errors->has('keyless_entry') ? ' parsley-error' : '' }}"
                                      id="keyless_entry" value="{{$product->keyless_entry}}" name="keyless_entry"
                                            placeholder="Keyless Entry"  >
                                  </div>
                                  @if ($errors->has('keyless_entry')) <div class="errMsg"> <span>{{ $errors->first('keyless_entry') }}</span> </div> @endif
                              </div>
                                <div class="col-md-4 mt-2  ">
                                  <p for="back_tyre">Back Tyre</p>
                                  <div class="input-group  {{ $errors->has('back_tyre') ? ' has-error' : '' }}">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                                      </div>
                                      <input   class="form-control {{ $errors->has('back_tyre') ? ' parsley-error' : '' }}"
                                      id="back_tyre" value="{{$product->back_tyre}}" name="back_tyre"
                                            placeholder="Back Tyre"  >
                                  </div>
                                  @if ($errors->has('back_tyre')) <div class="errMsg"> <span>{{ $errors->first('back_tyre') }}</span> </div> @endif
                              </div>
                              <div class="col-md-4 mt-2  ">
                                  <p for="abs">Air Bag</p>
                                  <div class="input-group  {{ $errors->has('abs') ? ' has-error' : '' }}">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                                      </div>
                                      <input   class="form-control {{ $errors->has('abs') ? ' parsley-error' : '' }}"
                                      id="abs" value="{{$product->abs}}" name="abs"
                                            placeholder="abs"  >
                                  </div>
                                  @if ($errors->has('abs')) <div class="errMsg"> <span>{{ $errors->first('abs') }}</span> </div> @endif
                              </div>
                              <div class="col-md-12  mt-2">
                                <p for="description">Description</p>
                                <div class="input-group  {{ $errors->has('description') ? ' has-error' : '' }}"> 
                                    <textarea name="description" id="description" class="form-control"  placeholder="Description"
                                     rows="5">{{$product->description }}</textarea> 
                                     
                                </div>
                                @if ($errors->has('description')) <div class="errMsg"> <span>{{ $errors->first('description') }}</span> </div> @endif
                            </div>
                            <div class="col-md-4  mt-2">
                                <p for="is_damage">Is Damage?</p>
                                <div class="input-group m-0  {{ $errors->has('is_damage') ? ' has-error' : '' }}"> 
                                  <div class="radio ml-2">
                                      <label><input type="radio" {{ $product->is_damage == 1?" checked ":"" }} value="1" name="is_damage" checked> Yes </label>
                                    </div>
                                    <div class="radio  ml-2">
                                      <label><input type="radio" {{ $product->is_damage == 0?" checked ":"" }}  value="0" checked name="is_damage"> No </label>
                                    </div>
                                      
                                </div>
                                @if ($errors->has('is_damage')) <div class="errMsg"> <span>{{ $errors->first('description') }}</span> </div> @endif
                            </div>
                              <div class="col-md-4  mt-2">
                                <p>Upload Image</p>
                                <div class="custom-file ">
                                  <input    type="file" name="files[]" multiple class="custom-file-input" id="files">
                                  <label class="custom-file-label" for="files">Upload Image</label>
                                </div>
                            </div>
                            <div class="col-md-4  mt-2">
                                <p>Feature Image</p>
                                <div class="custom-file ">
                                  <input   type="file" name="feature_image"   class="custom-file-input" id="feature_image">
                                  <label class="custom-file-label" for="feature_image">Upload Image</label>
                                </div>
                                @if ($errors->has('feature_image')) <div class="errMsg"> <span>{{ $errors->first('feature_image') }}</span> </div> @endif
                            </div>
                            </div>
                             
                            <div class="form-row mb-3">
                              <div class="col-md-12 text-right">
                                <input type="submit" class="btn btn-primary w-25" value="Save">
                              </div>
                            </div>
                          </form>
                      </div>
                  </div>
            </div>
            </div>
          </div>
      </div>
      <div class="card w-100 d-print-none" id="customer-files">
        <div class="card-body customer-files" >
            <div class="files-div">
                <p ><strong>Files: </strong></p>
                    <div class="row">
                         
                         
                            @forelse ($files as $file)
                                <div class="col-lg-2 col-xl-2 col-md-3 col-sm-6 col-6 main-img-div  ">
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
                                            <img class="img-fluid" alt="" 
                                             src=" {{url('site_images/products/'.$file->file)}}" 
                                             style="height: 118px !important;"  width="100%">
                                            </a>
                                            <div class="view-document">
                                                <a href="javascript:;" class="delete"  data-id="{{encrypt($file->id)}}" >
                                                    <i class="fa fa-trash "></i>
                                                </a>
                                            </div>
                                        @endif
                                        
                                    </div>
                                </div>
                                @empty
                                <p>No file uploaded.</p>
                            @endforelse
                            
                    </div>
            </div>
        </div>
    </div> 
  </div>
</div>
@endsection


@section('script') 
<script src="{{url('libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script src="{{url('js/pages/lightbox.init.js')}}"></script> 
<script src="{{url('libs/parsleyjs/parsley.min.js')}}"></script>
<script src="{{url('js/pages/form-validation.init.js')}}"></script>

<script src="{{url('libs/sweetalert2/sweetalert2.min.js')}}"></script>
<script>
    $(document).ready(function(){
      $('#category_id').on('change', function(){
      var  id = $(this).children("option:selected").val();
      if(id == ""){
        return;
      }
      
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $.ajax({
                  method: 'POST',
                  url: '{{url('sub_category/getSubCategories')}}/'+id,
                  
              }).done(function(response) {
              $("#sub_category_id").html(response.html);
              }).fail(function(error){
               alert("Error "+error.responseJSON.message);
              });
      });
  
  });
  
  $('.delete').click(function () {
    var uid = $(this).data('id');
    var tr =   $(this).closest('.main-img-div'); 
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
            url: '{{url('remove_file/')}}/' + uid,
        }).done(function (responce) {
            console.log(responce);
            if(responce.status){ 
                Swal.fire("Deleted!",responce.msg, "success"); 
                $(tr).remove(); 
            }else{
                swal.fire("Cancelled",responce.msg, "error");
            }
        }).fail(function (responce) {
            swal.fire("Cancelled",responce.error, "error");
        });
    }
})
});
  </script>
  @endsection