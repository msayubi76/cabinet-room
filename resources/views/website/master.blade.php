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
    <link href="{{ url('admin-assets/plugins/custom.css') }}" rel="stylesheet">


    <!-- Main CSS File -->

    <link rel="stylesheet" type="text/css" href="{{ asset('website/assets/vendor/fontawesome-free/css/all.min.css') }}">
    <style>

    </style>
    @yield('style')
</head>

<body class="loaded ">
    <div id="loader-wrapper">
        <div id="loader"></div>
    </div>
    {{-- front --}}
    <div class="page-wrapper">

        <!-- End .top-notice -->

        @include('website.include.header')
        <!-- End .header -->

        <main>
            @yield('content')
        </main>
        <!-- End .main -->
        <a href="https://wa.me/923320313159" target="_blank" class=" rounded-circle position-fixed"
            style="width: 40px;
                    height: 40px;
                    bottom: 51px;
                    right: 30px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    z-index: 999;"
            title="Chat with us on WhatsApp">
            <img src="/images/whatsapp.svg" alt="" height="30px">

        </a>
        @include('website.include.footer')
        <!-- End .footer -->
    </div>
    <!-- End .page-wrapper -->



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

        // Show loader
        function showLoader() {
            document.getElementById('loader-wrapper').style.display = 'flex';
        }

        // Hide loader
        function hideLoader() {
            document.getElementById('loader-wrapper').style.display = 'none';
        }

        // Call showLoader() when page starts loading
        showLoader();

        // Call hideLoader() when page finishes loading
        window.addEventListener('DOMContentLoaded', hideLoader);
    </script>

    <!-- Main JS File -->
    <script src="{{ asset('website/assets/js/main.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script> --}}

    <script>
        function openDeleteDialog(id) {
            $("#deleteID").val(id);
            $("#deleteModal").modal('show');
        }

        function deleteCartItem() {
            $("#button-delete").text('Loading...');
            $("#button-delete").attr('disabled', true);
            // alert(product_id);
            var product_id = $('#deleteID').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "GET",
                url: "/delete",
                data: {
                    'product_id': product_id,
                },

                success: function(response) {
                    $("#button-delete").html("Yes");
                    $("#button-delete").attr('disabled', false);
                    window.location.reload();
                    // alert(response);
                    swal("", response.message, "success");
                },
                error: function(error) {
                    // $(form)
                    $("#button-delete").html("Yes");
                    $("#button-delete").attr('disabled', false);

                    var errorMessage = error.statusText;
                    var sweetMessage = error.statusText;

                    swal({
                        title: "Error",
                        text: sweetMessage,
                        icon: "error",
                    });

                },
            });
        }

        $(document).ready(function() {

            $('.update-cart').click(function(e) {
                e.preventDefault();

                var product_id = $(this).closest('.product_data').find('.product_id').val();
                var quantity = $(this).closest('.product_data').find('.horizontal-quantity').val();


                data = {
                    'product_id': product_id,
                    'quantity': quantity,
                }


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }

                });
                $.ajax({
                    method: "POST",
                    url: "/update",
                    data: data,

                    success: function(response) {
                        // window.location.reload();
                        console.log('response', response.data);
                        // toster.success("", response.status, "success");
                        swal({
                            title: "Success",
                            text: response.message,
                            icon: "success",
                        });
                    }
                });



            });
        });
    </script>
    @yield('scripts')
</body>


</html>
