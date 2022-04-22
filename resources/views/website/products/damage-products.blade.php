 

<div class="featured-categories_area damage-products">
    <div class="container-fluid"> 
        <div class="section-title_area">
            
            <h3 class="pb-2 text-uppercase">Damage Products</h3>
            <hr>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                <div class="featured-categories_slider uren-slick-slider slider-navigation_style-1" data-slick-options='{
                "slidesToShow": 4,
                "spaceBetween": 30,
                "arrows" : true,
                "autoplay":false,
                "infinite": false,
                "autoplaySpeed": 1500
               }' data-slick-responsive='[
                                     {"breakpoint":1200, "settings": {"slidesToShow": 4}},
                                     {"breakpoint":992, "settings": {"slidesToShow": 3}}, 
                                     {"breakpoint":767, "settings": {"slidesToShow": 3}}, 
                                     {"breakpoint":575, "settings": {"slidesToShow": 2}}, 
                                     {"breakpoint":425, "settings": {"slidesToShow": 1}}

                                 ]'>
                    @foreach ($damage_products as $damage_product)
                         
                                             
                                <div class="slide-item">
                                    <div class="slide-inner">
                                        <div class="slide-image_area">
                                            <a href="{{ url('produc/'.encrypt($damage_product->id)) }}">
                                                <img src="{{ url('site_images/feature_image/' . $damage_product->feature_image) }}"
                                                    alt="{{ $damage_product->model }}">
                                            </a>
                                        </div>
                                        <?php
                                        $category = $damage_product->getCategory ? $damage_product->getCategory->name : '';
                                        $sub_category = $damage_product->getsubCategory ? $damage_product->getsubCategory->name
                                        : '';
                                        $name = $category . ', ' . $sub_category;
                                        ?>
                                        <div class="slide-content_area">
                                            <h3><a href="{{ url('produc/'.encrypt($damage_product->id)) }}">{{ $name }}</a></h3>
                                            <ul class="product-item">
                                                <li>
                                                    <i class="fa fa-arrow-right"></i>
                                                    {{ $damage_product->price . ' ' . $damage_product->currency_type }}
                                                </li>
                                                <li class="text-cepitalize">
                                                    <i class="fa fa-arrow-right"></i> {{ $damage_product->model }}
                                                </li>
                                                <li>
                                                    <i class="fa fa-arrow-right"></i>
                                                    {{ $damage_product->hybrid_petrol_diesel }}
                                                </li>
                                                <li>
                                                    <i class="fa fa-arrow-right"></i>
                                                    {{ $damage_product->cc."cc" }}
                                                </li>
        
                                                 
        
        
                                            </ul>
        
                                        </div>
                                    </div>
                                </div>
                             
                    @endforeach
                        
                   
                </div>
            </div>
        </div>
    </div>
</div>