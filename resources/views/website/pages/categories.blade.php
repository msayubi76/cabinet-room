@extends('website.master')
@section('title', 'Categories')

@section('content')
 

    <div class="container">
        
        <h2>Categories</h2>

        

        <div class="row">
            @foreach ($categories as $cateorylist)
                <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                    <div class="card">
                        <div class="product-default">
                            <figure>
                                <a href="{{ url('/products/' . $cateorylist->name) }}">
                                    <img src="{{ asset($cateorylist->image_url) }}" width="180" height="180"
                                        alt="product" />
                                    <img src="{{ asset($cateorylist->image_url) }}" width="180" height="180"
                                        alt="product" />
                                </a>


                            </figure>

                            <div class="product-details">
                                <div class="category-wrap">
                                    {{-- <div class="category-list">
                                <a href="category.html" class="product-category">{{$cateorylist->category->name}}</a>
                            </div> --}}
                                </div>

                                <h3 class="product-title"> <a href="product.html">{{ $cateorylist->name }}</a>
                                </h3>


                                <!-- End .product-container -->


                            </div>
                            <!-- End .product-details -->
                        </div>
                    </div>
                </div>
            @endforeach



        </div>
        <!-- End .row -->

    </div>
    <!-- End .container -->


@endsection
