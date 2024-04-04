@extends('website.master')
@section('title', $product->name)
@section('style')
    <style>
        i.anc-tw {
            background: url(../images/twitter.png)no-repeat 10px 9px #1CA4D6;
            width: 26px;
            height: 19px;
            display: inline-block;
            padding: 10px 6px;
            float: left;
            border-radius: 4px 0px 0px 4px;
        }

        i.anc-fa {
            float: left;
            background: url(/form-assets/images/facebook.png)no-repeat 6px 9px #37528C;
            width: 35px;
            height: 35px;
            display: inline-block;
            padding: 10px 6px;

            border-radius: 4px 0px 0px 4px;
        }

        i.anc-go {
            background: url(/form-assets/images/google.png)no-repeat 9px 9px #C74534;
            width: 35px;
            height: 35px;
            display: inline-block;
            padding: 10px 6px;
            float: left;
            border-radius: 4px 0px 0px 4px;
        }


        .login-bottom {
            text-align: center;
            background: rgba(236, 236, 236, 0.29);
            padding: 0px 0px 40px 0px;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
            padding: 0 1.5em 2em;
        }

        .login-bottom h3 {
            font-size: 20px;
            font-weight: 700;
            color: #000;
            padding: 25px 0px 0px 0px;
        }

        .login-bottom p {
            font-size: 15px;
            font-weight: 400;
            color: #000;
            margin: 4px 0px 10px 0px;
        }

        .login-bottom h4,
        .login-bottom h4 a {
            font-size: 13px;
        }

        .reg-bwn a {
            padding: 6px 18px;
        }

        .login-bottom h3 {
            padding: 15px 0px 0px 0px;
            margin-top: 0.51em;
        }

        .button a {
            font-size: 15px;
            font-weight: 600;
            color: #fff;
            margin: 0px 1.5% 0px 0px;
            border-radius: 4px;
            float: left;
            width: 45%;
            margin-left: 20px;
            padding: 0px 0;
        }

        .button a.tw {
            background: #1DAEE3;
            float: left;

        }

        .button a.fa {
            background: #3B5998;
            float: left;

        }

        .button a span {
            margin-top: 8px;
            display: block;
        }

        .button a.go {
            background: #D34836;
            margin: 0;
            float: left;
        }

        .button a.tw:hover {
            background: #1CA4D6;
        }

        .button a.fa:hover {
            background: #37528C;
        }

        .button a.go:hover {
            background: #C74534;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="demo4.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ url('/products') }}">Products</a></li>
            </ol>
        </nav>

        <div class="product-single-container product-single-default product_data">
            <div class="cart-message d-none">
                {{-- <strong class="single-cart-notice">“{{ $product->name }}”</strong>
                <span>has been added to your cart.</span> --}}
            </div>
            @include('alerts')

            <div class="row">
                <div class="col-lg-5 col-md-6 product-single-gallery hidden-overflow">
                    <div class="product-slider-container">


                        <div class="product-single-carousel owl-carousel owl-theme show-nav-hover  ">
                            @foreach ($colors as $key => $color)
                                @foreach ($color->media as $color_media)
                                    <div class="product-item">
                                        <img class="product-single-image" src="{{ $color_media->url }}"
                                            data-zoom-image="{{ $color_media->url }}" width="468" height="468"
                                            alt="product" />
                                    </div>
                                @endforeach
                            @endforeach

                            @foreach ($product->images as $image)
                                <div class="product-item">
                                    <img class="product-single-image" src="{{ $image->url }}"
                                        data-zoom-image="{{ $image->url }}" width="468" height="468"
                                        alt="product" />
                                </div>
                            @endforeach
                        </div>

                        <!-- End .product-single-carousel -->
                        <span class="prod-full-screen">
                            <i class="icon-plus"></i>
                        </span>
                    </div>

                    <div class="prod-thumbnail owl-dots  ">
                        @foreach ($colors as $key => $color)
                            @foreach ($color->media as $color_media)
                                <div class="owl-dot">
                                    <img src="{{ $color_media->url }}" width="110" height="110"
                                        alt="product-thumbnail" />
                                </div>
                            @endforeach
                        @endforeach

                        @foreach ($product->images as $image)
                            <div class="owl-dot">
                                <img src="{{ $image->url }}" width="110" height="110" alt="product-thumbnail" />
                            </div>
                        @endforeach
                    </div>



                </div>
                <!-- End .product-single-gallery -->

                <div class="col-lg-7 col-md-6 product-single-details ">
                    <h1 class="product-title">{!! $product->name !!} {!! $product->category ? $product->category->name : '' !!}</h1>
                    <table>
                        <tbody>
                            <tr>
                                <td width="120">SKU:</td>
                                <td>{{ $product->sku ? $product->sku : 'N/A' }}</td>
                                <td width="50"></td>
                                <td></td>
                                @if ($product->is_active)
                                    <td id="stock-text"></td>
                                @else
                                    <td>Not Available</td>
                                @endif
                            </tr>
                            <tr>
                                @if ($product->delivered_in)
                                    <td width="120">Delivered In:</td>
                                    <td>{{ $product->delivered_in ? $product->delivered_in . ' Days' : 'N/A' }}</td>
                                @endif

                                <td width="50"></td>
                                @if ($product->rating)
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:{{ ($product->rating / 5) * 100 }}%"></span>
                                            <!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                    </div>
                                @else
                                    <td></td>
                                    <td></td>
                                @endif
                            </tr>
                        </tbody>
                    </table>



                    <hr class="short-divider">


                    <div class="price-box">
                        <p>Price</p>
                        <span class="new-price ">{{ $product->currency }} <span
                                id="product-price">{!! $product->saleprice !!}</span></span>

                    </div>
                    <!-- End .price-box -->

                    <div class="product-desc">

                        <p>{!! $product->short_description !!}</p>

                    </div>



                    @if (count($colors) > 0)
                        <div class="product-filters-container">
                            <div class="product-single-filter"><label><b>Colors</b></label>
                                <ul class="config-size-list config-color-list config-filter-list" id="color-list">
                                    @foreach ($colors as $key => $color)
                                        <li data-id="{{ $color->id }}" class="{{ $key == 0 ? 'active' : '' }} pointer"
                                            onclick="onChangeVariation({{ $color->id }}, this)">
                                            <div class="color ">
                                                <img src="{{ $color->media[0]->url }}" alt="" srcset=""
                                                    height="80px">

                                                <div class="text-capitalize mb-0 text-center">{{ $color->value }}</div>
                                            </div>
                                        </li>
                                    @endforeach


                                </ul>
                            </div>

                        </div>
                    @endif
                    <div class="product-action">
                        <input type="hidden" value="{{ $product->id }}" class="product_id">
                        @if (!$product->is_for_request_quote)
                            <div class="product-single-qty">
                                <input class="horizontal-quantity form-control" name="quantity" type="text">
                            </div>
                        @endif


                        <!-- End .product-single-qty -->
                        @if (Auth::user() && !$product->is_for_request_quote)
                            @if ($productCheck == 1)
                                <button class="btn btn-dark add-cart mr-2 btn-sm" id="add-to-cart" title="Add to Cart">Add
                                    to Cart </button>
                            @endif
                            @if ($productCheck == 0)
                                <a href="{{ url('cart') }}" class="btn btn-gray view-cart btn-sm">View cart</a>
                            @endif
                        @elseif(!$product->is_for_request_quote)
                            <a class="btn btn-dark  mr-2 btn-sm" title="Add to Cart" data-toggle="modal" id="add-to-cart"
                                data-target="#loginModal">Add to Cart</a>
                        @endif
                        @if ($product->is_for_request_quote == 1 && $quoteCheck == true)
                            <a class="btn btn-dark  btn-sm" onclick="showQuoteRequestModal({{ $product }})">Request
                                Quote</a>
                        @endif
                    </div>

                    <!-- End .product-action -->

                    <hr class="divider mb-0 mt-0">


                    <!-- End .product single-share -->
                </div>
                <!-- End .product-single-details -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .product-single-container -->

        <div class="product-single-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content"
                        role="tab" aria-controls="product-desc-content" aria-selected="true">Description</a>
                </li>

                {{-- <li class="nav-item">
                    <a class="nav-link" id="product-tab-size" data-toggle="tab" href="#product-size-content"
                        role="tab" aria-controls="product-size-content" aria-selected="true">Size Guide</a>
                </li> --}}



                {{-- <li class="nav-item">
                    <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content"
                        role="tab" aria-controls="product-reviews-content" aria-selected="false">Reviews (1)</a>
                </li> --}}
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel"
                    aria-labelledby="product-tab-desc">
                    <div class="product-desc-content">
                        <p>{!! $product->description !!}</p>
                    </div>
                    <!-- End .product-desc-content -->
                </div>
                <!-- End .tab-pane -->


                <!-- End .tab-pane -->


                <!-- End .tab-pane -->


                <!-- End .tab-pane -->
            </div>
            <!-- End .tab-content -->
        </div>
        <!-- End .product-single-tabs -->

        <div class="products-section pt-0">
            <h2 class="section-title">Related Products</h2>

            <div class="products-slider owl-carousel owl-theme dots-top dots-small">
                @foreach ($relatedProducts as $product_item)
                    <div class="product-default">
                        <figure>
                            <a href="{{ url('product/' . $product_item->id) }}">
                                <img src="{{ asset($product_item->feature_image) }}" width="280" height="280"
                                    alt="product">
                                <img src="{{ asset($product_item->feature_image) }}" width="280" height="280"
                                    alt="product">
                            </a>
                            @if ($product_item->is_for_request_quote)
                                <div class="label-group">
                                    {{-- <div class="product-label label-hot">HOT</div> --}}
                                    <div class="product-label label-sale">
                                        request for quote
                                    </div>
                                </div>
                            @elseif ($product_item->discount > 0)
                                <div class="label-group">
                                    <div class="product-label label-sale">{{ substr($product_item->discount, 0, 2) }}%
                                    </div>
                                </div>
                            @endif

                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href=""
                                    class="product-category">{{ $product_item->category ? $product_item->category->name : '' }}</a>
                            </div>
                            <h3 class="product-title">
                                <a href="{{ url('product/' . $product_item->id) }}">{{ $product_item->name }}</a>
                            </h3>
                            @if ($product_item->rating > 0)
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings"
                                            style="width:{{ ($product_item->rating / 5) * 100 }}%"></span>
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

                            <!-- End .product-container -->
                            <div class="price-box">
                                @if ($product_item->discount > 0)
                                    <del
                                        class="old-price">{{ $product_item->currency }}{{ $product_item->actual_price }}</del>
                                    <span
                                        class="product-price">{{ $product_item->currency }}{{ $product_item->saleprice }}</span>
                                @elseif($product_item->saleprice > 0)
                                    <span
                                        class="product-price">{{ $product_item->currency }}{{ $product_item->saleprice }}</span>
                                @endif

                            </div>

                        </div>
                        <!-- End .product-details -->
                    </div>
                @endforeach
            </div>
            <!-- End .products-slider -->
        </div>
        <!-- End .products-section -->

        <hr class="mt-0 m-b-5" />

        <div class="product-widgets-container row pb-2">
            <div class="col-lg-3 col-sm-6 pb-5 pb-md-0">
                <h4 class="section-sub-title">Featured Products</h4>
                @foreach ($featuredProductsFooter as $featuredlist)
                    <div class="product-default left-details product-widget">
                        <figure>
                            <a href="{{ url('product/' . $featuredlist->id) }}">
                                <img src="{{ $featuredlist->feature_image }}" width="74" height="74"
                                    alt="product">
                                <img src="{{ $featuredlist->feature_image }}" width="74" height="74"
                                    alt="product">
                            </a>
                            {{-- <div class="product-label label-hot">HOT</div> --}}
                            @if ($featuredlist->is_for_request_quote)
                                <div class="label-group">
                                    {{-- <div class="product-label label-hot">HOT</div> --}}
                                    <div class="product-label label-sale">
                                        quote
                                    </div>
                                </div>
                            @elseif ($featuredlist->discount > 0)
                                <div class="product-label label-sale">{{ substr($featuredlist->discount, 0, 2) }}%</div>
                            @endif

                        </figure>

                        <div class="product-details">
                            <h3 class="product-title"> <a href="{{ url('product/' . $featuredlist->id) }}">
                                    {{ $featuredlist->name }}</a>
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
                                @if ($featuredlist->discount > 0)
                                    <span
                                        class="old-price">{{ $featuredlist->currency }}{{ $featuredlist->actual_price }}</span>
                                    <span
                                        class="product-price">{{ $featuredlist->currency }}{{ $featuredlist->saleprice }}</span>
                                @elseif($featuredlist->saleprice > 0)
                                    <span
                                        class="product-price">{{ $featuredlist->currency }}{{ $featuredlist->saleprice }}</span>
                                @endif

                            </div>
                            <!-- End .price-box -->
                        </div>
                        <!-- End .product-details -->
                    </div>
                @endforeach

            </div>

            <div class="col-lg-3 col-sm-6 pb-5 pb-md-0 appear-animate" data-animation-name="fadeInLeftShorter"
                data-animation-delay="500">
                <h4 class="section-sub-title">Arrivial Products</h4>
                @foreach ($arrivialProductsFooter as $arriviallist)
                    <div class="product-default left-details product-widget">
                        <figure>
                            <a href="{{ url('product/' . $arriviallist->id) }}">
                                <img src="{{ $arriviallist->feature_image }}" width="84" height="84"
                                    alt="product">
                                <img src="{{ $arriviallist->feature_image }}" width="84" height="84"
                                    alt="product">
                            </a>
                            {{-- <div class="product-label label-hot">HOT</div> --}}
                            @if ($arriviallist->is_for_request_quote)
                                <div class="label-group">
                                    {{-- <div class="product-label label-hot">HOT</div> --}}
                                    <div class="product-label label-sale">
                                        quote
                                    </div>
                                </div>
                            @elseif ($arriviallist->discount > 0)
                                <div class="label-group">
                                    <div class="product-label label-sale">{{ substr($arriviallist->discount, 0, 2) }}%
                                    </div>
                                </div>
                            @endif
                        </figure>

                        <div class="product-details">
                            <h3 class="product-title"> <a
                                    href="{{ url('product/' . $arriviallist->id) }}">{{ $arriviallist->name }}
                                </a> </h3>

                            @if ($arriviallist->rating > 0)
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings"
                                            style="width:{{ ($arriviallist->rating / 5) * 100 }}%"></span>
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
                                @if ($arriviallist->discount > 0)
                                    <span
                                        class="old-price">{{ $arriviallist->currency }}{{ $arriviallist->actual_price }}</span>
                                    <span
                                        class="product-price">{{ $arriviallist->currency }}{{ $arriviallist->saleprice }}</span>
                                @elseif($arriviallist->saleprice > 0)
                                    <span
                                        class="product-price">{{ $arriviallist->currency }}{{ $arriviallist->saleprice }}</span>
                                @endif
                            </div>
                            <!-- End .price-box -->
                        </div>
                        <!-- End .product-details -->
                    </div>
                @endforeach
            </div>

            <div class="col-lg-3 col-sm-6 pb-5 pb-md-0 appear-animate" data-animation-name="fadeInLeftShorter"
                data-animation-delay="800">
                <h4 class="section-sub-title">Latest Products</h4>
                @foreach ($latestPoductsFooter as $list)
                    <div class="product-default left-details product-widget">
                        <figure>
                            <a href="{{ url('product/' . $list->id) }}">
                                <img src="{{ $list->feature_image }}" width="84" height="84" alt="product">
                                <img src="{{ $list->feature_image }}" width="84" height="84" alt="product">
                            </a>
                            {{-- <div class="product-label label-hot">HOT</div> --}}
                            @if ($list->is_for_request_quote)
                                <div class="label-group">
                                    {{-- <div class="product-label label-hot">HOT</div> --}}
                                    <div class="product-label label-sale">
                                        quote
                                    </div>
                                </div>
                            @elseif ($list->discount > 0)
                                <div class="product-label label-sale">{{ substr($list->discount, 0, 2) }}%</div>
                            @endif
                        </figure>

                        <div class="product-details">
                            <h3 class="product-title"> <a href="{{ url('product/' . $list->id) }}">{{ $list->name }}
                                </a> </h3>

                            @if ($list->rating > 0)
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{ ($list->rating / 5) * 100 }}%"></span>
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
                                    <span class="old-price">{{ $list->currency }}{{ $list->actual_price }}</span>
                                    <span class="product-price">{{ $list->currency }}{{ $list->saleprice }}</span>
                                @elseif($list->saleprice > 0)
                                    <span class="product-price">{{ $list->currency }}{{ $list->saleprice }}</span>
                                @endif
                            </div>
                            <!-- End .price-box -->
                        </div>
                        <!-- End .product-details -->
                    </div>
                @endforeach

            </div>

            <div class="col-lg-3 col-sm-6 pb-5 pb-md-0 appear-animate" data-animation-name="fadeInLeftShorter"
                data-animation-delay="800">
                <h4 class="section-sub-title">Top Rated Products</h4>
                @foreach ($latestPoductsFooter as $list)
                    <div class="product-default left-details product-widget">
                        <figure>
                            <a href="{{ url('product/' . $list->id) }}">
                                <img src="{{ $list->feature_image }}" width="84" height="84" alt="product">
                                <img src="{{ $list->feature_image }}" width="84" height="84" alt="product">
                            </a>
                            {{-- <div class="product-label label-hot">HOT</div> --}}
                            @if ($list->is_for_request_quote)
                                <div class="label-group">
                                    {{-- <div class="product-label label-hot">HOT</div> --}}
                                    <div class="product-label label-sale">
                                        quote
                                    </div>
                                </div>
                            @elseif ($list->discount > 0)
                                <div class="product-label label-sale">{{ substr($list->discount, 0, 2) }}%</div>
                            @endif
                        </figure>

                        <div class="product-details">
                            <h3 class="product-title"> <a href="{{ url('product/' . $list->id) }}">{{ $list->name }}
                                </a> </h3>

                            @if ($list->rating > 0)
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{ ($list->rating / 5) * 100 }}%"></span>
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
                                    <span class="old-price">{{ $list->currency }}{{ $list->actual_price }}</span>
                                    <span class="product-price">{{ $list->currency }}{{ $list->saleprice }}</span>
                                @elseif($list->saleprice > 0)
                                    <span class="product-price">{{ $list->currency }}{{ $list->saleprice }}</span>
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
    <!-- End .container -->
    <!-- Modal -->

    @include('website.include.login-modal')
    @include('website.include.quote-request-modal')
@endsection


@section('scripts')

    <script>
        const PRODUCT = @json($product);
    </script>
    <script src="{{ asset('website/assets/js/products.js') }}"></script>
    <script>
        function loginUser() {
            $(".login-btn").attr('disabled', 'disabled');
            $(".login-btn").html("Checking..");
            // e.preventDefault();
            var password = $('#password').val();
            var email = $('#email').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "/login",
                data: {
                    'password': password,
                    'email': email,
                },

                success: function(response) {
                    $(".login-btn").html("Login");
                    swal("", response.status, "success");
                    setTimeout(location.reload(), 25000);
                },
                error: function(error) {
                    // $(form)
                    $(".login-btn").html("Login");
                    $(".login-btn").attr('disabled', false);

                    var errorMessage = error.statusText;
                    var sweetMessage = error.statusText;
                    if (error.status == 422) {
                        errorMessage = handleValidationErrors(error)
                        sweetMessage = 'Invalid Data'
                    }
                    swal({
                        title: "Error",
                        text: sweetMessage,
                        icon: "error",
                    });

                },
            });
        }

        function handleValidationErrors(error, type = 'create') {
            let errors = error.responseJSON.errors;
            var errorMessage = error.responseJSON.message
            var element = '';
            $.each(errors, function(key, item) {
                element = key.split('.')
                if (element.length > 1) {
                    element = `${element[0]}_${element[1]}`
                } else {
                    element = `${element}`
                }
                // dataAttr = $(element).closest('.tab').data('id')
                // $(`.step-${dataAttr}`).addClass('backend-error')

                console.log(type, $(`#${element}_text`));
                if (type == 'edit') {

                    $(`#edit_${element}_text`).text(item[0])
                } else if (type == 'create') {
                    $(`#${element}_text`).text(item[0])
                }

            });

            return errorMessage;
        }
        $(document).ready(function() {
            console.log('hi');
            $('.add-cart').click(function(e) {
                e.preventDefault();
                const color = $('#color-list').find('li.active').data('id')
                var product_id = $(this).closest('.product_data').find('.product_id').val();
                var quantity = $(this).closest('.product_data').find('.horizontal-quantity').val();

                $(".add-cart").prop('disabled', true)



                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/add-to-cart",
                    data: {
                        'product_id': product_id,
                        'quantity': quantity,
                        'color': color,
                    },
                    success: function(response) {
                        swal("", response.status, "success");
                        setTimeout(location.reload(), 20000);
                    },
                    error: function(res) {
                        $(".add-cart").prop('disabled', false)
                    }
                });

            });

        });
    </script>

@endsection
