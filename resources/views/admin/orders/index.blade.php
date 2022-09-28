@extends('layouts.theme')
@section('title', 'Home')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-sm-8 text-left">
                                <h4 class="card-title">Customers Orders </h4>
                            </div>
                            {{-- <div class="col-lg-4 col-md-6 col-sm-4 text-right">
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addcategory">Add
                                    Category</button>
                            </div> --}}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration" id="table">
                                <thead>
                                    <tr>
                                        <th>Sr No</th>
                                        <th>Order Date</th>
                                        <th>price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table_id">
                                    @foreach ($orders as $order)
                                        <tr class="order_data" id='row_{{ $order->id }}'>
                                            <td>{{ $order->id }}</td>
                                            <td> {{ date('d-m-y', strtotime($order->created_at)) }}</td>
                                            <td>{{ $order->payment->payment }}</td>
                                            <td>
                                                <input type="hidden" class="id"  value={{$order->id}} >
                                                <select class="form-select order_status " name="order_status" style="height: 29px;
                                                border-radius: 5px;
                                                background: content-box;">
                                                    <option >--Select Status--</option>

                                                    <option  {{ $order->order_status =='pending' ? 'selected':'' }} value="pending" class="update-status">Pending</option>
                                                    <option {{ $order->order_status =='accepted' ? 'selected':'' }} value="accepted">Accepted</option>
                                                    <option {{ $order->order_status =='completed' ? 'selected':'' }} value="completed">Completed</option>
                                                    <option {{ $order->order_status =='proccing' ? 'selected':'' }} value="proccing">Proccing</option>
                                                    <option {{ $order->order_status =='rejecting' ? 'selected':'' }} value="rejecting">Rejecting</option>

                                                  </select>

                                                  <a href="" class="btn btn-sm btn-primary update-status" > Update Status</a>

                                            </td>

                                            <td>
                                                <div class="button-group">
                                                    <div class="btn-group">
                                                       <div class="btn-group">
                                                          <button id="btnGroupDrop1" type="button"
                                                             class="btn btn-primary dropdown-toggle py-0 px-2"
                                                             data-toggle="dropdown"></button>
                                                          <div class="dropdown-menu">


                                                             <a class="dropdown-item"
                                                             href="javascript:openPaymentModal({{ json_encode($order) }})">Payment</a>


                                                             <a class="dropdown-item"
                                                             href="{{ url('admin/view-order/'.$order->id) }}" class="btn btn-sm btn-primary" >View</a>

                                                          </div>
                                                       </div>
                                                    </div>
                                                 </div>

                                                {{-- <a  class="btn btn-sm btn-success text-white"
                                                href="javascript:openPaymentModal({{ json_encode($order) }})">Payment</a>
                                                <a href="{{ url('admin/view-order/'.$order->id) }}" class="btn btn-sm btn-primary" >View</a> --}}

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination justify-content-center">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" value="-1" id="deleteID">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Category
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Category?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" id="button-delete" class="btn btn-primary"
                        onclick="deleteCategory()">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="payment">
        <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content">
              <div class="modal-header">
                 <h5 class="modal-title">Payment</h5>
                 <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                 </button>
              </div>
              <div class="modal-body">
                 <form class="form-valide" id="payment-form" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden"  id="order_id" name="order_id">
                    <input type="hidden"  id="user_id"  name="user_id">
                    {{-- <input type="hidden" value="PUT" name="_method"> --}}
                    <div class="form-validation">


                       <div class="modal-body row">
                         <div class="col-md-12">
                             <label class="form-label" for="name">Amount<span class="text-danger">*</span>
                             </label>
                             <input type="text" class="form-control" id="amount" name="amount"
                             placeholder="Enter a name.." value="">
                          <div id="amount_text" class="text-danger backend-error-text"></div>
                         </div>



                       </div>
                       <div class="modal-body">
                        <label class="form-label" for="name">Comment<span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control col-xs-12" name="comment" id="comment"  rows="7" cols="50" :value="old('comment')"></textarea>
                        <div id="comment_text" class="text-danger backend-error-text"></div>
                    </div>


                    </div>
                    <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                       <button type="button" id="button-update" onclick="payment(this)"
                          class="btn btn-primary">Submit</button>
                    </div>
                 </form>
              </div>
           </div>
        </div>
     </div>

@endsection
@section('scripts')
<script>
    $(document).ready(function () {

 $('.update-status').click(function (e) {
    e.preventDefault();

    var id = $(this).closest('.order_data').find('.id').val();
    var order_status = $(this).closest('.order_data').find('.order_status').val();
    console.log(id);
    console.log(order_status);


    data = {
        'id':id,
        'order_status' :order_status,
    }


    $.ajax({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
           },

        method: "POST",
        url: "update-status",
        data: data,

        success: function (data) {
            console.log(data);
            window.location.reload();
            swal({
                   title: "",
                   text: data.message,
                   icon: "success",
               });
        }
    });



});


});

function openPaymentModal(order) {
    console.log(order.id);

document.getElementById('amount').value = order.payment.remaining_amount;



document.getElementById('order_id').value = order.id;
document.getElementById('user_id').value = order.user_id;

     $("#payment").modal()
}

function payment() {
       var form = $('#payment-form')[0];
       $("#button-update").text('Loading...');
       order_id = form.order_id.value;



       const myFormData = new FormData(form);



       $.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           url: "/admin/orders/" + order_id, // the endpoint
           type: "POST",
           processData: false,
           contentType: false,
           data: myFormData,
           beforeSend: function() {
               $(form)
               $('.backend-error-text').text('')
               $("#button-update").prop("disabled", true)

           },
           success: function(data) {
            console.log(data)
               $("#button-update").prop("disabled", false);
               $("#button-update").text("Submit");

               if (data.status == false) {
                   swal({
                       title: "Error",
                       text: data.message,
                       icon: "error",
                   });
                   return;
               }


               swal({
                   title: "",
                   text: data.message,
                   icon: "success",
               });

              ;


               $('#payment').modal('hide');


           },
           error: function(error) {
               $(form)
               $("#button-update").prop("disabled", false);
               $("#button-update").text("Submit");
               var errorMessage = error.statusText;
               var sweetMessage = error.statusText;

               if (error.status == 422) {
                   errorMessage = handleValidationErrors(error, 'edit')
                   sweetMessage = 'Invalid Data'
               }
               swal({
                   title: "Error",
                   text: sweetMessage,
                   icon: "error",
               });


           },
       });
   }

//    function payment() {
//     var form = $('#payment-form')[0];
//        $("#button-update").text('Loading...');
//        const myFormData = new FormData(form);
//             const formDataObj = {};

//        $.ajax({
//            headers: {
//                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
//            },
//            method: "/admin/orders", // the endpoint
//            type: "POST", // http method
//            processData: false,
//            contentType: false,
//            data: myFormData,
//            beforeSend: function() {
//                $(form)
//                $('.backend-error-text').text('')
//                $("#button-update").prop("disabled", true)

//            },
//            success: function(data) {
//             console.log(data)
//                $("#button-update").prop("disabled", false);
//                $("#button-update").text("Submit");

//                if (data.status == false) {
//                    swal({
//                        title: "Error",
//                        text: data.message,
//                        icon: "error",
//                    });
//                    return;
//                }


//                swal({
//                    title: "",
//                    text: data.message,
//                    icon: "success",
//                });

//     //            const CATRGORY = JSON.stringify(data.category)
//     //            var string =
//     //                `<tr id="row_${data.category.id}">
//     //       <td>${data.category.name}</td>
//     //       <td><img src="${data.category.image_url}" height="50px" width="50px" alt=""></td>
//     //       <td class="text-center"><span class="badge badge-${ data.category.is_active == '1' ? 'success' : 'warning' }">${(data.category.is_active == '1' ? 'active' : 'not-active')}</td>

//     //       <td>
//     //           <div class="button-group">
//     //               <div class="btn-group">
//     //                   <div class="btn-group"><button id="btnGroupDrop${data.category.id}" type="button"
//     //                           class="btn btn-primary dropdown-toggle py-0 px-2" data-toggle="dropdown"></button>
//     //                       <div class="dropdown-menu"> <a class="dropdown-item" onclick="openViewModal(${data.category})">View</a>
//     //                           <a class="dropdown-item" href="javascript:;" onclick='openEditModal(${CATRGORY})'>Edit</a><a
//     //                               class="dropdown-item" href="javascript:openDeleteDialog(${data.category.id});">Delete</a></div>
//     //                   </div>
//     //               </div>
//     //           </div>
//     //       </td>
//     //   </tr>`
//                $("#table_id").append(string);


//                $('#addcategory').modal('hide');


//            },
//            error: function(error) {
//                $(form)
//                $("#button-update").prop("disabled", false);
//                $("#button-update").text("Submit");
//                var errorMessage = error.statusText;
//                var sweetMessage = error.statusText;

//                if (error.status == 422) {
//                    errorMessage = handleValidationErrors(error, 'edit')
//                    sweetMessage = 'Invalid Data'
//                }
//                swal({
//                    title: "Error",
//                    text: sweetMessage,
//                    icon: "error",
//                });


//            },
//        });
//    }
</script>
@endsection
