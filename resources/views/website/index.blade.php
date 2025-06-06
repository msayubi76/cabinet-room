@extends('website.master')
@section('title', 'Home')
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
    </div>

    <section class="featured-products-section">
        <div class="container">

            <div class="row">
                <div class="products-slider  custom-products owl-carousel  owl-theme nav-outer show-nav-hover nav-image-center"
                    data-owl-options="{
                'dots': false,
                'nav': true,
                'responsive': {
                    '320': {
                        'items': 2
                    },
                    '425': {
                        'items': 3
                    },
                    '767': {
                        'items': 5  
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

            <h2 class=" heading-border ls-20 border-0  ">
                <span>Just Launched</span>
            </h2>

            <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center mb-2 just-launched"
                data-owl-options="{
                    'dots': false,
                    'nav': true,
                    'responsive': {
                        '320': {
                            'items': 1
                        },
                        '375': {
                            'items': 2
                        },
                        '767': {
                            'items': 4
                        },
                        '992': {
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
                    <div
                        class="  new-arrival product-default inner-quickview inner-icon appear-animate animated   appear-animation-visible">
                        <figure class="img-effect">
                            <a href="{{ url('product/' . $arriviallist->id) }}">
                                <img src="{{ $arriviallist->feature_image }}" alt="product">
                                <img src="{{ $arriviallist->feature_image }}" alt="product">
                            </a>
                            @if ($arriviallist->is_for_request_quote)
                                <div class="label-group">
                                    {{-- <div class="product-label label-hot">HOT</div> --}}
                                    <div class="product-label label-sale">
                                        request for quote
                                    </div>
                                </div>
                            @elseif ($arriviallist->discount > 0)
                                <div class="label-group">
                                    {{-- <div class="product-label label-hot">HOT</div> --}}
                                    <div class="product-label label-sale">
                                        {{ substr($arriviallist->discount, 0, 2) }}%
                                    </div>
                                </div>
                            @endif
                            @if ($arriviallist->is_for_request_quote)
                                <span class="btn-quickview pointer" title="Quote Request"
                                    onclick="showQuoteRequestModal({{ $arriviallist }})"> Quote Request</span>
                            @endif
                        </figure>
                        <div class="product-details text-center">
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
                                        class="old-price">{{ $arriviallist->currency }}{{ (int) $arriviallist->actual_price }}</del>
                                    <span
                                        class="product-price">{{ $arriviallist->currency }}{{ (int) $arriviallist->saleprice }}</span>
                                @elseif($arriviallist->saleprice > 0)
                                    <span
                                        class="product-price">{{ $arriviallist->currency }}{{ (int) $arriviallist->saleprice }}</span>
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
                        '320': {
                            'items': 1
                        },
                        '375': {
                            'items': 2
                        },
                        '767': {
                            'items': 4
                        },
                        '992': {
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


                @foreach ($featuredProducts as $featuredlist)
                    <div class="product-default feature-product inner-quickview inner-icon">
                        <figure>
                            <a href="{{ url('product/' . $featuredlist->id) }}">
                                <img src="{{ $featuredlist->feature_image }}" width="280" height="280" alt="product">
                                <img src="{{ $featuredlist->feature_image }}" width="280" height="280" alt="product">
                            </a>
                            @if ($featuredlist->is_for_request_quote)
                                <div class="label-group">
                                    {{-- <div class="product-label label-hot">HOT</div> --}}
                                    <div class="product-label label-sale">
                                        request for quote
                                    </div>
                                </div>
                            @elseif($featuredlist->discount > 0)
                                <div class="label-group">
                                    {{-- <div class="product-label label-hot">HOT</div> --}}
                                    <div class="product-label label-sale">{{ substr($featuredlist->discount, 0, 2) }}%
                                    </div>
                                </div>
                            @endif

                            @if ($featuredlist->is_for_request_quote)
                                <span class="btn-quickview pointer" title="Quote Request"
                                    onclick="showQuoteRequestModal({{ $arriviallist }})"> Quote Request</span>
                            @endif
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
                            @if ($featuredlist->saleprice > 0)
                                <div class="price-box">
                                    <span
                                        class="product-price">{{ $featuredlist->currency }}{{ (int) $featuredlist->saleprice }}</span>
                                </div>
                            @endif

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
                        '320': {
                            'items': 1
                        },
                        '375': {
                            'items': 2
                        },
                        '767': {
                            'items': 4
                        },
                        '992': {
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
                    @foreach ($category->products as $featuredlist)
                        <div class="product-default feature-product inner-quickview inner-icon">
                            <figure class="img-effect">
                                <a href="{{ url('product/' . $featuredlist->id) }}">
                                    <img src="{{ $featuredlist->feature_image }}" width="280" height="280"
                                        alt="product">
                                    <img src="{{ $featuredlist->feature_image }}" width="280" height="280"
                                        alt="product">
                                </a>
                                @if ($featuredlist->is_for_request_quote)
                                    <div class="label-group">
                                        {{-- <div class="product-label label-hot">HOT</div> --}}
                                        <div class="product-label label-sale">
                                            request for quote
                                        </div>
                                    </div>
                                @elseif ($featuredlist->discount > 0)
                                    <div class="label-group">
                                        <div class="product-label label-sale">{{ substr($featuredlist->discount, 0, 2) }}%
                                        </div>
                                    </div>
                                @endif
                                @if ($featuredlist->is_for_request_quote)
                                    <span class="btn-quickview pointer" title="Quote Request"
                                        onclick="showQuoteRequestModal({{ $arriviallist }})"> Quote Request</span>
                                @endif
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
                                    @elseif($featuredlist->saleprice > 0)
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

    @include('website.include.quote-request-modal')
@endsection
@section('scripts')
    <script>
        const PRODUCT = {}
    </script>
    <script src="{{ url('website/assets/js/silk-slider.js') }}"></script>
    <script src="{{ url('website/assets/js/products.js') }}"></script>
@endsection
