@extends('website.master')
@section('title', 'About Us')

@section('content')
    <div class="page-header page-header-bg text-left"
        style="background: 50%/cover #D4E1EA url('assets/images/page-header-bg.jpg');">
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
                <li class="breadcrumb-item active" aria-current="page">About Us</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="about-section">
        <div class="container">
            <h2 class="subtitle">OUR STORY</h2>

            <div>{!! $setting->about_us_detail !!}</div>

        </div><!-- End .container -->
    </div><!-- End .about-section -->

    <div class="features-section bg-gray">
        <div class="container">
            <h2 class="subtitle">Bank Detail</h2>
            <div class="row">
                <div class="col-lg-8">
                    <div class="feature-box bg-white">
                        <i class="icon-shipped"></i>

                        <div class="feature-box-content p-0">
                            <h3 class="mb-0">  Soneri Bank </h3>
                            <p>
                                <strong>
                                    Account Title:
                                </strong> RK TRADERS
                            </p>
                            <p>
                                <strong>
                                    IBAN NO:
                                </strong> PK86SONE0020520004454961
                            </p>
                        </div><!-- End .feature-box-content -->
                    </div><!-- End .feature-box -->
                </div><!-- End .col-lg-4 -->
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="feature-box bg-white">
                        <i class="icon-shipped"></i>

                        <div class="feature-box-content p-0">
                            <h3>Free Shipping</h3>
                            <p>Enjoy free shipping on all orders — no hidden fees or surprises at checkout! We make shopping easy and affordable by delivering your favorite products right to your doorstep at no extra cost.</p>
                        </div><!-- End .feature-box-content -->
                    </div><!-- End .feature-box -->
                </div><!-- End .col-lg-4 -->

                <div class="col-lg-4">
                    <div class="feature-box bg-white">
                        <i class="icon-us-dollar"></i>

                        <div class="feature-box-content p-0">
                            <h3>100% Money Back Guarantee</h3>
                            <p>Shop with confidence! If you’re not completely satisfied with your purchase, we offer a 100% money-back guarantee — no questions asked. Your satisfaction is our top priority.</p>
                        </div><!-- End .feature-box-content -->
                    </div><!-- End .feature-box -->
                </div><!-- End .col-lg-4 -->

                <div class="col-lg-4">
                    <div class="feature-box bg-white">
                        <i class="icon-online-support"></i>

                        <div class="feature-box-content p-0">
                            <h3>Online Support 24/7</h3>
                            <p>Need help anytime, anywhere? Our friendly customer support team is available 24/7 to assist you with product inquiries, order updates, or any issues you may face. We’re just a message away!</p>
                        </div><!-- End .feature-box-content -->
                    </div><!-- End .feature-box -->
                </div><!-- End .col-lg-4 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .features-section -->

    <!--<div class="testimonials-section">
        <div class="container">
            <h2 class="subtitle text-center">HAPPY CLIENTS</h2>

            <div class="testimonials-carousel owl-carousel owl-theme images-left"
                data-owl-options="{
                'margin': 20,
                'lazyLoad': true,
                'autoHeight': true,
                'dots': false,
                'responsive': {
                    '0': {
                        'items': 1
                    },
                    '992': {
                        'items': 2
                    }
                }
            }">
                <div class="testimonial">
                    <div class="testimonial-owner">
                        <figure>
                            <img src="/website/assets/images/clients/client1.png" alt="client">
                        </figure>

                        <div>
                            <strong class="testimonial-title">John Smith</strong>
                            <span>SMARTWAVE CEO</span>
                        </div>
                    </div> 

                    <blockquote>
                        <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mipsum
                            dolor sit amet, consectetur elitad adipiscing cas non placerat mi.</p>
                    </blockquote>
                </div>

                <div class="testimonial">
                    <div class="testimonial-owner">
                        <figure>
                            <img src="/website/assets/images/clients/client2.png" alt="client">
                        </figure>

                        <div>
                            <strong class="testimonial-title">Bob Smith</strong>
                            <span>SMARTWAVE CEO</span>
                        </div>
                    </div>

                    <blockquote>
                        <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mipsum
                            dolor sit amet, consectetur elitad adipiscing cas non placerat mi.</p>
                    </blockquote>
                </div>

                <div class="testimonial">
                    <div class="testimonial-owner">
                        <figure>
                            <img src="/website/assets/images/clients/client1.png" alt="client">
                        </figure>

                        <div>
                            <strong class="testimonial-title">John Smith</strong>
                            <span>SMARTWAVE CEO</span>
                        </div>
                    </div>

                    <blockquote>
                        <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mipsum
                            dolor sit amet, consectetur elitad adipiscing cas non placerat mi.</p>
                    </blockquote>
                </div>
            </div>
        </div>
    </div> -->

    <!--<div class="counters-section bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-4 count-container">
                    <div class="count-wrapper">
                        <span class="count-to" data-from="0" data-to="200" data-speed="2000"
                            data-refresh-interval="50">200</span>+
                    </div>
                    <h4 class="count-title">MILLION CUSTOMERS</h4>
                </div>

                <div class="col-6 col-md-4 count-container">
                    <div class="count-wrapper">
                        <span class="count-to" data-from="0" data-to="1800" data-speed="2000"
                            data-refresh-interval="50">1800</span>+
                    </div>
                    <h4 class="count-title">TEAM MEMBERS</h4>
                </div>

                <div class="col-6 col-md-4 count-container">
                    <div class="count-wrapper line-height-1">
                        <span class="count-to" data-from="0" data-to="24" data-speed="2000"
                            data-refresh-interval="50">24</span><span>HR</span>
                    </div>
                    <h4 class="count-title">SUPPORT AVAILABLE</h4>
                </div>

                <div class="col-6 col-md-4 count-container">
                    <div class="count-wrapper">
                        <span class="count-to" data-from="0" data-to="265" data-speed="2000"
                            data-refresh-interval="50">265</span>+
                    </div>
                    <h4 class="count-title">SUPPORT AVAILABLE</h4>
                </div>

                <div class="col-6 col-md-4 count-container">
                    <div class="count-wrapper line-height-1">
                        <span class="count-to" data-from="0" data-to="99" data-speed="2000"
                            data-refresh-interval="50">99</span><span>%</span>
                    </div>
                    <h4 class="count-title">SUPPORT AVAILABLE</h4>
                </div>
            </div>
        </div>
    </div>-->
@endsection
