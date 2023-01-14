@extends('website.master')

@section('content')
    <div class="home-slider slide-animate owl-carousel owl-theme show-nav-hover nav-big mb-2 text-uppercase"
        data-owl-options="{
        'loop': true,
        'autoplay':true,
        'autoplayTimeout':2000
    }">
        @foreach ($banners as $banner)
            <div class="  home-slide1 banner">

                <img class="slide-bg" src="{{ $banner->image_url }}" width="1903" height="499" alt="slider image">
                <div class="container d-flex align-items-center">
                    <div class="banner-layer appear-animate" data-animation-name="fadeInUpShorter">
                        <h4 class="text-transform-none m-b-3">{{ $banner->name }}</h4>
                        <h2 class="text-transform-none mb-0">{{ $banner->name }}</h2>
                        <h3 class="m-b-3">70% Off</h3>
                        <h5 class="d-inline-block mb-0">
                            <span>Starting At</span>
                            <b class="coupon-sale-text text-white bg-secondary align-middle"><sup>$</sup><em
                                    class="align-text-top">199</em><sup>99</sup></b>
                        </h5>
                        <a href="category.html" class="btn btn-dark btn-lg">Shop Now!</a>
                    </div>
                    <!-- End .banner-layer -->
                </div>

            </div>
        @endforeach

        <!-- End .home-slide -->


        <!-- End .home-slide -->
    </div>
    <!-- End .home-slider -->

  
    <!-- End .container -->

    <section class="featured-products-section">
        <div class="container">
            <h2 class="section-title categories-section-title heading-border border-0 ls-0 appear-animate text-center"
                data-animation-delay="100" data-animation-name="fadeInUpShorter">
                <span style="border-bottom: 2px solid;">Shop by Categories</span>
            </h2>

            <div class="row">
                @foreach ($categories as $catitem)
                    <div class=" col-md-3 " >
                        <div class="product-category p-3 border">
                            <a href="{{ url('category=' . $catitem->name) }}">
                                <figure>
                                    <img src="{{ asset($catitem->image_url) }}" alt="category" width="260" height="200" />
                                </figure>
                                <div class="category-content py-2 px-0">
                                    <a href="{{ url('category=' . $catitem->name) }}">
                                        <h5 class="mb-0">{{ $catitem->name }}</h5>
                                    </a> 
                                </div>
                            </a>
                        </div>
                       
                    </div>
                @endforeach

            </div>
            <h2 class="section-title heading-border ls-20 border-0  text-center">
                
                <span  style="border-bottom: 2px solid;">Featured Products</span>
                </h2>

            <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center"
                data-owl-options="{
                'dots': false,
                'nav': true
            }">


                @foreach ($featuredProducts as $featuredlist)
                    <div class="product-default  ">
                        <figure>
                            <a href="{{ url('product/' . $featuredlist->id) }}">
                                <img src="{{ $featuredlist->feature_image }}" width="280" height="280" alt="product">
                                <img src="{{ $featuredlist->feature_image }}" width="280" height="280" alt="product">
                            </a>
                            <div class="label-group">
                                {{-- <div class="product-label label-hot">HOT</div> --}}
                                @if ($featuredlist->discount > 0)
                                    <div class="product-label label-sale">{{ substr($featuredlist->discount, 0, 2) }}%
                                    </div>
                                @endif
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">

                                <a href=""
                                    class="product-category">{{ $featuredlist->category ? $featuredlist->category->name : '' }}</a>
                            </div>
                            <h3 class="product-title">
                                <a href="{{ url('product/' . $featuredlist->id) }}">{{ $featuredlist->name }}</a>
                            </h3>
                            @if($featuredlist->rating>0)
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{ (($featuredlist->rating)/5)*100}}%"></span>
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
                                @if ($featuredlist->discount > 0)
                                    <del
                                        class="old-price">{{ $featuredlist->currency }}{{ $featuredlist->actual_price }}</del>
                                    <span
                                        class="product-price">{{ $featuredlist->currency }}{{ $featuredlist->saleprice }}</span>
                                @else
                                    <span
                                        class="product-price">{{ $featuredlist->currency }}{{ $featuredlist->saleprice }}</span>
                                @endif
                            </div>

                        </div>

                        <!-- End .product-details -->
                    </div>
                @endforeach

            </div>

            <!-- End .featured-proucts -->
        </div>
    </section>

    <section class="new-products-section">
        <div class="container">

            <h2 class="section-title heading-border ls-20 border-0 text-center" >
                <span  style="border-bottom: 2px solid;">New Arrivals</span>
            </h2>

            <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center mb-2"
                data-owl-options="{
                'dots': false,
                'nav': true,
                'responsive': {
                    '992': {
                        'items': 4
                    },
                    '1200': {
                        'items': 5
                    }
                }
            }">
                @foreach ($arrivialProducts as $arriviallist)
                    <div class="product-default  ">
                        <figure>
                            <a href="{{ url('product/' . $arriviallist->id) }}">
                                <img src="{{ $arriviallist->feature_image }}" width="220" height="220" alt="product">
                                <img src="{{ $arriviallist->feature_image }}" width="220" height="220" alt="product">
                            </a>
                            <div class="label-group">
                                {{-- <div class="product-label label-hot">HOT</div> --}}
                                @if ($arriviallist->discount > 0)
                                    <div class="product-label label-sale">{{ substr($arriviallist->discount, 0, 2) }}%
                                    </div>
                                @endif
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href=""
                                    class="product-category">{{ $arriviallist->category ? $arriviallist->category->name : '' }}</a>
                            </div>
                            <h3 class="product-title">
                                <a href="{{ url('product/' . $arriviallist->id) }}">{{ $arriviallist->name }}</a>
                            </h3>
                            @if($arriviallist->rating>0)
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{ (($arriviallist->rating)/5)*100}}%"></span>
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
                                @if ($arriviallist->discount > 0)
                                    <del
                                        class="old-price">{{ $arriviallist->currency }}{{ $arriviallist->actual_price }}</del>
                                    <span
                                        class="product-price">{{ $arriviallist->currency }}{{ $arriviallist->saleprice }}</span>
                                @else
                                    <span
                                        class="product-price">{{ $arriviallist->currency }}{{ $arriviallist->saleprice }}</span>
                                @endif

                            </div>

                        </div>
                        <!-- End .product-details -->
                    </div>
                @endforeach


            </div>
            <!-- End .featured-proucts -->



        </div>
    </section>
 
 
 
@endsection
