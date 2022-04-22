@extends('layouts.website_theme')
@section('web_title', 'Home')

@section('website_content')
    <style>
        .product-slide_item .inner-slide {
    height: auto !important;
    border: 1px solid rgb(229, 229, 229);
}

    </style>
    
    <div class="container pb-5 latest-products px-0">
        @include('website/parts/banner') 
        <div class="row">
            <div class="col-md-3 col-lg-3 col-sm-12  d-none   d-xl-block">
                <h3 class="text-center   pt-4 pb-2   text-uppercase">Latest Products</h3>
                <hr>
                           @include('website/parts/productpart') 
            </div>
            
            <div class="col-md-12 col-lg-12 col-xl-6   p-0 ">
                <div class="uren-product_area pt-0">
                    <div class="container-fluid   ">
                        <h3 class="text-center p-4 mb-0  text-uppercase  ">
                            Jdm Parts
                        </h3>
                        <hr class="mt-0">
                        <div class=" row"
                            >
                            @forelse ($parts as $item)
                                <?php
                                $count = $loop->iteration;
                                 $file_name = $item->feature_image; ?>
                                <div class="col-md-3 col-lg-2 col-xl-4 col-sm-6 col-6 pr-0">
                                    <div class="product-slide_item">
                                        <div class="inner-slide">
                                            <div class="single-product">
                                                <div class="product-img">
                                                    <a 
                                                    @if ( $item->status == 0 ) 
                                                        href="{{ url('part-detail/'.encrypt($item->id)) }}"
                                                        @elseif ( $item->status == 0 ) 
                                                        href="javascript:;"
                                                    @endif
                                                    >
                                                        <img class="primary-img"
                                                            src="{{ url('site_images/feature_image/'.$file_name) }}"
                                                            alt="{{ $item->name }}">
                                                        <img class="secondary-img"
                                                        src="{{ url('site_images/feature_image/'.$file_name) }}"
                                                            alt="{{ $item->name }}">
                                                    </a>
                                                     
                                                    @if ( $item->status == 1 ) 
                                                        <div class="sticker">
                                                            <span class="sticker">Reserved</span>
                                                        </div>
                                                        @elseif ($item->status == 2) 
                                                        <div class="sticker">
                                                            <span class="sticker-2">  Sold</span>
                                                        </div>
                                                    @endif
                                                    <div class="add-actions">
                                                        <ul>
                                                            @if ( $item->status == 0 ) 
                                                            <li>
                                                                <a class="uren-wishlist" href="{{ url('part-detail/'.encrypt($item->id)) }}" data-toggle="tooltip"
                                                                    data-placement="top" title="Reserve"
                                                                    onclick="event.preventDefault();
                                                                    document.getElementById('reserver-form_{{ $count }}').submit()"   ><i
                                                                    class="ion-android-favorite-outline"></i></a>
                                                                        <form action="{{ url('quote') }}" method="POST" class="d-none" id="reserver-form_{{ $count }}">
                                                                            @csrf
                                                                            <input type="hidden" name="part_id" value="{{ encrypt($item->id) }}">
                                                                        </form>
                                                            </li>
                                                            @endif
                                                            <li class="quick-view-btn" data-toggle="modal"
                                                                data-target="#exampleModalCenter">
                                                                <a href="{{ url('part-detail/'.encrypt($item->id)) }}" 
                                                                    data-toggle="tooltip" data-placement="top" title="View"><i
                                                                        class="fa fa-eye"></i></a></li>
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
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-6 col-sm-12   d-xl-none">
                <h3 class="text-center   pt-4 pb-2   text-uppercase">Latest Products</h3>
                <hr>
                @include('website/parts/productpart') 
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12 col-xl-3 flags_right">
                <h3 class="text-center   pt-4 pb-2 text-uppercase">Countries List</h3>
                @include('website/right-side-bar')
            </div>
        </div>
    </div>
    @include('footer.website_footer')
@endsection
