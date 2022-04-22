@extends('layouts.website_theme')
@section('web_title', 'Product Detail')

@section('website_content')
    <style>
        table tr td {
            text-transform: capitalize;
            border-top: 0px !important;
        }

        .sp-area {
            padding: 20px 0 0;
        }

        .text-black {
            color: #000000;
        }

        .loader {
            width: 100px;

            border-radius: 100%;
            position: relative;
            margin: 0 auto;
        }

        @keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        #loader-4 span {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 100%;
            background-color: #dc4768;
            margin: 5px 0px;
            opacity: 0;
        }

        #loader-4 span:nth-child(1) {
            animation: opacitychange 1s ease-in-out infinite;
        }

        #loader-4 span:nth-child(2) {
            animation: opacitychange 1s ease-in-out 0.33s infinite;
        }

        #loader-4 span:nth-child(3) {
            animation: opacitychange 1s ease-in-out 0.66s infinite;
        }

        @keyframes opacitychange {

            0%,
            100% {
                opacity: 0;
            }

            60% {
                opacity: 1;
            }
        }

        #customerList ul {
            border-radius: 0px;
            padding: 0px;
            margin: 0px;
        }

        #customerList ul li {
            border-bottom: 1px solid gray;
            text-transform: capitalize;
        }

        .row {
            color: #000000;
        }

        .prod-detail div {
            margin: 5px 0px;
        }

        @media only screen and (max-width:430px) {
            .product-img {
                height: 280px;
            }
        }

    </style>
    <div class="sp-area">

        <div class="container-fluid">

            <div class="row">
                <div class="{{ $product->is_damage?"col-md-4":"col-md-6" }}  ">
                    <h3>Product Detail</h3>
                </div>
                <div class="col-md-2">
                    <div class="carlist-item-subheader text-uppercase">
                        <a data-toggle="modal" data-target=".contactModal" class="ask" href="javascript:;">Ask for any
                            query.</a>
                    </div>
                </div>
                @if ($product->is_damage)
                    <div class="col-md-2 text-right">
                        <span class="badge badge-warning p-2">Damage Product</span>
                    </div>
                @endif
                <div class="col-md-4 qty-btn_area">
                    @role('Super Admin')
                    <input type="button" data-toggle="modal" data-target="#reserveProductModal"
                        class="btn  qty-cart_btn float-right text-white text-uppercase" value="Reserve Now">
                    @endrole
                    @role('Customer')
                    @if ($product->status == 0)
                        <form action="{{ url('quote') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ encrypt($product->id) }}">
                            <input type="submit" class="btn  qty-cart_btn float-right text-uppercase" style="background: #0c2a5c;
                                color: white;" value="Reserve Now">
                        </form>
                    @endif
                    @endrole
                </div>
            </div>
            <div class="sp-nav">
                <div class="row">
                    <div class="col-lg-12 col-xl-5  col-md-12 mx-auto">
                        <div class="sp-img_area">
                            <div class="sp-img_slider slick-img-slider uren-slick-slider" data-slick-options='{
                            "slidesToShow": 1,
                            "arrows": false,
                            "fade": true,
                            "draggable": false,
                            "swipe": false,
                            "asNavFor": ".sp-img_slider-nav"
                            }'>
                                <?php $files = $product->getMedia($product->id, 'products'); ?>
                                @foreach ($files as $file)
                                    <div class="single-slide red zoom">
                                        <img class="product-img" src="{{ url('site_images/products/' . $file->file) }}"
                                            height="407px" alt="Product Image">
                                    </div>
                                @endforeach

                            </div>
                            <div class="sp-img_slider-nav slick-slider-nav uren-slick-slider slider-navigation_style-3"
                                data-slick-options='{
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
                                        <img src="{{ url('site_images/products/' . $file->file) }}" height="98px"
                                            alt="JDM Product">
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-xl-7 ">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <div class="row prod-detail">
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Category:
                                    </strong>{{ $product->getCategory ? $product->getCategory->name : '' }}
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Sub Category:
                                    </strong>{{ $product->getSubCategory ? $product->getSubCategory->name : '' }}
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Price: </strong>{{ $product->price . ' $ ' }}
                                </div>

                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Chassis No: </strong>{{ $product->chassis_no }}
                                </div>

                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>CC: </strong>{{ $product->cc }}
                                </div>

                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Make: </strong>{{ $product->make }}
                                </div>

                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Model: </strong>{{ $product->model }}
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Package: </strong>
                                    {{ $product->package }}
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Year: </strong>{{ $product->year }}
                                </div>

                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Seats: </strong> {{ $product->seats }}
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Hybrid / Petrol/Diesel: </strong>{{ $product->hybrid_petrol_diesel }}
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>2Wd / 4Wd: </strong>{{ $product->_wd_4wd }}
                                </div>

                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Mileage: </strong>{{ $product->mileage }}
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Transmission: </strong>{{ $product->transmission }}
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Power Window: </strong>{{ $product->power_window }}
                                </div>

                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Power Stearing: </strong>{{ $product->power_stearing }}
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Ac /Aac: </strong>{{ $product->ac_aac }}
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Navigation / Tc/Dvd: </strong>{{ $product->navigation_tc_dvd }}
                                </div>

                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Steering Audio Controls: </strong><br>{{ $product->steering_audio_controls }}
                                </div>
                                <div class="col-lg-4 col-sm-3 col-2">
                                    <strong>Cruise Controls: </strong>{{ $product->cruise_controls }}
                                </div>
                                <div class="col-lg-4  col-sm-4 col-12">
                                    <strong>Paddle Shifters: </strong>{{ $product->paddle_shifters }}
                                </div>

                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Key Start / Push Start: </strong>{{ $product->key_start_push_start }}
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Alloys: </strong>{{ $product->alloys }}
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Fog: </strong>{{ $product->fog }}
                                </div>

                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Rear Spoiler: </strong>{{ $product->rear_spoiler }}
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Aero Kit: </strong>{{ $product->aero_kit }}
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Leather Seats: </strong>{{ $product->leather_seats }}
                                </div>

                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Back Camera: </strong>{{ $product->back_camera }}
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Bumper Sensors: </strong>{{ $product->bumper_sensors }}
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Sunroof Penoramic: </strong>{{ $product->sunroof_penoramic }}
                                </div>

                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Retractable Side Mirrors: </strong>{{ $product->retractable_side_mirrors }}
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Keyless Entry: </strong>{{ $product->keyless_entry }}
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>Back Tyre: </strong>{{ $product->back_tyre }}
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <strong>ABS: </strong>{{ $product->abs }}
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <strong>Description: </strong>
                                    <div>
                                        {{ $product->description }}
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
            @role('Super Admin')
            <div class="modal fade" id="reserveProductModal" tabindex="-1" role="dialog"
                aria-labelledby="reserveProductModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">

                    <div class="modal-content">
                        <form class="custom-validation" action="{{ url('quote') }}" id="productReserveForm" role="form"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="reserveProductModalLabel">Resever Product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>

                                <input type="hidden" name="product_id" value="{{ encrypt($product->id) }}">
                                <div class="form-group mb-0">
                                    <label for="recipient-name" class="col-form-label text-black">Search Customer</label>
                                    <input type="hidden" name="customer_id" id="customer_id">
                                    <input type="hidden" name="reserve_by_admin" value="1">
                                    <input type="text" autocomplete="false" placeholder="Customer id/Customer name"
                                        name="customerSearch" class="form-control" id="customerSearch">
                                    <div id="customerList" class="dropdown text-center">

                                        <div class="col-md-2 bg" id="customer_loader" style="display: none">
                                            <div class="loader" id="loader-4">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label text-black">Product Actual Price
                                        ($)</label>
                                    <input type="number" min="1" value="{{ $product->price }}" class="form-control"
                                        placeholder="Product Actual Price ($)" readonly id="product_actual_price">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label text-black">Customer Product Price
                                        ($)</label>
                                    <input type="number" min="1" value="{{ $product->price }}"
                                        placeholder="Customer Product Price ($)" class="form-control"
                                        name="customer_product_price" id="customer_product_price">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Reserver Now</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            @endrole
        </div>
    </div>
    @include('footer.website_footer')
    @include('website/ask-dialog')
@endsection
@section('website_script')
    <script>
        $(document).ready(function() {
            $('#customerSearch').keyup(function() {

                var query = $(this).val();
                if (query != '') {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ url('find_customer') }}",
                        beforeSend: function() {
                            $("#customer_loader").fadeIn();
                            $("#customerList ul").fadeOut();
                        },
                        method: "POST",
                        data: {
                            query: query
                        },
                    }).done(function(response) {
                        if (response.success) {
                            $("#customer_loader").fadeOut();
                            $('#customerList').fadeIn();
                            $('#customerList ul').fadeIn();
                            $('#customerList').html(response.html);
                        } else {
                            $("#customer_loader").fadeOut();
                            alert("Something want wrong");
                        }
                    }).fail(function(error) {
                        $("#customer_loader").fadeOut();
                        alert(error);
                    });
                }
            });
        });

        $(document).on('click', 'li', function() {
            var customer_id = $(this).data('customer_id')
            $('#customerSearch').val($(this).text());
            $('#customer_id').val(customer_id);
            $('#customerList').fadeOut();
        });

    </script>
@endsection
