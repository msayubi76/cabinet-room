@extends('website.master')
@section('title', 'Single product')
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
                    <h1 class="product-title">{!! $product->name !!}</h1>
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
                        @if ($product->discount > 0)
                            <span class="old-price">{{ $product->currency }}{!! $product->actual_price !!}</span>
                            <span class="new-price">{{ $product->currency }}{!! $product->saleprice !!}</span>
                        @else
                            <span class="new-price">{{ $product->currency }}{!! $product->saleprice !!}</span>
                        @endif

                    </div>
                    <!-- End .price-box -->

                    <div class="product-desc">

                        <p>{!! $product->short_description !!}</p>

                    </div>
                    <div class="product-desc">
                        <a href="https://www.facebook.com/" class="social-icon social-facebook icon-facebook text-white"
                            target="_blank" title="Facebook"></a>
                        <!-- <a href="#" class="social-icon  text-white" target="_blank" title="Facebook">
                                                                                                                                                                <i class="fa fa-whatsapp"></i>
                                                                                                                                                            </a> -->

                    </div>
                    <!-- End .product-desc -->

                    <ul class="single-info-list">

                        {{-- <li>
                            SKU: <strong>654613612</strong>
                        </li> --}}

                        <li>
                            CATEGORY: <strong><a href="#"
                                    class="product-category">{!! $product->category ? $product->category->name : '' !!}</a></strong>
                        </li>
                        {{--
                        <li>
                            TAGs: <strong><a href="#" class="product-category">CLOTHES</a></strong>,
                            <strong><a href="#" class="product-category">SWEATER</a></strong>
                        </li> --}}
                    </ul>

                    <div class="product-filters-container">
                        <div class="product-single-filter"><label>Color:</label>
                            <ul class="config-size-list config-color-list config-filter-list" id="color-list">
                                @foreach ($colors as $key => $color)
                                    <li data-id="{{ $color->id }}" class="{{ $key == 0 ? 'active' : '' }}" onclick="onChangeVariation({{ $color->id }})">
                                        <a href="javascript:;" class="filter-color border"
                                            style="background-color: {{ $color->value }};"></a>
                                    </li>
                                @endforeach


                            </ul>
                        </div>



                        <div class="product-single-filter">
                            <label></label>
                            <a class="font1 text-uppercase clear-btn" href="#">Clear</a>
                        </div>
                        <!---->
                    </div>

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
                                <button class="btn btn-dark add-cart mr-2 btn-sm" id="add-to-cart" title="Add to Cart">Add to Cart </button>
                            @endif
                            @if ($productCheck == 0)
                                <a href="{{ url('cart') }}" class="btn btn-gray view-cart btn-sm">View cart</a>
                            @endif
                        @else
                            <a class="btn btn-dark  mr-2 btn-sm" title="Add to Cart" data-toggle="modal" id="add-to-cart"
                                data-target="#loginModal">Add to Cart</a>
                        @endif
                        @if (Auth::user() && $product->is_for_request_quote == 1 && $quoteCheck == true)
                            <a class="btn btn-dark  btn-sm" data-toggle="modal" data-target="#requestModal">Request
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
                            <div class="label-group">
                                {{-- <div class="product-label label-hot">HOT</div> --}}
                                @if ($product_item->discount > 0)
                                    <div class="product-label label-sale">{{ substr($product_item->discount, 0, 2) }}%
                                    </div>
                                @endif
                            </div>
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
                                @else
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
                            @if ($featuredlist->discount > 0)
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
                                @else
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
                            @if ($arriviallist->discount > 0)
                                <div class="product-label label-sale">{{ substr($arriviallist->discount, 0, 2) }}%</div>
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
                                @else
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
                            @if ($list->discount > 0)
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
                                @else
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
                            @if ($list->discount > 0)
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
                                @else
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
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true" style="background-color: rgba(0,0,0,0.4);">
        <div class="modal-dialog modal-dialog-centered" role="document" style=" width: 400px;
    margin: auto;">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="{{ asset('website/assets/images/logo.png') }}" width="111" height="44"
                        alt="Porto Logo">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-title text-center">
                        <h4>Login</h4>

                        <h5 class="modal-title" id=""><b>Welcome! Please Login to continue.</b></h5>
                    </div>
                    <div class="d-flex flex-column  ">
                        <form class="form-valide" id="subcategory-form" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="product_page" value="{{ $product->id }}"
                                    class="form-control">
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Your email address...">
                                <div id="email_text" class="text-danger backend-error-text"></div>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Your password...">
                                <div id="password_text" class="text-danger backend-error-text"></div>
                            </div>
                            <button type="submit" class="btn btn-info btn-block btn-round login-btn btn-sm"
                                onclick="loginUser()">Login</button>
                        </form>



                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <div class="signup-section">Not a member yet? <a href="{{ url('register/' . $product->id) }}"
                            class="text-info">
                            Sign Up</a>.</div>
                </div>
            </div>
        </div>
    </div>
    <!--Request Quote Modal -->
    <div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style=" width: 550px;
    margin: auto;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><b>Request a Quote.</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-valide" id="request-quote-form" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-title text-center"> </div>
                        <div class="d-flex flex-column text-center">

                            @csrf
                            <input type="hidden" id="user_id" name="user_id"
                                value="{{ Auth::user() ? Auth::user()->id : '' }}">
                            <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="email" id="user_email" name="email" class="form-control"
                                        id="email"placeholder="Your email address..." required>
                                    <div id="user_email_text" class="text-danger backend-error-text"></div>

                                </div>
                                <div class="col-md-6">
                                    <input type="name" id="name" name="name" class="form-control"
                                        id="name"placeholder="Your name..." required>
                                    <div id="name_text" class="text-danger backend-error-text"></div>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="address" id="address" name="address" class="form-control"
                                        id="address" placeholder="Your address..." required>
                                    <div id="address_text" class="text-danger backend-error-text"></div>

                                </div>
                                <div class="col-md-6">
                                    <input type="phone" id="phone" name="phone" class="form-control"
                                        id="phone" placeholder="Your phone..." required>
                                    <div id="phone_text" class="text-danger backend-error-text"></div>

                                </div>

                            </div>
                            <div class="">
                                <textarea name="discription" id="discription" placeholder="Your description..." class="form-control" cols="30"
                                    rows="6" required></textarea>
                                <div id="discription_text" class="text-danger backend-error-text"></div>

                            </div>



                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" onclick="requestQuote()"
                            class="btn btn-info btn-sm btn-round add-quote btn-sm">Request Quote</button>

                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
@section('scripts')

    <script>
        const PRODUCT = @json($product);
    </script>
    <script src="{{ asset('website/assets/js/products.js') }}"></script>
    <script>
        function requestQuote() {
            console.log(' i m here');
            $(".add-quote").attr('disabled', 'disabled');
            $(".add-quote").html("Requesting a quote");
            // e.preventDefault();
            var user_id = $('#user_id').val();
            var product_id = $('#product_id').val();
            var email = $('#user_email').val();
            var name = $('#name').val();
            var address = $('#address').val();
            var phone = $('#phone').val();
            var discription = $('#discription').val();
            console.log('product_id', product_id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "/add-quote",
                data: {
                    'user_id': user_id,
                    'product_id': product_id,
                    'user_email': email,
                    'name': name,
                    'address': address,
                    'phone': phone,
                    'discription': discription,
                },

                success: function(response) {
                    $(".add-quote").html("Quote Requested");
                    swal("", response.status, "success");
                    setTimeout(location.reload(), 25000);
                },
                error: function(error) {
                    // $(form)
                    $(".add-quote").html("Request Quote");
                    $(".add-quote").attr('disabled', false);

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
