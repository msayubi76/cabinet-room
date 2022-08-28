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
                    <h4 class="card-title">Add Banner</h4>

                    <div class="basic-form">
                        <form action="{{route('banners.store')}}"  method="Post" id="product-form" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group  row mb-8">
                                <div class="col-md-12">
                                    <input type="text" class="form-control input-default" placeholder="Banner Name" :value="old('name')" name="name">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            </div>




                            <div class="form-group row mb-8">
                                <div class="col-md-12">
                                    <label class="col-lg-4 col-form-label" for="name">Banner Image <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" class="form-control" id="banner_image" name="banner_image"
                                placeholder="Banner image" :value="old('banner_image')">
                                @error('banner_image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                </div>


                            </div>





                            <div class="modal-footer">
                               <a href="{{url('/admin/products')}}"  type="button" class="btn btn-secondary"> Close </a>
                               <button type="submit"  id="button-save"  class="btn btn-primary">Add banner</button>
                            </div><br>



                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 </div>
</div>

@endsection


