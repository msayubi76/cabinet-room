@extends('website.master')
@section('title', 'Gallary')

@section('content')

    <div class="category-banner-container bg-gray">
        <div class="category-banner banner text-uppercase"
            style="background: no-repeat 60%/cover url('website/assets/images/elements/page-header.jpg');">
            <div class="container position-relative">
                <nav aria-label="breadcrumb" class="breadcrumb-nav text-white">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="demo4.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Banners</li>
                    </ol>
                </nav>
                <h1 class="page-title text-center text-white">Banners</h1>
            </div>
        </div>
    </div>


    <section class="hover-section container mt-8">
        <h3 class="text-center">Our Gallary </h3>
        <p class="text-center mx-auto mb-3">There are many hover effects as you can see below. Please choose any
            effect to suit your need.</p>
        <div class="row">
            @foreach ($media as $list)
            <div class="col-md-4 col-6">
                <div class="banner overlay-effect1 mb-3">
                    <figure>
                        <img src="{{$list->image_url }}" width="1920"
                            alt="element-banner" height="1080" /></figure>
                    <div class="banner-layer banner-layer-middle text-center">
                        <h3 class=" text-white mb-0">Effect 1</h3>
                    </div>
                </div>
            </div>

            @endforeach



        </div>
    </section>



@endsection
