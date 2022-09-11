@extends('website.master')

@section('content')
    <div class="home-slider slide-animate owl-carousel owl-theme show-nav-hover nav-big mb-2 text-uppercase" data-owl-options="{
        'loop': false
    }">
        <div class="home-slide home-slide1 banner">
            <img class="slide-bg" src="{{asset('website/assets/images/demoes/demo4/slider/slide-1.jpg')}}" width="1903" height="499" alt="slider image">
            <div class="container d-flex align-items-center">
                <div class="banner-layer appear-animate" data-animation-name="fadeInUpShorter">
                    <h4 class="text-transform-none m-b-3">Find the Boundaries. Push Through!</h4>
                    <h2 class="text-transform-none mb-0">Summer Sale</h2>
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
        <!-- End .home-slide -->

        <div class="home-slide home-slide2 banner banner-md-vw">
            <img class="slide-bg" style="background-color: #ccc;" width="1903" height="499" src="{{asset('website/assets/images/demoes/demo4/slider/slide-2.jpg')}}" alt="slider image">
            <div class="container d-flex align-items-center">
                <div class="banner-layer d-flex justify-content-center appear-animate" data-animation-name="fadeInUpShorter">
                    <div class="mx-auto">
                        <h4 class="m-b-1">Extra</h4>
                        <h3 class="m-b-2">20% off</h3>
                        <h3 class="mb-2 heading-border">Accessories</h3>
                        <h2 class="text-transform-none m-b-4">Summer Sale</h2>
                        <a href="category.html" class="btn btn-block btn-dark">Shop All Sale</a>
                    </div>
                </div>
                <!-- End .banner-layer -->
            </div>
        </div>
        <!-- End .home-slide -->
    </div>
    <!-- End .home-slider -->

    <div class="container">
        <div class="info-boxes-slider owl-carousel owl-theme mb-2" data-owl-options="{
            'dots': false,
            'loop': false,
            'responsive': {
                '576': {
                    'items': 2
                },
                '992': {
                    'items': 3
                }
            }
        }">
            <div class="info-box info-box-icon-left">
                <i class="icon-shipping"></i>

                <div class="info-box-content">
                    <h4>FREE SHIPPING &amp; RETURN</h4>
                    <p class="text-body">Free shipping on all orders over $99.</p>
                </div>
                <!-- End .info-box-content -->
            </div>
            <!-- End .info-box -->

            <div class="info-box info-box-icon-left">
                <i class="icon-money"></i>

                <div class="info-box-content">
                    <h4>MONEY BACK GUARANTEE</h4>
                    <p class="text-body">100% money back guarantee</p>
                </div>
                <!-- End .info-box-content -->
            </div>
            <!-- End .info-box -->

            <div class="info-box info-box-icon-left">
                <i class="icon-support"></i>

                <div class="info-box-content">
                    <h4>ONLINE SUPPORT 24/7</h4>
                    <p class="text-body">Lorem ipsum dolor sit amet.</p>
                </div>
                <!-- End .info-box-content -->
            </div>
            <!-- End .info-box -->
        </div>
        <!-- End .info-boxes-slider -->

        <div class="banners-container mb-2">
            <div class="banners-slider owl-carousel owl-theme" data-owl-options="{
                'dots': false
            }">
            @foreach ($banners as $banner)


                <div class="banner banner1 banner-sm-vw d-flex align-items-center appear-animate" style="background-color: #ccc;" data-animation-name="fadeInLeftShorter" data-animation-delay="500">
                    <figure class="w-100">
                        <img src="{{ $banner->image_url }}" alt="banner" width="380" height="175" />
                    </figure>
                    <div class="banner-layer">
                        <h3 class="m-b-2">{{ $banner->name }}</h3>
                        <h4 class="m-b-3 text-primary"><sup class="text-dark"><del>20%</del></sup>30%<sup>OFF</sup></h4>
                        <a href="category.html" class="btn btn-sm btn-dark">Shop Now</a>
                    </div>
                </div>
                @endforeach


                <!-- End .banner -->
            </div>
        </div>
    </div>
    <!-- End .container -->

    <section class="featured-products-section">
        <div class="container">
            <h2 class="section-title heading-border ls-20 border-0">Featured Products</h2>

            <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center" data-owl-options="{
                'dots': false,
                'nav': true
            }">


            @foreach ($featuredProducts as $featuredlist)
                <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                    <figure>
                        <a href="{{url('product/'.$featuredlist->id)}}">
                            <img src="{{ $featuredlist->feature_image }}" width="280" height="280" alt="product">
                            <img src="{{ $featuredlist->feature_image }}" width="280" height="280" alt="product">
                        </a>
                        <div class="label-group">
                             {{-- <div class="product-label label-hot">HOT</div> --}}
                             @if ($featuredlist->discount > 0)
                             <div class="product-label label-sale">{{ substr($featuredlist->discount,0,2 )}}%</div>
                             @endif
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="category-list">

                            <a href="" class="product-category">{{$featuredlist->category?$featuredlist->category->name:''}}</a>
                        </div>
                        <h3 class="product-title">
                            <a href="{{url('product/'.$featuredlist->id)}}">{{$featuredlist->name}}</a>
                        </h3>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:80%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <!-- End .product-ratings -->
                        </div>

                        <!-- End .product-container -->
                        <div class="price-box">
                            @if ($featuredlist->discount > 0)
                            <del class="old-price">{{$featuredlist->currency}}{{$featuredlist->actual_price}}</del>
                            <span class="product-price">{{$featuredlist->currency}}{{$featuredlist->saleprice }}</span>
                         @else
                            <span class="product-price">{{$featuredlist->currency}}{{$featuredlist->saleprice }}</span>
                            @endif
                            </div>
                        <!-- End .price-box -->
                        <div class="product-action">
                            <a href="wishlist.html" class="btn-icon-wish" title="wishlist"><i
                                    class="icon-heart"></i></a>
                            <a href="{{url('product/'.$featuredlist->id)}}" class="btn-icon btn-add-cart"><i
                                    class="fa fa-arrow-right"></i><span>SELECT
                                    OPTIONS</span></a>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i
                                    class="fas fa-external-link-alt"></i></a>
                        </div>
                    </div>

                    <!-- End .product-details -->
                </div>
                @endforeach
                {{-- <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                    <figure>
                        <a href="product.html">
                            <img src="{{asset('website/assets/images/products/product-2.jpg')}}" width="280" height="280" alt="product">
                            <img src="{{asset('website/assets/images/products/product-2-2.jpg')}}" width="280" height="280" alt="product">
                        </a>
                        <div class="label-group">
                            <div class="product-label label-hot">HOT</div>
                            <div class="product-label label-sale">-30%</div>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="category.html" class="product-category">Category</a>
                        </div>
                        <h3 class="product-title">
                            <a href="product.html">Brown Women Casual HandBag</a>
                        </h3>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:80%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <!-- End .product-ratings -->
                        </div>
                        <!-- End .product-container -->
                        <div class="price-box">
                            <del class="old-price">$59.00</del>
                            <span class="product-price">$49.00</span>
                        </div>
                        <!-- End .price-box -->
                        <div class="product-action">
                            <a href="wishlist.html" class="btn-icon-wish" title="wishlist"><i
                                    class="icon-heart"></i></a>
                            <a href="product.html" class="btn-icon btn-add-cart"><i
                                    class="fa fa-arrow-right"></i><span>SELECT
                                    OPTIONS</span></a>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i
                                    class="fas fa-external-link-alt"></i></a>
                        </div>
                    </div>
                    <!-- End .product-details -->
                </div> --}}
            </div>

            <!-- End .featured-proucts -->
        </div>
    </section>

    <section class="new-products-section">
        <div class="container">
            <h2 class="section-title heading-border ls-20 border-0">New Arrivals</h2>

            <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center mb-2" data-owl-options="{
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


                <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                    <figure>
                        <a href="{{url('product/'.$arriviallist->id)}}">
                            <img src="{{ $arriviallist->feature_image }}" width="220" height="220" alt="product">
                            <img src="{{ $arriviallist->feature_image }}" width="220" height="220" alt="product">
                        </a>
                        <div class="label-group">
                             {{-- <div class="product-label label-hot">HOT</div> --}}
                             @if ($arriviallist->discount > 0)
                             <div class="product-label label-sale">{{ substr($arriviallist->discount,0,2 )}}%</div>
                             @endif
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="" class="product-category">{{$arriviallist->category?$arriviallist->category->name:''}}</a>
                        </div>
                        <h3 class="product-title">
                            <a href="{{url('product/'.$arriviallist->id)}}">{{$arriviallist->name}}</a>
                        </h3>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:80%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <!-- End .product-ratings -->
                        </div>
                        <!-- End .product-container -->
                        <div class="price-box">
                            @if ($arriviallist->discount > 0)
                            <del class="old-price">{{$arriviallist->currency}}{{$arriviallist->actual_price}}</del>
                            <span class="product-price">{{$arriviallist->currency}}{{$arriviallist->saleprice }}</span>
                            @else
                            <span class="product-price">{{$arriviallist->currency}}{{$arriviallist->saleprice }}</span>
                            @endif

                             </div>
                        <!-- End .price-box -->
                        <div class="product-action">
                            <a href="wishlist.html" class="btn-icon-wish" title="wishlist"><i
                                    class="icon-heart"></i></a>
                            {{-- <a href="{{url('product/'.$arriviallist->id)}}" class="btn-icon btn-add-cart product-type-simple"><i
                                    class="icon-shopping-cart"></i><span>ADD TO CART</span></a> --}}
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i
                                    class="fas fa-external-link-alt"></i></a>
                        </div>
                    </div>
                    <!-- End .product-details -->
                </div>
                @endforeach


            </div>
            <!-- End .featured-proucts -->

            <div class="banner banner-big-sale appear-animate" data-animation-delay="200" data-animation-name="fadeInUpShorter" style="background: #2A95CB center/cover url('assets/images/demoes/demo4/banners/banner-4.jpg');">
                <div class="banner-content row align-items-center mx-0">
                    <div class="col-md-9 col-sm-8">
                        <h2 class="text-white text-uppercase text-center text-sm-left ls-n-20 mb-md-0 px-4">
                            <b class="d-inline-block mr-3 mb-1 mb-md-0">Big Sale</b> All new fashion brands items up to 70% off
                            <small class="text-transform-none align-middle">Online Purchases Only</small>
                        </h2>
                    </div>
                    <div class="col-md-3 col-sm-4 text-center text-sm-right">
                        <a class="btn btn-light btn-white btn-lg" href="category.html">View Sale</a>
                    </div>
                </div>
            </div>

            <h2 class="section-title categories-section-title heading-border border-0 ls-0 appear-animate" data-animation-delay="100" data-animation-name="fadeInUpShorter">Browse Our Categories
            </h2>

            <div class="categories-slider owl-carousel owl-theme show-nav-hover nav-outer">
                @foreach ($categories as $catitem  )
                <div class="product-category appear-animate" data-animation-name="fadeInUpShorter">
                    <a href="{{url('category=' .$catitem->name)}}">
                        <figure>
                            <img src="{{asset($catitem->image_url)}}" alt="category" width="280" height="240" />
                        </figure>
                        <div class="category-content">
                            <a href="{{url('category=' .$catitem->name)}}">
                            <h3>{{ $catitem->name }}</h3></a>

                        </div>
                    </a>
                </div>
                @endforeach


            </div>
        </div>
    </section>

    <section class="feature-boxes-container">
        <div class="container appear-animate" data-animation-name="fadeInUpShorter">
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-box px-sm-5 feature-box-simple text-center">
                        <div class="feature-box-icon">
                            <i class="icon-earphones-alt"></i>
                        </div>

                        <div class="feature-box-content p-0">
                            <h3>Customer Support</h3>
                            <h5>You Won't Be Alone</h5>

                            <p>We really care about you and your website as much as you do. Purchasing Porto or any other theme from us you get 100% free support.</p>
                        </div>
                        <!-- End .feature-box-content -->
                    </div>
                    <!-- End .feature-box -->
                </div>
                <!-- End .col-md-4 -->

                <div class="col-md-4">
                    <div class="feature-box px-sm-5 feature-box-simple text-center">
                        <div class="feature-box-icon">
                            <i class="icon-credit-card"></i>
                        </div>

                        <div class="feature-box-content p-0">
                            <h3>Fully Customizable</h3>
                            <h5>Tons Of Options</h5>

                            <p>With Porto you can customize the layout, colors and styles within only a few minutes. Start creating an amazing website right now!</p>
                        </div>
                        <!-- End .feature-box-content -->
                    </div>
                    <!-- End .feature-box -->
                </div>
                <!-- End .col-md-4 -->

                <div class="col-md-4">
                    <div class="feature-box px-sm-5 feature-box-simple text-center">
                        <div class="feature-box-icon">
                            <i class="icon-action-undo"></i>
                        </div>
                        <div class="feature-box-content p-0">
                            <h3>Powerful Admin</h3>
                            <h5>Made To Help You</h5>

                            <p>Porto has very powerful admin features to help customer to build their own shop in minutes without any special skills in web development.</p>
                        </div>
                        <!-- End .feature-box-content -->
                    </div>
                    <!-- End .feature-box -->
                </div>
                <!-- End .col-md-4 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container-->
    </section>
    <!-- End .feature-boxes-container -->

    <section class="promo-section bg-dark" data-parallax="{'speed': 2, 'enableOnMobile': true}" data-image-src="assets/images/demoes/demo4/banners/banner-5.jpg">
        <div class="promo-banner banner container text-uppercase">
            <div class="banner-content row align-items-center text-center">
                <div class="col-md-4 ml-xl-auto text-md-right appear-animate" data-animation-name="fadeInRightShorter" data-animation-delay="600">
                    <h2 class="mb-md-0 text-white">Top Fashion<br>Deals</h2>
                </div>
                <div class="col-md-4 col-xl-3 pb-4 pb-md-0 appear-animate" data-animation-name="fadeIn" data-animation-delay="300">
                    <a href="category.html" class="btn btn-dark btn-black ls-10">View Sale</a>
                </div>
                <div class="col-md-4 mr-xl-auto text-md-left appear-animate" data-animation-name="fadeInLeftShorter" data-animation-delay="600">
                    <h4 class="mb-1 mt-1 font1 coupon-sale-text p-0 d-block ls-n-10 text-transform-none">
                        <b>Exclusive
                            COUPON</b></h4>
                    <h5 class="mb-1 coupon-sale-text text-white ls-10 p-0"><i class="ls-0">UP TO</i><b class="text-white bg-secondary ls-n-10">$100</b> OFF</h5>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-section pb-0">
        <div class="container">




            <hr class="mt-4 m-b-5">

            <div class="product-widgets-container row pb-2">
                <div class="col-lg-3 col-sm-6 pb-5 pb-md-0">
                    <h4 class="section-sub-title">Featured Products</h4>
                    @foreach ($featuredProductsFooter as $featuredlist)
                    <div class="product-default left-details product-widget">
                        <figure>
                            <a href="{{url('product/'.$featuredlist->id)}}">
                                <img src="{{ $featuredlist->feature_image }}" width="74" height="74"
                                    alt="product">
                                <img src="{{ $featuredlist->feature_image }}" width="74" height="74"
                                    alt="product">
                            </a>
                            {{-- <div class="product-label label-hot">HOT</div> --}}
                            @if ($featuredlist->discount > 0)
                            <div class="product-label label-sale">{{ substr($featuredlist->discount,0,2 )}}%</div>
                            @endif

                        </figure>

                        <div class="product-details">
                            <h3 class="product-title"> <a href="{{url('product/'.$featuredlist->id)}}"> {{$featuredlist->name}}</a>
                            </h3>

                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:100%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->

                            <div class="price-box">
                                @if ($featuredlist->discount > 0)
                                <span class="old-price">{{$featuredlist->currency}}{{$featuredlist->actual_price}}</span>
                                <span class="product-price">{{$featuredlist->currency}}{{$featuredlist->saleprice }}</span>
                                @else
                                <span class="product-price">{{$featuredlist->currency}}{{$featuredlist->saleprice }}</span>
                                @endif

                            </div>
                            <!-- End .price-box -->
                        </div>
                        <!-- End .product-details -->
                    </div>
    @endforeach

                </div>

                <div class="col-lg-3 col-sm-6 pb-5 pb-md-0 appear-animate" data-animation-name="fadeInLeftShorter" data-animation-delay="500">
                    <h4 class="section-sub-title">Arrivial Products</h4>
                    @foreach ($arrivialProductsFooter as $arriviallist)
                    <div class="product-default left-details product-widget">
                        <figure>
                            <a href="{{url('product/'.$arriviallist->id)}}">
                                <img src="{{ $arriviallist->feature_image }}" width="84" height="84" alt="product">
                                <img src="{{ $arriviallist->feature_image }}" width="84" height="84" alt="product">
                            </a>
                             {{-- <div class="product-label label-hot">HOT</div> --}}
                             @if ($arriviallist->discount > 0)
                             <div class="product-label label-sale">{{ substr($arriviallist->discount,0,2 )}}%</div>
                             @endif
                        </figure>

                        <div class="product-details">
                            <h3 class="product-title"> <a href="{{url('product/'.$arriviallist->id)}}">{{$arriviallist->name}}
                                    </a> </h3>

                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:100%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top">5.00</span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->

                            <div class="price-box">
                                @if ($arriviallist->discount > 0)
                                <span class="old-price">{{$arriviallist->currency}}{{$arriviallist->actual_price}}</span>
                                <span class="product-price">{{$arriviallist->currency}}{{$arriviallist->saleprice }}</span>
                                @else
                                <span class="product-price">{{$arriviallist->currency}}{{$arriviallist->saleprice }}</span>
                                @endif
                            </div>
                            <!-- End .price-box -->
                        </div>
                        <!-- End .product-details -->
                    </div>
      @endforeach
                </div>

                <div class="col-lg-3 col-sm-6 pb-5 pb-md-0 appear-animate" data-animation-name="fadeInLeftShorter" data-animation-delay="800">
                    <h4 class="section-sub-title">Latest Products</h4>
                    @foreach ($latestrPoductsFooter as $list)
                    <div class="product-default left-details product-widget">
                        <figure>
                            <a href="{{url('product/'.$list->id)}}">
                                <img src="{{ $list->feature_image }}" width="84" height="84" alt="product">
                                <img src="{{ $list->feature_image }}" width="84" height="84" alt="product">
                            </a>
                             {{-- <div class="product-label label-hot">HOT</div> --}}
                             @if ($list->discount > 0)
                             <div class="product-label label-sale">{{ substr($list->discount,0,2 )}}%</div>
                             @endif
                        </figure>

                        <div class="product-details">
                            <h3 class="product-title"> <a href="{{url('product/'.$list->id)}}">{{$list->name}}
                                    </a> </h3>

                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:100%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top">5.00</span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->

                            <div class="price-box">
                                @if ($list->discount > 0)
                                <span class="old-price">{{$list->currency}}{{$list->actual_price}}</span>
                                <span class="product-price">{{$list->currency}}{{$list->saleprice }}</span>
                                @else
                                <span class="product-price">{{$list->currency}}{{$list->saleprice }}</span>
                                @endif
                            </div>
                            <!-- End .price-box -->
                        </div>
                        <!-- End .product-details -->
                    </div>
                 @endforeach

                </div>

                <div class="col-lg-3 col-sm-6 pb-5 pb-md-0 appear-animate" data-animation-name="fadeInLeftShorter" data-animation-delay="800">
                    <h4 class="section-sub-title">Top Rated Products</h4>
                    @foreach ($latestrPoductsFooter as $list)
                    <div class="product-default left-details product-widget">
                        <figure>
                            <a href="{{url('product/'.$list->id)}}">
                                <img src="{{ $list->feature_image }}" width="84" height="84" alt="product">
                                <img src="{{ $list->feature_image }}" width="84" height="84" alt="product">
                            </a>
                             {{-- <div class="product-label label-hot">HOT</div> --}}
                             @if ($list->discount > 0)
                             <div class="product-label label-sale">{{ substr($list->discount,0,2 )}}%</div>
                             @endif
                        </figure>

                        <div class="product-details">
                            <h3 class="product-title"> <a href="{{url('product/'.$list->id)}}">{{$list->name}}
                                    </a> </h3>

                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:100%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top">5.00</span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->

                            <div class="price-box">
                                @if ($list->discount > 0)
                                <span class="old-price">{{$list->currency}}{{$list->actual_price}}</span>
                                <span class="product-price">{{$list->currency}}{{$list->saleprice }}</span>
                                @else
                                <span class="product-price">{{$list->currency}}{{$list->saleprice }}</span>
                                @endif
                            </div>
                            <!-- End .price-box -->
                        </div>
                        <!-- End .product-details -->
                    </div>
                 @endforeach

                </div>
            </div>
            <!-- End .row -->
        </div>
    </section>
    @endsection
