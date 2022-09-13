@extends('layouts.theme')
@section('title', 'Home')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong><br> There were some<strong> problems</strong> with your
                                input.<br><br>

                            </div>
                        @endif
                        <h4 class="card-title">Update Product</h4>

                        <div class="basic-form">
                            <form action="{{ route('products.update', $product->id) }}" method="post" id="edit-product-form"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="-1" id="product_id">
                                <input type="hidden" value="PUT" name="_method">
                                <div class="form-group row mb-8">

                                    <div class="col-md-4">
                                        <label for=""> Product Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control input-default" id="edit_name"
                                        placeholder="Product Name" value="{{ $product->name }}" name="name">
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for=""> Product Category<span class="text-danger">*</span></label>
                                        <select name="category_id" class="form-control" id="category">
                                            <option value="">-- Select Category --</option>
                                            @foreach ($category as $catitem)

                                                <option value="{{ $catitem->id }}"
                                                    {{ $product->category_id == $catitem->id ? 'selected' : '' }}>
                                                    {{ $catitem->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for=""> Product SubCategory<span class="text-danger">*</span></label>
                                        <select name="sub_category_id" id="subcategory" class="form-control">
                                            <option>-- Select sub Category --</option>

                                            @foreach ($sub_categories as $sub_category)

                                                <option value="{{ $sub_category->id }}" {{ $product->sub_category_id == $sub_category->id?' selected':'' }}>{{ $sub_category->name }}</option>
                                            @endforeach


                                        </select>
                                        @error('sub_category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>


                                </div>

                                <div class="form-group mb-8">
                                    <label for=""> Product Discription<span class="text-danger">*</span></label>
                                    <textarea class="form-control h-150px mysummernote" id="edit_description mysummernote" name="description" rows="6"
                                        placeholder="Write here.......">{{ $product->description }}</textarea>
                                        @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group row mb-8">
                                    <div class="col-md-6">
                                        <div class="mb-8">
                                            <img src="{{ asset( $product->feature_image) }}" width="50px"
                                                height="50px" alt="img">
                                        </div>
                                        <label for=""> Feature Image<span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="edit_feature_image" name="feature_image"
                                            placeholder="feature image" :value="old('feature_image')">
                                            @error('feature_image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                     <div class="col-md-6">
                                        <div class="mb-8">
                                            @foreach ($product->images as $image)
                                            <i class="fa-solid fa-xmark"></i><a href=""></a> <img src="{{ $image->url }}" width="50px"
                                                height="50px"/>

                                             @endforeach
                                        </div>
                                        <label  for="">Multiple Images<span class="text-danger">*</span>
                                        </label>
                                        <input type="file" class="form-control" id="images" name="images[]"
                                    placeholder="images" :value="old('images')" multiple>
                                    @error('images')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                    </div>


                                </div>
                                <div class="form-group row ">
                                    <div class="col-md-4 mb-8">
                                        <label for="">Actual Price<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control input-default" id="actualprice"
                                            placeholder="Actual Price" value="{{ $product->actual_price }}"
                                            name="actual_price">
                                            @error('actual_price')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="col-md-4 mb-8">
                                        <label for="">Discount Optional<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control input-default" id="discount"
                                            placeholder="Discount Optional" value="{{ $product->discount }}" name="discount">
                                            @error('discount')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                         <div class="col-md-4 mb-8">
                                            <label for="">Sale Price<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control input-default" id="saleprice"
                                            placeholder="Sale Price" value="{{ $product->saleprice }}" name="saleprice">
                                            @error('saleprice')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>

                                </div>



                                <div class="form-group row ">
                                    <div class="col-md-4 mb-8">
                                        <label for="">Shipping Charge<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control input-default" id="edit_shipping_charge"
                                            placeholder="Shipping Charge" value="{{ $product->shipping_charge }}"
                                            name="shipping_charge">
                                            @error('shipping_charge')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="col-md-4 mb-8">
                                        <label for="">Product Length<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control input-default" id="edit-length"
                                            placeholder="Length" value="{{ $product->length }}"name="length">
                                            @error('length')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="col-md-4 mb-8">
                                        <label for="">Product width<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control input-default" id="edit_width"
                                            placeholder="width" value="{{ $product->width }}" name="width">
                                            @error('width')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <div class="col-md-2 mb-8">
                                        <label style="margin-top: 30px;">

                                            <input type="checkbox" class="form-check-input" value="1"
                                                name="is_active"
                                                {{ $product->is_active == '1' ? 'checked' : '' }}>Active
                                                <span class="text-danger">*</span></label>
                                        @error('width')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-2 mb-8">
                                        <label style="margin-top: 30px;">

                                            <input type="checkbox" class="form-check-input" value="1"
                                                name="is_feature_product"
                                                {{ $product->is_feature_product == '1' ? 'checked' : '' }}>Feature Product
                                                <span class="text-danger">*</span></label>
                                        @error('width')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mb-8">
                                        <label style="margin-top: 30px;">

                                            <input type="checkbox" class="form-check-input" value="1"
                                                name="is_feature_product"
                                                {{ $product->is_arrival_product == '1' ? 'checked' : '' }}>Arrival Product
                                                <span class="text-danger">*</span></label>
                                        @error('is_arrival_product')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mb-8">
                                        <label for="">Product Colour<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control input-default" id="edit_colour"
                                            placeholder="colour" value="{{ $product->colour }}" name="colour">
                                            @error('colour')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="col-md-3 mb-8">
                                        <label for="">Product Currency<span class="text-danger">*</span></label>
                                    <select name="currency" class="form-control" id="currency">
                                        <option value="">-- Select Currency --</option>
                                        @foreach ( currencies() as $currency )


                                        <option value="{{$currency->code}}" {{ $product->currency == $currency->code?' selected':'' }}>{{$currency->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('code')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-8">
                                    <label for="">Product Short Discription<span class="text-danger">*</span></label>
                                    <textarea class="form-control h-150px mysummernote" id="edit_description mysummernote" name="short_description" rows="6"
                                        placeholder="Write here.......">{{ $product->short_description }}</textarea>
                                        @error('short_description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="modal-footer">
                                    <a href="{{ url('/admin/products') }}" type="button" class="btn btn-secondary">
                                        Close </a>
                                    <button type="submit" id="button-update"
                                        class="btn btn-primary">Update Products</button>
                                </div><br>



                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
      $("#actualprice,#discount").keyup(function (e) {
 var actual = $("#actualprice").val();
 var discount = $("#discount").val();
 var divide = (discount / 100).toFixed(2);
 var mutiplication = actual * divide;
 var mainvalue = actual - mutiplication;
 $("#saleprice").val(mainvalue);


});



        $("#category").on('change', function() {
            getSubCategory();
        });



        function getSubCategory() {
            var id = $("#category").val();

            console.log(id);
            $.ajax({
                method: 'GET',
                url: "{{ route('getSubCategory') }}",
                data: {
                    id: id
                },
                success: function(response) {
                    console.log(response);
                    var str = '<option selected disabled>--Select Sub Category--</option>';


                    for (var i = 0; i < response.length; i++) {
                        str += "<option value='" + response[i].id + "'>" + response[i].name + "</option>"
                    }
                    $("#subcategory").html(str);

                }

            });
        }
    </script>
@endsection
