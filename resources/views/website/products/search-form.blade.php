<form action="{{url('search_products')}}" enctype="multipart/form-data" method="post">
            @csrf
            <input type="hidden" name="is_damage" value="{{ $is_damage }}">
            <div class="row">
                <div class="col-md-4 col-lg-3 col-sm-6 ">
                    <label class="text-uppercase" >Select Make</label>
                    
                    <select name="make"   class="select2 form-control">
                        <option value="">Select Make</option>
                        @foreach ($make as $item)
                            <option value="{{$item->make}}" class="text-capitalize">{{$item->make}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-lg-3 col-sm-6 ">
                    <label  class="text-uppercase" >Select Model</label>
                    <select name="model"    class="select2 form-control">
                        <option value="">Select Model</option>
                        @foreach ($model as $item)
                            <option value="{{$item->model}}" class="text-capitalize">{{$item->model}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-lg-3 col-sm-6 ">
                    <label class="text-uppercase">Year from</label>
                    <select name="min_year"   class="select2 form-control">
                        <option value="">Select Year</option>
                        @foreach ($year as $item)
                            <option value="{{$item->year}}" class="text-capitalize">{{$item->year}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-4 col-lg-3 col-sm-6 ">
                    <label class="text-uppercase" >Year to</label>
                    <select name="max_year"   class="select2 form-control">
                        <option value="">Select Year</option>
                        @foreach ($year as $item)
                            <option value="{{$item->year}}" class="text-capitalize">{{$item->year}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-lg-3 col-sm-6 ">
                    <label class="text-uppercase" >Max price</label>
                    <select name="max_price" id="max_price" class="select2 form-control">
                        <option value="">Select price</option>
                        @foreach ($price as $item)
                            <option value="{{$item->price .'  '.$item->currency_type}}" class="text-capitalize">{{$item->price .'  '.$item->currency_type}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-lg-3 col-sm-6 ">
                    <label class="text-uppercase" >Min price</label>
                    <select name="min_price" id="min_price" class="select2 form-control">
                        <option value="">Select price</option>
                        @foreach ($price as $item)
                            <option value="{{$item->price}}" class="text-capitalize">{{$item->price .'  '.$item->currency_type}}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="col-md-4 col-lg-3 col-sm-6 ">
                    <label class="text-uppercase" >CC From</label>
                    <select name="min_cc" id="min_cc" class="select2 form-control">
                        <option value="">Select CC</option>
                        @foreach ($cc as $item)
                            <option value="{{$item->cc}}" class="text-capitalize">{{$item->cc}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-lg-3 col-sm-6 ">
                    <label class="text-uppercase" >CC To</label>
                    <select name="max_cc" id="max_cc" class="select2 form-control">
                        <option value="">Select CC</option>
                        @foreach ($cc as $item)
                            <option value="{{$item->cc}}" class="text-capitalize">{{$item->cc}}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="col-md-4 col-lg-3 col-sm-6 ">
                    <label class="text-uppercase" >Mileage From</label>
                    <select name="mileage_from" id="mileage_from" class="select2 form-control">
                        <option value="">Select Mileage</option>
                        @foreach ($mileage as $item)
                            <option value="{{$item->mileage}}" class="text-capitalize">{{$item->mileage}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-lg-3 col-sm-6 ">
                    <label class="text-uppercase" >Mileage to</label>
                    <select name="mileage_to" id="mileage_to" class="select2 form-control">
                        <option value="">Select Mileage</option>
                        @foreach ($mileage as $item)
                            <option value="{{$item->mileage}}" class="text-capitalize">{{$item->mileage}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-lg-3 col-sm-6 ">
                    <label class="text-uppercase" >Select transmission</label>
                    <select name="transmission"   class="select2 form-control">
                        <option value="">Select transmission</option>
                        @foreach ($transmission as $item)
                            <option value="{{$item->transmission}}" class="text-capitalize">{{$item->transmission}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-lg-3 col-sm-6 ">
                    <label class="text-uppercase">Select color</label>
                    <select name="color" id="color" class="select2 form-control">
                        <option value="">Select color</option>
                        @foreach ($color as $item)
                            <option value="{{$item->color}}" class="text-capitalize">{{$item->color}}</option>
                        @endforeach
                    </select>
                </div>
                 
                <div class="col-md-4 col-lg-3 col-sm-6 ">
                    <label class="text-uppercase">Select fuel</label>
                    <select name="hybrid_petrol_diesel" id="hybrid_petrol_diesel" class="select2 form-control">
                        <option value="">Select fuel</option>
                        @foreach ($fuel as $item)
                            <option value="{{$item->hybrid_petrol_diesel}}" class="text-capitalize">{{$item->hybrid_petrol_diesel}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
    
            <div class="row">
              <div class="col-md-12">
                <div class="btn-group float-right">

                    <button type="sbmit" class="btn btn-success  m-1 text-uppercase">Search</button>
                  </div>
              </div>
            </div>
        </form> 