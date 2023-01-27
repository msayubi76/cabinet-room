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
                        <h4 class="card-title">Update Banner</h4>

                        <div class="basic-form">
                            <form action="{{ route('banners.update', $banner->id) }}" method="post" id="edit-product-form"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="-1" id="banner_id">
                                <input type="hidden" value="PUT" name="_method">
                                <div class="form-group row mb-8">

                                    <div class="col-md-12">
                                        <input type="text" class="form-control input-default" id="edit_name"
                                        placeholder="Banner Name" value="{{ $banner->name }}" name="name">
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>


                                    </div>


                                </div>



                                <div class="form-group row mb-8">
                                    <div class="col-md-12">
                                        <div class="mb-8">
                                            <img src="{{ asset( $banner->image_url) }}" width="50px"
                                                height="50px" alt="img">
                                        </div>
                                        <input type="file" class="form-control" id="edit_banner_image" name="banner_image"
                                            placeholder="banner image" :value="old('banner_image')">
                                            @error('banner_image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>



                                </div>







                                <div class="modal-footer">
                                    <a href="{{ url('/admin/banners') }}" type="button" class="btn btn-secondary">
                                        Close </a>
                                    <button type="submit" id="button-update"
                                        class="btn btn-primary">Update Banner</button>
                                </div><br>



                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

