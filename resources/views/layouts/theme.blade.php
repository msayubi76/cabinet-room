<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>CABINET ROOM | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('admin/images/favicon.png') }}">
    <!-- Pignose Calender -->
    <link href="{{ url('admin/plugins/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{ url('admin/plugins/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css') }}">
    <link rel="stylesheet" href="{{ url('admin/plugins/highlightjs/styles/darkula.css') }}">

    <link href="{{ url('admin/plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="{{ url('admin/css/style.css') }}" rel="stylesheet">
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



    <script src="{{ url('admin/plugins/common/common.min.js') }}"></script>
    <script src="{{ url('admin/js/custom.min.js') }}"></script>
    <script src="{{ url('admin/js/settings.js') }}"></script>
    <script src="{{ url('admin/js/gleek.js') }}"></script>
    <script src="{{ url('admin/js/styleSwitcher.js') }}"></script>

    <script src="{{ url('admin/plugins/highlightjs/highlight.pack.min.js') }}"></script>
    <script>
        hljs.initHighlightingOnLoad();
    </script>

    

    {{-- datatables --}}
    {{-- <script src="{{ url('admin/plugins/tables/js/jquery.dataTables.min.js') }}"></script>
     <script src="{{ url('admin/plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
     <script src="{{ url('admin/plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>--}}
    <!-- Chartjs -->
    <script src="{{ url('admin/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Circle progress -->
    <script src="{{ url('admin/plugins/circle-progress/circle-progress.min.js') }}"></script>
    <!-- Datamap -->
    <script src="{{ url('admin/plugins/d3v3/index.js') }}"></script>
    <script src="{{ url('admin/plugins/topojson/topojson.min.js') }}"></script>
    <script src="{{ url('admin/plugins/datamaps/datamaps.world.min.js') }}"></script>
    <!-- Morrisjs -->
    <script src="{{ url('admin/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ url('admin/plugins/morris/morris.min.js') }}"></script>
    <!-- Pignose Calender -->
    <script src="{{ url('admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ url('admin/plugins/pg-calendar/js/pignose.calendar.min.js') }}"></script>
    <!-- ChartistJS -->
    <script src="{{ url('admin/plugins/chartist/js/chartist.min.js') }}"></script>
    <script src="{{ url('admin/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ url('admin/plugins/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ url('admin/plugins/validation/jquery.validate-init.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ url('admin/plugins/toastr/js/toastr.min.js') }}"></script>
    <script src="{{ url('admin/plugins/toastr/js/toastr.init.js') }}"></script>
    {{-- sweet alert --}}
    <script src="{{ url('admin/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    {{-- <script src="{{ url('admin/plugins/sweetalert/js/sweetalert.init.js') }}"></script> --}}

    <script src="{{ url('admin/js/myScript.js') }}"></script>
    <script src="{{ url('admin/js/dashboard/dashboard-1.js') }}"></script>
    @yield('scripts')

</body>

</html>
