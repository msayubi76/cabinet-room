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
                        'items': 3
                    },
                    '425': {
                        'items': 3
                    },
                    '767': {
                        'items': 5  
                    },
                    '1200': {
                        'items': 8
                    } 
                }
            }">
                    @foreach ($categories as $catitem)
                        <div class="  feature-product item">
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
                            '420': {
                                'items': 2
                            },
                            '767': {
                                'items': 2
                            },
                            '992': {
                                'items': 6
                            },
                            '1400': {
                                'items': 7
                            }
                        }
                    }">

                @foreach ($arrivialProducts->chunk(2) as $chunk)
                    <div class="item  ">
                        <div class="row ">
                            @foreach ($chunk as $arriviallist)
                                <div class="col-12 px-2">
                                    <div class="card rounded">
                                        <div
                                            class="new-arrival product-default inner-quickview inner-icon appear-animate animated   appear-animation-visible">

                                            <figure class="img-effect">
                                                <a href="{{ url('product/' . $arriviallist->id) }}">
                                                    <img src="{{ $arriviallist->feature_image }}" alt="product"
                                                        class="img-fluid p-2 rounded">
                                                    <img src="{{ $arriviallist->feature_image }}" alt="product"
                                                        class="img-fluid p-2 rounded">
                                                </a>

                                                @if ($arriviallist->is_for_request_quote)
                                                    <div class="label-group">
                                                        <div class="product-label label-sale">request for quote</div>
                                                    </div>
                                                @elseif ($arriviallist->discount > 0)
                                                    <div class="label-group">
                                                        <div class="product-label label-sale">
                                                            {{ substr($arriviallist->discount, 0, 2) }}%
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($arriviallist->is_for_request_quote)
                                                    <span class="btn-quickview pointer" title="Quote Request"
                                                        onclick="showQuoteRequestModal({{ $arriviallist }})">Quote
                                                        Request</span>
                                                @endif
                                            </figure>


                                            <div class="product-details text-center  px-2">
                                                <div class="category-list">
                                                    <a href="" class="product-category">
                                                        {{ $arriviallist->category ? $arriviallist->category->name : '' }}
                                                    </a>
                                                </div>
                                                <h3 class="product-title">
                                                    <a
                                                        href="{{ url('product/' . $arriviallist->id) }}">{{ $arriviallist->name }}</a>
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
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
                            'items': 2
                        },
                        '375': {
                            'items': 2
                        },
                        '767': {
                            'items': 4
                        },
                        '992': {
                            'items': 6
                        }
                        
                    }
                }">


                @foreach ($featuredProducts as $featuredlist)
                    <div class="card rounded">
                        <div class="product-default feature-product inner-quickview inner-icon">
                            <figure>
                                <a href="{{ url('product/' . $featuredlist->id) }}">
                                    <img src="{{ $featuredlist->feature_image }}" width="280" height="280"
                                        class="img-fluid p-2 rounded" alt="product">
                                    <img src="{{ $featuredlist->feature_image }}" width="280" height="280"
                                        class="img-fluid p-2 rounded" alt="product">
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
                            <div class="product-details px-2">
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

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    @foreach ($categoriesWithProducts as $category)
        <section class="featured-products-section mt-1 categories-products">
            <div class="container">
                <div class="row">
                    <div class="col-md-5  col-7">
                        <h3 class="  heading-border ls-20 border-0   ">

                            <span>{{ $category->name }}</span>
                        </h3>
                    </div>
                    <div class="col-md-7 text-right py-4  col-5">
                        <a href="{{ url('products/' . $category->name) }}">View All</a>
                    </div>
                </div>
                {{-- <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center"
                    data-owl-options="{
                        'dots': false,
                        'nav': true,
                        'responsive': {
                        
                            '425': {
                                'items': 2
                            },
                            '767': {
                                'items': 3
                            },
                            '992': {
                                'items': 5
                            },
                            '1400': {
                                'items': 6
                            }
                        }
                    }">

                    @foreach ($category->products->chunk(2) as $chunk)
                        <div class="item">
                            <div class="row g-2">
                                @foreach ($chunk as $featuredlist)
                                    <div class="col-12">
                                        <div class="card rounded">
                                            <div class="product-default inner-quickview inner-icon">
                                                <figure class="img-effect">
                                                    <a href="{{ url('product/' . $featuredlist->id) }}">
                                                        <img src="{{ $featuredlist->feature_image }}" width="180"
                                                            height="180" alt="product" class="img-fluid p-2 rounded">
                                                        <img src="{{ $featuredlist->feature_image }}" width="180"
                                                            height="180" alt="product" class="img-fluid p-2 rounded">
                                                    </a>


                                                    @if ($featuredlist->is_for_request_quote)
                                                        <div class="label-group">
                                                            <div class="product-label label-sale">request for quote</div>
                                                        </div>
                                                    @elseif ($featuredlist->discount > 0)
                                                        <div class="label-group">
                                                            <div class="product-label label-sale">
                                                                {{ substr($featuredlist->discount, 0, 2) }}%
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($featuredlist->is_for_request_quote)
                                                        <span class="btn-quickview pointer" title="Quote Request"
                                                            onclick="showQuoteRequestModal({{ $featuredlist }})"> Quote
                                                            Request</span>
                                                    @endif
                                                </figure>
                                                <div class="product-details px-2">
                                                    <div class="category-list">
                                                        <a href="" class="product-category">
                                                            {{ $featuredlist->category ? $featuredlist->category->name : '' }}
                                                        </a>
                                                    </div>
                                                    <h3 class="product-title">
                                                        <a
                                                            href="{{ url('product/' . $featuredlist->id) }}">{{ $featuredlist->name }}</a>
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
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div> --}}


                <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center"
                    data-owl-options="{
                        'dots': false,
                        'nav': true,
                        'responsive': { 
                            '425': { 'items': 2 },
                            '767': { 'items': 3 },
                            '992': { 'items': 6 }
                        }
                    }">

                    @if ($category->products->count() > 12)
                        {{-- 🔹 Two-row layout (chunked into 2 per slide) --}}
                        @foreach ($category->products->chunk(2) as $chunk)
                            <div class="item">
                                <div class="row g-2">
                                    @foreach ($chunk as $featuredlist)
                                        <div class="col-12">
                                            <div class="card rounded">
                                                <div class="product-default inner-quickview inner-icon">
                                                    <figure class="img-effect">
                                                        <a href="{{ url('product/' . $featuredlist->id) }}">
                                                            <img src="{{ $featuredlist->feature_image }}" width="180"
                                                                height="180" alt="product"
                                                                class="img-fluid p-2 rounded">
                                                            <img src="{{ $featuredlist->feature_image }}" width="180"
                                                                height="180" alt="product"
                                                                class="img-fluid p-2 rounded">
                                                        </a>
                                                        @if ($featuredlist->is_for_request_quote)
                                                            <div class="label-group">
                                                                <div class="product-label label-sale">request for quote
                                                                </div>
                                                            </div>
                                                        @elseif ($featuredlist->discount > 0)
                                                            <div class="label-group">
                                                                <div class="product-label label-sale">
                                                                    {{ substr($featuredlist->discount, 0, 2) }}%
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($featuredlist->is_for_request_quote)
                                                            <span class="btn-quickview pointer" title="Quote Request"
                                                                onclick="showQuoteRequestModal({{ $featuredlist }})">
                                                                Quote Request</span>
                                                        @endif
                                                    </figure>
                                                    <div class="product-details px-2">
                                                        <div class="category-list">
                                                            <a href="" class="product-category">
                                                                {{ $featuredlist->category ? $featuredlist->category->name : '' }}
                                                            </a>
                                                        </div>
                                                        <h3 class="product-title">
                                                            <a
                                                                href="{{ url('product/' . $featuredlist->id) }}">{{ $featuredlist->name }}</a>
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
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @else
                        {{-- 🔹 Normal one-row layout (no chunking) --}}
                        @foreach ($category->products as $featuredlist)
                            <div class="card rounded">
                                <div class="product-default inner-quickview inner-icon">
                                    <figure class="img-effect">
                                        <a href="{{ url('product/' . $featuredlist->id) }}">
                                            <img src="{{ $featuredlist->feature_image }}" width="180" height="180"
                                                alt="product" class="img-fluid p-2 rounded">
                                            <img src="{{ $featuredlist->feature_image }}" width="180" height="180"
                                                alt="product" class="img-fluid p-2 rounded">
                                        </a>
                                        @if ($featuredlist->is_for_request_quote)
                                            <div class="label-group">
                                                <div class="product-label label-sale">request for quote</div>
                                            </div>
                                        @elseif ($featuredlist->discount > 0)
                                            <div class="label-group">
                                                <div class="product-label label-sale">
                                                    {{ substr($featuredlist->discount, 0, 2) }}%
                                                </div>
                                            </div>
                                        @endif
                                        @if ($featuredlist->is_for_request_quote)
                                            <span class="btn-quickview pointer" title="Quote Request"
                                                onclick="showQuoteRequestModal({{ $featuredlist }})"> Quote Request</span>
                                        @endif
                                    </figure>
                                    <div class="product-details px-2">
                                        <div class="category-list">
                                            <a href="" class="product-category">
                                                {{ $featuredlist->category ? $featuredlist->category->name : '' }}
                                            </a>
                                        </div>
                                        <h3 class="product-title">
                                            <a
                                                href="{{ url('product/' . $featuredlist->id) }}">{{ $featuredlist->name }}</a>
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
                                </div>
                            </div>
                        @endforeach
                    @endif
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
