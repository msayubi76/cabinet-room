<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from portotheme.com/html/porto_ecommerce/demo4.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Jul 2022 13:50:23 GMT -->
@include('website.inc.head')

<body>
    {{-- front --}}
    <div class="page-wrapper">
        <div class="top-notice bg-primary text-white">
            <div class="container text-center">
                <h5 class="d-inline-block">Get Up to <b>40% OFF</b> New-Season Styles</h5>
                <a href="category.html" class="category">MEN</a>
                <a href="category.html" class="category ml-2 mr-3">WOMEN</a>
                <small>* Limited time only.</small>
                <button title="Close (Esc)" type="button" class="mfp-close">×</button>
            </div>
            <!-- End .container -->
        </div>
        <!-- End .top-notice -->

        @include('website.inc.header')
        <!-- End .header -->

        <main>
            @yield('content')
         </main>
        <!-- End .main -->

        @include('website.inc.footer')
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

   @include('website.inc.mobile_menu_container')
    <!-- End .mobile-menu-container -->

    @include('website.inc.sticky_navbar')

    @include('website.inc.newsletter_popup')
    <!-- End .newsletter-popup -->

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    <!-- Plugins JS File -->
    <script src="{{ asset('website/assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('website/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('website/assets/js/optional/isotope.pkgd.min.js')}}"></script>
    <script src="{{ asset('website/assets/js/plugins.min.js')}}"></script>
    <script src="{{ asset('website/assets/js/jquery.appear.min.js')}}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('website/assets/js/main.min.js')}}"></script>
</body>


<!-- Mirrored from portotheme.com/html/porto_ecommerce/demo4.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Jul 2022 13:50:31 GMT -->
</html>
