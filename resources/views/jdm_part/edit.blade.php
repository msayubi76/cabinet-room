@extends('layouts.theme')
@section('title','Edit Part')
@section('style') 
<link href="{{url('libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

<link href="{{url('libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet">
<style>
    .view-document {
    position: absolute;
    top: 0px;
    right: 0px;
    background: #e8e8e8;
    padding: 2px 8px;
}

.view-document a {
    color: red;
    font-size: 11px;
}
</style>
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid  ">
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-body"> 
                        <h5 class="card-title">Edit Part</h5>
                       @include('alertsInfo')
                      
                        <div class="row">
                            <div class="col-md-8 mx-auto"> 
                                <form class="custom-validation" action="{{url('jdm_part/'.encrypt($jdm_part->id)) }}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="PUT">
                                    @include('jdm_part/fields')
                                    <div class="text-center mt-3">
                                        <input type="submit" value="Save" class="btn btn-primary">
                                    </div> 
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="card-body customer-files" >
                        <div class="files-div">
                            <div class="row">
                                <div class="col-md-12">
                                    <p ><strong>Feature Image: </strong></p>
                                </div>
                                <div class="col-md-3">
                                    <a class="image-popup-no-margins" href="{{ url('site_images/feature_image/'.$jdm_part->feature_image)}}" title="View" >
                                                        
                                    <img class="img-fluid" alt=""  src=" {{url('site_images/feature_image/'.$jdm_part->feature_image)}}"  >
                                    </a>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                </div>
                            </div>
                           
                                <div class="row">
                                    <div class="col-md-12">
                                        <p ><strong>Files: </strong></p>
                                    </div>
                                     
                                        @forelse ($images as $file)
                                            <div class="col-lg-2 col-xl-2 col-md-3 col-sm-6 col-6 main-img-div  ">
                                                <div class="card"> 
                                                    @if ($file->file_type == 'image')
                                                        <a class="image-popup-no-margins" href="{{ url('site_images/jdm_parts/'.$file->file)}}" title="View" >
                                                        <img class="img-fluid" alt="" 
                                                         src=" {{url('site_images/jdm_parts/'.$file->file)}}" 
                                                         style="height: 118px !important;"  width="100%">
                                                        </a>
                                                        <div class="view-document">
                                                            <a href="javascript:;" class="delete"  data-id="{{encrypt($file->id)}}" >
                                                                <i class="fa fa-trash "></i>
                                                            </a>
                                                        </div>
                                                    @endif 
                                                </div>
                                            </div>
                                            @empty
                                            <p>No file uploaded.</p>
                                        @endforelse
                                        
                                </div>
                        </div>
                    </div>
                </div>

            </div> <!-- end col -->


        </div> <!-- end row -->
    </div>
</div>
@endsection
@section('script')
<script src="{{url('libs/select2/js/select2.min.js')}}"></script>
<script src="{{url('libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script src="{{url('js/pages/lightbox.init.js')}}"></script> 
<link href="{{url('libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" /> 
<script src="{{url('libs/sweetalert2/sweetalert2.min.js')}}"></script>
<script>
    $(".select2").select2();
    
  $('.delete').click(function () {
    var uid = $(this).data('id');
    var tr =   $(this).closest('.main-img-div'); 
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: 'post',
            data: {'_method': 'DELETE'},
            url: '{{url('remove_file/')}}/' + uid,
        }).done(function (responce) {
            if(responce.status){ 
                Swal.fire("Deleted!",responce.msg, "success"); 
                $(tr).remove(); 
            }else{
                swal.fire("Cancelled",responce.msg, "error");
            }
        }).fail(function (responce) {
            swal.fire("Cancelled",responce.error, "error");
        });
    }
})
});
</script>
@endsection
 
