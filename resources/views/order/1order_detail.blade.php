@extends('layouts.theme')
@section('title','Product Detail')
@section('style')
    <link href="{{url('libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{url('libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" /> 
    <link href="{{url('libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet">

    <link href="{{url('ibs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
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
                        <h2>Order Detail</h2>
                    </div>

                    @include('alertsInfo')

                <div class="row">
                    <div class="col-lg-12 col-xl-12 print-div pr-0 d-print-none">
                        <div class="float-right ">
                            <a href="javascript:window.print()" class="btn btn-info"><i class="fa fa-print"></i></a>
                        </div>
                    </div>
                </div>
                </div>

                <div style="padding: 0px 14px;">
                   
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table   class="table mb-0">
                                <tbody>
                                    <tr> 
                                        <td><strong>Category: </strong>{{$product->getCategory?$product->getCategory->name:''}}</td>
                                        <td><strong>Sub Category: </strong>{{$product->getSubCategory?$product->getSubCategory->name:''}}</td>
                                        <td><strong>Price: </strong>
                                            <span id="price_">{{$transaction->getTransactionsSelline?$transaction->getTransactionsSelline->sale_price .' $':''}}</span>
                                        <a href="javascript:;" data-toggle="modal" data-target="#editPriceModal" 
                                        data-toggle="tooltip" data-placement="top"  
                                        > <i class="fas fa-pencil-alt ml-2 tippy-btn" title="Edit Price" data-tippy-placement="top"></i></a>
 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Chassis No: </strong>{{$product->chassis_no}}</td>
                                        <td><strong>CC: </strong>{{$product->cc}}</td>
                                        <td><strong>Make: </strong>{{$product->make}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Model: </strong>{{$product->model}}</td>
                                        <td><strong>Model: </strong>{{$product->model}}</td>
                                        <td><strong>Package: </strong>
                                            {{$product->package}}
                                        </td>
                                       
                                    </tr> 
                                    <tr>
                                        <td><strong>Year: </strong>{{$product->year}}</td>
                                        <td><strong>Seats: </strong> {{$product->seats}}</td>
                                        <td><strong>Hybrid / Petrol/Diesel: </strong>{{$product->hybrid_petrol_diesel}}</td>
                                       
                                    </tr>
                                    <tr>
                                        <td><strong>2Wd / 4Wd: </strong>{{$product->_wd_4wd}}</td>
                                        <td><strong>Mileage: </strong>{{$product->mileage}}</td>
                                        <td><strong>Transmission: </strong>{{$product->transmission}}</td>
                                       
                                       
                                    </tr>
                                    <tr>
                                        <td><strong>Power Window: </strong>{{$product->power_window}}</td>
                                        <td  ><strong>Power Stearing: </strong>{{$product->power_stearing}}</td>
                                        <td><strong>Ac /Aac: </strong>{{$product->ac_aac}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td ><strong>Navigation / Tc/Dvd: </strong>{{$product->navigation_tc_dvd}}</td>
                                        <td ><strong>Steering Audio Controls: </strong>{{$product->steering_audio_controls}} </td>
                                        <td><strong>Cruise Controls: </strong>{{$product->cruise_controls}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td><strong>Paddle Shifters: </strong>{{$product->paddle_shifters}}</td>
                                        <td><strong>Key Start / Push Start: </strong>{{$product->key_start_push_start}}</td>
                                        <td><strong>Alloys: </strong>{{$product->alloys}}</td>
                                        
                                    </tr> 

                                    <tr>
                                        <td><strong>Fog: </strong>{{$product->fog}}</td>
                                        <td><strong>Rear Spoiler: </strong>{{$product->rear_spoiler}}</td>
                                        <td><strong>Aero Kit: </strong>{{$product->aero_kit}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td><strong>Leather Seats: </strong>{{$product->leather_seats}}</td>
                                        <td><strong>Back Camera: </strong>{{$product->back_camera}}</td>
                                        <td><strong>Bumper Sensors: </strong>{{$product->bumper_sensors}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td><strong>Sunroof Penoramic: </strong>{{$product->sunroof_penoramic}}</td>
                                        <td><strong>Retractable Side Mirrors: </strong>{{$product->retractable_side_mirrors}}</td>
                                        <td><strong>Keyless Entry: </strong>{{$product->keyless_entry}}</td>
                                       
                                    </tr> 
                                    <tr>
                                        <td><strong>Back Tyre: </strong>{{$product->back_tyre}}</td>
                                        <td><strong>ABS: </strong>{{$product->abs}}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                     
                </div>
            </div>
            <div class="card w-100 d-print-none" >
                <div class="card-body " >

                   <div class="documents">
                    <p ><strong>Product Documents: </strong></p>
                    <div class="col-xl-2">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{url('upload_product_documents')}}"  enctype="multipart/form-data" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{encrypt($transaction->getTransactionsSelline?$transaction->getTransactionsSelline->id:'')}}">
                                    <input type="file" name="documents[]" multiple id="input-file-now" class="dropify" />   
                                    <button type="submit" class="btn btn-primary  mt-3 float-right">Save</button>
                                </form>                                               
                            </div>
                        </div>
                    </div>
                    <div class="row">

                       
                        <?php 
                                $files = array();
                                $documents =   $transaction->getTransactionsSelline?$transaction->getTransactionsSelline->getDocuments:'';
                            ?>

                            @foreach ($documents as $file)

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
                                        <img class="img-fluid" alt=""  src=" {{url('site_images/product_documents/'.$file->file)}}"  width="100%">
                                        </a>
                                    @endif
                                    <div class="py-2 text-center">
                                        <a href="{{ url('site_images/product_documents/'.$file->file)}}" download class="text-muted font-600">Download</a>
                                    </div>
                                    
                                </div>
                                <a href="javascript:;" class="delete" 
                                        data-id="{{encrypt($file->id)}}"
                                        
                                        class="remove_image"><i class="fa fa-trash "> Remove</i></a>
                            </div>
                            @endforeach
                    </div>  
                    
                   </div>
                       
                                                                               
                         






                    <div class="files-div">
                        <p ><strong>Product Images: </strong></p>
                            <div class="row">
                                <?php 
                                $file = "";
                                $files = array(); 
                                $files =  json_decode( $product->image);
                                ?>
                                @if (!empty($files ))
                                    @foreach ($files as $file)
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-2 ">
                                            <div class="card">
                                                @if ($file->file_type != 'image')
                                                <a  class="" href="{{ url('site_images/products/'.$file->name)}}" title="Preview"  target="_blank" >
                                                <div class="view-document">
                                                    <i class="dripicons-document-remove "></i>
                                                </div>
                                                </a>
                                                @endif
                                               
                                                @if ($file->file_type == 'image')
                                                    <a class="image-popup-no-margins" href="{{ url('site_images/products/'.$file->name)}}" title="View" >
                                                    <img class="img-fluid" alt=""  src=" {{url('site_images/products/'.$file->name)}}"  width="100%">
                                                    </a>
                                                @endif
                                                <div class="py-2 text-center">
                                                    <a href="{{ url('site_images/products/'.$file->name)}}" download class="text-muted font-600">Download</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @else
                                    <p>No file uploaded.</p>
                                @endif
                            </div>
                    </div>
                </div>

                <div class="modal fade" id="editPriceModal" tabindex="-1" role="dialog" aria-labelledby="editPriceModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editPriceModalLabel">Edit Price</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form id="edit_price_form" method="POST" enctype="multipart/form-data" >
                            <input type="hidden" name="id" value="{{encrypt( $transaction->getTransactionsSelline?$transaction->getTransactionsSelline->id:'')}}">
                            <div class="form-group">
                              <label for="actual_sale_price" class="col-form-label">Actual Sale Price</label>
                              <input type="text" name="actual_sale_price" class="form-control" id="actual_sale_price">
                              <span id="err_actual_sale_price" class="text-danger ERR"></span>
                            </div>
                            <div class="form-group">
                              <label for="message-text" class="col-form-label">Customer Sale Price ( Optional )</label>
                              <input type="text" name="customer_sale_price" class="form-control" id="customer_sale_price">
                              <span id="err_customer_sale_price" class="text-danger ERR"></span>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary save_price" id="save_price">Save</button>
                        </div>
                      </div>
                    </div>
                </div>
            </div> 
        </div> <!-- container-fluid -->
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
 
