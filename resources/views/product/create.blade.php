@extends('layouts.theme')
@section('title','Create Product')

@section('content')
<style>
    .parsley-errors-list{
        width: 100%;
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
                <h3 class="box-title">Create Product</h3>
              </div>
                <div class="box-body">

              <form action="{{url('product')}}"  class="custom-validation" enctype="multipart/form-data" method="post" role="form">
                @csrf
                <div class="form-row mb-3">
                     
                    <div class="col-md-4 ">
                        <p for="category_id">Select Category</p>
                        <div class="form-group ">
                          
                            <select required class="form-control {{ $errors->has('category_id') ? ' has-error' : '' }}" name="category_id" id="category_id">
                                <option value="">Select Category</option>
                                @foreach ($categories as $item)
                                    <option value="{{$item->id}}" {{old('category_id') == $item->id?'selected':''}} >{{$item->name}}</option>
                                @endforeach
                            </select> 
                            @if ($errors->has('category_id')) <div class="errMsg"> <span>{{ $errors->first('category_id') }}</span> </div> @endif
                        </div> 
                    </div>
                    <div class="col-md-4 ">
                        <p for="sub_category_id">Select Sub Category</p>
                        <div class="form-group ">
                          
                            <select required class="form-control {{ $errors->has('sub_category_id') ? ' has-error' : '' }}" name="sub_category_id" id="sub_category_id">
                                <option value="">Select Sub Category</option>
                                
                            </select> 
                            @if ($errors->has('sub_category_id')) <div class="errMsg"> <span>{{ $errors->first('sub_category_id') }}</span> </div> @endif
                        </div> 
                    </div>
                    <div class="col-md-4 ">
                        <p for="country">Select Country</p>
                        <div class="form-group ">
                          
                            <select class="form-control {{ $errors->has('country') ? ' has-error' : '' }}" name="country" required id="country">
                                <option value="">Select Country</option>
                                @foreach ($countries as $key => $country)
                                    <option value="{{$key}}" {{old('country') == $key?'selected':''}} >{{$country}}</option>
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
                          <input    type="text" class="form-control {{ $errors->has('make') ? ' parsley-error' : '' }}" id="make"
                                 name="make" placeholder="Make"  value="{{old('make')}}"  >

                      </div>
                      @if ($errors->has('make')) <div class="errMsg"> <span>{{ $errors->first('make') }}</span> </div> @endif

                  </div>
                  <div class="col-md-4 ">
                    <p for="currency_type">Currency Type</p>
                    <div class="input-group  {{ $errors->has('currency_type') ? ' has-error' : '' }}">
                        <select    class="form-control  {{ $errors->has('currency_type') ? ' parsley-error' : '' }}" name="currency_type" id="hybrid_petrol_diesel"  >
                            <option value="">Select</option>
                            <option {{old('currency_type')=='$'?'selected="selected"':''}}  value="$">Dollar</option> 
                            <option  {{old('currency_type')=='¥'?'selected="selected"':''}} value="¥">Yen </option>
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
                      <input  required  type="text" class="form-control {{ $errors->has('price') ? ' parsley-error' : '' }}" id="price"
                             name="price" placeholder="Sale Price"  value="{{old('price')}}"  >

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
                      <input required   type="text" class="form-control {{ $errors->has('purchase_price') ? ' parsley-error' : '' }}" id="purchase_price"
                             name="purchase_price" placeholder="Purchase Price"  value="{{old('purchase_price')}}"  >
                  </div>
                  @if ($errors->has('purchase_price')) <div class="errMsg"> <span>{{ $errors->first('purchase_price') }}</span> </div> @endif

              </div>
                  
                    <div class="col-md-4  ">
                        <p for="model">Model</p>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i
                                            class="typcn typcn-user-outline"></i></span>
                            </div>
                            <input type="text" class="form-control" id="modal"
                                   name="model" placeholder="model" value="{{old('model')}}"  >
                        </div>
                    </div>
                    <div class="col-md-4 ">
                      <p for="first_name">Package</p>
                      <div class="input-group  {{ $errors->has('package') ? ' has-error' : '' }}">
                          <div class="input-group-prepend">
                              <span class="input-group-text">
                                  <i class="typcn typcn-user-outline"></i>
                              </span>
                          </div>
                          <input type="text" class="form-control {{ $errors->has('package') ? ' parsley-error' : '' }}" id="package"
                                 name="package" placeholder="Package"  value="{{old('package')}}"  >

                      </div>
                      @if ($errors->has('package')) <div class="errMsg"> <span>{{ $errors->first('package') }}</span> </div> @endif

                  </div>
               
                

                    <div class="col-md-4 ">
                        <p for="year">Year</p>
                        <div class="input-group   {{ $errors->has('year') ? ' has-error' : '' }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="typcn typcn-user-outline"></i></span>
                            </div>
                            <input   type="text" class="form-control {{ $errors->has('year') ? ' parsley-error' : '' }}" id="year" name="year" placeholder="Year" value="{{old('year')}}">
                        </div>
                        @if ($errors->has('year')) <div class="errMsg"> <span>{{ $errors->first('year') }}</span> </div> @endif
                    </div>
                    <div class="col-md-4 mt-2 {{ $errors->has('hybrid_petrol_diesel') ? ' has-error' : '' }}">
                        <p for="hybrid_petrol_diesel">Type</p>
                        <select    class="form-control selectm {{ $errors->has('hybrid_petrol_diesel') ? ' parsley-error' : '' }}" name="hybrid_petrol_diesel" id="hybrid_petrol_diesel"  >
                            <option value="">Select</option>
                            <option  {{old('hybrid_petrol_diesel')=='hybrid'?'selected="selected"':''}} value="hybrid">Hybrid</option>
                            <option {{old('hybrid_petrol_diesel')=='petrol'?'selected="selected"':''}}  value="petrol">Petrol</option>
                            <option {{old('hybrid_petrol_diesel')=='diesel'?'selected="selected"':''}}  value="diesel">Diesel</option>
                        </select>
                        @if ($errors->has('hybrid_petrol_diesel')) <div class="errMsg"> <span>{{ $errors->first('hybrid_petrol_diesel') }}</span> </div> @endif

                    </div>
                    <div class="col-md-4 mt-2">
                        <p for="_wd_4wd">2wd/4wd</p>
                        <div class="input-group {{ $errors->has('_wd_4wd') ? ' has-error' : '' }} ">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="typcn typcn-user-outline"></i></span>
                        </div>
                        <select    class="form-control selectm {{ $errors->has('_wd_4wd') ? ' parsley-error' : '' }}" 
                          name="_wd_4wd" id="_wd_4wd" >
                          <option value="">Select</option>
                          <option  {{old('_wd_4wd')=='2wd'?'selected="selected"':''}} value="2wd">2wd</option>
                          <option {{old('_wd_4wd')=='4wd'?'selected="selected"':''}}  value="4wd">4wd</option> 
                      </select>
                        
                             
                        </div>
                        @if ($errors->has('2wd_4wd')) <div class="errMsg"> <span>{{ $errors->first('2wd_4wd') }}</span> </div> @endif

                    </div>
                 
                     
                    <div class="col-md-4 mt-2">
                      <p for="seats">Seats</p>
                      <div class="input-group  {{ $errors->has('seats') ? ' has-error' : '' }}">
                          <div class="input-group-prepend">
                              <span class="input-group-text">
                                  <i  class="typcn typcn-user-outline"></i>
                              </span>

                          </div>

                          <input  min="0"   type="number" class="form-control {{ $errors->has('seats') ? ' parsley-error' : '' }}" id="seats" name="seats" 
                          value="{{old('seats')}}"  placeholder="Seats" >
                      </div>
                      @if ($errors->has('seats')) <div class="errMsg"> <span>{{ $errors->first('seats') }}</span> </div> @endif
                  </div>
                 
                    <div class="col-md-4 mt-2">
                        <p for="validationTooltip02">CC</p>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i  class="typcn typcn-user-outline"></i>
                                </span>
                                
                            </div>

                            <input  class="form-control" id="cc" name="cc" value="{{old('cc')}}"
                                   placeholder="CC" >
                        </div>
                    </div>
                    
                        <div class="col-md-4 mt-2">
                          <p for="abs">Air Bag</p>
                          <div class="input-group  {{ $errors->has('ab') ? ' has-error' : '' }}">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                              </div>
                              <input   class="form-control {{ $errors->has('ab') ? ' parsley-error' : '' }}"
                              id="ab" value="{{old('ab')}}" name="ab"
                                    placeholder="Air Bag"  >
                          </div>
                          @if ($errors->has('ab')) <div class="errMsg"> <span>{{ $errors->first('ab') }}</span> </div> @endif
                      </div>
                      
                      
                
                    <div class="col-md-4 mt-2">
                        <p for="color">Color</p>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i
                                            class="typcn typcn-mail"></i></span>
                            </div>
                            <input type="text" class="form-control" value="{{old('color')}}" name="color" id="color"
                             placeholder="Color"  >
                        </div>
                    </div>

                    <div class="col-md-4 mt-2">
                        <p for="mileage">Mileage</p>
                        <div class="input-group  {{ $errors->has('mileage') ? ' has-error' : '' }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="mdi mdi-calendar"></i></span>
                            </div>
                            <input   type="text"  class="form-control {{ $errors->has('mileage') ? ' parsley-error' : '' }}" 
                            name="mileage" value="{{old('mileage')}}" placeholder="Mileage" id="mileage"  autocomplete="off">
                        </div>
                        @if ($errors->has('mileage')) <div class="errMsg"> <span>{{ $errors->first('mileage') }}</span> </div> @endif
                    </div>
                    <div class="col-md-4 mt-2 {{ $errors->has('transmission') ? ' has-error' : '' }}">
                        <p for="transmission">Transmission</p>
                        <input   type="text"  class="form-control {{ $errors->has('transmission') ? ' parsley-error' : '' }}" 
                        name="transmission" value="{{old('transmission')}}" placeholder="Transmission" id="transmission"  autocomplete="off">
                        
                        @if ($errors->has('transmission')) <div class="errMsg"> <span>{{ $errors->first('transmission') }}</span> </div> @endif

                    </div>
                

                    <div class="col-md-4  mt-2 {{ $errors->has('power_window') ? ' has-error' : '' }}">
                        <p for="power_window">Power Window</p> 
                          <input   type="text"  class="form-control {{ $errors->has('power_window') ? ' parsley-error' : '' }}" 
                          name="power_window" value="{{old('power_window')}}" placeholder="Power Window"
                           id="power_window"  autocomplete="off">
                          
                        @if ($errors->has('power_window')) <div class="errMsg"> <span>{{ $errors->first('power_window') }}</span> </div> @endif

                    </div>

                    <div class="col-md-4 mt-2 power_stearing  {{ $errors->has('power_stearing') ? ' has-error' : '' }}">
                        <p for="power_stearing">Power Stearing</p>

                        <input   type="text"  class="form-control {{ $errors->has('power_stearing') ? ' parsley-error' : '' }}" 
                        name="power_stearing" value="{{old('power_stearing')}}" placeholder="Power Stearing"
                         id="power_stearing"  autocomplete="off">
 
                        @if ($errors->has('power_stearing')) <div class="errMsg"> <span>{{ $errors->first('power_stearing') }}</span> </div> @endif
                    </div>

                    <div class="col-md-4 mt-2 ">
                        <p for="customer_status">Ac/AAc</p>
 
                              

                               <select    class="form-control selectm {{ $errors->has('ac_aac') ? ' parsley-error' : '' }}" 
                                name="ac_aac" id="ac_aac" >
                                <option value="">Select</option>
                                <option  {{old('ac_aac')=='ac'?'selected="selected"':''}} value="ac">AC</option>
                                <option {{old('ac_aac')=='aac'?'selected="selected"':''}}  value="aac">AAC</option> 
                            </select>
                             
                    </div>
                 

                    <div class="col-md-4 mt-2 ">
                        <p for="occupation">Navigation/Tc/Dvd</p>
                        <div class="input-group  ">
                          <select    class="form-control selectm {{ $errors->has('navigation_tc_dvd') ? ' parsley-error' : '' }}" 
                            name="navigation_tc_dvd" id="navigation_tc_dvd" >
                            <option value="">Select</option>
                            <option  {{old('navigation_tc_dvd')=='navigation'?'selected="selected"':''}} value="navigation">Navigation</option>
                            <option {{old('navigation_tc_dvd')=='tc'?'selected="selected"':''}}  value="tc">TC</option> 
                            <option {{old('navigation_tc_dvd')=='dvd'?'selected="selected"':''}}  value="dvd">DVD</option> 
                        </select>
                        </div>
                        @if ($errors->has('navigation_tc_dvd')) <div class="errMsg"> <span>{{ $errors->first('navigation_tc_dvd') }}</span> </div> @endif

                    </div>
                    <div class="col-md-4 mt-2 ">
                        <p for="steering_audio_controls">Steering Audio Controls</p>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i
                                            class="typcn typcn-user-outline"></i></span>
                            </div>
                            <input type="text" class="form-control" id="steering_audio_controls" name="steering_audio_controls" 
                            value="{{old('steering_audio_controls')}}"
                                   placeholder="Steering Audio Controls"  >
                        </div>
                    </div>
                    <div class="col-md-4 mt-2 ">
                        <p for="cruise_controls">Cruise Controls</p>
                        <div class="input-group  {{ $errors->has('cruise_controls') ? ' has-error' : '' }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                            </div>
                            <input   class="form-control {{ $errors->has('cruise_controls') ? ' parsley-error' : '' }}"
                             id="cruise_controls" value="{{old('cruise_controls')}}" name="cruise_controls"
                                   placeholder="Cruise Controls"  >
                        </div>
                        @if ($errors->has('cruise_controls')) <div class="errMsg"> <span>{{ $errors->first('cruise_controls') }}</span> </div> @endif

                    </div>
               

                    <div class="col-md-4 mt-2 ">
                        <p for="paddle_shifters">Paddle Shifters</p>
                        <div class="input-group }">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class=" mdi mdi-currency-gbp"></i></span>
                            </div>
                            <input   class="form-control  " id="paddle_shifters"
                                   placeholder="Paddle Shifters" value="{{old('paddle_shifters')}}" name="paddle_shifters"  >
                        </div>
                    </div>
                    <div class="col-md-4 mt-2 ">
                        <p for="key_start_push_start">Key Start/ Push Start</p>
                        <select    class="form-control selectm {{ $errors->has('key_start_push_start') ? ' parsley-error' : '' }}" 
                          name="key_start_push_start" id="key_start_push_start" >
                          <option value="">Select</option>
                          <option  {{old('key_start_push_start')=='navigation'?'selected="selected"':''}} value="key_start">Key Start</option>
                          <option {{old('key_start_push_start')=='tc'?'selected="selected"':''}}  value="push_start">Push Start</option> 
                      </select> 
                        @if ($errors->has('key_start_push_start')) <div class="errMsg"> <span>{{ $errors->first('key_start_push_start') }}</span> </div> @endif
                    </div>

                    <div class="col-md-4 mt-2">
                      <p for="alloys">Alloys</p>
                      <div class="input-group  {{ $errors->has('alloys') ? ' has-error' : '' }}">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                          </div>
                          <input   class="form-control {{ $errors->has('alloys') ? ' parsley-error' : '' }}"
                           id="alloys" value="{{old('alloys')}}" name="alloys"
                                 placeholder="Alloys"  >
                      </div>
                      @if ($errors->has('alloys')) <div class="errMsg"> <span>{{ $errors->first('alloys') }}</span> </div> @endif
                  </div>
               
                    <div class="col-md-4 mt-2 ">
                      <p for="fog">Fog</p>
                      <div class="input-group  {{ $errors->has('fog') ? ' has-error' : '' }}">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                          </div>
                          <input   class="form-control {{ $errors->has('fog') ? ' parsley-error' : '' }}"
                          id="fog" value="{{old('fog')}}" name="fog"  placeholder="Fog"  >
                      </div>
                      @if ($errors->has('alloys')) <div class="errMsg"> <span>{{ $errors->first('alloys') }}</span> </div> @endif
                  </div>
                    <div class="col-md-4 mt-2 ">
                      <p for="alloys">Rear Spoiler</p>
                      <div class="input-group  {{ $errors->has('rear_spoiler') ? ' has-error' : '' }}">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                          </div>
                          <input   class="form-control {{ $errors->has('rear_spoiler') ? ' parsley-error' : '' }}"
                          id="rear_spoiler" value="{{old('rear_spoiler')}}" name="rear_spoiler"
                                placeholder="Rear Spoiler"  >
                      </div>
                      @if ($errors->has('rear_spoiler')) <div class="errMsg"> <span>{{ $errors->first('rear_spoiler') }}</span> </div> @endif
                  </div>
                  <div class="col-md-4 mt-2">
                      <p for="door_visors">Door Visors</p>
                      <div class="input-group  {{ $errors->has('door_visors') ? ' has-error' : '' }}">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                          </div>
                          <input   class="form-control {{ $errors->has('door_visors') ? ' parsley-error' : '' }}"
                          id="door_visors" value="{{old('door_visors')}}" name="door_visors"
                                placeholder="Door Visors"  >
                      </div>
                      @if ($errors->has('door_visors')) <div class="errMsg"> <span>{{ $errors->first('door_visors') }}</span> </div> @endif
                  </div>
                 
                    <div class="col-md-4 mt-2 ">
                      <p for="aero_kit">Aero Kit</p>
                      <div class="input-group  {{ $errors->has('aero_kit') ? ' has-error' : '' }}">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                          </div>
                          <input   class="form-control {{ $errors->has('aero_kit') ? ' parsley-error' : '' }}"
                          id="aero_kit" value="{{old('aero_kit')}}" name="aero_kit"
                                placeholder="Aero Kit"  >
                      </div>
                      @if ($errors->has('aero_kit')) <div class="errMsg"> <span>{{ $errors->first('aero_kit') }}</span> </div> @endif
                  </div>
                    <div class="col-md-4 mt-2 ">
                      <p for="leather_seats">Leather Aeats</p>
                      <div class="input-group  {{ $errors->has('leather_seats') ? ' has-error' : '' }}">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                          </div>
                          <input   class="form-control {{ $errors->has('leather_seats') ? ' parsley-error' : '' }}"
                          id="leather_seats" value="{{old('leather_seats')}}" name="leather_seats"
                                placeholder="Leather Aeats"  >
                      </div>
                      @if ($errors->has('leather_seats')) <div class="errMsg"> <span>{{ $errors->first('leather_seats') }}</span> </div> @endif
                  </div>
                  <div class="col-md-4 mt-2 ">
                      <p for="back_camera">Back Camera</p>
                      <div class="input-group  {{ $errors->has('back_camera') ? ' has-error' : '' }}">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                          </div>
                          <input   class="form-control {{ $errors->has('back_camera') ? ' parsley-error' : '' }}"
                          id="back_camera" value="{{old('back_camera')}}" name="back_camera"
                                placeholder="Back Camera"  >
                      </div>
                      @if ($errors->has('back_camera')) <div class="errMsg"> <span>{{ $errors->first('back_camera') }}</span> </div> @endif
                  </div>
                
                    <div class="col-md-4  mt-2">
                      <p for="bumper_sensors">Bumper Sensors</p>
                      <div class="input-group  {{ $errors->has('bumper_sensors') ? ' has-error' : '' }}">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                          </div>
                          <input   class="form-control {{ $errors->has('bumper_sensors') ? ' parsley-error' : '' }}"
                          id="bumper_sensors" value="{{old('bumper_sensors')}}" name="bumper_sensors"
                                placeholder="Bumper Sensors"  >
                      </div>
                      @if ($errors->has('bumper_sensors')) <div class="errMsg"> <span>{{ $errors->first('bumper_sensors') }}</span> </div> @endif
                  </div>
                    <div class="col-md-4 mt-2 ">
                      <p for="sunroof_penoramic">Sunroof</p>
                      <div class="input-group  {{ $errors->has('sunroof_penoramic') ? ' has-error' : '' }}">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                          </div>
                          <input   class="form-control {{ $errors->has('sunroof_penoramic') ? ' parsley-error' : '' }}"
                          id="sunroof_penoramic" value="{{old('sunroof_penoramic')}}" name="sunroof_penoramic"
                                placeholder="Sunroof"  >
                      </div>
                      @if ($errors->has('sunroof_penoramic')) <div class="errMsg"> <span>{{ $errors->first('alloys') }}</span> </div> @endif
                  </div>
                  <div class="col-md-4  mt-2">
                      <p for="retractable_side_mirrors">Retractable Side Mirrors</p>
                      <div class="input-group  {{ $errors->has('retractable_side_mirrors') ? ' has-error' : '' }}">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                          </div>
                          <input   class="form-control {{ $errors->has('retractable_side_mirrors') ? ' parsley-error' : '' }}"
                          id="retractable_side_mirrors" value="{{old('retractable_side_mirrors')}}" name="retractable_side_mirrors"
                                placeholder="Retractable Side Mirrors"  >
                      </div>
                      @if ($errors->has('retractable_side_mirrors')) <div class="errMsg"> <span>{{ $errors->first('retractable_side_mirrors') }}</span> </div> @endif
                  </div>
               
                    <div class="col-md-4 mt-2 ">
                      <p for="keyless_entry">Keyless Entry</p>
                      <div class="input-group  {{ $errors->has('keyless_entry') ? ' has-error' : '' }}">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                          </div>
                          <input   class="form-control {{ $errors->has('keyless_entry') ? ' parsley-error' : '' }}"
                          id="keyless_entry" value="{{old('keyless_entry')}}" name="keyless_entry"
                                placeholder="Keyless Entry"  >
                      </div>
                      @if ($errors->has('keyless_entry')) <div class="errMsg"> <span>{{ $errors->first('keyless_entry') }}</span> </div> @endif
                  </div>
                    <div class="col-md-4 mt-2 ">
                      <p for="back_tyre">Back Tyre</p>
                      <div class="input-group  {{ $errors->has('back_tyre') ? ' has-error' : '' }}">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                          </div>
                          <input   class="form-control {{ $errors->has('back_tyre') ? ' parsley-error' : '' }}"
                          id="back_tyre" value="{{old('back_tyre')}}" name="back_tyre"
                                placeholder="Back Tyre"  >
                      </div>
                      @if ($errors->has('back_tyre')) <div class="errMsg"> <span>{{ $errors->first('back_tyre') }}</span> </div> @endif
                  </div>
                  <div class="col-md-4  mt-2">
                      <p for="abs">ABS</p>
                      <div class="input-group  {{ $errors->has('abs') ? ' has-error' : '' }}">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="mdi mdi-currency-gbp"></i></span>
                          </div>
                          <input   class="form-control {{ $errors->has('abs') ? ' parsley-error' : '' }}"
                          id="abs" value="{{old('abs')}}" name="abs"
                                placeholder="abs"  >
                      </div>
                      @if ($errors->has('abs')) <div class="errMsg"> <span>{{ $errors->first('abs') }}</span> </div> @endif
                  </div>
                  <div class="col-md-12  mt-2">
                    <p for="description">Description</p>
                    <div class="input-group  {{ $errors->has('description') ? ' has-error' : '' }}"> 
                        <textarea name="description" id="description" class="form-control"  placeholder="Description"
                         rows="5">{{old('description')}}</textarea> 
                         
                    </div>
                    @if ($errors->has('description')) <div class="errMsg"> <span>{{ $errors->first('description') }}</span> </div> @endif
                </div>
                <div class="col-md-4  mt-2">
                  <p for="is_damage">Is Damage?</p>
                  <div class="input-group m-0  {{ $errors->has('is_damage') ? ' has-error' : '' }}"> 
                    <div class="radio ml-2">
                        <label><input type="radio" {{ old('is_damage') == 1?" checked ":"" }} value="1" name="is_damage" checked> Yes </label>
                      </div>
                      <div class="radio  ml-2">
                        <label><input type="radio" {{ old('is_damage') == 0?" checked ":"" }}  value="0" checked name="is_damage"> No </label>
                      </div>
                        
                  </div>
                  @if ($errors->has('is_damage')) <div class="errMsg"> <span>{{ $errors->first('description') }}</span> </div> @endif
              </div>
                  <div class="col-md-4  mt-2">
                    <p>Upload Image</p>
                    <div class="custom-file ">
                      <input required type="file" name="files[]" multiple class="custom-file-input" id="files">
                      <label class="custom-file-label" for="files">Upload Image</label>
                    </div>
                    @if ($errors->has('files')) <div class="errMsg"> <span>{{ $errors->first('files') }}</span> </div> @endif
                </div>

                
                <div class="col-md-4  mt-2">
                    <p>Feature Image</p>
                    <div class="custom-file ">
                      <input required type="file" name="feature_image"   class="custom-file-input" id="feature_image">
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
  </div>
</div>

@endsection 

 
  @section('script')
  <script src="{{url("libs/parsleyjs/parsley.min.js")}}"></script>
  <script src="{{url('js/pages/form-validation.init.js')}}"></script>
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
  </script>
  @endsection
 