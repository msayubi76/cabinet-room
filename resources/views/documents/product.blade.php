@extends('layouts.theme')
@section('title','Product Detail')
@section('style')
    <link href="{{url('libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{url('libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" /> 
    <link href="{{url('libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet">

    <link href="{{url('libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('libs/dropify/css/dropify.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<style>
    .view-document {
        text-align: center;
        padding: 20px;
    }

    .view-document i {
        font-size: 65px;
    }
    .item-doc .delete{
        position: absolute;
        top: 0px;
        right: 0px;
        background: #5f5f5f;
        color: white;
        padding: 3px 10px;
    }
</style>
    <div class="page-content">
        <div class="container-fluid ">
            <div class="loading_div"  id="loading" style="display: none">
                <div class="spinner-grow text-secondary  loading" role="status" ></div>
            </div>
            <div class="card w-100"  >
                <div class="card-body  " >
                    <div class="top-headings text-center">
                        <h2>Documents</h2>
                    </div>

                    @include('alertsInfo')
                    <div class="documents">
                        <div class="row mb-2"> 
                            <div class="col-md-4"> 
                                <p class="mb-0"><strong>Customer Information</strong></p>
                                <p  class="mb-0"><strong>Name</strong>: {{$transaction->getCustomer?$transaction->getCustomer->name:''}}</p>
                                <p class="mb-0"><strong>Address</strong>:
                                    {{$transaction->getCustomer?$transaction->getCustomer->address:''}}
                                </p>
                                <p class="mb-0"><b>Phone: </b>  {{$transaction->getCustomer?$transaction->getCustomer->phone:''}}</p>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="float-right text-right">
                                    <p class="mb-0"><strong>Order Date</strong>:  {{date('d-M-Y',strtotime($transaction->transaction_date))}}</p>
                                    <p class="mb-0"><b>Order Time</b>: {{date('h:i: A',strtotime($transaction->transaction_date))}}</p>
                                    <p class="mb-0"><b>Order ID :</b>  {{$transaction->transaction_no}}</p>
                                </div>
                            </div>
                        </div>
                      
                        <div class="row">
                                @foreach ($items as $file)
                                 

                                <div class="col-lg-2 col-md-2 col-sm-2 col-2 item-doc ">
                                    <div class="card">
                                        @if ($file->file_type != 'image')
                                        <a  class="" href="{{ url('site_images/product_documents/'.$file->file)}}" title="Preview"  target="_blank" >
                                        <div class="view-document">
                                            <i class="dripicons-document-remove "></i>
                                        </div>
                                        </a>
                                        @endif
                                        @if ($file->file_type == 'image')
                                            <a class="image-popup-no-margins" href="{{ url('site_images/product_documents/'.$file->file)}}" title="View" >
                                            <img class="img-fluid" alt="Image"   style="height: 200px !important;" src=" {{url('site_images/product_documents/'.$file->file)}}"  width="100%">
                                            </a>
                                        @endif
                                        <div class="py-2 text-center">
                                            <a href="{{ url('site_images/product_documents/'.$file->file)}}" download class="text-muted font-600">Download</a>
                                        </div>
                                        
                                    </div>
                                    @can('order.remove_document')
                                    <a href="javascript:;" class="delete" 
                                            data-id="{{encrypt($file->id)}}"
                                            class="remove_image"><i class="fa fa-trash "> Remove</i></a>
                                       @endcan
                                </div>
                                @endforeach
                        </div>  

                        @if (count($items) == 0)

                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="text-center">Documents not uploaded yet</h3>
                                </div>
                            </div>
                        @endif
                   </div> 
 
                </div>

                
            
    </div>
    <!-- End Page-content -->
@endsection
@section('script')
<script src="{{url('libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script src="{{url('js/pages/lightbox.init.js')}}"></script> 
<script src="{{url('libs/tippy.js/tippy.all.min.js')}}"></script>
<script src="{{url('js/pages/tooltipster.init.js')}}"></script>

<script src="{{url('libs/sweetalert2/sweetalert2.min.js')}}"></script>

<!-- Plugins js -->
<script src="{{url('libs/dropzone/min/dropzone.min.js')}}"></script>
<script src="{{url('libs/dropify/js/dropify.min.js')}}"></script>

<script src="{{url('js/pages/form-fileuploads.init.js')}}"></script>

<script>
    $('.save_price').click(function () {

        $(".ERR").text("")

        var form = $("#edit_price_form").serialize();
        
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'GET',
                data: form,
                url: '{{url('updatePrice')}}',
                beforeSend: function() { 
                     $("#loading").show();
                 },
            }).done(function(response) {
             $("#loading").hide();
             if(response.status){
                $('#editPriceModal').modal('toggle');
                $("#price_").html(response.price);

                $("#actual_sale_price").val("");
                $("#customer_sale_price").val("");
                $(".ERR").text("")
             }
             

            }).fail(function(error){
             $("#loading").hide(); 
             $.each(error.responseJSON.errors, function (key, item) {
                $("#err_"+key).text(item[0]);  
            });
        });
    });


    $('.delete').click(function () {
            var uid = $(this).data('id');
            var tr =   $(this).closest('.item-doc'); 
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
                    console.log(responce);
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
 
