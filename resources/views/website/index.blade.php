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

                <img class="slide-bg" src="{{ $banner->image_url }}" height="499" alt="slider image">


            </div>
        @endforeach

        <!-- End .home-slide -->


        <!-- End .home-slide -->
    </div>
    <!-- End .home-slider -->






    <!-- End .container -->

    <section class="featured-products-section">
        <div class="container">

            <div class="row">
                <div class="products-slider  custom-products owl-carousel  owl-theme nav-outer show-nav-hover nav-image-center"
                    data-owl-options="{
                'dots': false,
                'nav': true,
                'responsive': {
                    '992': {
                        'items': 4
                    },
                    '1200': {
                        'items': 8
                    },
                    '1400': {
                        'items': 8
                    }
                }
            }">


                    @foreach ($categories as $catitem)
                        <div class="product-default feature-product item">
                            <div class="product-category p-3 border category-container">
                                <a href="{{ route('products', $catitem->name) }}">
                                    <figure>
                                        <img src="{{ asset($catitem->image_url) }}" alt="category" />
                                    </figure>
                                    <div class="category-content py-2 px-0">
                                        <a href="{{ route('products', $catitem->name) }}">
                                            <h5 class="mb-0">{{ $catitem->name }}</h5>
                                        </a>
                                    </div>
                                </a>
                            </div>

                        </div>
                    @endforeach
                </div>

            </div>



            <!-- End .featured-proucts -->
        </div>
    </section>

    <section class="new-products-section mt-2">
        <div class="container">
            <h2 class="  heading-border ls-20 border-0">Sale Items</h2>


            <div class="   general-slick-slider   mb-2 sale-items">

                @foreach ($saleItems as $saleItem)
                    <div class="product-default  ">
                        <figure>
                            <a href="{{ url('product/' . $saleItem->id) }}">
                                <img src="{{ url($saleItem->feature_image) }}" alt="product">
                                <img src="{{ url($saleItem->feature_image) }}" alt="product">
                            </a>
                            <div class="label-group">
                                <div class="product-label label-sale">{{ substr($saleItem->discount, 0, 2) }}%</div>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="category.html" class="product-category">{{ $saleItem->category->name }}</a>
                            </div>
                            <h3 class="product-title">
                                <a href="{{ url('product/' . $saleItem->id) }}">{{ $saleItem->name }}</a>
                            </h3>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <span class="product-price">{{ $saleItem->currency }}{{  (int)$saleItem->saleprice }}</span>
                            </div>

                        </div>
                        <!-- End .product-details -->
                    </div>
                @endforeach
            </div>


        </div>
    </section>


    <section class="new-products-section mt-2">
        <div class="container">

            <h2 class=" heading-border ls-20 border-0  ">
                <span>Just Launched</span>
            </h2>

            <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center mb-2 just-launched"
                data-owl-options="{
                    'dots': false,
                    'nav': true,
                    'responsive': {
                        '992': {
                            'items': 4
                        },
                        '1200': {
                            'items': 5
                        },  
                        '1400': {
                            'items': 7
                        },
                        '1600': {
                            'items': 10
                        }
                    }
                }">
                @foreach ($arrivialProducts as $arriviallist)
                    <div class="product-default  new-arrival">
                        <figure>
                            <a href="{{ url('product/' . $arriviallist->id) }}">
                                <img src="{{ $arriviallist->feature_image }}" alt="product">
                                <img src="{{ $arriviallist->feature_image }}" alt="product">
                            </a>
                            <div class="label-group">
                                {{-- <div class="product-label label-hot">HOT</div> --}}
                                @if ($arriviallist->discount > 0)
                                    <div class="product-label label-sale">
                                        {{ substr($arriviallist->discount, 0, 2) }}%
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

                            <div class="price-box" style="width: max-content;">
                                @if ($arriviallist->discount > 0)
                                    <del
                                        class="old-price">{{ $arriviallist->currency }}{{  (int)$arriviallist->actual_price }}</del>
                                    <span
                                        class="product-price">{{ $arriviallist->currency }}{{ (int)$arriviallist->saleprice }}</span>
                                @else
                                    <span
                                        class="product-price">{{ $arriviallist->currency }}{{  (int)$arriviallist->saleprice }}</span>
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


    <section class="featured-products-section mt-2">
        <div class="container">
            <h2 class="  heading-border ls-20 border-0   ">

                <span>Featured Products</span>
            </h2>

            <div class="products-slider  custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center featured-products"
                data-owl-options="{
                    'dots': false,
                    'nav': true,
                    'responsive': {
                        '992': {
                            'items': 4
                        },
                        '1200': {
                            'items': 6
                        },
                        '1300': {
                            'items': 6
                        },
                        '1600': {
                            'items': 9
                        }
                    }
                }">


                @foreach ($featuredProducts as $featuredlist)
                    <div class="product-default feature-product ">
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
                            @if ($featuredlist->rating > 0)
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings"
                                            style="width:{{ ($featuredlist->rating / 5) * 100 }}%"></span>
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

                                <span
                                    class="product-price">{{ $featuredlist->currency }}{{ (int) $featuredlist->saleprice }}</span>

                            </div>

                        </div>

                        <!-- End .product-details -->
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    @foreach ($categoriesWithProducts as $category)
        <section class="featured-products-section mt-1 categories-products">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <h2 class="  heading-border ls-20 border-0   ">

                            <span>{{ $category->name }}</span>
                        </h2>
                    </div>
                    <div class="col-md-7 text-right py-4 mt-1">
                        <a href="{{ url('products/' . $category->name) }}">View All</a>
                    </div>
                </div>
                <div class="products-slider  custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center"
                    data-owl-options="{
                    'dots': false,
                    'nav': true,
                    'responsive': {
                        '992': {
                            'items': 4
                        },
                        '1200': {
                            'items': 6
                        },
                        '1300': {
                            'items': 6
                        },
                        '1600': {
                            'items': 9
                        }
                    }
                }">
                    @foreach ($category->products as $featuredlist)
                        <div class="product-default feature-product ">
                            <figure>
                                <a href="{{ url('product/' . $featuredlist->id) }}">
                                    <img src="{{ $featuredlist->feature_image }}" width="280" height="280"
                                        alt="product">
                                    <img src="{{ $featuredlist->feature_image }}" width="280" height="280"
                                        alt="product">
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

                                <div class="price-box">
                                    @if ($featuredlist->discount > 0)
                                        <del
                                            class="old-price">{{ $featuredlist->currency }}{{ (int) $featuredlist->actual_price }}</del>
                                        <span
                                            class="product-price">{{ $featuredlist->currency }}{{ (int) $featuredlist->saleprice }}</span>
                                    @else
                                        <span
                                            class="product-price">{{ $featuredlist->currency }}{{ (int) $featuredlist->saleprice }}</span>
                                    @endif
                                </div>

                            </div>

                            <!-- End .product-details -->
                        </div>
                    @endforeach
                </div>

            </div>
        </section>
    @endforeach
@endsection
@section('scripts')
    <script src="{{ url('website/assets/js/silk-slider.js') }}"></script>
@endsection
