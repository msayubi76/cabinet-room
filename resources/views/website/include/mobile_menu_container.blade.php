<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="fa fa-times"></i></span>
        <nav class="mobile-nav">
            <ul class="mobile-menu">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>
                    <a href="category.html">Categories</a>
                    <ul>
                        @foreach ($categories as $catitem )
                        <li><a href="{{url('category=' .$catitem->name)}}">{{ $catitem->name }}</a></li>
                        @endforeach

                    </ul>
                </li>
                <li>
                    <a href="{{ url('/products') }}">Products</a>


                </li>
                <li>
                    <a href="#">Pages<span class="tip tip-hot">Hot!</span></a>
                    <ul>
                        <li>
                            <a href="{{ url('/about-us') }}">About Us</a>
                        </li>
                        <li>
                            <a href="{{ url('/contact-us') }}">Contact Us</a>
                        </li>
                        <li>
                            <a href="{{ url('/privacy-and-policy') }}">Privacy and Policy</a>
                        </li>
                        <li>
                            <a href="{{ url('user-dashboard') }}">Dashboard</a>
                        </li>
                        <li>
                            <a href="login.html">Login</a>
                        </li>
                        <li>
                            <a href="forgot-password.html">Forgot Password</a>
                        </li>
                    </ul>
                </li>


            </ul>

            <ul class="mobile-menu mt-2 mb-2">
                <li class="border-0">
                    <a href="#">
                        Special Offer!
                    </a>
                </li>
                <li class="border-0">
                    <a href="#" target="_blank">
                        Buy Porto!
                        <span class="tip tip-hot">Hot</span>
                    </a>
                </li>
            </ul>

            <ul class="mobile-menu">
                <li><a href="{{ url('user-dashboard') }}">My Account</a></li>
                <li><a href="{{ url('about-us') }}">About Us</a></li>
                <li><a href="{{ url('contact-us') }}">Contact Us</a></li>

                <li><a href="{{ url('cart') }}">Cart</a></li>
                <li><a href="login.html" class="login-link">Log In</a></li>
            </ul>
        </nav>
        <!-- End .mobile-nav -->

        <form class="search-wrapper mb-2" action="#">
            <input type="text" class="form-control mb-0" placeholder="Search..." required />
            <button class="btn icon-search text-white bg-transparent p-0" type="submit"></button>
        </form>

        <div class="social-icons">
            <a href="#" class="social-icon social-facebook icon-facebook" target="_blank">
            </a>
            <a href="#" class="social-icon social-twitter icon-twitter" target="_blank">
            </a>
            <a href="#" class="social-icon social-instagram icon-instagram" target="_blank">
            </a>
        </div>
    </div>
    <!-- End .mobile-menu-wrapper -->
</div>
