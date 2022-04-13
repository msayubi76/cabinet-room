@extends('layouts.website_theme')
@section('web_title', 'Home')

@section('website_content')
    <style>
        .product-slide_item .inner-slide {
    height: auto !important;
    border: 1px solid rgb(229, 229, 229);
}

    </style>
    <div class="container-fluid pb-5  ">
        <div class="row"> 
           
            <div class="col-md-6 qty-btn_area"> 
                @role('Customer')  
                    @if ($part->status == 0 )
                        <form action="{{url('quote')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="part_id" value="{{encrypt($part->id)}}">
                            <input type="submit" class="btn  qty-cart_btn float-right" style="background: #0c2a5c;
                            color: white;" value="Reserve Now">
                        </form> 
                    @endif
                @endrole 
            </div>
        </div>
        <div class="sp-nav">
            <div class="row"> 
                <div class="col-lg-5 col-xl-5  col-md-12  ">
                    <div class="carlist-item-subheader text-uppercase">
                        <h4>
                            <a data-toggle="modal"  data-target=".contactModal" class="ask text-center" href="javascript:;">Contact us for any query</a>
                        </h4>     
                   </div>
                   <hr>
                    <div class="sp-img_area">
                        <div class="sp-img_slider slick-img-slider uren-slick-slider" data-slick-options='{
                        "slidesToShow": 1,
                        "arrows": false,
                        "fade": true,
                        "draggable": false,
                        "swipe": false,
                        "asNavFor": ".sp-img_slider-nav"
                        }'>
                         
                            @foreach ($files as $file)
                                <div class="single-slide red zoom"> 
                                    <img class="product-img" src="{{url('site_images/jdm_parts/'.$file->file)}}" height="407px" alt="Product Image">
                                </div>
                            @endforeach
 
                        </div>
                        <div class="sp-img_slider-nav slick-slider-nav uren-slick-slider slider-navigation_style-3" data-slick-options='{
                        "slidesToShow": 3,
                        "asNavFor": ".sp-img_slider",
                        "focusOnSelect": true,
                        "arrows" : true,
                        "spaceBetween": 30
                        }' data-slick-responsive='[ 
                                {"breakpoint":992, "settings": {"slidesToShow": 4}},
                                {"breakpoint":768, "settings": {"slidesToShow": 3}},
                                {"breakpoint":575, "settings": {"slidesToShow": 2}}
                            ]'>
                            @foreach ($files as $file)
                                <div class="single-slide red">
                                    <img src="{{url('site_images/jdm_parts/'.$file->file)}}"  height="98px"  alt="JDM Product">
                                </div>
                            @endforeach
                             
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-xl-4  col-md-12  ">
                    <section id="quick-summary" class="clearfix">
                        <h4 class="text-uppercase">Part Detail</h4>
                        <hr>
                        <dl>
                            <dt>Name</dt>
                                <dd>{{ $part->name }}</dd>
                            <dt>Price</dt>
                                <dd><span class="badge badge-info">{{ $part->currency_type }} {{ $part->price }}</span></dd>
                            <dt>Product:</dt>
                                <dd>{{ $part->product }}</dd>
                            <dt>Part Category:</dt>
                            <dd>{{ $part_category?$part_category->name:'' }}</dd>
                             
                            <div><strong>Part Detail:</strong></div>
                            <div class="w-100">{{ $part->part_detail }}</div> 
                                 
                                @if ($part->status == 0 )
                                    <form action="{{url('quote')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="part_id" value="{{encrypt($part->id)}}">
                                        <input type="submit" class="btn  qty-cart_btn float-right text-uppercase" style="background: #0c2a5c;
                                        color: white;" value="Reserve">
                                    </form> 
                                @endif 
                        </dl>
                    </section>
                </div>
                <div class="col-md-3 col-lg-3">
                    <h5 class="text-uppercase">Jdm Export Countries</h5>
                    <hr>
                    @include('website/right-side-bar')
                </div>

                
            </div>
        </div>
    </div>
    @include('footer.website_footer')
    @include('website/ask-dialog')
@endsection
