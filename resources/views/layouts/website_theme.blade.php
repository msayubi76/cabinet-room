<!doctype html>
<html class="no-js" lang="zxx">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>JDM | @yield('web_title')</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="Salahuddin" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('site_images/logo.jpeg') }}">

    <!-- CSS
 ============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('website/css/vendor/bootstrap.min.css') }}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ url('website/css/vendor/font-awesome.css') }}">
    <!-- Fontawesome Star -->
    <link rel="stylesheet" href="{{ url('website/css/vendor/fontawesome-stars.css') }}">
    <!-- Ion Icon -->
    <link rel="stylesheet" href="{{ url('website/css/vendor/ion-fonts.css') }}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{ url('website/css/plugins/slick.css') }}">
    <!-- Animation -->
    <link rel="stylesheet" href="{{ url('website/css/plugins/animate.css') }}">
    <!-- jQuery Ui -->
    <link rel="stylesheet" href="{{ url('website/css/plugins/jquery-ui.min.css') }}">
    <!-- Lightgallery -->
    <link rel="stylesheet" href="{{ url('website/css/plugins/lightgallery.min.css') }}">
    <!-- Nice Select -->
    <link rel="stylesheet" href="{{ url('website/css/plugins/nice-select.css') }}">
    <link rel="stylesheet" href="{{ url('website/css/custom.css') }}">

    

    <!-- Main Style CSS (Please use minify version for better website load performance) -->
    <link rel="stylesheet" href="{{ url('website/css/style.css') }}">
    <!--<link rel="stylesheet" href="assets/css/style.min.css">-->

</head>

<body class="template-color-1">

    <div class="main-wrapper">


        @include('header.website_header')

        @yield('website_content')



    </div>

    <!-- JS
============================================ -->

    <!-- jQuery JS -->
    <script src="{{ url('website/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <!-- Modernizer JS -->
    <script src="{{ url('website/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <!-- Popper JS -->
    <script src="{{ url('website//js/vendor/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ url('website/js/vendor/bootstrap.min.js') }}"></script>

    <!-- Slick Slider JS -->
    <script src="{{ url('website/js/plugins/slick.min.js') }}"></script>
    <!-- Barrating JS -->
    <script src="{{ url('website/js/plugins/jquery.barrating.min.js') }}"></script>
    <!-- Counterup JS -->
    <script src="{{ url('website/js/plugins/jquery.counterup.js') }}"></script>
    <!-- Nice Select JS -->
    <script src="{{ url('website/js/plugins/jquery.nice-select.js') }}"></script>
    <!-- Sticky Sidebar JS -->
    <script src="{{ url('website/js/plugins/jquery.sticky-sidebar.js') }}"></script>
    <!-- Jquery-ui JS -->
    <script src="{{ url('website/js/plugins/jquery-ui.min.js') }}"></script>
    <script src="{{ url('website/js/plugins/jquery.ui.touch-punch.min.js') }}"></script>
    <!-- Lightgallery JS -->
    <script src="{{ url('website/js/plugins/lightgallery.min.js') }}"></script>
    <!-- Scroll Top JS -->
    <script src="{{ url('website/js/plugins/scroll-top.js') }}"></script>
    <!-- Theia Sticky Sidebar JS -->
    <script src="{{ url('website/js/plugins/theia-sticky-sidebar.min.js') }}"></script>
    <!-- Waypoints JS -->
    <script src="{{ url('website/js/plugins/waypoints.min.js') }}"></script>
    <!-- jQuery Zoom JS -->
    <script src="{{ url('website/js/plugins/jquery.zoom.min.js') }}"></script>

    <!-- Vendor & Plugins JS (Please remove the comment from below vendor.min.js & plugins.min.js for better website load performance and remove js files from avobe) -->


    <!-- Main JS -->
    <script src="{{ url('website/js/main.js') }}"></script>
    <script src="{{ url('website/js/plugins/date.format.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone.min.js"></script>
    <script src="{{ url('libs/moment/min/moment-time-zone-data.js') }}"></script>
    @yield('website_script')
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/5f898874f91e4b431ec50870/default';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();

    </script>
    <script>
        var japan_time = calculateDateTime(+9);

        document.getElementById("datetime_sticky").innerHTML = japan_time;
        document.getElementById("datetime").innerHTML = japan_time;
        document.getElementById("mobileDatetime").innerHTML = japan_time;


        function calculateDateTime(offset) {
            var date = new Date();
            var localTime = date.getTime();
            var localOffset = date.getTimezoneOffset() * 60000;
            var utc = localTime + localOffset;
            var newDateTime = utc + (3600000 * offset);
            var convertedDateTime = new Date(newDateTime);

            return dateFormat(convertedDateTime, "dddd, mmmm dS, yyyy, h:MM TT");
        }

        $(document).on('click', '.search-by-country', function(e) {

            var url = $(this).data('url');
            console.log("url: " + url)
            window.location.href = url;
        });
        $('.search-by-country').click(function() {
            window.location = $(this).data('url');
        });

    </script>

</body>

</html>
