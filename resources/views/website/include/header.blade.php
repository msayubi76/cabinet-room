<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left d-none d-sm-block">
                <p class="top-message text-uppercase">FREE Returns. Standard Shipping Orders $99+</p>
            </div>
            <!-- End .header-left -->

            <div class="header-right header-dropdowns ml-0 ml-sm-auto w-sm-100">
                <div class="header-dropdown dropdown-expanded d-none d-lg-block">
                    <a href="#">Links</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="{{ url('user-dashboard') }}">My Account</a></li>
                            <li><a href="{{ url('about-us') }}">About Us</a></li>
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="wishlist.html">My Wishlist</a></li>
                            <li><a href="cart.html">Cart</a></li>
                            <li><a href="login.html" class="login-link">Log In</a></li>
                        </ul>
                    </div>
                    <!-- End .header-menu -->
                </div>
                <!-- End .header-dropown -->

                <span class="separator"></span>

                <div class="header-dropdown">
                    <a href="#"><i class="flag-us flag"></i>ENG</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#"><i class="flag-us flag mr-2"></i>ENG</a>
                            </li>
                            <li><a href="#"><i class="flag-fr flag mr-2"></i>FRA</a></li>
                        </ul>
                    </div>
                    <!-- End .header-menu -->
                </div>
                <!-- End .header-dropown -->

                <div class="header-dropdown mr-auto mr-sm-3 mr-md-0">
                    <a href="#">USD</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">EUR</a></li>
                            <li><a href="#">USD</a></li>
                        </ul>
                    </div>
                    <!-- End .header-menu -->
                </div>
                <!-- End .header-dropown -->

                <span class="separator"></span>

                <div class="social-icons">
                    <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"></a>
                    <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"></a>
                    <a href="#" class="social-icon social-instagram icon-instagram" target="_blank"></a>
                </div>
                <!-- End .social-icons -->
            </div>
            <!-- End .header-right -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .header-top -->

    <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
        <div class="container">
            <div class="header-left col-lg-2 w-auto pl-0">
                <button class="mobile-menu-toggler text-primary mr-2" type="button">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="demo4.html" class="logo">
                    <img src="{{asset('website/assets/images/logo.png')}}" width="111" height="44" alt="Porto Logo">
                </a>
            </div>
            <!-- End .header-left -->

            <div class="header-right w-lg-max">
                <div class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mt-0">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                    <form action="{{ url('search-product') }}" method="POST">
                        @csrf
                        <div class="header-search-wrapper">
                            <input type="search" class="form-control" name="name" id="search_product" placeholder="Search..." required>
                            <div class="select-custom">
                                <select id="cat" name="cat">
                                    <option value="">All Categories</option>
                                    @foreach ($category as $catitem )

                                    <option value="">{{$catitem->name}}</option>
                                    @foreach ($subcategory as $subcatlist )

                                    <option value="">-
                                        {{$subcatlist->name}}</option>
                                    @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <!-- End .select-custom -->
                            <button class="btn icon-magnifier p-0" title="search" type="submit"></button>
                        </div>
                        <!-- End .header-search-wrapper -->
                    </form>
                </div>
                <!-- End .header-search -->

                <div class="header-contact d-none d-lg-flex pl-4 pr-4">
                    <img alt="phone" src="{{asset('website/assets/images/phone.png')}}" width="30" height="30" class="pb-1">
                    <h6><span>Call us now</span><a href="tel:#" class="text-dark font1">+123 5678 890</a></h6>
                </div>

                <a href="login.html" class="header-icon" title="login"><i class="icon-user-2"></i></a>

                <a href="wishlist.html" class="header-icon" title="wishlist"><i class="icon-wishlist-2"></i></a>

                <div class="dropdown cart-dropdown">
                    <a href="{{url('cart')}}" title="Cart" class="dropdown-toggle dropdown-arrow cart-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i  class="minicart-icon"></i>
                        <span class="cart-count badge-circle">3</span>
                    </a>

                    <div class="cart-overlay"></div>

                    <div class="dropdown-menu mobile-cart">
                        <a href="#" title="Close (Esc)" class="btn-close">×</a>

                        <div class="dropdownmenu-wrapper custom-scrollbar">
                            <div class="dropdown-cart-header">Shopping Cart</div>
                            <!-- End .dropdown-cart-header -->

                            <div class="dropdown-cart-products">
                                @php $total = 0; @endphp

                                @foreach ($cart as $cartlist)
                                <div class="product">



                                    <div class="product-details">
                                        <h4 class="product-title">
                                            <a href="product.html">{{$cartlist->product->name}}</a>
                                        </h4>

                                        <span class="cart-product-info">
                                            <span class="cart-product-qty">{{$cartlist->quantity}}</span> × {{$cartlist->product->discount}}
                                        </span>
                                    </div>

                                    <!-- End .product-details -->

                                    <figure class="product-image-container">
                                        <a href="product.html" class="product-image">
                                            <img src="{{asset('website/assets/images/products/product-1.jpg')}}" alt="product" width="80" height="80">
                                        </a>

                                        <a href="#" class="btn-remove" title="Remove Product"><span>×</span></a>
                                    </figure>
                                </div>
                                @php $total += $cartlist->product->discount * $cartlist->quantity; @endphp
                                @endforeach
                                <!-- End .product -->

                                {{-- <div class="product">
                                    <div class="product-details">
                                        <h4 class="product-title">
                                            <a href="product.html">Brown Women Casual HandBag</a>
                                        </h4>

                                        <span class="cart-product-info">
                                            <span class="cart-product-qty">1</span> × $35.00
                                        </span>
                                    </div>
                                    <!-- End .product-details -->

                                    <figure class="product-image-container">
                                        <a href="product.html" class="product-image">
                                            <img src="{{asset('website/assets/images/products/product-2.jpg')}}" alt="product" width="80" height="80">
                                        </a>

                                        <a href="#" class="btn-remove" title="Remove Product"><span>×</span></a>
                                    </figure>
                                </div>
                                <!-- End .product -->

                                <div class="product">
                                    <div class="product-details">
                                        <h4 class="product-title">
                                            <a href="product.html">Circled Ultimate 3D Speaker</a>
                                        </h4>

                                        <span class="cart-product-info">
                                            <span class="cart-product-qty">1</span> × $35.00
                                        </span>
                                    </div>
                                    <!-- End .product-details -->

                                    <figure class="product-image-container">
                                        <a href="product.html" class="product-image">
                                            <img src="{{asset('website/assets/images/products/product-3.jpg')}}" alt="product" width="80" height="80">
                                        </a>
                                        <a href="#" class="btn-remove" title="Remove Product"><span>×</span></a>
                                    </figure>
                                </div> --}}
                                <!-- End .product -->
                            </div>
                            <!-- End .cart-product -->

                            <div class="dropdown-cart-total">
                                <span>SUBTOTAL:</span>

                                <span class="cart-total-price float-right">{{$total}}</span>
                            </div>
                            <!-- End .dropdown-cart-total -->

                            <div class="dropdown-cart-action">
                                <a href="{{url('cart')}}" class="btn btn-gray btn-block view-cart">View
                                    Cart</a>
                                <a href="checkout.html" class="btn btn-dark btn-block">Checkout</a>
                            </div>
                            <!-- End .dropdown-cart-total -->
                        </div>
                        <!-- End .dropdownmenu-wrapper -->
                    </div>
                    <!-- End .dropdown-menu -->
                </div>
                <!-- End .dropdown -->
            </div>
            <!-- End .header-right -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .header-middle -->

    <div class="header-bottom sticky-header d-none d-lg-block" data-sticky-options="{'mobile': false}">
        <div class="container">
            <nav class="main-nav w-100">
                <ul class="menu">
                    <li class="{{ Request::is('/') ? 'active' : '' }}">
                        <a  href="{{url('/')}}">Home</a>
                    </li>
                    <li>
                        <a href="category.html">Categories</a>
                        <div class="megamenu megamenu-fixed-width megamenu-3cols">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a href="#" class="nolink">VARIATION 1</a>
                                    <ul class="submenu">
                                        @foreach ($category as $catlist )


                                        <li><a href="{{url('category=' .$catlist->name)}}">{{$catlist->name}}</a></li>
                                        @endforeach


                                    </ul>
                                </div>

                                <div class="col-lg-6 p-0">
                                    <div class="menu-banner">
                                        <figure>
                                            <img src="{{asset('website/assets/images/menu-banner.jpg')}}" width="192" height="313" alt="Menu banner">
                                        </figure>
                                        <div class="banner-content">
                                            <h4>
                                                <span class="">UP TO</span><br />
                                                <b class="">50%</b>
                                                <i>OFF</i>
                                            </h4>
                                            <a href="category.html" class="btn btn-sm btn-dark">SHOP NOW</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End .megamenu -->
                    </li>
                    <li class="{{ Request::is('products') ? 'active' : '' }}">
                        <a  href="{{url('/products')}}">Products</a>

                        <!-- End .megamenu -->
                    </li>
                    <li>
                        <a href="#">Pages</a>
                        <ul>

                            <li><a href="{{ url('/about-us') }}">About Us</a></li>

                            <li><a href="{{ url('/contact-us') }}">Contact Us</a></li>
                            <li><a href="{{ url('/privacy-and-policy') }}">Privacy and Policy</a></li>
                            <li><a href="login.html">Login</a></li>
                            <li><a href="forgot-password.html">Forgot Password</a></li>
                        </ul>
                    </li>

                    <li class="{{ Request::is('about-us') ? 'active' : '' }}"><a href="{{ url('/about-us') }}">About Us</a></li>
                    <li class="{{ Request::is('contact-us') ? 'active' : '' }}"><a href="{{ url('/contact-us') }}">Contact Us</a></li>
                    <li class="float-right"><a href="https://1.envato.market/DdLk5" rel="noopener" class="pl-5" target="_blank">Buy Porto!</a></li>
                    <li class="float-right"><a href="#" class="pl-5">Special Offer!</a></li>
                </ul>
            </nav>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .header-bottom -->
</header>
<!-- End .header -->
