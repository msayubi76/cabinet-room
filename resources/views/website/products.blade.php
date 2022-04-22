@extends('layouts.website_theme')
@section('web_title',$title)

@section('website_content')
 <style>
     .reserved {
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: #00000052;
            z-index: 999;
            cursor: no-drop;
            text-align: center;
            color: white;
        }
        .reserved-lbl{
            position: absolute;
            right: 0;
            bottom: 0;
            background: #dc3545;
            color: #fff;
            text-transform: uppercase;
            font-size: 10px;
            text-align: center;
            width: 100%;
        }
        .paginate nav ul{
            width: fit-content;
            margin: 10px auto;
        }

        .primary-img, .secondary-img, .carlist-item-image-holder img {
            height: 161px;
        }
        .pro_det {
            color: #000000;
            font-weight: 500;
        }
        .pro-detail h6 {
            font-weight: 500;
            margin: 0px;
        }

        .pro-detail span {
            font-weight: 400;
            text-transform: capitalize;
            color: #dc3545;
            font-size: 14px;
        }
        .price {
            background: #dc3545;
            width: fit-content;
            margin: 0 0 0 auto;
            padding: 4px 11px;
            color: white;
            font-size: 14px;
            border-radius: 2px;
        }
        .pro-detail {
            border-top: 1px solid #c7c7c7;
            border-bottom: 1px solid #c7c7c7;
            margin: 40px 2px 0px;
            padding: 6px 0px;
        }
        .carlist-item-subheader {
            margin-top: 10px;
        }
        .product_row
        {
            box-shadow: 0 16px 9px -6px #0000005c;
        }
        .zoomer {
            overflow: hidden; 
            position: relative;
        }
        .carlist-item-image-holder img:hover {
            -webkit-transform: scale(1.5);
            transform: scale(1.5);
            transition: 2s;
        }
        @media only screen and (max-width: 425px) {
                 .pro-detail  {
                    margin: 0px !important;
                }
                .pro-detail h6{
                    font-size: 12px;
                }
                .primary-img, .secondary-img, .carlist-item-image-holder img { 
                    display: block;
                    max-width: 100% !important;
                    height: auto;
                }
                .zoomer {
                    margin-bottom: 11px;
                }
                .product_row h6{
                    font-size: 14px;
                }
            }
 </style>
   <link href="{{url('libs/select2/css/select2.min.css')}}" rel="stylesheet">
<div class="container-fluid mb-5">

    <div class="jumbotron">
        @include('website.products.search-form')
    </div>


    <h3 class="text-center text-uppercase" >
        {{$type}}
    </h3>
    <div class="row pl-3 pr-3  ">

        @foreach ($items as $item)
            <?Php  
                    $file_name =    $item->feature_image;  
             ?>
               <div class="col-md-12 col-lg-12  mt-5    ">
                <div class="row product_row">
                    <div class="col-md-2 col-sm-3 col-12 p-0   ">
                        <div class="carlist-item-image-holder zoomer">
                            <a 
                                @if ($item->status == 1 || $item->status == 2)
                                href="javascript:;"
                                @else  
                                target="_blank" 
                                href="{{url('produc/'.encrypt($item->id))}}"
                                @endif >
                                <img  
                                alt="Product" class="lazy carlist-item-image" src="{{url('site_images/feature_image/'.$file_name)}}">
                                @if ($item->status == 1)
                                <span class="reserved-lbl">Under Negotiation</span> 
                                @endif
                                @if ($item->status == 2)
                                <span class="sold-lbl">Recently Sold</span> 
                                @endif
                            </a>
                        </div>
                    </div>

                    <div class="col-md-10  col-sm-9 col-12 ">
                        <div class="row"> 
                            <div class="col-md-6 col-sm-6 col-6">
                                <h6 class="text-capitalize text-uppercase">
                                        {{$item->getCategory?$item->getCategory->name.' ':''}}  
                                            {{$item->getSubCategory?$item->getSubCategory->name:''}}
                                </h6> 
                                <div class="carlist-item-subheader text-uppercase">
                                    <span class="pro_det">Chassis No </span> {{$item->chassis_no}}    
                               </div>
                               <div class="carlist-item-subheader text-uppercase">
                                   <a data-toggle="modal"  data-target=".contactModal" class="ask" href="javascript:;">Ask</a>     
                              </div>
                            </div>
                            <div class="col-md-6 col-sm-6   col-6 text-right">
                                <h6 class="price">{{$item->price.'  '.$item->currency_type}}</h6>
                            </div>
                        </div>
                        <a   
                            @if ($item->status == 1 || $item->status == 2)
                                href="javascript:;"
                            @else  
                            target="_blank" 
                                href="  {{'produc/'.encrypt($item->id)}}"
                            @endif > 
                             
                            <div class="row pro-detail">
                                <div class="col-md-2 col-sm-4  col-6">
                                    <h6>Year: <span>{{$item->year}}</span></h6>
                                </div>
                                <div class="col-md-2  col-sm-4 col-6">
                                    <h6>Color: <span>{{$item->color}}</span></h6>
                                </div>
                                <div class="col-md-2 col-sm-4 col-6">
                                    <h6>Engine: <span>{{$item->cc}}</span></h6>
                                </div>
                                <div class="col-md-2 col-sm-4 col-6">
                                    <h6>Trns: <span>{{$item->transmission}}</span></h6>
                                </div>
                                <div class="col-md-2 col-sm-4 col-6">
                                    <h6>Ch No: <span>{{$item->chassis_no}}</span></h6>
                                </div>
                                <div class="col-md-2 col-sm-4 col-6">
                                    <h6>Air Bag: <span>{{$item->abs}}</span></h6>
                                </div>
                                
                            </div>
                        </a>
                        
                    </div>
                </div>
            </div>

           
        @endforeach
 
    @if (count($items) == 0 )

    <div class="col-md-12">
        <h4 class="text-center text-uppercase">Products not available found</h4>
    </div>
        
    @endif

 
              
    </div>
    <div class="row">

      <div class="col-md-12 paginate">
      
            {{$items->links()}}
         
      </div>
    </div>
</div>
@include('footer.website_footer') 
@include('website/ask-dialog') 
@endsection

@section('website_script')
<script src="{{url('libs/select2/js/select2.min.js')}}"></script>
    <script>
        $('.select2').select2();
    </script>
@endsection