@extends('website.master')
@section('title' , "Privacy and policy")

@section('content')
    <div class="page-header page-header-bg text-left"
        style="background: 50%/cover #D4E1EA url('{{asset('assets/images/page-header-bg.jpg')}}');">
        <div class="container">
            <h1><span>ABOUT US</span>
                OUR COMPANY</h1>
            <a href="contact.html" class="btn btn-dark" style="border-color: #fb7d1a; background-color: #fb7d1a;">Contact</a>
        </div><!-- End .container -->
    </div><!-- End .page-header -->

    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="demo4.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Privacy and policy</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="about-section">
        <div class="container">
            <h2 class="subtitle">Privacy and policy</h2>
            
                <div>{!!$setting->privacy_detail!!}</div>
           
        </div><!-- End .container -->
    </div><!-- End .about-section -->

   
@endsection
