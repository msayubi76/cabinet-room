@extends('layouts.theme')
@section('title', 'Home')
@section('content')
    <div class="container-fluid order-page">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if ($orders->count() > 0)
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
                                            <th>Order Receipt</th>
                                            <th>Order Date</th>
                                            <th>Price</th>
                                            <th>Remaining Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody id="table_id">
                                        @php $i=0; @endphp
                                        @foreach ($orders as $order)
                                            <tr class="order_data" id='row_{{ $order->id }}'>
                                                <td>{{ $i + 1 }}</td>
                                                <td><a href="{{ $order->order_receipt }}" target="_blank">
            <img src="{{ $order->order_receipt }}" alt="Payment Receipt" style="max-width: 100px; height: auto;" />
        </a></td>
                                                <td> {{ date('d F, Y h:i A', strtotime($order->created_at)) }}</td>
                                                <td>{{ $order->payment->payment }}</td>
                                                <td>{{ $order->payment->remaining_amount }}</td>
                                                <td>
                                                    <input type="hidden" class="id" value='{{ $order->id }}'>
                                                    {{ $order->order_status }}
                                                    <!-- <select id="my_selection" class="form-select order_status " name="order_status" style="height: 29px;
                                                border-radius: 5px;
                                                background: content-box;">



                                                        <option {{ $order->order_status == 'pending' ? 'selected' : '' }} value="pending" class="sweet">
                                                            Pending
                                                        </option>

                                                        <option {{ $order->order_status == 'Accepted' ? 'selected' : '' }} value="Accepted" class="sweet">Accepted</option>
                                                        <option {{ $order->order_status == 'Completed' ? 'selected' : '' }} value="Completed" class="sweet">Completed</option>
                                                        <option {{ $order->order_status == 'Rejected' ? 'selected' : '' }} value="Rejected" class="sweet">Rejected</option>
                                                        <option {{ $order->order_status == 'Canceled' ? 'selected' : '' }} value="Canceled" class="sweet">Canceled</option>

                                                    </select> -->


                                                    <!-- <a href="" class="btn btn-sm btn-primary update-status"> Update Status</a> -->

                                                </td>

                                                <td>
                                                    <div class="button-group">
                                                        <div class="btn-group">
                                                            <div class="btn-group">
                                                                <button id="btnGroupDrop1" type="button"
                                                                    class="btn btn-primary dropdown-toggle py-0 px-2"
                                                                    data-toggle="dropdown"></button>
                                                                <div class="dropdown-menu">
                                                                    @if ($order->order_status == 'pending')
                                                                        <a class="dropdown-item"
                                                                            href="javascript:openConfirmationDialog('Accepted',{{ $order->id }})"
                                                                            class="btn btn-sm btn-primary">Accept Order</a>
                                                                        <a class="dropdown-item"
                                                                            href="javascript:openConfirmationDialog('Completed',{{ $order->id }})"
                                                                            class="btn btn-sm btn-primary">Complete
                                                                            Order</a>
                                                                        <a class="dropdown-item"
                                                                            href="javascript:openConfirmationDialog('Rejected',{{ $order->id }})"
                                                                            class="btn btn-sm btn-primary">Reject Order</a>
                                                                        <a class="dropdown-item"
                                                                            href="javascript:openConfirmationDialog('Canceled',{{ $order->id }})"
                                                                            class="btn btn-sm btn-primary">Cancel Order</a>
                                                                    @elseif ($order->order_status == 'Accepted')
                                                                        <a class="dropdown-item"
                                                                            href="javascript:openConfirmationDialog('shipped',{{ $order->id }})"
                                                                            class="btn btn-sm btn-primary">Shipping
                                                                            Started</a>
                                                                        <a class="dropdown-item"
                                                                            href="javascript:openConfirmationDialog('Completed',{{ $order->id }})"
                                                                            class="btn btn-sm btn-primary">Complete
                                                                            Order</a>
                                                                        <a class="dropdown-item"
                                                                            href="javascript:openConfirmationDialog('Rejected',{{ $order->id }})"
                                                                            class="btn btn-sm btn-primary">Reject Order</a>
                                                                        <a class="dropdown-item"
                                                                            href="javascript:openConfirmationDialog('Canceled',{{ $order->id }})"
                                                                            class="btn btn-sm btn-primary">Cancel Order</a>
                                                                    @elseif ($order->order_status == 'shipped')
                                                                        <a class="dropdown-item"
                                                                            href="javascript:openConfirmationDialog('Completed',{{ $order->id }})"
                                                                            class="btn btn-sm btn-primary">Completed</a>
                                                                    @endif
                                                                    @if($order->tcs_consignment_number)
                                                                        <!-- Download Label -->
                                                                        <a href="javascript:void(0)" 
                                                                        class="dropdown-item"
                                                                        onclick="openTCSConfirmation('Label', {{ $order->id }}, '{{ $order->tcs_consignment_number }}')">
                                                                            Download Shipping Label
                                                                        </a>
                                                                    @endif


                                                                    <a class="dropdown-item"
                                                                        href="javascript:openPaymentModal({{ json_encode($order) }})">Payment</a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('admin/view-order/' . $order->id) }}"
                                                                        class="btn btn-sm btn-primary">View</a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('admin/order/' . $order->id) }}"
                                                                        class="btn btn-sm btn-primary">Payment History</a>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- <a  class="btn btn-sm btn-success text-white"
                                                href="javascript:openPaymentModal({{ json_encode($order) }})">Payment</a>
                                        <a href="{{ url('admin/view-order/'.$order->id) }}" class="btn btn-sm btn-primary">View</a> --}}

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>


                                </table>
                            </div>
                        @else
                            <h4 class="card-title">No Orders Available Right Now</h4>

                        @endif
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

                        <input type="hidden" id="order_id" name="order_id">
                        <input type="hidden" id="user_id" name="user_id">
                        {{-- <input type="hidden" value="PUT" name="_method"> --}}
                        <div class="form-validation">


                            <div class="modal-body row">
                                <div class="col-md-12">
                                    <label class="form-label" for="name">Amount<span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="amount" name="amount"
                                        placeholder="Enter ammount.." value="">
                                    <div id="amount_text" class="text-danger backend-error-text"></div>
                                    @error('amount')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>



                            </div>
                            <div class="modal-body">
                                <label class="form-label" for="name">Comment
                                </label>
                                <textarea class="form-control col-xs-12" name="comment" placeholder="Order here" id="comment" rows="7"
                                    cols="50" :value="old('comment')"></textarea>
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
    <div class="modal fade" id="changeStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" value="-1" id="changeStatusValue">
                    <input type="hidden" value="-1" id="orderId">

                    <h5 class="modal-title" id="exampleModalLongTitle">Change Status
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to change the current status to <span id="changeStatusTo"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" id="button-delete" class="btn btn-primary"
                        onclick="updateStatus()">Yes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function openTCSConfirmation(action, orderId, consignmentNo) {
    let routeUrl = '';
    let method = '';

    if (action === 'Track') {
        routeUrl = '/admin/orders/tcs-track';
        method = 'POST';
    } 
    else if (action === 'Label') {
        routeUrl = '/admin/orders/tcs-label';
        method = 'GET';
    }

    if (action === 'Label') {
        // Just open the label PDF
        const url = `${routeUrl}?consignment_number=${encodeURIComponent(consignmentNo)}&order_id=${orderId}`;
        window.open(url, '_blank');
    } else {
        // Call the backend via AJAX (like updateStatus)
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: method,
            url: routeUrl,
            data: {
                consignment_number: consignmentNo,
                order_id: orderId
            },
            success: function(response) {
                console.log('TCS Tracking Response:', response);
                // you can optionally update UI here — no alert
            },
            error: function(xhr, status, error) {
                console.error('TCS tracking failed:', error);
            }
        });
    }
}

        function openConfirmationDialog(Status, id) {
            $("#changeStatusValue").val(Status);

            $("#changeStatusTo").html(Status);
            $("#orderId").val(id);
            $("#changeStatus").modal('show');
        }

        function updateStatus() {
            $("#changeStatus").modal('hide');

            var id = $("#orderId").val();
            var order_status = $('#changeStatusValue').val();
            console.log('order sttus', order_status);
            data = {
                'id': id,
                'order_status': order_status,
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                method: "POST",
                url: "{{ route('orders') }}",
                data: data,

                success: function(data) {
                    console.log(data);
                    $('#row_' + id).remove();
                    // window.location.reload();
                    swal({
                        title: "",
                        text: data.message,
                        icon: "success",

                    });

                }
            });
        }
        $(document).ready(function() {
            $('.sweet').click(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to  be change the order status !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Changed!',
                            'Your order status  has been changed.',
                            'success'
                        )
                    }
                })
            });


            // $('.update-status').click(function(e) {
            //     e.preventDefault();

            //     var id = $(this).closest('.order_data').find('.id').val();
            //     var order_status = $(this).closest('.order_data').find('.order_status').val();
            //     console.log('order sttus',order_status);
            //     data = {
            //         'id': id,
            //         'order_status': order_status,
            //     }
            //     $.ajax({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            //         },
            //         method: "POST",
            //         url: "{{ route('orders') }}",
            //         data: data,

            //         success: function(data) {
            //             console.log(data);
            //             // window.location.reload();
            //             swal({
            //                 title: "",
            //                 text: data.message,
            //                 icon: "success",

            //             });

            //         }
            //     });



            // });



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
                    myTimeout = setTimeout(location.reload(), 3500);

                },
                error: function(error) {
                    $(form)
                    $("#button-update").prop("disabled", false);
                    $("#button-update").text("Submit");
                    var errorMessage = error.statusText;
                    var sweetMessage = error.statusText;

                    if (error.status == 422) {
                        errorMessage = handleValidationErrors(error)
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

        document.getElementById('my_selection').onchange = function() {
            window.location.href = this.children[this.selectedIndex].getAttribute('href');
        }

        function handleValidationErrors(error, type = 'create') {
            let errors = error.responseJSON.errors;
            var errorMessage = error.responseJSON.message
            var element = '';
            $.each(errors, function(key, item) {
                element = key.split('.')
                if (element.length > 1) {
                    element = `${element[0]}_${element[1]}`
                } else {
                    element = `${element}`
                }
                // dataAttr = $(element).closest('.tab').data('id')
                // $(`.step-${dataAttr}`).addClass('backend-error')
                if (type == 'edit') {
                    console.log('edit', element);
                    $(`#edit_${element}_text`).text(item[0])
                } else if (type == 'create') {
                    $(`#${element}_text`).text(item[0])
                }
            });

            return errorMessage;
        }
    </script>
@endsection
