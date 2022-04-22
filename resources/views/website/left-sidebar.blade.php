<div class="row">

    @forelse ($parts as $item)
        <?php $file_name = $item->feature_image; ?>
        <div class="col-md-12 col-xl-12  ">

            <div class="left-item">
                <a href="{{ url('part-detail/' . encrypt($item->id)) }}">
                    <div class="row">
                        <div class="col-md-6 col-4 col-xl-4"> 
                                <img height="60" width="100%"  class="rounded-circle"  src="{{ url('site_images/feature_image/' . $file_name) }}"
                                    alt="{{ $item->name }}"> 
                        </div> 
                        <div class="col-md-6 col-8 col-xl-8">
                            <div class="product-content">
                                <div class="product-desc_info"> 
                                    <h6>  {{ $item->name }} </h6>
                                    <div class="price-box">
                                        <span class="new-price"> {{ $item->currency_type }} {{ $item->price }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    @empty
        <div class="col-md-12 col-lg-12">
            <h5 class="text-center text-uppercase">
                Parts not found.
            </h5>
        </div>
    @endforelse


</div>
