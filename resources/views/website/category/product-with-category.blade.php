
@extends('website.master')
@section('title' , "shop")


@section('content')

    <div class="category-banner-container bg-gray">
        <div class="category-banner banner text-uppercase" style="background: no-repeat 60%/cover url('website/assets/images/banners/banner-top.jpg');">
            <div class="container position-relative">
                <div class="row">
                    <div class="pl-lg-5 pb-5 pb-md-0 col-md-5 col-xl-4 col-lg-4 offset-1">
                        <h3>Electronic<br>Deals</h3>
                        <a href="category.html" class="btn btn-dark">Get Yours!</a>
                    </div>
                    <div class="pl-lg-3 col-md-4 offset-md-0 offset-1 pt-3">
                        <div class="coupon-sale-content">
                            <h4 class="m-b-1 coupon-sale-text bg-white text-transform-none">Exclusive COUPON
                            </h4>
                            <h5 class="mb-2 coupon-sale-text d-block ls-10 p-0"><i class="ls-0">UP TO</i><b class="text-dark">$100</b> OFF</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="demo4.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Men</a></li>
                <li class="breadcrumb-item active" aria-current="page">Accessories</li>
            </ol>
        </nav>

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
                        <path d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z"
                            class="cls-2"></path>
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

            <div class="toolbox-item toolbox-sort ml-lg-auto">
                <label>Sort By:</label>

                <div class="select-custom">
                    <select name="orderby" class="form-control">
                        <option value="menu_order" selected="selected">Default sorting</option>
                        <option value="popularity">Sort by popularity</option>
                        <option value="rating">Sort by average rating</option>
                        <option value="date">Sort by newness</option>
                        <option value="price">Sort by price: low to high</option>
                        <option value="price-desc">Sort by price: high to low</option>
                    </select>
                </div>
                <!-- End .select-custom -->
            </div>
            <!-- End .toolbox-item -->


        </nav>

        <div class="row main-content-wrap">
            <div class="col-lg-9 main-content">
                <div class="row">
                    @foreach ($products as $productlist)
                    <div class="col-6 col-sm-4 col-md-3">
                        <div class="product-default">
                            <figure>
                                <a href="{{url('product/'.$productlist->id)}}">
                                    <img src="{{asset($productlist->feature_image)}}" width="280" height="280" alt="product" />
                                    <img src="{{asset($productlist->feature_image)}}" width="280" height="280" alt="product" />
                                </a>

                                <div class="label-group">
                                      {{-- <div class="product-label label-hot">HOT</div> --}}
                                      @if ($productlist->discount > 0)
                                      <div class="product-label label-sale">{{ substr($productlist->discount,0,2 )}}%</div>
                                      @endif
                                </div>
                            </figure>

                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="" class="product-category">{{$productlist->category?$productlist->category->name:''}}</a>
                                    </div>
                                </div>

                                <h3 class="product-title"> <a href="{{url('product/'.$productlist->id)}}">{{$productlist->name}}</a>  </h3>

                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:100%"></span>
                                        <!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <!-- End .product-ratings -->
                                </div>
                                <!-- End .product-container -->

                                <div class="price-box" style="width: max-content;">
                                    @if ($productlist->discount > 0)
                                    <span class="old-price">{{$productlist->currency}}{{$productlist->actual_price}}</span>
                                    <span class="product-price">{{$productlist->currency}}{{$productlist->saleprice }}</span>
                                    @else
                                    <span class="product-price">{{$productlist->currency}}{{$productlist->saleprice }}</span>
                                    @endif
                                </div>
                                <!-- End .price-box -->

                                <div class="product-action">
                                    <a href="wishlist.html" class="btn-icon-wish" title="wishlist"><i
                                            class="icon-heart"></i></a>
                                    <a href="{{url('product/'.$productlist->id)}}" class="btn-icon btn-add-cart"><i
                                            class="fa fa-arrow-right"></i><span>SELECT
                                            OPTIONS</span></a>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                                </div>
                            </div>
                            <!-- End .product-details -->
                        </div>
                    </div>
                    @endforeach
                    <!-- End .col-sm-4 -->



                </div>
                <!-- End .row -->
                <div class="text-center">
                <nav class="toolbox toolbox-pagination" style="align-content: center;">


                        <ul class="pagination toolbox-item" >
                            {{ $products->links() }}
                            {{-- <li class="page-item disabled">
                                <a class="page-link page-link-btn" href="#"><i class="icon-angle-left"></i></a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#"> <span class="sr-only"></span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#"></a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><span class="page-link">...</span></li>
                            <li class="page-item">
                                <a class="page-link page-link-btn" href="#"><i class="icon-angle-right"></i></a>
                            </li> --}}
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
                            <a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true" aria-controls="widget-body-3">Price</a>
                        </h3>

                        <div class="collapse show" id="widget-body-3">
                            <div class="widget-body pb-0">
                                <form action="#">
                                    <div class="price-slider-wrapper">
                                        <div id="price-slider"></div>
                                        <!-- End #price-slider -->
                                    </div>
                                    <!-- End .price-slider-wrapper -->

                                    <div class="filter-price-action d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="filter-price-text">
                                            Price:
                                            <span id="filter-price-range"></span>
                                        </div>
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
                                            <a href="{{url('products/'.$list->id)}}">
                                                <img src="{{ $list->feature_image }}" width="75" height="75" alt="product" />
                                                <img src="{{ $list->feature_image }}" width="75" height="75" alt="product" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h3 class="product-title"> <a href="{{url('product/'.$list->id)}}">{{$list->name}}</a> </h3>
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

                                </div>
                                <!-- End .featured-col -->

@endforeach
                                <!-- End .featured-col -->
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
