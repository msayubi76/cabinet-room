<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>CABINET ROOM | @yield('title')</title>
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('admin-assets/images/favicon.png') }}">
    <!-- Pignose Calender -->
    <link href="{{ url('admin-assets/plugins/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{ url('admin-assets/plugins/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin-assets/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css') }}">
    <link rel="stylesheet" href="{{ url('admin-assets/plugins/highlightjs/styles/darkula.css') }}">

       {{-- -- Summernote link -- --}}
       <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
       <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <link href="{{ url('admin-assets/plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="{{ url('admin-assets/css/style.css') }}" rel="stylesheet">

    <script>
        var base_url = '{{ url('/') }}';
    </script>
</head>

<body>
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <div id="main-wrapper">
        @include('header.header')
        @include('sidebar.sidebar')
        <div class="content-body">
            @yield('content')
        </div>
        @include('footer.footer')


    </div>


    <!--**********************************
        Scripts
    ***********************************-->



    <script src="{{ url('admin-assets/plugins/common/common.min.js') }}"></script>
    <script src="{{ url('admin-assets/js/custom.min.js') }}"></script>
    <script src="{{ url('admin-assets/js/settings.js') }}"></script>
    <script src="{{ url('admin-assets/js/gleek.js') }}"></script>
    <script src="{{ url('admin-assets/js/styleSwitcher.js') }}"></script>

    <script src="{{ url('admin-assets/plugins/highlightjs/highlight.pack.min.js') }}"></script>
    <script>
        hljs.initHighlightingOnLoad();
    </script>



    {{-- datatables --}}
    {{-- <script src="{{ url('admin-assets/plugins/tables/js/jquery.dataTables.min.js') }}"></script>
     <script src="{{ url('admin-assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
     <script src="{{ url('admin-assets/plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>--}}
    <!-- Chartjs -->
    <script src="{{ url('admin-assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Circle progress -->
    <script src="{{ url('admin-assets/plugins/circle-progress/circle-progress.min.js') }}"></script>
    <!-- Datamap -->
    <script src="{{ url('admin-assets/plugins/d3v3/index.js') }}"></script>
    <script src="{{ url('admin-assets/plugins/topojson/topojson.min.js') }}"></script>
    <script src="{{ url('admin-assets/plugins/datamaps/datamaps.world.min.js') }}"></script>
    <!-- Morrisjs -->
    <script src="{{ url('admin-assets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ url('admin-assets/plugins/morris/morris.min.js') }}"></script>
    <!-- Pignose Calender -->
    <script src="{{ url('admin-assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ url('admin-assets/plugins/pg-calendar/js/pignose.calendar.min.js') }}"></script>
    <!-- ChartistJS -->
    <script src="{{ url('admin-assets/plugins/chartist/js/chartist.min.js') }}"></script>
    <script src="{{ url('admin-assets/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ url('admin-assets/plugins/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ url('admin-assets/plugins/validation/jquery.validate-init.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ url('admin-assets/plugins/toastr/js/toastr.min.js') }}"></script>
    <script src="{{ url('admin-assets/plugins/toastr/js/toastr.init.js') }}"></script>
    {{-- sweet alert --}}
    <script src="{{ url('admin-assets/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    {{-- <script src="{{ url('admin-assets/plugins/sweetalert/js/sweetalert.init.js') }}"></script> --}}

    <script src="{{ url('admin-assets/js/myScript.js') }}"></script>
    {{-- <script src="{{ url('admin-assets/js/dashboard/dashboard-1.js') }}"></script> --}}
    <script src="{{ url('admin-assets/js/summernote-lite.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            $(".mysummernote").summernote({
                height:150,
            });

            $('.dropdown-toggle').dropdown();
        });
    </script>
    @yield('scripts')

</body>

</html>
