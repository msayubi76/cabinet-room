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
                    <h4 class="card-title">Add About Us</h4>

                    <div class="basic-form">
                        <form action="{{route('settings.store')}}"  method="Post" id="product-form" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group mb-8">
                                <textarea class="form-control h-150px mysummernote" id="" name="about_us_detail" rows="6" placeholder="Write here.......">
                                   </textarea>
                                   @error('about_us_detail')
                                   <div class="text-danger">{{ $message }}</div>
                               @enderror
                            </div>









                               <div class="modal-footer">
                               <a href="{{url('/admin/settings')}}"  type="button" class="btn btn-secondary"> Close </a>
                               <button type="submit"  id="button-save"  class="btn btn-primary">Add About Us</button>
                            </div><br>



                            </form>
                    </div>
                </div>
            </div>
        </div>
 </div>
</div>

@endsection

