<div class="featured-categories_area ">
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                <div class="featured-categories_slider uren-slick-slider slider-navigation_style-1" data-slick-options='{
                "slidesToShow": 6,
                "spaceBetween": 30,
                "arrows" : true,
                "autoplay":false,
                "infinite": false,
                "autoplaySpeed": 1500
               }' data-slick-responsive='[
                                     {"breakpoint":1200, "settings": {"slidesToShow": 6}},
                                     {"breakpoint":992, "settings": {"slidesToShow": 5}}, 
                                     {"breakpoint":767, "settings": {"slidesToShow": 3}}, 
                                     {"breakpoint":575, "settings": {"slidesToShow": 2}}

                                 ]'>
                    @foreach ($old_products as $old_product)
                        <?php  
                            $file_name =    $old_product->feature_image; 
                        ?>
                        <div class="slide-item carsect ">
                            <div  class="carbox slide-inner pt-0 pb-0">                        
                                <a     target="_blank"  href="  {{'produc/'.encrypt($old_product->id)}}">
                                    <div  class="col-md-12 p-0">   
                                        <div   class="zoomer">   
                                            <img   class="mainimage img-responsive"   src="{{url('site_images/feature_image/'.$file_name)}}">
                                        </div>                           
                                        <div  class="col-xs-12">
                                            <h6 class="text-capitalize m-0">
                                                {{$old_product->getCategory?$old_product->getCategory->name.' ':''}}  
                                                {{$old_product->getSubCategory?$old_product->getSubCategory->name:''}}
</h6> 
                                            <p class="m-0">{{$old_product->model}}</p> 
                                            <span   class="price">{{$old_product->price .' $ '}}</span> 
                                        </div>
                                    </div>
                                </a>
                            </div>   
                        </div> 
                    @endforeach
                        
                   
                </div>
            </div>
        </div>
    </div>
</div>