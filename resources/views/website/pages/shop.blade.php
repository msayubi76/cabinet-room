@extends('website.master')
@section('title', 'shop')
@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

::selection{
  color: #fff;
  background: #0088cc;
}
.wrapper{
  width: 400px;
  background: #fff;
  border-radius: 10px;
  padding: 20px 25px 40px;
  box-shadow: 0 12px 35px rgba(0,0,0,0.1);
}
header h2{
  font-size: 24px;
  font-weight: 600;
}
header p{
  margin-top: 5px;
  font-size: 16px;
}
.price-input{
  width: 100%;
  display: flex;
  margin: 30px 0 35px;
}
.price-input .field{
  display: flex;
  width: 100%;
  height: 45px;
  align-items: center;
}
.field input{
  width: inherit;
  height: 100%;
  outline: none;
  font-size: 19px;
  margin-left: 12px;
  border-radius: 5px;
  text-align: center;
  border: 1px solid #999;
  -moz-appearance: textfield;
}
input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
  -webkit-appearance: none;
}
.price-input .separator{
  width: 130px;
  display: flex;
  font-size: 19px;
  align-items: center;
  justify-content: center;
}
.slider{
  height: 5px;
  position: relative;
  background: #ddd;
  border-radius: 5px;
}
.slider .progress{
  height: 100%;
  left: 25%;
  right: 25%;
  position: absolute;
  border-radius: 5px;
  background: #dddddd;
}
.range-input{
  position: relative;
}
.range-input input{
  position: absolute;
  width: 100%;
  height: 5px;
  top: -5px;
  background: none;
  pointer-events: none;
  -webkit-appearance: none;
  -moz-appearance: none;
}
input[type="range"]::-webkit-slider-thumb{
  height: 17px;
  width: 17px;
  border-radius: 50%;
  background: #0088cc;
  pointer-events: auto;
  -webkit-appearance: none;
  box-shadow: 0 0 6px rgba(0,0,0,0.05);
}
input[type="range"]::-moz-range-thumb{
  height: 17px;
  width: 17px;
  border: none;
  border-radius: 50%;
  background: #0088cc;
  pointer-events: auto;
  -moz-appearance: none;
  box-shadow: 0 0 6px rgba(0,0,0,0.05);
}
</style>
    <div class="category-banner-container bg-gray">
        <div class="category-banner banner text-uppercase"
            style="background: no-repeat 60%/cover url('{{ $banner?$banner->image_url:asset('website/assets/images/banners/banner-top.jpg') }}');">
            <div class="container position-relative">
                <div class="row">
                    <div class="pl-lg-5 pb-5 pb-md-0 col-md-5 col-xl-4 col-lg-4 offset-1">
                        <h3>{{$banner?$banner->name:''}}</h3>
                        <a href="category.html" class="btn btn-dark">Get Yours!</a>
                    </div>
                    <div class="pl-lg-3 col-md-4 offset-md-0 offset-1 pt-3">
                        <div class="coupon-sale-content">
                            <h4 class="m-b-1 coupon-sale-text bg-white text-transform-none">Exclusive COUPON
                            </h4>
                            <h5 class="mb-2 coupon-sale-text d-block ls-10 p-0"><i class="ls-0">UP TO</i><b
                                    class="text-dark">$100</b> OFF</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">

        <nav class="toolbox sticky-header horizontal-filter mb-1" data-sticky-options="{'mobile': true}">
            <div class="toolbox-left">
                <a href="#" class="sidebar-toggle"><svg data-name="Layer 3" id="Layer_3" viewBox="0 0 32 32"
                        xmlns="http://www.w3.org/2000/svg">
                        <line x1="15" x2="26" y1="9" y2="9" class="cls-1"></line>
                        <line x1="6" x2="9" y1="9" y2="9" class="cls-1"></line>
                        <line x1="23" x2="26" y1="16" y2="16" class="cls-1"></line>
                        <line x1="6" x2="17" y1="16" y2="16" class="cls-1"></line>
                        <line x1="17" x2="26" y1="23" y2="23" class="cls-1"></line>
                        <line x1="6" x2="11" y1="23" y2="23" class="cls-1"></line>
                        <path d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z" class="cls-2">
                        </path>
                        <path d="M22.5,15.92a2.5,2.5,0,1,1-5,0,2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                        <path d="M21,16a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" class="cls-3"></path>
                        <path d="M16.5,22.92A2.6,2.6,0,0,1,14,25.5a2.6,2.6,0,0,1-2.5-2.58,2.5,2.5,0,0,1,5,0Z"
                            class="cls-2"></path>
                    </svg>
                    <span>Filter</span>
                </a>

                <div class="toolbox-item filter-toggle d-none d-lg-flex">
                    <span>Filters:</span>
                    <a href=#>&nbsp;</a>
                </div>
            </div>
            <!-- End .toolbox-left -->




        </nav>

        <div class="row main-content-wrap">
            <div class="col-lg-9 main-content">
                <div class="row">
                    @forelse($products as $productlist)
                        <div class="col-6 col-sm-4 col-md-3">
                            <div class="product-default">
                                <figure>
                                    <a href="{{ url('product/' . $productlist->id) }}">
                                        <img src="{{ asset($productlist->feature_image) }}" width="280" height="280"
                                            alt="product" />
                                        <img src="{{ asset($productlist->feature_image) }}" width="280" height="280"
                                            alt="product" />
                                    </a>

                                    <div class="label-group">
                                        {{-- <div class="product-label label-hot">HOT</div> --}}
                                        @if ($productlist->discount > 0)
                                            <div class="product-label label-sale">{{ substr($productlist->discount, 0, 2) }}%
                                            </div>
                                        @endif
                                    </div>
                                </figure>

                                <div class="product-details">
                                    <div class="category-wrap">
                                        <div class="category-list">
                                            <a href=""
                                                class="product-category">{{ $productlist->category ? $productlist->category->name : '' }}</a>
                                        </div>
                                    </div>

                                    <h3 class="product-title"> <a
                                            href="{{ url('product/' . $productlist->id) }}">{{ $productlist->name }}</a> </h3>

                                    @if($productlist->rating>0)
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:{{ (($productlist->rating)/5)*100}}%"></span>
                                                <!-- End .ratings -->
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                        </div> 
                                    @else
                                    <div class="ratings-container">
                                        <div class="" style="height:11px">
                                        </div>
                                    </div>                         
                                    @endif

                                    <div class="price-box" style="width: max-content;">
                                        @if ($productlist->discount > 0)
                                            <span
                                                class="old-price">{{ $productlist->currency }}{{ $productlist->actual_price }}</span>
                                            <span
                                                class="product-price">{{ $productlist->currency }}{{ $productlist->saleprice }}</span>
                                        @else
                                            <span
                                                class="product-price">{{ $productlist->currency }}{{ $productlist->saleprice }}</span>
                                        @endif
                                    </div>
                                    <!-- End .price-box -->


                                </div>
                                <!-- End .product-details -->
                            </div>
                        </div>
                        @empty
                            <p>Products not found</p>
                        @endforelse
                    <!-- End .col-sm-4 -->



                </div>
                <!-- End .row -->
                <div class="pagination justify-content-center">
                    <nav class="toolbox toolbox-pagination" style="float:right;">


                        <ul class="pagination toolbox-item">
                            {{ $products->links() }}

                        </ul>


                    </nav>
                </div>
            </div>
            <!-- End .col-lg-9 -->

            <div class="sidebar-overlay"></div>
            <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
                <div class="sidebar-wrapper">


                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true"
                                aria-controls="widget-body-3">Price</a>
                        </h3>

                        <div class="collapse show" id="widget-body-3">
                            <div class="widget-body pb-0">
                                <form method="GET" action="{{route('products')}}">
                                    @csrf
                                <div class="price-input">
                                    <div class="field">
                                    <span>Min</span>
                                    <input type="number" class="input-min" name="minPrice" value="{{$min}}">
                                    </div>
                                    <div class="separator">-</div>
                                    <div class="field">
                                    <span>Max</span>
                                    <input type="number" class="input-max" name="maxPrice" value="{{$max}}">
                                    </div>
                                </div>
                                <div class="slider">
                                    <div class="progress"></div>
                                </div>
                                <div class="range-input">
                                    <input type="range" class="range-min"  min="{{$min}}" max="{{$max}}" value="{{$min_price?$min_price:$min}}" step="100">
                                    <input type="range" class="range-max" min="{{$min}}" max="{{$max}}" value="{{$max_price?$max_price:$max}}" step="100">
                                </div>
                                    <!-- <div class="price-slider-wrapper"> -->
                                        <!-- <div id="price-slider"></div> -->
                                    <!-- </div> -->
                                    <div
                                        class="filter-price-action d-flex align-items-center justify-content-between flex-wrap">
                                        <!-- <div class="filter-price-text">
                                            Price:{{$min}} - {{$max}} 
                                           <span id="filter-price-range"></span>
                                        </div> -->
                                        <!-- End .filter-price-text -->

                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                    <!-- End .filter-price-action -->
                                </form>
                            </div>
                            <!-- End .widget-body -->
                        </div>
                        <!-- End .collapse -->
                    </div>
                    <!-- End .widget -->


                    <!-- End .widget -->

                    <div class="widget widget-featured">
                        <h3 class="widget-title">Featured</h3>

                        <div class="widget-body">
                            <div class="owl-carousel widget-featured-products">
                                @foreach ($featuredProducts as $list)
                                    <div class="featured-col">
                                        <div class="product-default left-details product-widget">
                                            <figure>
                                                <a href="{{ url('products/' . $list->id) }}">
                                                    <img src="{{ $list->feature_image }}" width="75" height="75"
                                                        alt="product" />
                                                    <img src="{{ $list->feature_image }}" width="75" height="75"
                                                        alt="product" />
                                                </a>
                                            </figure>
                                            <div class="product-details">
                                                <h3 class="product-title"> <a
                                                        href="{{ url('product/' . $list->id) }}">{{ $list->name }}</a>
                                                </h3>
                                                @if($list->rating>0)
                                                    <div class="ratings-container">
                                                        <div class="product-ratings">
                                                            <span class="ratings" style="width:{{ (($list->rating)/5)*100}}%"></span>
                                                            <!-- End .ratings -->
                                                            <span class="tooltiptext tooltip-top"></span>
                                                        </div>
                                                    </div> 
                                                @else
                                                <div class="ratings-container">
                                                    <div class="" style="height:11px">
                                                    </div>
                                                </div>                         
                                                @endif
                                                <div class="price-box">
                                                    @if ($list->discount > 0)
                                                        <span
                                                            class="old-price">{{ $list->currency }}{{ $list->actual_price }}</span>
                                                        <span
                                                            class="product-price">{{ $list->currency }}{{ $list->saleprice }}</span>
                                                    @else
                                                        <span
                                                            class="product-price">{{ $list->currency }}{{ $list->saleprice }}</span>
                                                    @endif
                                                </div>
                                                <!-- End .price-box -->
                                            </div>
                                            <!-- End .product-details -->
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                            <!-- End .widget-featured-slider -->
                        </div>
                        <!-- End .widget-body -->
                    </div>
                    <!-- End .widget -->

                    <div class="widget widget-block">
                    </div>
                    <!-- End .widget -->
                </div>
                <!-- End .sidebar-wrapper -->
            </aside>
            <!-- End .col-lg-3 -->
        </div>
        <!-- End .row -->
    </div>
    <!-- End .container -->

    <div class="mb-4"></div>
    <!-- margin -->

@endsection
@section('scripts')
<script>
    const rangeInput = document.querySelectorAll(".range-input input"),
priceInput = document.querySelectorAll(".price-input input"),
range = document.querySelector(".slider .progress");
let priceGap = 1000;
priceInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minPrice = parseInt(priceInput[0].value),
        maxPrice = parseInt(priceInput[1].value);
        
        if((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max){
            if(e.target.className === "input-min"){
                rangeInput[0].value = minPrice;
                range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
            }else{
                rangeInput[1].value = maxPrice;
                range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
            }
        }
    });
});
rangeInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minVal = parseInt(rangeInput[0].value),
        maxVal = parseInt(rangeInput[1].value);
        if((maxVal - minVal) < priceGap){
            if(e.target.className === "range-min"){
                rangeInput[0].value = maxVal - priceGap
            }else{
                rangeInput[1].value = minVal + priceGap;
            }
        }else{
            priceInput[0].value = minVal;
            priceInput[1].value = maxVal;
            range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
            range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
        }
    });
});
</script>
@endsection

