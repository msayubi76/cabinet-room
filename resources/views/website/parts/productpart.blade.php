<div class="row">
    @forelse ($items as $item)
        <?php $file_name = $item->feature_image; ?>
        <div class=" col-md-12">
            <div class="left-item product-part">
                <a href="{{ url('produc/'.encrypt($item->id)) }}">
                    <div class="row">
                        <div class="col-md-6 col-4 col-xl-6">
                            <img class="img-fluid" src="{{ url('site_images/feature_image/' . $file_name) }}">
                        </div>
                        <div class="col-md-6 col-8  col-xl-6">
                             <h6 class="text-capitalize m-0">
                                 {{ $item->getCategory ? $item->getCategory->name. ',' : '' }}
                                 {{ $item->getSubCategory ? $item->getSubCategory->name : '' }}
                            </h6>    
                            <p class="d-none d-xl-block d-block "><b>Modal: </b>{{ $item->model }}</p>
                            <span class="new-price">{{ $item->price . ' ' . $item->currency_type }}</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
 
    @empty
        <div class="col-md-12 col-lg-12 text-uppercase">
            <h5 class="text-center">
                Products not found.
            </h5>
        </div>
    @endforelse
</div>

 
