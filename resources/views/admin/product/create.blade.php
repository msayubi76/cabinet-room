@extends('layouts.theme')
@section('title', 'Home')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="text-danger">
                                <strong>Whoops!</strong><br> There were some<strong> problems</strong> with your
                                input.
                            </div>
                            {{ $errors }}
                            <br><br>
                        @endif
                        <h4 class="card-title">Add Product</h4>

                        <div class="basic-form">
                            <form action="{{ route('products.store') }}" method="Post" id="product-form"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group  row mb-8">
                                    <div class="col-md-4">
                                        <label for=""> Product Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control input-default" placeholder="Product Name"
                                            value="{{ old('name') }}" name="name">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for=""> Product Category<span class="text-danger">*</span></label>
                                        <select name="category_id" class="form-control" id="category">
                                            <option value="">-- Select Category --</option>
                                            @foreach ($category as $catitem)
                                                @if (old('category_id') == $catitem->id)
                                                    <option value="{{ $catitem->id }}" selected>{{ $catitem->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $catitem->id }}">{{ $catitem->name }}</option>
                                                @endif
                                                <!-- <option value="{{ $catitem->id }}">{{ $catitem->name }}</option> -->
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for=""> Product Sub Category</label>
                                        <select name="sub_category_id" id="subcategory" class="form-control">
                                            <option value="">-- Select sub Category --</option>
                                        </select>
                                        @error('sub_category_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-md-6">
                                        <label for=""> Product Discription<span class="text-danger">*</span></label>
                                        <textarea class="form-control h-150px mysummernote" id="" name="description" rows="6"
                                            placeholder="Write here.......">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Product Short Discription<span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control h-150px mysummernote" id="" name="short_description" rows="6"
                                            placeholder="Short Discription"> {{ old('short_description') }} </textarea>
                                        @error('short_description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>



                                <div class="form-group row mb-8">
                                    <div class="col-md-6">
                                        <label class="col-lg-4 col-form-label" for="name">Featured Image <span
                                                class="text-danger">*</span>
                                        </label>
                                        <input type="file" class="form-control" id="feature_image" name="feature_image"
                                            placeholder="feature image" :value="old('feature_image')">
                                        @error('feature_image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-lg-4 col-form-label" for="name">Multiple Images
                                        </label>
                                        <input type="file" class="form-control" id="images" name="images[]" multiple>
                                        @error('images')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group row ">
                                    <div class="col-md-4 mb-8 ">
                                        <label for="">Actual Price <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control input-default" id="actualprice"
                                            placeholder="Actual Price" value="{{ old('actual_price') }}"
                                            name="actual_price">
                                        @error('actual_price')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-8">
                                        <label for="">Discount Optional (Rs)</label>
                                        <input type="number" class="form-control input-default" id="discount"
                                            placeholder="Discount Optional" value="{{ old('discount') }}" name="discount">
                                        @error('discount')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-8">
                                        <label for="">Sale Price <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control input-default" id="saleprice"
                                            placeholder="Sale Price" value="{{ old('saleprice') }}" name="saleprice">
                                        @error('saleprice')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                </div>


                                <div class=" row ">


                                    <div class="col-md-4 ">
                                        <label for="">Product Currency<span class="text-danger">*</span></label>
                                        <select name="currency" class="form-control" id="currency">
                                            <option value="">-- Select currency --</option>
                                            @foreach (currencies() as $currency)
                                                @if (old('currency') == $currency->code)
                                                    <option value="{{ $currency->code }}" selected>{{ $currency->code }}
                                                    </option>
                                                @else
                                                    <option value="{{ $currency->code }}">{{ $currency->code }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('currency')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Delivered-in</label>
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" placeholder="01-05 Working days"
                                                value="{{ old('delivered_in') }}" name="delivered_in"
                                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <!-- <div class="input-group-append">
                                                                                                                                                                                                                            <span class="input-group-text" id="basic-addon2">Working days</span>
                                                                                                                                                                                                                        </div> -->
                                        </div>
                                        @error('delivered_in')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Reviews </label>
                                        <input type="number" class="form-control input-default" min="1"
                                            max="5" placeholder="Rate" value="{{ old('rating') }}"
                                            name="rating">
                                        @error('rating')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Available Stock </label>
                                        <input type="number" class="form-control input-default" min="1"
                                            id="available-stock"  placeholder="Available Stock"
                                            value="{{ old('stock') }}" name="stock">
                                        @error('stock')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class=" row  px-4">
                                    <div class="col-md-2">
                                        <label class=" col-form-label form-check-label" for="have_variations">
                                            <input type="checkbox" class="form-check-input" name="have_variations"
                                                onchange="enableDisableVariations(this)" value="1"
                                                id="have_variations"
                                                {{ old('have_variations') == '1' ? 'checked' : '' }}>Have Variations
                                        </label>
                                    </div>
                                    <div class="col-md-2 ">
                                        <label class=" col-form-label form-check-label  " for="is_active">

                                            <input type="checkbox" class="form-check-input" name="is_active" checked
                                                value="1" id="is_active"
                                                {{ old('is_active') == '1' ? 'checked' : '' }}>Active </label>
                                        @error('is_active')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2  ">
                                        <label class=" col-form-label form-check-label y-8" for="is_feature_product">
                                            <input type="checkbox" class="form-check-input" name="is_feature_product"
                                                id="is_feature_product" value="1"
                                                {{ old('is_feature_product') == '1' ? 'checked' : '' }}>
                                            Feature Product </label>
                                        @error('is_feature_product')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mb-8">
                                        <label class=" col-form-label form-check-label" for="is_arrival_product">

                                            <input type="checkbox" class="form-check-input" name="is_arrival_product"
                                                value="1" id="is_arrival_product"
                                                {{ old('is_arrival_product') == '1' ? 'checked' : '' }}>Arrival
                                            Product </label>
                                        @error('is_arrival_product')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mb-8">
                                        <label class=" col-form-label form-check-label" for="is_for_request_quote">

                                            <input type="checkbox" class="form-check-input" name="is_for_request_quote"
                                                value="1" id="is_for_request_quote"
                                                {{ old('is_for_request_quote') == '1' ? 'checked' : '' }}>Request
                                            Quote </label>
                                        @error('is_for_request_quote')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-2">
                                        <label class=" col-form-label form-check-label" for="is_installment_available">
                                            <input type="checkbox" class="form-check-input"
                                                name="is_installment_available" value="1"
                                                id="is_installment_available"
                                                {{ old('is_installment_available') == '1' ? 'checked' : '' }}>Installment
                                            Available </label>
                                    </div>
                                </div>

                                <div class="row px-4" id="product-variations">
                                    <div class="col-md-6">
                                        <h3>Product Variations</h3>
                                    </div>
                                    <div class="col-md-6 text-right px-5">
                                        <button type="button" class="btn-success btn text-white"
                                            onclick="addMoreVariation()">Add
                                            More</button>
                                    </div>
                                    <div class="col-md-12">
                                        @php
                                            $variations = old('Variation', []);
                                            $variationCount = count($variations);
                                        @endphp
                                        <table class="table">
                                            <thead>
                                                <th>Sr No</th>
                                                <th>Name </th>
                                                <th>Value</th>
                                                <th>Price</th>
                                                <th>Stock</th>
                                                <th>Images</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody id="variationTableBody">

                                                @for ($i = 0; $i < max(1, $variationCount); $i++)
                                                    @if (isset($variations[$i]))
                                                        @php $variation = $variations[$i]; @endphp
                                                    @else
                                                        @php $variation = ['name' => '', 'value' => '', 'price' => '', 'stock' => '']; @endphp
                                                    @endif
                                                    <tr>
                                                        <td class="count">{{ $i + 1 }}</td>
                                                        <td>
                                                            <select class="form-control" required
                                                                name="Variation[{{ $i }}][name]">
                                                                <option
                                                                    {{ old('Variation.' . $i . '.name', $variation['name']) == 'color' ? 'selected' : '' }}
                                                                    value="color">Color</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text"
                                                                name="Variation[{{ $i }}][value]" required
                                                                placeholder="Value"
                                                                value="{{ old('Variation.' . $i . '.value', $variation['value']) }}">
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="number"
                                                                name="Variation[{{ $i }}][price]" required
                                                                placeholder="Price"
                                                                value="{{ old('Variation.' . $i . '.price', $variation['price']) }}">
                                                        </td>
                                                        <td>
                                                            <input class="form-control stock" type="number"
                                                                name="Variation[{{ $i }}][stock]" required
                                                                placeholder="Stock" onkeyup="updateStock()"
                                                                onchange="updateStock()"
                                                                value="{{ old('Variation.' . $i . '.stock', $variation['stock']) }}">
                                                        </td>
                                                        <td>
                                                            <input type="file" multiple required
                                                                name="Variation[{{ $i }}][images][]">
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn-danger btn"
                                                                onclick="deleteVariation(this)">Delete</button>
                                                        </td>
                                                    </tr>
                                                @endfor

                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <div class="modal-footer">
                                    <a href="{{ url('/admin/products') }}" type="button" class="btn btn-secondary">
                                        Close </a>
                                    <button type="submit" id="button-save" onclick="submitProduct(this)"
                                        class="btn btn-primary">Add Products</button>
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
    <script src="{{ url('admin-assets/js/products.js') }}"></script>

@endsection
