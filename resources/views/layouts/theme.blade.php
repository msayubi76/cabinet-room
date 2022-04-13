<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>JDM | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="JDM" name="JDM" />
    <meta content="Salahuddin" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{url('site_images/logo.jpeg')}}">
@yield('style')
    <!-- Bootstrap Css -->
    <link href="{{url('css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{url('css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{url('css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{url('css/style.css')}}"   rel="stylesheet" type="text/css" />
    <script>var base_url = '{{url('/')}}';</script>
    <link href="{{url('libs/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">
</head>

<body data-topbar="dark">

<!-- Begin page -->
<div id="layout-wrapper">
    
    @if (Auth::user()->hasRole('Customer')))
   
    @include('header.customer_header')
    @include('sidebar.customer_sidebar')
    @else 
        @include('header.header')
        @include('sidebar.sidebar')
    @endif
   
    <!-- ============================================================== -->
    <!-- Start  Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
       @yield('content')
       @include('footer.footer')
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->
<script src="{{url('libs/jquery/jquery.min.js')}}"></script>
<script src="{{url('libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{url('libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{url('libs/node-waves/waves.min.js')}}"></script>
<script src="{{url('js/app.js')}}"></script>

@yield('script')
<script>
    $("#change_password").on('click', function(e){
        e.preventDefault();
        $("#success_msg").text("");
         
        $("#error_current_password").text("");
        $("#error_new_password").text("");
        $("#error_password_confirmation").text("");
        var form = $('#change_password_form').serialize();
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }, 
                type:'POST',
                url: '{{url('save-change-password')}}',
                data: form,
                success:function(response){ 
                    if(response.status){
                        $("#success_msg").removeClass("text-danger").addClass("text-success");
                        window.setTimeout(function(){location.reload()},1000)
                    }else{
                        $("#success_msg").addClass("text-danger").removeClass("text-success");
                    }
                     $("#success_msg").text(response.msg);
                    $("#error_current_password").text("");
                    $("#error_new_password").text("");
                    $("#error_password_confirmation").text("");
                    
                }, 
                error: function(res){
                  $.each(res.responseJSON.errors, function (key, item) {
                     
                       $("#error_"+key).text(item[0]  );
                  });
                }
            })
    })
</script>
</body>

</html>


