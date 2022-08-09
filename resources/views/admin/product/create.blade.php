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
                <strong>Whoops!</strong><br> There were some<strong> problems</strong> with your input.<br><br>

            </div>
                @endif
                    <h4 class="card-title">Add Product</h4>

                    <div class="basic-form">
                        <form action="{{route('products.store')}}"  method="Post" id="product-form" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group  row mb-8">
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-default" placeholder="Product Name" :value="old('name')" name="name">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <select name="category_id" class="form-control" id="category">
                                    <option value="">-- Select Category --</option>
                                    @foreach ($category as $catitem )


                                    <option value="{{$catitem->id}}">{{$catitem->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                            </div>
                            <div class="col-md-4">
                                <select name="sub_category_id" id="subcategory" class="form-control" >
                                    <option >-- Select sub Category --</option>

                                </select>
                                @error('sub_category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>

                            </div>

                            <div class="form-group mb-8">
                                <textarea class="form-control h-150px mysummernote" id="" name="description" rows="6" placeholder="Write here.......">
                                   </textarea>
                                   @error('description')
                                   <div class="alert alert-danger">{{ $message }}</div>
                               @enderror
                            </div>


                            <div class="form-group row mb-8">
                                <div class="col-md-6">
                                    <label class="col-lg-4 col-form-label" for="name">Featured Image <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" class="form-control" id="feature_image" name="feature_image"
                                placeholder="feature image" :value="old('feature_image')">
                                @error('feature_image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="col-lg-4 col-form-label" for="name">Multiple Images <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" class="form-control" id="images" name="images[]"
                                placeholder="images" :value="old('images')" multiple>
                                @error('images')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                                </div>

                            </div>
                            <div class="form-group row ">
                                <div class="col-md-4 mb-8">
                                    <input type="text" class="form-control input-default" placeholder="Actual Price" :value="old('actual_price')" name="actual_price">
                                    @error('actual_price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="col-md-4 mb-8">
                                    <input type="text" class="form-control input-default" placeholder="Discount" :value="old('discount')" name="discount">
                                    @error('discount')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                                </div>
                                <div class="col-md-4 mb-8">
                                    <input type="text" class="form-control input-default" placeholder="Shipping Charge" :value="old('shipping_charge')" name="shipping_charge">
                                    @error('shipping_charge')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>

                               </div>

                            <div class="form-group row ">
                                <div class="col-md-4 mb-8">
                                    <input type="text" class="form-control input-default" placeholder="Colour" :value="old('colour')" name="colour">
                                    @error('colour')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="col-md-4 mb-8">
                                    <input type="text" class="form-control input-default" placeholder="Length" :value="old('length')" name="length">
                                    @error('length')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                                </div>
                                <div class="col-md-4 mb-8">
                                    <input type="text" class="form-control input-default" placeholder="Width" :value="old('Width')" name="width">
                                    @error('Width')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                                </div>

                               </div>
                               <div class="form-group row ">
                                <div class="col-md-4 mb-8">
                                    <select name="currency" class="form-control" id="currency">
                                        <option value="">-- Select currency --</option>
                                        @foreach ( currencies() as $currency )


                                        <option value="{{$currency->code}}">{{$currency->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="col-md-4 mb-8">
                                    <label class=" col-form-label form-check-label" for="name">

                                        <input type="checkbox" class="form-check-input" name="is_feature_product" value="1">Feature Product </label>
                                        @error('is_feature_product')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                                </div>
                                <div class="col-md-4 mb-8">
                                    <label class=" col-form-label form-check-label" for="name">

                                        <input type="checkbox" class="form-check-input" name="is_arrival_product" value="1">Arrival Product </label>
                                        @error('is_arrival_product')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                               </div>
                               {{-- <div class="form-group mb-8">
                                <textarea class="form-control h-150px mysummernote" id="" name="short_description" rows="6" placeholder="Describe yourself here...">
                                   </textarea>
                                   @error('description')
                                   <div class="alert alert-danger">{{ $message }}</div>
                               @enderror
                            </div> --}}

                               <div class="modal-footer">
                               <a href="{{url('/admin/products')}}"  type="button" class="btn btn-secondary"> Close </a>
                               <button type="submit"  id="button-save" onclick="submitProduct(this)" class="btn btn-primary">Add Products</button>
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
//  function submitProduct() {
//     var form = $('#product-form')[0];
//     $("#button-save").text('Loading...');
//     console.log('form ', form);


//     const myFormData = new FormData(form);
//     const formDataObj = {};
//     myFormData.forEach((value, key) => (formDataObj[key] = value));
//     console.log(formDataObj);
//     $.ajax({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
//         },
//         url: "/admin/products", // the endpoint
//         type: "POST", // http method
//         processData: false,
//         contentType: false,
//         data: myFormData,
//         beforeSend: function () {
//             $(form)
//             $('.backend-error-text').text('')
//             $("#button-save").prop("disabled", true);
//         },
//         success: function (data) {
//             $("#button-save").prop("disabled", false);
//             $("#button-save").text("Add Product");
//             console.log('data',data);
//             swal({
//                 title: "",
//                 text: data.message,
//                 icon: "success",

//               });
//             $(form)
//                 .find('[type="button"]')
//                 .prop("disabled", false);
//             document.getElementById("product-form").reset();



//         },
//         error: function (error) {
//             $(form)
//             $("#button-save").prop("disabled", false);
//             $("#button-save").text("Add Product");
//             var errorMessage = error.statusText;
//             var sweetMessage = error.statusText;
//             if (error.status == 422) {
//                 errorMessage = handleValidationErrors(error)
//                 sweetMessage ='Invalid Data'
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



    $("#category").on('change',function(){
        getSubCategory();
    });



    function getSubCategory(){
        var id = $("#category").val();

        console.log(id);
        $.ajax({
            method:'GET',
            url:"{{ route('getSubCategory') }}",
            data:{id:id},
            success:function(response){
                console.log(response);
                var str  = '<option selected disabled>--Select Sub Category--</option>';


                for(var i = 0; i< response.length; i++){
                    str += "<option value='"+response[i].id+"'>"+response[i].name+"</option>"
                }
                $("#subcategory").html(str);

            }

        });
    }



</script>
@endsection
