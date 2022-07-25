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
                @foreach ($errors->all() as $error)
                <div>{{$error}}</div>

                @endforeach
            </div>
                @endif
                    <h4 class="card-title">Add Product</h4>

                    <div class="basic-form">
                        <form action="{{route('products/store')}}" method="post">
                            @csrf
                            <div class="form-group mb-8">
                                <input type="text" class="form-control input-default" placeholder="Product Name" :value="old('name')" name="name">
                            </div>
                            <div class="form-group row ">
                                <div class="col-md-6 mb-8">
                                    <select name="category_id" class="form-control" id="category">
                                        <option value="">-- Select Category --</option>
                                        @foreach ($category as $catitem )


                                        <option value="{{$catitem->id}}">{{$catitem->name}}</option>
                                        @endforeach
                                    </select>  </div>
                                <div class="col-md-6 mb-8">
                                    <select name="subcategory" id="subcategory" class="form-control" >
                                        <option selected disabled>-- Select sub Category --</option>
                                        {{-- @foreach ($category as $catitem ) --}}


                                        {{-- <option value="{{$catitem->id}}">{{$catitem->name}}</option> --}}
                                        {{-- @endforeach --}}
                                    </select></div>
                               </div>
                            <div class="form-group mb-8">
                                <textarea class="form-control h-150px" id="description" name="description" rows="6" placeholder="Write here.......">
                                   </textarea></div>
                                   <div class="form-group row ">
                                    <div class="col-md-6 mb-8">
                                        <input type="text" class="form-control input-default" placeholder="Actual Price" :value="old('actual_price')" name="actual_price">
                                    </div>
                                    <div class="col-md-6 mb-8">
                                        <input type="text" class="form-control input-default" placeholder="Discount" :value="old('discount')" name="discount">
                                    </div>
                                   </div>
                                   <div class="form-group row ">
                                    <div class="col-md-6 mb-8">
                                        <input type="text" class="form-control input-default" placeholder="Shipping Charge" :value="old('shipping_charge')" name="shipping_charge">
                                    </div>
                                    <div class="col-md-6 mb-8">
                                        <input type="text" class="form-control input-default" placeholder="colour" :value="old('colour')" name="colour">
                                    </div>
                                   </div>
                            <div class="form-group mb-8">
                                <input type="file" class="form-control" id="feature_image" name="feature_image"
                            placeholder="feature image" :value="old('feature_image')">
                            </div>
                            <div class="form-group mb-8">
                                <input type="file" class="form-control" id="image" name="images"
                            placeholder="images" :value="old('images')"></div>
                            <div class="form-group row ">
                                <div class="col-md-6 mb-8">
                                    <input type="text" class="form-control input-default" placeholder="length" :value="old('images')" name="length">
                                </div>
                                <div class="col-md-6 mb-8">
                                    <input type="text" class="form-control input-default" placeholder="width" :value="old('images')" name="width">
                                </div>
                               </div>
                               <div class="modal-footer">
                               <a href="{{url('/admin/products')}}"  type="button" class="btn btn-secondary"> Close </a>
                               <button type="submit"   class="btn btn-primary">Add Products</button>
                            </div><br>



                            </form>
                    </div>
                </div>
            </div>
        </div>
 </div>
</div>


<script>
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
