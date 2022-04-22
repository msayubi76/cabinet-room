<header class="header-main_area ">
    <div class=" d-lg-block d-none">
        <div class="row p-3 header_top_time_area ">
            <div class="col-md-5  ">
                <div class="text-center">
                    <p style=" color: #dc3545"><b class="text-uppercase">Japan Time: </b><span id="datetime"></span></p>
                </div>
            </div>
            <div class="col-md-2">
                <p style=" color: #000000"><b class="text-uppercase">USD/JPY: </b><span>
                        {{ $generalSetting->japan_rate . ' ¥ ' }}</span></p>
            </div>
            <div class="col-md-5 text-right">
                <ul class="list-inline">

                    @if (Route::has('login'))
                        @auth
                            <li class="list-inline-item text-uppercase "><a href="{{ url('dashboard') }}">
                                    My Account
                                </a>
                            </li>
                            <li class="list-inline-item active text-uppercase"><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">Logout</a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <li class="list-inline-item text-uppercase"><a href="{{ url('customer/create') }}">Register</a>
                            </li>
                            <li class="list-inline-item text-uppercase"><a href="{{ url('login') }}">Login</a></li>
                        @endauth
                    @endif

                </ul>
                </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                @include('alertsInfo')
            </div>
        </div>
    </div>


    <div class="header-top_area bg--sapphire d-lg-block d-none">
        <div class="container-fluid">
            <div class="row">

                <div class="col-xl-2 col-lg-2">
                    <div class="ht-right_area">
                        <div class="ht-menu">
                            <ul>
                                <li>
                                    <a class="p-0" href="{{ url('/') }}">
                                        <img src="{{ url('site_images/logo.jpeg') }}" height="130px" alt="JDM Logo">
                                    </a>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-10 col-lg-10">
                    <div class="main-menu_area position-relative">
                        <nav class="main-nav mx-auto">
                            <ul>
                                <?php if (isset($page)) {
                                $page ? $page : 'np';
                                } else {
                                $page = 'np';
                                } ?>
                                <li class="{{ $page == 'home' ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>
                                <li class="dropdown-toggle stock-list {{ $page == 'stock-list' ? 'active' : '' }}"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Stock List
                                    <i class="mdi mdi-chevron-down"></i>
                                    <ul class="dropdown-menu" role="menu">
                                        @foreach ($countries as $key => $count)
                                            <li class="dropdown-item search-by-country"
                                                data-url="{{ url('country/' . $key) }}">
                                                {{ $count }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="{{ $page == 'damage_products' ? 'active' : '' }}"><a
                                        href="{{ url('damage/products') }}">Damage Products</a></li>
                                <li class="{{ $page == 'parts' ? 'active' : '' }}"><a
                                        href="{{ url('parts') }}">Parts</a></li>
                                <li class="{{ $page == 'bank' ? 'active' : '' }}"><a
                                        href="{{ url('bank-detail') }}">Bank Detail</a></li>
                                <li class="{{ $page == 'about' ? 'active' : '' }}"><a
                                        href="{{ url('about') }}">About</a></li>
                                <li class="{{ $page == 'contact' ? 'active' : '' }}"><a
                                        href="{{ url('contact-us') }}">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="header-top_area header-sticky bg--sapphire">
        <div class=" d-lg-block d-none">
            <div class="row p-3 header_top_time_area ">
                <div class="col-md-5  ">
                    <div class="text-center text-uppercase">
                        <p style=" color: #dc3545"><b>Japan Time: </b> <span id="datetime_sticky"></span></p>

                    </div>
                </div>
                <div class="col-md-2 text-uppercase">
                    <p style=" color: #000000"><b>USD/JPY: </b><span> {{ $generalSetting->japan_rate . ' ¥ ' }}</span>
                    </p>
                </div>
                <div class="col-md-5 text-right">
                    <ul class="list-inline">

                        @if (Route::has('login'))
                            @auth
                                <li class="list-inline-item text-uppercase"><a href="{{ url('dashboard') }}">
                                        My Account
                                    </a>
                                </li>
                                <li class="list-inline-item active text-uppercase"><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">Logout</a>

                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @else
                                <li class="list-inline-item text-uppercase"><a
                                        href="{{ url('customer/create') }}">Register</a></li>
                                <li class="list-inline-item text-uppercase"><a href="{{ url('login') }}">Login</a></li>
                            @endauth
                        @endif


                    </ul>
                    </li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="header-top_area bg--sapphire d-lg-block d-none">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-xl-2 col-lg-2">
                        <div class="ht-right_area">
                            <div class="ht-menu">
                                <ul>
                                    <li>
                                        <a class="p-0" href="{{ url('/') }}">
                                            <img src="{{ url('site_images/logo.jpeg') }}" height="130px" alt="JDM Logo">
                                        </a>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-10 col-lg-10">
                        <div class="main-menu_area position-relative">
                            <nav class="main-nav mx-auto">
                                <ul>
                                    <li class="{{ $page == 'home' ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a>
                                    </li>
                                    <li class="dropdown-toggle stock-list {{ $page == 'stock-list' ? 'active' : '' }}"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Stock List
                                        <i class="mdi mdi-chevron-down"></i>
                                        <ul class="dropdown-menu" role="menu">

                                            @foreach ($countries as $key => $count)
                                                <li class="dropdown-item search-by-country"
                                                    data-url="{{ url('country/' . $key) }}">
                                                    {{ $count }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="{{ $page == 'damage_products' ? 'active' : '' }}"><a
                                            href="{{ url('damage/products') }}">Damage Products</a></li>
                                    <li class="{{ $page == 'pats' ? 'active' : '' }}"><a
                                            href="{{ url('parts') }}">Parts</a></li>
                                    <li class="{{ $page == 'bank' ? 'active' : '' }}"><a
                                            href="{{ url('bank-detail') }}">Bank Detail</a></li>
                                    <li class="{{ $page == 'about' ? 'active' : '' }}"><a
                                            href="{{ url('about') }}">About</a></li>
                                    <li class="{{ $page == 'contact' ? 'active' : '' }}"><a
                                            href="{{ url('contact-us') }}">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="  col-12 d-lg-none">
        <div class="header-right_area">
            <ul class="mobile-menu-icon">
                <li class="mobile-menu_wrap d-flex ">
                    <a href="#mobileMenu" class="mobile-menu_btn toolbar-btn color--white">
                        <i class="ion-navicon"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="p-0 mb-0 mr-0" href="{{ url('/') }}">
                        <img src="{{ url('site_images/logo.jpeg') }}" height="40px" alt="JDM Logo">
                    </a>
                </li>
            </ul>
            <ul>
                <li class="list-inline-item mobile_time p-0" style="margin: 0px auto; text-align">
                    <span class="text-uppercase"><b>Japan Time:</b> <span id="mobileDatetime"></span></span>
                </li>

            </ul>
            <ul>
                <li class="list-inline-item mobile_time p-0" style="margin: 0px auto;">
                    <span class="text-uppercase" style=" color: #000000"><b>USD/JPY:</b>
                        <span>{{ $generalSetting->japan_rate . ' ¥ ' }}</span></span>
                </li>
            </ul>
        </div>
    </div>

    <div class="mobile-menu_wrapper" id="mobileMenu">
        <div class="offcanvas-menu-inner" style="padding: 10px 0 0 !important;">
            <div class="container">
                <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
                <nav class="offcanvas-navigation text-uppercase">
                    <ul class="mobile-menu text-uppercase">
                        @if (Route::has('login'))
                            @auth
                                <li class="list-inline-item text-uppercase"><a href="{{ url('dashboard') }}">
                                        My Account
                                    </a>
                                </li>
                                <li class="list-inline-item active text-uppercase"><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">Logout</a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @else
                                <li class="list-inline-item text-uppercase"><a
                                        href="{{ url('customer/create') }}">Register</a></li>
                                <li class="list-inline-item text-uppercase"><a class="text-uppercase"
                                        href="{{ url('login') }}">Login</a></li>
                            @endauth
                        @endif
                        <li class="menu-item-has-children {{ $page == 'home' ? 'active' : '' }} "><a
                                href="{{ url('/') }}">Home</a></li>

                        <li class="menu-item-has-children   {{ $page == 'stock-list' ? 'active' : '' }}"
                            style="    padding: 0px 19px;">
                            <span class="mm-text text-uppercase">Stock List</span>
                            <ul class="sub-menu" style="display: none;">

                                @foreach ($countries as $key => $count)
                                    <li class="search-by-country" data-url="{{ url('country/' . $key) }}">
                                        <a href="javascript:;">{{ $count }} </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="{{ $page == 'damage_products' ? 'active' : '' }}"><a
                            href="{{ url('damage/products') }}">Damage Products</a></li>
                        <li class="menu-item-has-children {{ $page == 'parts' ? 'active' : '' }}"><a
                                href="{{ url('parts') }}">Parts</a></li>

                        <li class="menu-item-has-children {{ $page == 'bank' ? 'active' : '' }}"><a
                                href="{{ url('bank-detail') }}">Bank Detail</a></li>
                        <li class="menu-item-has-children {{ $page == 'about' ? 'active' : '' }}"><a
                                href="{{ url('about') }}">About</a></li>
                        <li class="menu-item-has-children {{ $page == 'contact' ? 'active' : '' }}"><a
                                href="{{ url('contact-us') }}">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
