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
                {{-- <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>

                @endforeach
                </ul> --}}
            </div>
                @endif
                    <h4 class="card-title">Update Product</h4>

                    <div class="basic-form">
                        <form action=""  method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-8">
                                <input type="text" class="form-control input-default" placeholder="Product Name" value="{{$product->name}}" name="name">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="form-group row ">
                                <div class="col-md-6 mb-8">
                                    <select name="category_id" class="form-control" id="category">
                                        <option value="">-- Select Category --</option>
                                        @foreach ($category as $catitem )


                                         <option value="{{$catitem->id}}" {{$product->category_id == $catitem->id ? 'selected' : ''}}>{{$catitem->name}}</option>

                                        @endforeach
                                    </select> @error('category_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror </div>
                                <div class="col-md-6 mb-8">
                                    <select name="subcategory_id" id="subcategory" class="form-control" >
                                        <option >-- Select sub Category --</option>

                                    </select>
                                    @error('subcategory_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                               </div>
                            <div class="form-group mb-8">
                                <textarea class="form-control h-150px" id="description" name="description" rows="6" placeholder="Write here.......">{{$product->description}}</textarea>
                                   @error('description')
                                   <div class="alert alert-danger">{{ $message }}</div>
                               @enderror
                            </div>
                                   <div class="form-group row ">
                                    <div class="col-md-6 mb-8">
                                        <input type="text" class="form-control input-default" placeholder="Actual Price" value="{{$product->actual_price}}" name="actual_price">
                                        @error('actual_price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="col-md-6 mb-8">
                                        <input type="text" class="form-control input-default" placeholder="Discount" value="{{$product->discount}}" name="discount">
                                        @error('discount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                   </div>
                                   <div class="form-group row ">
                                    <div class="col-md-6 mb-8">
                                        <input type="text" class="form-control input-default" placeholder="Shipping Charge" value="{{$product->shipping_charge}}" name="shipping_charge">
                                        @error('shipping_charge')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="col-md-6 mb-8">
                                        <input type="text" class="form-control input-default" placeholder="colour" value="{{$product->colour}}" name="colour">
                                        @error('colour')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                   </div>
                            <div class="form-group mb-8">
                                <div class="mb-8">
                                <img src="{{asset('uploads/product/'.$product->feature_image)}}" width="50px" height="50px" alt="img">
                            </div>
                                <input type="file" class="form-control" id="feature_image" name="feature_image"
                            placeholder="feature image" :value="old('feature_image')">
                            @error('feature_image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                            </div>
                            <div class="form-group mb-8">

                                <input type="file" class="form-control" id="image" name="images[]"
                            placeholder="images" :value="old('images')">
                            @error('images')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                            <div class="form-group row ">
                                <div class="col-md-6 mb-8">
                                    <input type="text" class="form-control input-default" placeholder="length" value="{{$product->length}}"name="length">
                                    @error('length')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="col-md-6 mb-8">
                                    <input type="text" class="form-control input-default" placeholder="width" value="{{$product->width}}"name="width">
                                    @error('width')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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

@endsection
@section('scripts')
<script>
// $(document).ready(function () {
//     $("#category").change(function () {

//        alert('a');

//     });
// });



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
