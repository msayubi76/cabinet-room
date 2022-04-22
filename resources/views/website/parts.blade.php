@extends('layouts.website_theme')
@section('web_title', 'Home')

@section('website_content')
    <style>
        .product-slide_item .inner-slide {
    height: auto !important;
    border: 1px solid rgb(229, 229, 229);
}

    </style>
    <div class="container-fluid pb-5 latest-products">
        <div class="row">
            <div class="col-md-9 col-lg-9 col-sm-12 p-0">
                <div class="uren-product_area pt-0">
                    <div class="container-fluid   ">
                        <h3 class="text-center p-4 mb-0  text-uppercase  ">
                            Jdm Parts
                        </h3>
                        <hr class="mt-0">
                        <div class=" row"
                            >
                            @forelse ($parts as $item)
                                <?php $file_name = $item->feature_image; ?>
                                <div class="col-md-4 col-lg-3 col-xl-3 col-sm-2">
                                    <div class="product-slide_item">
                                        <div class="inner-slide">
                                            <div class="single-product">
                                                <div class="product-img">
                                                    <a href="{{ url('part-detail/'.encrypt($item->id)) }}">
                                                        <img class="primary-img"
                                                            src="{{ url('site_images/jdm_parts/'.$file_name) }}"
                                                            alt="{{ $item->name }}">
                                                        <img class="secondary-img"
                                                        src="{{ url('site_images/jdm_parts/'.$file_name) }}"
                                                            alt="{{ $item->name }}">
                                                    </a>
                                                    <div class="sticker">
                                                        <span class="sticker">Reserved</span>
                                                    </div>
                                                    @if ($item->status == 1) 
                                                        <div class="sticker">
                                                            <span class="sticker">Reserved</span>
                                                        </div>
                                                        @elseif ($item->status == 2) 
                                                        <div class="sticker">
                                                            <span class="sticker-2">Recently Sold</span>
                                                        </div>
                                                    @endif
                                                    <div class="add-actions">
                                                        <ul>
                                                            
                                                            <li><a class="uren-wishlist" href="{{ url('part-detail/'.encrypt($item->id)) }}" data-toggle="tooltip"
                                                                    data-placement="top" title="Reserve"><i
                                                                        class="fa fa-heart"></i></a>
                                                            </li>
                                                             
                                                            <li class="quick-view-btn" data-toggle="modal"
                                                                data-target="#exampleModalCenter">
                                                                <a href="{{ url('part-detail/'.encrypt($item->id)) }}" 
                                                                    data-toggle="tooltip" data-placement="top" title="View"><i
                                                                        class="fa-eye-dropper"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <div class="product-desc_info">
                                                       
                                                        <h6><a class="product-name" href="{{ url('part-detail/'.encrypt($item->id)) }}">
                                                            {{$item->name}}</a></h6>
                                                        <div class="price-box">
                                                            <span class="new-price">  {{$item->currency_type}} {{$item->price}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-md-12 col-lg-12">
                                    <h5 class="text-center">
                                        Products not found.
                                    </h5>
                                </div>
                            @endforelse
                          

                        </div>
                        <div class="row pl-3 pr-3  product-row">


                        </div>
                        <div class="row">

                            <div class="col-md-12 paginate">

                                {{ $parts->links() }}

                            </div>
                        </div>
                        <div class="row ">
                            @if (count($parts) >= 10)
                                <div class="col-md-12 mb-2 mt-2">
                                    <hr>
                                    <div class="uren-btn-ps_left" style=" float: right;">
                                        <a href="{{ url('products') }}" tabindex="0">View All</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-12 flags_right">
                <h6 class="text-center   pt-4 pb-4 p text-uppercase">JDM Export Countries List</h6>
                @include('website/right-side-bar')
            </div>
        </div>
    </div>
    @include('footer.website_footer')
@endsection
