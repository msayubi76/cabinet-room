@extends('layouts.website_theme')
@section('web_title','Home')

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

        .reserved p {
            color: white;
            font-size: 18px;
            font-weight: 500;
            position: absolute;
            bottom: 0px;
            width: 100%;
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
        .primary-img, .secondary-img {
            height: 120px;
        }
        .flags_div{
            background-repeat: no-repeat;
            white-space: nowrap;
            float: left;
            margin-right: 10px;
            width: 40px;
            background-size: cover;
            height: 24px;
        }
        .flags_right  .list-group-item:first-child,
        .flags_right  .list-group-item:last-child{
            border-radius: 0px;
        }
        .pro_det {
            color: #000000;
            font-weight: 500;
        }
        .reserve_btn {
                border-radius: 4px;
                border: 1px solid #c82e34;
                color: #333333;
                display: block;
                width: 25px;
                height: 25px;
                line-height: 25px;
                text-align: center;
                -webkit-transform: scale(1);
                -ms-transform: scale(1);
                transform: scale(1);
                background: transparent;
                cursor: pointer;
                
             }
             .reserve_btn:hover{
                 background: #c82e34;
             }
             form
             {
                position: relative; 
             }
             form i{ 
                position: relative; 
             }
             .carlist-item-image-holder img {
                height: 137px;
            }
            .product-slide_item .inner-slide .single-product .product-img .add-actions > ul li{
                margin-bottom: -6px !important;
            }
            .carsect{
                padding: 0px;
            }
            .carsect p{
                color: #000!important;
                font-size: 12px;
            }
            .carsect .price{
                color: #dc3545;
            }
            .carsect img{
                height: 130px;
                width: 100%;
            }
            .carsect img:hover{
                -webkit-transform: scale(1.5);
                transform: scale(1.5);
                transition: 2s;
            }
            .zoomer {
                overflow: hidden;
                margin-bottom: 5px;
                position: relative;
            }
            .paginate nav ul{
                width: fit-content;
                margin: 10px auto;
            }


            
            @media only screen and (min-width: 1500px) { 
                .old-products .slick-slide{
                    width: 220px !important;
                }
                .carsect img{
                    height: 100px;
                    width: 100%;
                }
            }

            @media only screen and (max-width: 425px) {
                 .latest-products .container-fluid  {
                    padding: 0px !important;
                }
                .latest-products h3{
                    padding-left: 0px !important;
                    padding-right: 0px !important;
                }
                .old-products .carsect img {
                    height: 100px; 
                }
                .old-products .carbox p{
                    line-height: 10px;
                }
                .old-products .carbox h6 {
                    font-size: 12px;
                }
                .old-products .carsect .price{
                    font-size: 10px;
                    line-height: 0px;
                }
            }
 </style>
   
<div class="container pb-5 latest-products">
    @include('website.banner')
    <div class="row">
        <div class="col-md-6 col-lg-3 d-none d-lg-block d-xl-block ">
            <h3 class="text-center   pt-4 pb-2 p text-uppercase">Our New Parts</h3>
            <hr>
           @include('website/left-sidebar')

        </div>
        <div class="col-md-12 col-lg-6 col-sm-12 p-0">
            <div class="uren-product_area pt-0">
                <div class="container-fluid   "> 
                        <h3 class="text-center p-4 mb-0 text-uppercase   ">
                            {{$heading}}
                        </h3> 
                        <hr class="mt-0"> 
                    <div class="row pl-3 pr-3  product-row text-uppercase"> 
                        @forelse ($items as $item)
                            <?php  
                                $file_name =    $item->feature_image; 
                            ?>
                            <div  class=" col-xl-3 col-lg-4 col-md-3 col-sm-4 col-6   col-xs-12 carsect"  > 
                                <div  class="carbox">                        
                                    <a   
                                            @if ( $item->status == 1 || $item->status == 2 )
                                            href="javascript:;" 
                                            @else
                                            target="_blank" 
                                            href=" {{url('produc/'.encrypt($item->id))}}"
                                            @endif
                                        >
                                    <div   class="col-md-12 p-1">   
                                    <div   class="zoomer">
                                                @if ($item->status == 1)
                                                    <div class="reserved-lbl ">
                                                        <span  >Under Negotiation</span>
                                                    </div> 
                                                @endif     
                                                @if ($item->status == 2)
                                                    <div class="sold-lbl">
                                                        <span  >Recently Sold</span>
                                                    </div> 
                                                @endif  
                                            
                                        <img   class="mainimage img-responsive"   src="{{url('site_images/feature_image/'.$file_name)}}">
                                    </div>                           
                                    <div    class="col-xs-12">
                                        <h6 class="text-capitalize m-0">
                                            {{$item->getCategory?$item->getCategory->name.' ':''}}  
                                            {{$item->getSubCategory?$item->getSubCategory->name:''}}
                                        </h6> 
                                        <p class="m-0">{{$item->model}}</p> 
                                            <span   class="price">{{$item->price .' '.$item->currency_type}}</span> 
                                    </div>
                                    </div>
                                </a>
                                </div>                     
                            </div>
                            @empty
                            <div class="col-md-12 col-lg-12 text-uppercase" >
                                <h5 class="text-center" >
                                    Products not found.
                                </h5>
                            </div>
                        @endforelse
                    </div>
                    
                    <div class="row "> 
                        @if (count($items) >= 3 ) 
                            <div class="col-md-12 mb-2 mt-2">
                                <hr>
                                <div class="uren-btn-ps_left text-uppercase" style=" float: right;">
                                <a  href="{{url('products')}}" tabindex="0">View All</a>
                                </div> 
                            </div>
                        @endif
                    </div>
                </div>
            </div> 
        </div>
        <div class="col-md-6  col-sm-6 d-lg-none">
            <h3 class="text-center   pt-4 pb-2 p text-uppercase">Our New Parts</h3>
            <hr>
           @include('website/left-sidebar')

        </div>
        <div class="col-md-6 col-lg-3 col-sm-6 flags_right">
            <h3 class="text-center   pt-4 pb-2 p text-uppercase"> Countries List</h3>
           @include('website/right-side-bar')

        </div>
        
    </div>   
    <div class="row">
        <div class="col-md-12">
            @include('website/products/damage-products')

        </div>
    </div>  
</div>
@include('footer.website_footer') 

@include('website/ask-dialog') 
@endsection