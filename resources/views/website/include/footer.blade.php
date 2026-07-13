<footer class="footer bg-dark">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">Contact Info</h4>
                        <ul class="contact-info">
                            @php
                                $contact = App\Models\Setting::OrderBy('id', 'DESC')->get();
                            @endphp

                            @foreach ($contact as $item)
                                <li>
                                    <span class="contact-info-label">Address:</span>{{ $item->address }}
                                </li>
                                <li>
                                    <span class="contact-info-label">Phone:</span><a
                                        href="tel:">{{ $item->mobile_no1 }}</a>
                                </li>

                                <li>
                                    <span class="contact-info-label">Email:</span> <a
                                        href="mailto:{{ $item->email }}">{{ $item->email }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="social-icons">
                            <a href="https://www.facebook.com/profile.php?id=61580683346252" class="social-icon social-facebook icon-facebook" target="_blank"
                                title="Facebook"></a>
                            <a href="https://www.instagram.com/rkhardwaretraders.pk?igsh=MzZsc3YzcjlienMz" class="social-icon social-instagram icon-instagram" target="_blank"
                                title="Instagram"></a>
                        </div>
                        <!-- End .social-icons -->
                    </div>
                    <!-- End .widget -->
                </div>
                <!-- End .col-lg-3 -->

                <div class="col-lg-4 col-sm-6">
                    <div class="widget">
                      
                        <ul class="links">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('categories') }}">Categories</a></li>
                            <li><a href="{{ url('/products') }}">Shop</a></li>
                            <li><a href="{{ url('/about-us') }}">About</a></li>
                            <li><a href="{{ url('/contact-us') }}">Contact Us</a></li>
                           
                        
                            <li><a href="{{ url('/privacy-and-policy') }}">Privacy</a></li>
                        </ul>
                    </div>
                    <!-- End .widget -->
                </div>
                <!-- End .col-lg-3 -->

                <div class="col-lg-4 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">Popular Categories</h4>

                        <div class="tagcloud">
                            @foreach ($categories as $catlist)
                                <a href="{{ url('products/' . $catlist->name) }}">{{ $catlist->name }}</a>
                            @endforeach

                        </div>
                    </div>
                    <!-- End .widget -->
                </div>
                <!-- End .col-lg-3 -->

              
                <!-- End .col-lg-3 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .footer-middle -->

    <div class="container">
        <div class="footer-bottom">
            <div class="container d-sm-flex align-items-center">
                <div class="footer-left">
                    <span class="footer-copyright">© RK Hardware. 2026. All Rights Reserved</span>
                </div>
 
            </div>
        </div>
        <!-- End .footer-bottom -->
    </div>
    <!-- End .container -->
</footer>
<!-- End .footer -->
