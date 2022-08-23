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
                                        <input type="text" class="form-control input-default" id="edit_name"
                                        placeholder="Product Name" value="{{ $product->name }}" name="name">
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>

                                    <div class="col-md-4">
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
                                        <input type="file" class="form-control" id="edit_feature_image" name="feature_image"
                                            placeholder="feature image" :value="old('feature_image')">
                                            @error('feature_image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                     <div class="col-md-6">
                                        <div class="mb-8">
                                            @foreach ($product->images as $image)
                                            <i class="fa-solid fa-xmark"></i> <img src="{{ $image->url }}" width="50px"
                                                height="50px"/>

                                             @endforeach
                                        </div>
                                        {{-- <label class="col-lg-4 col-form-label" for="name">Multiple Images <span class="text-danger">*</span>
                                        </label> --}}
                                        <input type="file" class="form-control" id="images" name="images[]"
                                    placeholder="images"  multiple>
                                    @error('images')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                    </div>


                                </div>
                                <div class="form-group row ">
                                    <div class="col-md-4 mb-8">
                                        <input type="text" class="form-control input-default" id="edit_actual_price"
                                            placeholder="Actual Price" value="{{ $product->actual_price }}"
                                            name="actual_price">
                                            @error('actual_price')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="col-md-4 mb-8">
                                        <input type="text" class="form-control input-default" id="edit_discount"
                                            placeholder="Discount" value="{{ $product->discount }}" name="discount">
                                            @error('discount')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="col-md-4 mb-8">
                                        <input type="text" class="form-control input-default" id="edit_shipping_charge"
                                            placeholder="Shipping Charge" value="{{ $product->shipping_charge }}"
                                            name="shipping_charge">
                                            @error('shipping_charge')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>



                                <div class="form-group row ">
                                    <div class="col-md-4 mb-8">
                                        <input type="text" class="form-control input-default" id="edit_colour"
                                            placeholder="colour" value="{{ $product->colour }}" name="colour">
                                            @error('colour')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="col-md-4 mb-8">
                                        <input type="text" class="form-control input-default" id="edit-length"
                                            placeholder="length" value="{{ $product->length }}"name="length">
                                            @error('length')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="col-md-4 mb-8">
                                        <input type="text" class="form-control input-default" id="edit_width"
                                            placeholder="width" value="{{ $product->width }}"name="width">
                                            @error('width')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <div class="col-md-4 mb-8">
                                    <select name="currency" class="form-control" id="currency">
                                        <option value="">-- Select currency --</option>
                                        @foreach ( currencies() as $currency )


                                        <option value="{{$currency->code}}" {{ $product->currency == $currency->code?' selected':'' }}>{{$currency->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('code')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-8">
                                        <label class="col-lg-4 col-form-label form-check-label" for="name">

                                            <input type="checkbox" class="form-check-input" value="1"
                                                name="is_feature_product"
                                                {{ $product->is_feature_product == '1' ? 'checked' : '' }}>Feature Product
                                        </label>
                                        @error('width')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-8">
                                        <label class="col-lg-4 col-form-label form-check-label" for="name">

                                            <input type="checkbox" class="form-check-input" value="1"
                                                name="is_feature_product"
                                                {{ $product->is_arrival_product == '1' ? 'checked' : '' }}>Arrival Product
                                        </label>
                                        @error('is_arrival_product')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-8">
                                    <textarea class="form-control h-150px mysummernote" id="edit_description mysummernote" name="short_description" rows="6"
                                        placeholder="Write here.......">{{ $product->short_description }}</textarea>
                                        @error('short_description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="modal-footer">
                                    <a href="{{ url('/admin/products') }}" type="button" class="btn btn-secondary">
                                        Close </a>
                                    <button type="submit" id="button-update" onclick="updateProduct(this)"
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
        // function updateProduct() {
        //     var form = $('#edit-product-form')[0];
        //     $("#button-update").text('Loading...');
        //     proudct_id = form.proudct_id.value;
        //     console.log(proudct_id);
        //     console.log('proudct_id', proudct_id);

        //     const myFormData = new FormData(form);
        //     const formDataObj = {};
        //     myFormData.forEach((value, key) => (formDataObj[key] = value));
        //     console.log(formDataObj);
        //     $.ajax({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        //         },
        //         url: "/admin/products/" + proudct_id, // the endpoint
        //         type:"POST", // salahuyddin changed
        //         processData: false,
        //         contentType: false,
        //         data: myFormData,
        //         beforeSend: function () {
        //             $(form)
        //             $('.backend-error-text').text('')
        //             $("#button-update").prop("disabled", true);

        //         },
        //         success: function (data) {
        //             $("#button-update").prop("disabled", false);
        //             $("#button-update").text("Update Product");

        //             $(form)
        //                 .find('[type="button"]')
        //                 .prop("disabled", false);
        //                 swal({
        //                     title: "",
        //                     text: data.message,
        //                     icon: "success",
        //                 });
        //                 $(form)
        //                 .find('[type="button"]')
        //                 .prop("disabled", false);

        //         },
        //         error: function (error) {
        //             $(form)
        //             $("#button-update").prop("disabled", false);
        //             $("#button-update").text("Update Product");
        //             var errorMessage = error.statusText;
        //             var sweetMessage = error.statusText;

        //             if (error.status == 422) {
        //                 errorMessage = handleValidationErrors(error, 'edit')
        //                 sweetMessage = 'Invalid Data'
        //             }
        //             swal({
        //                 title: "Error",
        //                 text: sweetMessage,
        //                 icon: "error",
        //               });

        //         },
        //     });
        // }
        // function handleValidationErrors(error, type = 'create') {
        //     let errors = error.responseJSON.errors;
        //     var errorMessage = error.responseJSON.message
        //     var element = '';
        //     $.each(errors, function (key, item) {
        //         element = key.split('.')
        //         if (element.length > 1) {
        //             element = `${element[0]}_${element[1]}`
        //         } else {
        //             element = `${element}`
        //         }
        //         // dataAttr = $(element).closest('.tab').data('id')
        //         // $(`.step-${dataAttr}`).addClass('backend-error')
        //         if (type == 'edit') {
        //             console.log('edit',element);
        //             $(`#edit_${element}_text`).text(item[0])

        //         } else if (type == 'create') {
        //             $(`#${element}_text`).text(item[0])

        //         }
        //     });

        //     return errorMessage;
        // }



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
