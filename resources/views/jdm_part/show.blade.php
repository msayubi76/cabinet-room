@extends('layouts.theme')
@section('title','Part Detail')
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
                         
                       @include('alertsInfo')
                      
                        <div class="row">
                             
                            <div class="col-md-3">
                                <p ><strong>Feature Image: </strong></p>
                                <a class="image-popup-no-margins" href="{{ url('site_images/feature_image/'.$jdm_part->feature_image)}}" title="View" >
                                                    
                                <img class="img-fluid" alt=""  src=" {{url('site_images/feature_image/'.$jdm_part->feature_image)}}"  >
                                </a>
                            </div>
                           
                            <div class="col-lg-4 col-xl-4  col-md-12   ">
                                <section id="quick-summary" class="clearfix">
                                    <h4>Part Detail</h4>
                                    <hr>
                                    <dl>
                                        <dt>Name</dt>
                                            <dd>{{ $jdm_part->name }}</dd>
                                        <dt>Price</dt>
                                            <dd><span class="badge badge-info">{{ $jdm_part->currency_type }} {{ $jdm_part->price }}</span></dd>
                                        <dt>Product:</dt>
                                            <dd>{{ $jdm_part->product }}</dd>
                                        <dt>Part Category:</dt>
                                        <dd>{{ $part_category?$part_category->name:'' }}</dd>
                                         
                                        <div><strong>Part Detail:</strong></div>
                                        <div class="w-100">{{ $jdm_part->part_detail }}</div> 
                                    </dl>
                                </section>
                            </div>
                        </div>

                    </div>
                    <div class="card-body customer-files" >
                        <div class="files-div">
                            
                           
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
 
