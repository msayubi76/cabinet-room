<div class="sticky-navbar justify-content-between">
    <div class="sticky-info">
        <a href="/">
            <i class="icon-home"></i>Home
        </a>
    </div>
    <div class="sticky-info">
        <a href="/categories" class="">
            <i class="icon-bars"></i>Categories
        </a>
    </div>
    {{-- <div class="sticky-info">
        <a href="wishlist.html" class="">
            <i class="icon-wishlist-2"></i>Wishlist
        </a>
    </div> --}}
    <div class="sticky-info">
        <?php
        if (Auth::check()) {
            if (Auth::user()->type == 'admin') {
                $link = '/admin';
            } elseif (Auth::user()->type == 'customer') {
                $link = '/user-dashboard';
            } else {
                $link = '/login';
            }
        } else {
            $link = '/login';
        }
        ?>

        <a href="{{ $link }}">
            <i class="icon-user-2"></i>Account
        </a>
    </div>

    <div class="sticky-info">
        <a href="/cart" class="">
            <i class="icon-shopping-cart position-relative">
                @if ($cart->count() > 0)
                    <span class="cart-count badge-circle">{{ $cart->count() }}</span>
                @endif
            </i>Cart
        </a>
    </div>
</div>
