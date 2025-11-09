@extends('layouts.theme')
@section('title', 'Home')
@section('content')
<style>
.product-wrapper .table-responsive {
  overflow-x: auto;
}

.product-wrapper #variationTableBody td, 
.product-wrapper #variationTableBody th {
  white-space: nowrap;
  padding: 8px 12px;
  vertical-align: middle;
}

.product-wrapper #variationTableBody input.form-control,
.product-wrapper #variationTableBody select.form-control {
  min-width: 120px;
  font-size: 13px;
  padding: 4px 6px;
}

.product-wrapper #variationTableBody td:last-child {
  text-align: center;
}

.product-wrapper #variationTableBody tr {
  border-bottom: 1px solid #dee2e6;
}
</style>
    <div class="container-fluid product-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert alert-success"> {{ session('message') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong><br> There were some<strong> problems</strong> with your
                                input.
                                {{ $errors }}
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
                                        <label for=""> Product Sub Category </label>
                                        <select name="sub_category_id" id="subcategory" class="form-control">
                                            <option value="">-- Select sub Category --</option>
                                            @foreach ($sub_categories as $sub_category)
                                                <option value="{{ $sub_category->id }}"
                                                    {{ $product->sub_category_id == $sub_category->id ? ' selected' : '' }}>
                                                    {{ $sub_category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('sub_category_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for=""> Product Discription<span class="text-danger">*</span></label>
                                        <textarea class="form-control h-150px mysummernote" id="edit_description mysummernote" name="description" rows="6"
                                            placeholder="Write here.......">{{ $product->description }}</textarea>
                                        @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Product Short Discription<span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control h-150px mysummernote" id="edit_description mysummernote" name="short_description"
                                            rows="6" placeholder="Write here.......">{{ $product->short_description }}</textarea>
                                        @error('short_description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-8">
                                    <div class="col-md-6">
                                        <label for=""> Feature Image<span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="edit_feature_image"
                                            name="feature_image" placeholder="feature image" :value="old('feature_image')">
                                        @error('feature_image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="mb-8">
                                            <img src="{{ asset($product->feature_image) }}" width="50px" height="50px"
                                                alt="img">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Multiple Images
                                        </label>
                                        <input type="file" class="form-control" id="images" name="images[]"
                                            placeholder="images" :value="old('images')" multiple>
                                        @error('images')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="row">
                                            @foreach ($product->images as $image)
                                                <div class="col-md-2">
                                                    <a href=""></a> <img src="{{ $image->url }}" width="50px"
                                                        height="50px" />
                                                    <a href="{{ url('admin/delete/' . $image->id) }}" class="d-block">
                                                        remove</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- TCS Shipping Information Section -->
                                <div class="form-group row mb-8">
                                    <div class="col-md-12">
                                        <h4 class="card-title">TCS Shipping Information</h4>
                                        <hr>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="">Weight <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control input-default" placeholder="Weight"
                                            value="{{ $product->weight }}" name="weight" step="0.01" min="0.01">
                                        @error('weight')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label for="">Weight Unit</label>
                                        <select name="weight_unit" class="form-control">
                                            <!-- <option value="kg" {{ $product->weight_unit == 'kg' ? 'selected' : '' }}>Kilograms (kg)</option> -->
                                            <option value="g" {{ $product->weight_unit == 'g' ? 'selected' : '' }}>Grams (g)</option>
                                            <!-- <option value="lbs" {{ $product->weight_unit == 'lbs' ? 'selected' : '' }}>Pounds (lbs)</option> -->
                                        </select>
                                        @error('weight_unit')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label for="">TCS Product Description</label>
                                        <input type="text" class="form-control input-default" placeholder="TCS Description"
                                            value="{{ $product->tcs_product_description }}" name="tcs_product_description">
                                        @error('tcs_product_description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label for="">SKU</label>
                                        <input type="text" class="form-control input-default" placeholder="SKU"
                                            value="{{ $product->sku }}" name="sku">
                                        @error('sku')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Product Dimensions -->
                                <div class="form-group row mb-8">
                                    <div class="col-md-12">
                                        <h5>Product Dimensions</h5>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="">Length</label>
                                        <input type="number" class="form-control input-default" placeholder="Length"
                                            value="{{ $product->length }}" name="length" step="0.01" min="0">
                                        @error('length')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label for="">Width</label>
                                        <input type="number" class="form-control input-default" placeholder="Width"
                                            value="{{ $product->width }}" name="width" step="0.01" min="0">
                                        @error('width')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label for="">Height</label>
                                        <input type="number" class="form-control input-default" placeholder="Height"
                                            value="{{ $product->height }}" name="height" step="0.01" min="0">
                                        @error('height')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label for="">Dimension Unit</label>
                                        <select name="dimension_unit" class="form-control">
                                            <option value="cm" {{ $product->dimension_unit == 'cm' ? 'selected' : '' }}>Centimeters (cm)</option>
                                            <!-- <option value="m" {{ $product->dimension_unit == 'm' ? 'selected' : '' }}>Meters (m)</option>
                                            <option value="inch" {{ $product->dimension_unit == 'inch' ? 'selected' : '' }}>Inches</option>
                                            <option value="mm" {{ $product->dimension_unit == 'mm' ? 'selected' : '' }}>Millimeters (mm)</option> -->
                                        </select>
                                        @error('dimension_unit')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <div class="col-md-4 mb-8">
                                        <label for="">Actual Price<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control input-default" id="actualprice"
                                            placeholder="Actual Price" value="{{ (int) $product->actual_price }}"
                                            name="actual_price">
                                        @error('actual_price')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-8">
                                        <label for="">Discount Optional </label>
                                        <input type="number" class="form-control input-default" id="discount"
                                            placeholder="Discount Optional" value="{{ (int) $product->discount }}"
                                            name="discount">
                                        @error('discount')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-8">
                                        <label for="">Shipping Charge </label>
                                        <input type="text" class="form-control input-default" id="edit_shipping_charge"
                                            placeholder="Shipping Charge" value="{{ $product->shipping_charge }}"
                                            name="shipping_charge">
                                        @error('shipping_charge')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-8">
                                        <label for="">Sale Price<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control input-default" id="saleprice"
                                            placeholder="Sale Price" value="{{ (int) $product->saleprice }}"
                                            name="saleprice">
                                        @error('saleprice')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-8">
                                        <label for="">Product Currency<span class="text-danger">*</span></label>
                                        <select name="currency" class="form-control" id="currency">
                                            <option value="">-- Select Currency --</option>
                                            @foreach (currencies() as $currency)
                                                <option value="{{ $currency->code }}"
                                                    {{ $product->currency == $currency->code ? ' selected' : '' }}>
                                                    {{ $currency->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('code')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Delivered-in</label>
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" placeholder="01-05 Working days "
                                                value="{{ $product->delivered_in }}" name="delivered_in"
                                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        </div>
                                        @error('delivered_in')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Reviews</label>
                                        <input type="number" class="form-control input-default" min="1"
                                            max="5" placeholder="Rate" value="{{ $product->rating }}"
                                            name="rating">
                                        @error('rating')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="">Available Stock </label>
                                        <input type="number" class="form-control input-default" min="1"
                                            id="available-stock"  placeholder="Available Stock"
                                            value="{{ $product->stock }}" name="stock">
                                        @error('stock')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row px-4">
                                    <div class="col-md-2 mb-8">
                                        <label for="is_active">
                                            <input type="checkbox" class="form-check-input" value="1"
                                                id="is_active" name="is_active"
                                                {{ $product->is_active == '1' ? 'checked' : '' }}>Active
                                        </label>
                                        @error('is_active')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-2 mb-8">
                                        <label for="is_feature_product">
                                            <input type="checkbox" class="form-check-input" value="1"
                                                name="is_feature_product" id="is_feature_product"
                                                {{ $product->is_feature_product == '1' ? 'checked' : '' }}>Feature Product
                                        </label>
                                        @error('is_feature_product')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mb-8">
                                        <label for="is_arrival_product">
                                            <input type="checkbox" class="form-check-input" value="1"
                                                name="is_arrival_product" id="is_arrival_product"
                                                {{ $product->is_arrival_product == '1' ? 'checked' : '' }}>Arrival Product
                                        </label>
                                        @error('is_arrival_product')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label for="is_installment_available" for="is_installment_available">
                                            <input type="checkbox" id="is_installment_available" class="form-check-input"
                                                name="is_installment_available" value="1"
                                                {{ $product->is_installment_available == '1' ? 'checked' : '' }}>
                                            Installment Available </label>
                                    </div>
                                </div>

                                <!-- MOVE VARIATIONS SECTION INSIDE THE FORM -->
                                <div class="row px-4" id="product-variations">
                                    <div class="col-md-12">
                                        <h3>Product Variations</h3>
                                        <hr>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Variations List</h4>
                                    </div>
                                    <div class="col-md-6 text-right px-5">
                                        <button type="button" class="btn-success btn text-white"
                                            onclick="addMoreVariation()">Add More</button>
                                    </div>
                                    <div class="col-md-12">
                                    <div class="table-responsive">

                                        @php
                                            $variations = $product->variations;
                                            $variationCount = count($variations);
                                        @endphp
                                        <table class="table">
                                            <thead>
                                                <th>Sr No</th>
                                                <th>Name</th>
                                                <th>Value</th>
                                                <th>Price</th>
                                                <th>Discount</th>
                                                <th>Sale Price</th>
                                                <th>Stock</th>
                                                <!-- TCS Fields for Variations -->
                                                <th>Weight (g)</th>
                                                <th>Length (cm)</th>
                                                <th>Width (cm)</th>
                                                <th>Height (cm)</th>
                                                <th>TCS Description</th>
                                                <th>SKU</th>
                                                <th>Images</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody id="variationTableBody">
                                                @foreach($product->variations as $i => $variation)
                                                <tr>
                                                    <input type="hidden" name="Variation[{{ $i }}][id]" value="{{ $variation->id }}">
                                                    <td class="count">{{ $i + 1 }}</td>
                                                    <td>
                                                        <select class="form-control name" name="Variation[{{ $i }}][name]">
                                                            <option value="color" {{ $variation->name == 'color' ? 'selected' : '' }}>Color</option>
                                                            <option value="size" {{ $variation->name == 'size' ? 'selected' : '' }}>Size</option>
                                                            <option value="material" {{ $variation->name == 'material' ? 'selected' : '' }}>Material</option>
                                                            <option value="style" {{ $variation->name == 'style' ? 'selected' : '' }}>Style</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input class="form-control value" type="text" name="Variation[{{ $i }}][value]" value="{{ $variation->value }}">
                                                    </td>
                                                    <td>
                                                        <input class="form-control price" type="number" name="Variation[{{ $i }}][price]" value="{{ $variation->price }}" onkeyup="calculateVariationDiscount(this)" onchange="calculateVariationDiscount(this)">
                                                    </td>
                                                    <td>
                                                        <input class="form-control discount" type="number" name="Variation[{{ $i }}][discount]" value="{{ $variation->discount }}" onkeyup="calculateVariationDiscount(this)" onchange="calculateVariationDiscount(this)">
                                                    </td>
                                                    <td>
                                                        <input class="form-control sale_price" type="number" name="Variation[{{ $i }}][sale_price]" value="{{ $variation->sale_price }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input class="form-control stock" type="number" name="Variation[{{ $i }}][stock]" value="{{ $variation->stock }}" onkeyup="updateStock()" onchange="updateStock()">
                                                    </td>
                                                    <!-- TCS Fields for Variation -->
                                                    <td>
                                                        <input class="form-control variant-weight" type="number" name="Variation[{{ $i }}][weight]" value="{{ $variation->weight }}" step="0.01" min="0.01" onchange="autoFillVariantDimensions(this)">
                                                    </td>
                                                    <td>
                                                        <input class="form-control variant-length" type="number" name="Variation[{{ $i }}][length]" value="{{ $variation->length }}" step="0.01" min="0">
                                                    </td>
                                                    <td>
                                                        <input class="form-control variant-width" type="number" name="Variation[{{ $i }}][width]" value="{{ $variation->width }}" step="0.01" min="0">
                                                    </td>
                                                    <td>
                                                        <input class="form-control variant-height" type="number" name="Variation[{{ $i }}][height]" value="{{ $variation->height }}" step="0.01" min="0">
                                                    </td>
                                                    <td>
                                                        <input class="form-control variant-tcs-desc" type="text" name="Variation[{{ $i }}][tcs_description]" value="{{ $variation->tcs_description }}">
                                                    </td>
                                                    <td>
                                                        <input class="form-control variant-sku" type="text" name="Variation[{{ $i }}][sku]" value="{{ $variation->sku }}">
                                                    </td>
                                                    <td>
                                                        <input type="file" class="images" multiple name="Variation[{{ $i }}][images][]">
                                                        @if($variation->media && count($variation->media) > 0)
                                                            <div class="mt-2">
                                                                @foreach($variation->media as $media)
                                                                    <img src="{{ $media->url }}" width="30" height="30" class="mr-1">
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn-danger btn delete btn-sm" onclick="deleteVariationRow(this)">Delete</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <a href="{{ url('/admin/products') }}" type="button" class="btn btn-secondary">
                                        Close </a>
                                    <button type="submit" id="button-update" class="btn btn-primary">Update Products</button>
                                </div>
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
        const currentProduct = @json($product)
    </script>
    <script src="{{ url('admin-assets/js/products.js') }}"></script>
@endsection
{{-- @section('scripts')
    <script>
        $("#actualprice,#discount").keyup(function(e) {
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
@endsection --}}


@section('scripts')
    <script>
        const currentProduct = @json($product)
    </script>
    <script src="{{ url('admin-assets/js/products.js') }}"></script>
@endsection