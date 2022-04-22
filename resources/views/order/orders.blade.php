@extends('layouts.theme')
@section('title',$title)
@section('style')
    <!-- DataTables -->
    <link href="{{url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{url('libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet">
    <link href="{{url('libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('libs/dropify/css/dropify.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<style>
    .upload_document_form .dropify-wrapper .parsley-errors-list {
        position: absolute;
        bottom: 0px;
        text-align: center;
        width: 100%;
    }

    .upload_document_form .dropify-wrapper .parsley-errors-list li {
        font-size: 17px;
        padding: 6px;
    }
    .action_drop .dropdown-menu a span{
        padding: 0px 13px 0px 0px;
    }
</style>
    <div class="page-content">
        <div class="container-fluid "> 
            <div class="loading_div"  id="loading" style="display: none">
                <div class="spinner-grow text-secondary  loading" role="status" ></div>
            </div>
            <div class="card  w-100">
                <div class="card-body">
                    @include('alertsInfo')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row d-flex">
                                        <div class="col-lg-6  ">
                                            <h5 class="card-title text-capitalize">
                                                @if ($type == 'quotation_orders')
                                                {{ str_replace("_", ' ','reserve_units') }}
                                                @elseif ($type == 'in_process')
                                                {{ str_replace("_", ' ','ship_ok_units') }}
                                                @elseif ($type == 'complete_order')
                                                {{ str_replace("_", ' ','released_units') }}
                                                @endif
                                                </h5>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered w-100 user_table">
                                            <thead>
                                            <tr>
                                                <th>Sr. #</th>
                                                <td  >Order No</td>
                                                <th>Total Amount</th>
                                               
                                                <th>Order Date</th>
                                                
                                               
                                                @if (  Auth::user()->hasRole('Super Admin'))
                                                    <th>Customer Name</th>
                                                    @elseif(Auth::user()->hasRole('Customer') && $type == "accepted" )
                                                    <th>Order Status</th>
                                                @endif
                                                @if (Auth::user()->hasAnyPermission(['order.detail']) || Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Customer'))
                                                 <th>Order Detail</th>
                                                @endif  
                                                <th>Image</th>
                                                @if ((Auth::user()->hasAnyPermission(['order.accept', 'order.in_progress', 'order.complete','order.add_payment', 'order.reject']) ||
                                                Auth::user()->hasRole('Super Admin') ) && $type != "rejected_order" ||
                                                (   Auth::user()->hasRole('Customer') && ( $type == "in_process" ||  $type == "complete_order") ) )
                                               
                                                <th>Action</th>
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php $count=1;?> 
                                                
                                                @foreach ($items as $item)
                                                <?php 

                                                if ($item->type == "product") {
                                                    $product = $item->getTransactionsSelline?
                                                    $item->getTransactionsSelline?$item->getTransactionsSelline->getProduct :""
                                                    :""; 
                                                    
                                                }else{
                                                    $product = $item->getTransactionsSelline?
                                                    $item->getTransactionsSelline?$item->getTransactionsSelline->getPart:""
                                                    :"";  
                                                } 
                                                    ?>
                                                
                                                    <tr class="gradeX"> 
                                                        <td>{{$count++}}</td>
                                                        <td>{{$item->transaction_no}}</td>
                                                         
                                                        @if (Auth::user()->hasRole('Customer') )
                                                            <td class="total"> {{$item->customer_total_amount .' '. $product->currency_type}}</td> 
                                                            @else  <td class="total"> {{$item->total .' '. $product->currency_type}}</td>
                                                        @endif
                                                        <td>{{$item->transaction_date}}</td>
                                                        @if (  Auth::user()->hasRole('Super Admin'))
                                                            <td>{{$item->customer_name}}</td>
                                                            @elseif(Auth::user()->hasRole('Customer') && $type == "accepted" )
                                                            <td class="text-capitalize">{{$item->order_status}}</td>
                                                        @endif

                                                        @if (Auth::user()->hasAnyPermission(['order.detail']) || Auth::user()->hasRole('Super Admin') 
                                                        || Auth::user()->hasRole('Customer'))
                                                        <td><a href="{{url('order/detail/'.encrypt($item->id))}}">
                                                                <span class="fa fa-eye text-info "> </span> Detail
                                                            </a>
                                                        </td>
                                                        @endif
                                                        
                                                        <td>
                                                            <img class="img-fluid" alt=""  
                                                                src=" {{url('site_images/feature_image/'.$product->feature_image)}}" 
                                                            style="height: 80px !important;"  >
                                                        </td>
                                                         
                                                            @if ((Auth::user()->hasAnyPermission(['order.accept', 'order.in_progress', 
                                                            'order.complete' ,'order.add_payment', 
                                                            'order.reject', 
                                                            'order.mark_as_complete', 
                                                            'order.add_shipping_detail', 
                                                            'order.documents']) ||
                                                             Auth::user()->hasRole('Super Admin') ) && $type != "rejected_order" ||
                                                             ( Auth::user()->hasRole('Customer') && ($type == "in_process" ||  $type == "complete_order") )   )
                                                            <td> 
                                                                <div class="btn-group action_drop">
                                                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="mdi mdi-chevron-down"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu view-dropdown-menu "> 
                                                                        @if (  $type == "quotation_orders")
                                                                            @can('order.accept') 
                                                                                <a href="javascript:;" 
                                                                                 data-id="{{encrypt($item->getTransactionsSelline?$item->getTransactionsSelline->id:'')}}" 
                                                                                 data-price="{{$item->getTransactionsSelline?$item->getTransactionsSelline->sale_price:''}}"  
                                                                                 data-currency_type="{{ $product->currency_type }}"
                                                                                    class="dropdown-item action_imgs  accept_order">
                                                                                        <span class=" fas fa-check-circle text-success" > </span> Accept
                                                                                </a> 
                                                                            @endcan
                                                                        @endif
                                                                        
                                                                        @if ( $type == "in_process" )
                                                                        @can('order.add_payment')
                                         
                                                                            <a data-id="{{encrypt($item->id)}}"
                                                                                data-name="{{$item->customer_name }}"
                                                                                data-total_amount="{{$item->total }}"
                                                                                data-customer_id="{{encrypt($item->customer_id) }}"
                                                                                data-remaining_amount="{{ $item->total - $item->paid_amount }}"
                                                                                data-currency_type="{{ $product->currency_type }}"

                                                                                 href="javascript:;"   
                                                                                 class="dropdown-item action_imgs add_payment ">
                                                                                <span class="fa fa-paste text-primary" style=" font-size: 16px;" > 
                                                                                </span> Add Payment
                                                                            </a>
                                                                        @endcan
                                                                        @can('order.add_shipping_detail') 
                                                                            <a data-id="{{encrypt($item->id)}}" href="javascript:;"   
                                                                                 class="dropdown-item action_imgs shipping_detail ">
                                                                                <span class="fa fa-shopping-bag text-info" style=" font-size: 16px;" > </span> Add Shipping Detail
                                                                            </a>
                                                                        @endcan
                                                                            @can('order.upload_documents') 
                                                                                <a data-id="{{encrypt($item->id)}}" href="javascript:;"  class="dropdown-item action_imgs upload_document ">
                                                                                    <span class="fas fa-cloud-upload-alt text-primary" > </span> Upload Documents
                                                                                </a>
                                                                            @endcan
                                                                            
                                                                            @can('order.mark_as_complete') 
                                                                                <a data-id="{{encrypt($item->id)}}" href="javascript:;"  class="dropdown-item action_imgs mark_as_complete ">
                                                                                    <span class="fas fa-calendar-check text-success  " style=" font-size: 16px;" > </span> Mark as Complete
                                                                                </a>
                                                                            @endcan
                                                                        @endif
                                                                        @if ( $type == "in_process" || $type == "quotation_orders" )
                                                                            @can('order.reject') 
                                                                                <a href="javascript:;" data-id="{{encrypt($item->id)}}"  
                                                                                    class="dropdown-item action_imgs reject_order  ">
                                                                                    <span class="fas fa-window-close  text-danger" > </span> Reject
                                                                                </a> 
                                                                            @endcan 
                                                                        @endif
                                                                        
                                                                        @if (  $type == "in_process" 
                                                                        ||  $type == "complete_order" 
                                                                       
                                                                        || Auth::user()->hasRole('Customer') 
                                                                        || Auth::user()->hasAnyPermission(['order.view_documents']) 
                                                                         )  
                                                                            <a href="{{url('documents/'.encrypt($item->id))}}" target="_blank" class="dropdown-item action_imgs ">
                                                                                    <span class=" fas fa-check-circle text-success" > </span> View Documents
                                                                            </a>  
                                                                        @endif
                                                                         
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        @endif 
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

 
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
                                <input type="hidden" name="id" id="transaction_id">
                                <div class="form-group">
                                     <div class="row">
                                        <div class="col-md-6" >
                                            <label  class="col-form-label"  >Sale Price </label>
                                         </div>
                                       <div class="col-md-6 text-right">
                                        <label  class="col-form-label" id="sale_price_"> </label>
                                       </div>
                                     </div>
                                    
                                  </div>
                                <div class="form-group">
                                  <label for="actual_sale_price" class="col-form-label">Actual Sale Price ( $ )</label>
                                  <input type="text" name="actual_sale_price" placeholder="Actual Sale Price  ( $ )" class="form-control" id="actual_sale_price">
                                  <span id="err_actual_sale_price" class="text-danger ERR"></span>
                                </div>
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Customer Sale Price ( Optional )</label>
                                  <input type="text" name="customer_sale_price" placeholder="Customer Sale Price  ( $ )" class="form-control" id="customer_sale_price">
                                  <span id="err_customer_sale_price" class="text-danger ERR"></span>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary save_price" id="save_price">Accept Order</button>
                            </div>
                          </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="uploadDocumentModal" tabindex="-1" role="dialog" aria-labelledby="uploadDocumentModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <form class="custom-validation upload_document_form" action="{{url('upload_product_documents')}}"  enctype="multipart/form-data" method="post">
                                <div class="modal-header">
                                <h5 class="modal-title" id="uploadDocumentModalLabel">Upload Documents</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                   @csrf
                                   <input type="hidden" name="id" id="transaction_id_doc">
                                   <input type="file" required name="documents[]" multiple id="input-file-now" class="dropify" />   
                                </div>
                                <div class="modal-footer"> 
                                <a  class="btn btn-secondary  " id="view_documents" >View Documents</a>
                                <button type="submit" class="btn btn-primary    float-right">Upload</button>
                                </div>
                            </form> 
                          </div>
                        </div>
                    </div>

                    
                    <div class="modal fade" id="shippingDetailModal"   tabindex="-1" role="dialog" aria-labelledby="shippingDetailLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <form class="custom-validation" id="shippling_detial_form"  action="javascript:;" enctype="multipart/form-data" method="post">
                                <div class="modal-header">
                                <h5 class="modal-title" id="shippingDetailLabel">Add Shipping Detail</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                   @csrf
                                   <input type="hidden" name="id" id="transaction_id_ship">
                                   <input type="text" required name="shipping_detail" id="shipping_detail" placeholder="Shipping Detail"   class="form-control" />
                                   <span id="err_shipping_detail" class="ERR text-danger" ></span>   
                                </div>
                                <div class="modal-footer">  
                                <button type="submit" class="btn btn-primary float-right add_shipping_detail ">Add</button>
                                </div>
                            </form> 
                          </div>
                        </div>
                    </div> 
                <div class="modal fade" id="addPaymentDetailModal"   tabindex="-1" role="dialog" aria-labelledby="addPaymentDetailModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <form class="custom-validation" id="add_payment_detial_form"  action="javascript:;" enctype="multipart/form-data" method="post">
                                <div class="modal-header">
                                <h5 class="modal-title" id="addPaymentDetailModal">Add Payment Detail</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                   @csrf
                                   <input type="hidden" class="empty_fields" name="id" id="transaction_id_payment">
                                   <input type="hidden" class="empty_fields" name="customer_id" id="customer_id_payment">
                                      
                                   <div class="row">
                                       <div class="col-md-12 text-right">
                                           <label class="control-label m-1">Total Amount: </label>
                                           <span  class="empty_fields"  id="total_amount_of_order"></span>
                                       </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="control-label">Customer Name</label>
                                                <input   id="customer_name" class="form-control empty_fields" autocomplete="off" readonly   type="text">
                                                 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="control-label">Remaining Balance  </label>
                                            <input class="form-control empty_fields"  id="remaining_balance" autocomplete="off" readonly     type="text" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="control-label">Payment Date </label>
                                            <input class="form-control empty_fields" autocomplete="off"   name="payment_date"
                                                   placeholder="Enter Amount "   type="date">
                                                   <span id="err_payment_date" class="ERR text-danger" ></span> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="control-label">Amount to Paid </label>
                                            <input class="form-control empty_fields" autocomplete="off"   name="paid_amount"
                                                   placeholder="Enter Amount "   type="number">
                                                   <span id="err_paid_amount" class="ERR text-danger" ></span> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="control-label">Detail</label>
                                            <textarea name="remarks" class="form-control empty_fields"
                                                      cols="30" rows="3"   placeholder="Enter detail... "></textarea>

                                                <span id="err_remarks" class="ERR text-danger" ></span> 
                                        </div> 
                                    </div>
                                </div>
                                </div>
                                <div class="modal-footer">  
                                <button type="submit" class="btn btn-primary float-right add_payment_detail_submit ">Save</button>
                                </div>
                            </form> 
                          </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
   <!-- Required datatable js -->
   <script src="{{url('libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
   <script src="{{url('libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
   <!-- Buttons examples -->
   <script src="{{url('libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
   <script src="{{url('libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
   <script src="{{url('libs/jszip/jszip.min.js')}}"></script>
   <script src="{{url('libs/pdfmake/build/pdfmake.min.js')}}"></script>
   <script src="{{url('libs/pdfmake/build/vfs_fonts.js')}}"></script>
   <script src="{{url('libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
   <script src="{{url('libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
   <script src="{{url('libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
   <!-- Responsive examples -->
   <script src="{{url('libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
   <script src="{{url('libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

   <!-- Datatable init js -->
   <script src="{{url('js/pages/datatables.init.js')}}"></script>

   <script src="{{url('libs/sweetalert2/sweetalert2.min.js')}}"></script>
   
<!-- Plugins js -->
<script src="{{url('libs/dropzone/min/dropzone.min.js')}}"></script>
<script src="{{url('libs/dropify/js/dropify.min.js')}}"></script>

<script src="{{url('js/pages/form-fileuploads.init.js')}}"></script>
<script src="{{url("libs/parsleyjs/parsley.min.js")}}"></script>
<script src="{{url('js/pages/form-validation.init.js')}}"></script>

   <script>
    $('.accept_order').on('click', function(e){
        var id = $(this).data('id');
        var price = $(this).data('price');
        var currency_type = $(this).data('currency_type');
        $("#actual_sale_price").val(price);
        
          row =   $(this).closest('tr');

        $("#sale_price_").text(price+ " "+ currency_type);
        $("#transaction_id").val(id);

        $("#editPriceModal").modal('toggle');
    });
    
    $('.upload_document').on('click', function(e){
           var id = $(this).data('id');
           var price = $(this).data('price');
           $("#transaction_id_doc").val(id);
           $("#view_documents").attr("href","{{url('documents')}}/"+id)
           $("#uploadDocumentModal").modal('toggle');
    });
    
    
    $('.shipping_detail').on('click', function(e){
           var id = $(this).data('id'); 
           $("#transaction_id_ship").val(id); 
           $("#shippingDetailModal").modal('toggle');
    });

  


    
    $('.shipping_detail').on('click', function(e){
           var id = $(this).data('id'); 
           $("#transaction_id_ship").val(id); 
           $("#shippingDetailModal").modal('toggle');
    });

    $('.add_payment').on('click', function(e){
           var id = $(this).data('id');
           add_payment_element = $(this);

           var remaining_balance = $(this).data('remaining_amount'); 
           var name = $(this).data('name'); 
           var total_amount = $(this).data('total_amount'); 
           var customer_id = $(this).data('customer_id');
           var currency_type = $(this).data('currency_type');


           console.log("data-remaining_amount: "+$(this).data('remaining_amount') );
           
 
           $("#customer_name").val(name);
           $("#transaction_id_payment").val(id);
           $("#remaining_balance").val(remaining_balance +" "+currency_type);
           $("#total_amount_of_order").text(" "+total_amount+" "+currency_type);
           $("#customer_id_payment").val(customer_id);

           $("#addPaymentDetailModal").modal('toggle');
    });
    
    $('.add_payment_detail_submit').click(function (e) { 
var element = add_payment_element;

         
         $(".ERR").text("") 
         var form = $("#add_payment_detial_form").serialize();
             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });
             $.ajax({
                 method: 'POST',
                 data: form,
                 url: '{{url('savePayment')}}',
                 beforeSend: function() { 
                     $("#loading").show();
                 },
             }).done(function(response) {
             $("#loading").hide();
             if(response.status){
               
                $(element).attr('data-remaining_amount', response.remaining_amount)

                 $('#addPaymentDetailModal').modal('toggle');
 
                 $(".empty_fields").val("");
                 $(".empty_fields").text("");

                 setTimeout(function() {
                    location.reload();
                    }, 1000);
                
                  
                 $(".ERR").text("")
                 swal.fire("Message",response.message, "success");
             }else{
                 swal.fire("Cancelled",response.message, "error");
             }
 
             }).fail(function(error){
             $("#loading").hide(); 
             $.each(error.responseJSON.errors, function (key, item) {
                 $("#err_"+key).text(item[0]);  
             });
         }); 
     });

    $('.save_price').click(function () { 
        var tr = row; 
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

                $(tr).find(".total").text(response.price+" $")

                var table = $('#datatable-buttons').DataTable();
                table.row(tr).remove().draw();
                $("#actual_sale_price").val("");
                $("#customer_sale_price").val("");
                $(".ERR").text("")
                swal.fire("Message",response.message, "success");
            }else{
                swal.fire("Cancelled",response.message, "error");
            }

            }).fail(function(error){
            $("#loading").hide(); 
            $.each(error.responseJSON.errors, function (key, item) {
                $("#err_"+key).text(item[0]);  
            });
        }); 
    });

  

    
    $('.add_shipping_detail').click(function (e) { 
       e.preventDefault();
 
        $(".ERR").text("") 
        var form = $("#shippling_detial_form").serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST',
                data: form,
                url: '{{url('order/shipping_detail')}}' ,
                beforeSend: function() { 
                    $("#loading").show();
                },
            }).done(function(response) {
            $("#loading").hide();
            if(response.status){
                $("#transaction_id_ship").val(""); 
                $("#shipping_detail").val(""); 
                $("#shippingDetailModal").modal('toggle');

                $(".ERR").text("")
                swal.fire("Message",response.message, "success");
            }else{
                swal.fire("Cancelled",response.message, "error");
            }

            }).fail(function(error){
            $("#loading").hide(); 
            $.each(error.responseJSON.errors, function (key, item) {
                $("#err_"+key).text(item[0]);  
            });
        }); 
    });



    $('.reject_order').click(function (e) {
        e.preventDefault();
            var uid = $(this).data('id');
            var tr = $(this).closest('tr');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, reject it!'
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
                    url: '{{url('order/reject/')}}/' + uid,
                }).done(function (responce) {
                    console.log(responce);
                    if(responce.status){ 
                        Swal.fire("Message!",responce.success, "success");
                        var table = $('#datatable-buttons').DataTable();
                        table.row(tr).remove().draw();
                    }else{
                        swal.fire("Cancelled",responce.error, "error");
                    }
                }).fail(function (responce) {
                    swal.fire("Cancelled",responce.error, "error");
                });
            }
        })
    });

    
    $('.mark_as_complete').click(function (e) {
        e.preventDefault();
            var uid = $(this).data('id');
            var tr = $(this).closest('tr');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#009800',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Mark as complete!'
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
                    url: '{{url('order/complete/')}}/' + uid,
                }).done(function (responce) {
                    console.log(responce);
                    if(responce.status){ 
                        Swal.fire("Message!",responce.message, "success");
                        var table = $('#datatable-buttons').DataTable();
                        table.row(tr).remove().draw();
                    }else{
                        swal.fire("Cancelled",responce.error, "error");
                    }
                }).fail(function (responce) {
                    swal.fire("Cancelled",responce.error, "error");
                });
            }
        })
    });

   </script>
     
@endsection