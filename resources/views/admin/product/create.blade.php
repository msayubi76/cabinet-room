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
                <strong>Whoops!</strong><br> There were some<strong> problems</strong> with your input.<br><br>

            </div>
                @endif
                    <h4 class="card-title">Add Product</h4>

                    <div class="basic-form">
                        <form action="{{route('products.store')}}"  method="Post" id="product-form" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group  row mb-8">
                                <div class="col-md-4">
                                    <label for=""> Product Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control input-default" placeholder="Product Name" :value="old('name')" name="name">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for=""> Product Category<span class="text-danger">*</span></label>
                                <select name="category_id" class="form-control" id="category">
                                    <option value="">-- Select Category --</option>
                                    @foreach ($category as $catitem )


                                    <option value="{{$catitem->id}}">{{$catitem->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                            </div>
                            <div class="col-md-4">
                                <label for=""> Product SubCategory<span class="text-danger">*</span></label>
                                <select name="sub_category_id" id="subcategory" class="form-control" >
                                    <option >-- Select sub Category --</option>

                                </select>
                                @error('sub_category_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>

                            </div>

                            <div class="form-group mb-8">
                                <label for=""> Product Discription<span class="text-danger">*</span></label>
                                <textarea class="form-control h-150px mysummernote" id="" name="description" rows="6" placeholder="Write here.......">
                                   </textarea>
                                   @error('description')
                                   <div class="text-danger">{{ $message }}</div>
                               @enderror
                            </div>


                            <div class="form-group row mb-8">
                                <div class="col-md-6">
                                    <label class="col-lg-4 col-form-label" for="name">Featured Image <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" class="form-control" id="feature_image" name="feature_image"
                                placeholder="feature image" :value="old('feature_image')">
                                @error('feature_image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="col-lg-4 col-form-label" for="name">Multiple Images <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" class="form-control" id="images" name="images[]"
                                placeholder="images" :value="old('images')" multiple>
                                @error('images')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                </div>

                            </div>
                            <div class="form-group row ">
                                <div class="col-md-4 mb-8 ">
                                    <label for="">Actual Price <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control input-default"  id="actualprice" placeholder="Actual Price" :value="old('actual_price')" name="actual_price">
                                    @error('actual_price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="col-md-4 mb-8">
                                    <label for="">Discount Optional <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control input-default" id="discount" placeholder="Discount Optional" :value="old('discount')" name="discount">
                                    @error('discount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                                </div>
                                <div class="col-md-4 mb-8">
                                    <label for="">Sale Price <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control input-default" id="saleprice" placeholder="Sale Price" :value="old('saleprice')" name="saleprice">
                                    @error('saleprice')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                                </div>


                               </div>

                            <div class="form-group row ">
                                <div class="col-md-4 mb-8">
                                    <label for="">Shipping Charge <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control input-default" placeholder="Shipping Charge" :value="old('shipping_charge')" name="shipping_charge">
                                    @error('shipping_charge')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="col-md-4 mb-8">
                                    <label for="">Product Length <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control input-default" placeholder="Product Length" :value="old('length')" name="length">
                                    @error('length')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                </div>
                                <div class="col-md-4 mb-8">
                                    <label for="">Product Width <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control input-default" placeholder="Product Width" :value="old('width')" name="width">
                                    @error('width')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                </div>

                               </div>
                               <div class="form-group row ">
                                <div class="col-md-2 mb-8">
                                    <label class=" col-form-label form-check-label y-8" for="name" style="margin-top: 30px;">

                                        <input type="checkbox" class="form-check-input" name="is_active" checked value="1">Active<span class="text-danger">*</span> </label>
                                        @error('is_active')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                </div>
                                <div class="col-md-2 mb-8">
                                    <label class=" col-form-label form-check-label y-8" for="name" style="margin-top: 30px;">

                                        <input type="checkbox" class="form-check-input" name="is_feature_product" value="1">Feature Product<span class="text-danger">*</span> </label>
                                        @error('is_feature_product')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                </div>
                                <div class="col-md-2 mb-8">
                                    <label class=" col-form-label form-check-label" for="name" style="margin-top: 30px;">

                                        <input type="checkbox" class="form-check-input" name="is_arrival_product" value="1">Arrival Product<span class="text-danger">*</span> </label>
                                        @error('is_arrival_product')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-8">
                                    <label for="">Product Colour <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control input-default" placeholder="Product Colour" :value="old('colour')" name="colour">
                                    @error('colour')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="col-md-3 mb-8">
                                    <label for="">Product Currency<span class="text-danger">*</span></label>
                                    <select name="currency" class="form-control" id="currency">
                                        <option value="">-- Select currency --</option>
                                        @foreach ( currencies() as $currency )


                                        <option value="{{$currency->code}}">{{$currency->code}}</option>
                                        @endforeach
                                    </select>
                                    @error('currency')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>
                               </div>
                               <div class="form-group mb-8">
                                <label for="">Product Short Discription<span class="text-danger">*</span></label>
                                <textarea class="form-control h-150px mysummernote" id="" name="short_description" rows="6" placeholder="Describe yourself here...">
                                   </textarea>
                                   @error('short_description')
                                   <div class="text-danger">{{ $message }}</div>
                               @enderror
                            </div>

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
$("#actualprice,#discount").keyup(function (e) {
 var actual = $("#actualprice").val();
 var discount = $("#discount").val();
 var divide = (discount / 100).toFixed(2);
 var mutiplication = actual * divide;
 var mainvalue = actual - mutiplication;
 $("#saleprice").val(mainvalue);


});



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
