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

            <div class="row">
                <div class="col-lg-5 col-md-6 product-single-gallery">
                    <div class="product-slider-container">
                        <div class="label-group">

                                {{-- <div class="product-label label-hot">HOT</div> --}}
                                @if ($product->discount > 0)
                                <div class="product-label label-sale">{{ substr($product->discount,0,2 )}}%</div>
                                @endif


                        </div>

                        <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">

                                <div class="product-item">




                                    <img class="product-single-image" src="{{ $product->feature_image }}"
                                        data-zoom-image="{{ $product->feature_image }}" width="468" height="468"
                                        alt="product" />

                                </div>


                        </div>
                        <!-- End .product-single-carousel -->
                        <span class="prod-full-screen">
                            <i class="icon-plus"></i>
                        </span>
                    </div>

                    <div class="prod-thumbnail owl-dots">
                        @foreach ($product->images as $image)
                            <div class="owl-dot">
                                <img src="{{ $image->url }}" width="110" height="110" alt="product-thumbnail" />
                            </div>
                        @endforeach

                    </div>
                </div>
                <!-- End .product-single-gallery -->

                <div class="col-lg-7 col-md-6 product-single-details">
                    <h1 class="product-title">{!! $product->name !!}</h1>

                  


                    {{-- <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:60%"></span>
                            <!-- End .ratings -->
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <!-- End .product-ratings -->

                        <a href="#" class="rating-link">( 6 Reviews )</a>
                    </div> --}}
                    <!-- End .ratings-container -->

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
                        <p>
                            {{-- {!! $product->short_description !!} --}}
                        </p>
                    </div>
                    <!-- End .product-desc -->

                    <ul class="single-info-list">

                        {{-- <li>
                            SKU: <strong>654613612</strong>
                        </li> --}}

                        <li>
                            CATEGORY: <strong><a href="#"
                                    class="product-category">{!! $product->category?$product->category->name:'' !!}</a></strong>
                        </li>
{{--
                        <li>
                            TAGs: <strong><a href="#" class="product-category">CLOTHES</a></strong>,
                            <strong><a href="#" class="product-category">SWEATER</a></strong>
                        </li> --}}
                    </ul>

                    <div class="product-action">
                        <input type="hidden" value="{{ $product->id }}" class="product_id">
                        <div class="product-single-qty">
                            <input class="horizontal-quantity form-control" name="quantity" type="text">
                        </div>
                        <!-- End .product-single-qty -->
                        @if(Auth::user())
                        <a class="btn btn-dark add-cart mr-2" title="Add to Cart" >Add to
                            Cart</a>

                        <a href="{{ url('cart') }}" class="btn btn-gray view-cart d-none">View cart</a>
                        @else
                        <a class="btn btn-dark add-cart mr-2" title="Add to Cart" data-toggle="modal" data-target="#loginModal">Add to
                            Cart</a>
                        @endif

                    </div>
                    <!-- End .product-action -->

                    <hr class="divider mb-0 mt-0">

                    <div class="product-single-share mb-3">
                        <label class="sr-only">Share:</label>

                        <div class="social-icons mr-2">
                            <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"
                                title="Facebook"></a>
                            <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"
                                title="Twitter"></a>
                            <a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank"
                                title="Linkedin"></a>
                            <a href="#" class="social-icon social-gplus fab fa-google-plus-g" target="_blank"
                                title="Google +"></a>
                            <a href="#" class="social-icon social-mail icon-mail-alt" target="_blank"
                                title="Mail"></a>
                        </div>
                        <!-- End .social-icons -->

                        {{-- <a href="wishlist.html" class="btn-icon-wish add-wishlist" title="Add to Wishlist"><i
                                class="icon-wishlist-2"></i><span>Add to
                                Wishlist</span></a> --}}
                    </div>
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

                <li class="nav-item">
                    <a class="nav-link" id="product-tab-tags" data-toggle="tab" href="#product-tags-content"
                        role="tab" aria-controls="product-tags-content" aria-selected="false">Additional
                        Information</a>
                </li>

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

                {{-- <div class="tab-pane fade" id="product-size-content" role="tabpanel" aria-labelledby="product-tab-size">
                    <div class="product-size-content">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="assets/images/products/single/body-shape.png" alt="body shape" width="217"
                                    height="398">
                            </div>
                            <!-- End .col-md-4 -->

                            <div class="col-md-8">
                                <table class="table table-size">
                                    <thead>
                                        <tr>
                                            <th>SIZE</th>
                                            <th>CHEST(in.)</th>
                                            <th>WAIST(in.)</th>
                                            <th>HIPS(in.)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>XS</td>
                                            <td>34-36</td>
                                            <td>27-29</td>
                                            <td>34.5-36.5</td>
                                        </tr>
                                        <tr>
                                            <td>S</td>
                                            <td>36-38</td>
                                            <td>29-31</td>
                                            <td>36.5-38.5</td>
                                        </tr>
                                        <tr>
                                            <td>M</td>
                                            <td>38-40</td>
                                            <td>31-33</td>
                                            <td>38.5-40.5</td>
                                        </tr>
                                        <tr>
                                            <td>L</td>
                                            <td>40-42</td>
                                            <td>33-36</td>
                                            <td>40.5-43.5</td>
                                        </tr>
                                        <tr>
                                            <td>XL</td>
                                            <td>42-45</td>
                                            <td>36-40</td>
                                            <td>43.5-47.5</td>
                                        </tr>
                                        <tr>
                                            <td>XXL</td>
                                            <td>45-48</td>
                                            <td>40-44</td>
                                            <td>47.5-51.5</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End .row -->
                    </div>
                    <!-- End .product-size-content -->
                </div> --}}
                <!-- End .tab-pane -->

                <div class="tab-pane fade" id="product-tags-content" role="tabpanel" aria-labelledby="product-tab-tags">
                    <table class="table table-striped mt-2">
                        <tbody>
                            {{-- <tr>
                                <th>Weight</th>
                                <td>23 kg</td>
                            </tr> --}}

                            <tr>
                                <th>Width</th>
                                <td>{!! $product->width !!}</td>
                            </tr>
                            <tr>
                                <th>Length</th>
                                <td>{!! $product->length !!}</td>
                            </tr>

                            <tr>
                                <th>Color</th>
                                <td>{!! $product->colour !!}</td>
                            </tr>

                            {{-- <tr>
                                <th>Size</th>
                                <td>Large, Medium, Small</td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
                <!-- End .tab-pane -->

                {{-- <div class="tab-pane fade" id="product-reviews-content" role="tabpanel"
                    aria-labelledby="product-tab-reviews">
                    <div class="product-reviews-content">
                        <h3 class="reviews-title">1 review for Men Black Sports Shoes</h3>

                        <div class="comment-list">
                            <div class="comments">
                                <figure class="img-thumbnail">
                                    <img src="assets/images/blog/author.jpg" alt="author" width="80"
                                        height="80">
                                </figure>

                                <div class="comment-block">
                                    <div class="comment-header">
                                        <div class="comment-arrow"></div>

                                        <div class="ratings-container float-sm-right">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:60%"></span>
                                                <!-- End .ratings -->
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <!-- End .product-ratings -->
                                        </div>

                                        <span class="comment-by">
                                            <strong>Joe Doe</strong> – April 12, 2018
                                        </span>
                                    </div>

                                    <div class="comment-content">
                                        <p>Excellent.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="divider"></div>

                        <div class="add-product-review">
                            <h3 class="review-title">Add a review</h3>

                            <form action="#" class="comment-form m-0">
                                <div class="rating-form">
                                    <label for="rating">Your rating <span class="required">*</span></label>
                                    <span class="rating-stars">
                                        <a class="star-1" href="#">1</a>
                                        <a class="star-2" href="#">2</a>
                                        <a class="star-3" href="#">3</a>
                                        <a class="star-4" href="#">4</a>
                                        <a class="star-5" href="#">5</a>
                                    </span>

                                    <select name="rating" id="rating" required="" style="display: none;">
                                        <option value="">Rate…</option>
                                        <option value="5">Perfect</option>
                                        <option value="4">Good</option>
                                        <option value="3">Average</option>
                                        <option value="2">Not that bad</option>
                                        <option value="1">Very poor</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Your review <span class="required">*</span></label>
                                    <textarea cols="5" rows="6" class="form-control form-control-sm"></textarea>
                                </div>
                                <!-- End .form-group -->


                                <div class="row">
                                    <div class="col-md-6 col-xl-12">
                                        <div class="form-group">
                                            <label>Name <span class="required">*</span></label>
                                            <input type="text" class="form-control form-control-sm" required>
                                        </div>
                                        <!-- End .form-group -->
                                    </div>

                                    <div class="col-md-6 col-xl-12">
                                        <div class="form-group">
                                            <label>Email <span class="required">*</span></label>
                                            <input type="text" class="form-control form-control-sm" required>
                                        </div>
                                        <!-- End .form-group -->
                                    </div>

                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="save-name" />
                                            <label class="custom-control-label mb-0" for="save-name">Save my
                                                name, email, and website in this browser for the next time I
                                                comment.</label>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary" value="Submit">
                            </form>
                        </div>
                        <!-- End .add-product-review -->
                    </div>
                    <!-- End .product-reviews-content -->
                </div> --}}
                <!-- End .tab-pane -->
            </div>
            <!-- End .tab-content -->
        </div>
        <!-- End .product-single-tabs -->

        <div class="products-section pt-0">
            <h2 class="section-title">Related Products</h2>

            <div class="products-slider owl-carousel owl-theme dots-top dots-small">
                @foreach ($relatedProducts as $product_item )


                <div class="product-default">
                    <figure>
                        <a href="{{url('product/'.$product_item->id)}}">
                            <img src="{{asset($product_item->feature_image)}}" width="280" height="280"
                                alt="product">
                            <img src="{{asset($product_item->feature_image)}}" width="280" height="280"
                                alt="product">
                        </a>
                        <div class="label-group">
                              {{-- <div class="product-label label-hot">HOT</div> --}}
                              @if ($product_item->discount > 0)
                              <div class="product-label label-sale">{{ substr($product_item->discount,0,2 )}}%</div>
                              @endif
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="" class="product-category">{{$product_item->category?$product_item->category->name:''}}</a>
                        </div>
                        <h3 class="product-title">
                            <a href="{{url('product/'.$product_item->id)}}">{{$product_item->name}}</a>
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
                            @if ($product_item->discount > 0)
                            <del class="old-price">{{$product_item->currency}}{{$product_item->actual_price}}</del>
                            <span class="product-price">{{$product_item->currency}}{{$product_item->saleprice }}</span>
                            @else
                            <span class="product-price">{{$product_item->currency}}{{$product_item->saleprice }}</span>
                            @endif

                        </div>
                        <!-- End .price-box -->
                        <div class="product-action">

                            <a href="{{ url('cart') }}" class="btn-icon btn-add-cart"><i
                                    class="fa fa-arrow-right"></i><span>SELECT
                                    OPTIONS</span></a>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i
                                    class="fas fa-external-link-alt"></i></a>
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
                @foreach ($latestPoductsFooter as $list)
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
                @foreach ($latestPoductsFooter as $list)
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
    <!-- End .container -->




<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style=" width: 400px;
    margin: auto;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"><b>Welcome! Please Login to continue.</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-title text-center">
              <h4>Login</h4>
            </div>
            <div class="d-flex flex-column text-center">
                <form class="form-valide" id="subcategory-form" method="post" action="{{ route('login') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <input type="email" name="email" class="form-control" id="email1"placeholder="Your email address...">
                  @error('email')
                  <span class="text-danger" role="alert">
                      {{ $message }}
                  </span>
              @enderror
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control" id="password1" placeholder="Your password...">
                  @error('password')
                  <span class="text-danger " role="alert">
                    {{ $message }}
                  </span>
              @enderror
                </div>
                <button type="submit" class="btn btn-info btn-block btn-round">Login</button>
              </form>

              <div class="text-center text-muted delimiter">or use a social network</div>
              <div class="d-flex justify-content-center social-buttons">
                <button type="button" class="btn btn-gray btn-round" data-toggle="tooltip" data-placement="top" title="Twitter">
                  <i class="fab fa-twitter"></i>
                </button>
                <button type="button" class="btn btn-gray btn-round" data-toggle="tooltip" data-placement="top" title="Facebook">
                  <i class="fab fa-facebook"></i>
                </button>
                <button type="button" class="btn btn-gray btn-round" data-toggle="tooltip" data-placement="top" title="Linkedin">
                  <i class="fab fa-linkedin"></i>
                </button>
              </div>
            </div>
          </div>
          <div class="modal-footer d-flex justify-content-center">
            <div class="signup-section">Not a member yet? <a href="{{ url('register') }}" class="text-info"> Sign Up</a>.</div>
          </div>
      </div>
    </div>
  </div>


@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.add-cart').click(function(e) {
                e.preventDefault();
                var product_id = $(this).closest('.product_data').find('.product_id').val();
                var quantity = $(this).closest('.product_data').find('.horizontal-quantity').val();


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
                    },

                    success: function(response) {

                        swal("", response.status, "success");
                    }
                });

            });
        });
    </script>
@endsection

