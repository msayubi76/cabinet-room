<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from portotheme.com/html/porto_ecommerce/demo4.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Jul 2022 13:50:23 GMT -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <meta name="keywords" content="Cabinet Room" />
    <meta name="description" content="online ecommerce digital store">
    <meta name="author" content="Salah-ud-Din">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('website/assets/images/icons/favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>


    <script>
        WebFontConfig = {
            google: {
                families: ['Open+Sans:300,400,600,700,800', 'Poppins:300,400,500,600,700,800',
                    'Oswald:300,400,500,600,700,800'
                ]
            }
        };
        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = 'website/assets/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('website/assets/css/bootstrap.min.css') }}">

    <!--  CSS File -->
    <link rel="stylesheet" href="{{ asset('website/assets/css/style.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('website/assets/css/style.min.css') }}"> --}}

    {{-- <link rel="stylesheet" href="{{ asset('website/assets/css/demo4.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('website/assets/css/jquery.ui.css') }}">
    <link href="{{ url('admin-assets/plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,400;1,100&display=swap"
        rel="stylesheet">
    <link href="{{ url('admin-assets/plugins/slick.css') }}" rel="stylesheet">
    <link href="{{ url('admin-assets/plugins/slick-theme.css') }}" rel="stylesheet">


    <!-- Main CSS File -->

    <link rel="stylesheet" type="text/css" href="{{ asset('website/assets/vendor/fontawesome-free/css/all.min.css') }}">
    <style>
        .pagination {
            float: right;
            margin-top: 10px;
        }

        body {
            font-family: 'Montserrat', sans-serif;
        }

        .sale-items .slick-slide img {
            height: 150px !important;
        }

        .sale-items .slick-slide {
            padding-right: 4px;
        }

        .sale-items .slick-prev {
            left: -40px;
        }

        .slick-next:before,
        .slick-prev:before {
            content: '';
        }

        .slick-prev,
        .slick-next {
            font-size: 36px;
            color: black;
        }

        .slick-prev:hover,
        .slick-prev:focus,
        .slick-next:hover,
        .slick-next:focus {
            color: black;
        }

        .just-launched img,
        .shop-products img {
            height: 200px !important;
        }

        .featured-products img {
            height: 150px !important;
        }

        .categories-products img {
            height: 220px !important;
        }
        .widget-featured .widget-featured-products img{
            height: 75px;
        }
    </style>
    @yield('style')
</head>

<body class="loaded sidebar-opened">
    {{-- front --}}
    <div class="page-wrapper">

        <!-- End .top-notice -->

        @include('website.include.header')
        <!-- End .header -->

        <main>
            @yield('content')
        </main>
        <!-- End .main -->

        @include('website.include.footer')
        <!-- End .footer -->
    </div>
    <!-- End .page-wrapper -->

    <div class="loading-overlay">
        <div class="bounce-loader">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>

    <div class="mobile-menu-overlay"></div>
    <!-- End .mobil-menu-overlay -->

    @include('website.include.mobile_menu_container')
    <!-- End .mobile-menu-container -->

    @include('website.include.sticky_navbar')

    @include('website.include.newsletter_popup')
    <!-- End .newsletter-popup -->

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    <!-- Plugins JS File -->
    <script src="{{ asset('website/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/optional/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/plugins.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/jquery.plugin.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/jquery.appear.min.js') }}"></script>
    <script src="{{ url('admin-assets/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/jquery.ui.js') }}"></script>
    <script src="{{ url('admin-assets/plugins/slick.min.js') }}"></script>


    <script>
        var availableTags = [];

        $.ajax({
            method: "GET",
            url: "/product-list",

            success: function(response) {
                startAutoComplete(response);

            }
        });

        function startAutoComplete(availableTags) {
            $("#search_product").autocomplete({
                source: availableTags
            });
        }
    </script>

    <!-- Main JS File -->
    <script src="{{ asset('website/assets/js/main.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script> --}}
    @yield('scripts')
</body>


</html>
