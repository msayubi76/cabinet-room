<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Detail</title>
    <link rel="stylesheet" href="{{ asset('website/assets/css/bootstrap.min.css') }}">
</head>
<body>

    <div class="container account-container custom-account-container">
        <div class="row">
       <div class="col-md-2"></div>

            <div class="col-md-8">
                <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                    <div class="dashboard-content">


                        <div class="mb-4"></div>

                        <div class="order-content">
                            <h3 class="account-sub-title d-none d-md-block">Order Detail</h3><br>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <strong>Customer Name</strong><br>
                                            {{ $shipping_detail->first_name }}  {{ $shipping_detail->last_name }}
                                        </div>

                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <strong>Order Status</strong><br>

                                            @if ($order->order_status == 'pending')
                                            <span

                                            class="badge badge-warning text-black">
                                            {{ $order->order_status  }}</span>
                                            @elseif ($orders->order_status == 'Rejected')
                                            <span

                                            class="badge badge-danger text-black">
                                            {{ $order->order_status  }}</span>

                                            @else
                                            <span

                                            class=" badge badge-success text-black">
                                            {{ $order->order_status  }}</span>

                                            @endif


                                        </div>
                                        <div class="col-md-4">
                                            <strong>Order Date</strong><br>
                                            {{ date('d F, Y h:i A', strtotime($shipping_detail->created_at)) }}
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <strong>Bill To</strong><br>
                                            {{ $shipping_detail->first_name }}  {{ $shipping_detail->last_name }} <br>
                                            {{ $shipping_detail->address }}  {{ $shipping_detail->city }}

                                        </div>
                                        <div class="col-md-4">
                                            <strong>Shipp To</strong><br>
                                            {{ $shipping_detail->first_name }}  {{ $shipping_detail->last_name }} <br>
                                            {{ $shipping_detail->address }}  {{ $shipping_detail->city }}
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div><br>
                            <div class="order-table-container text-center">
                                @php $total = 0; @endphp

                                <table class="table table-order text-left">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Quantity</th>


                                            <th>Price</th>

                                        </tr>
                                    </thead>
                                    <tbody>


                                        @foreach ($order_items as $orderlist)
                                <tr>
                                    <td>
                                        {{ $loop->count }}


                                    </td>
                                    <td>
                                        {{ $orderlist->products->name }}


                                    </td>
                                    <td >
                                        @if ($orderlist->order->order_status == 'pending')
                                        <span

                                        class="badge badge-warning text-black">
                                        {{ $orderlist->order->order_status  }}</span>
                                        @elseif ($orderlist->orders->order_status == 'Rejected')
                                        <span

                                        class="badge badge-danger text-black">
                                        {{ $orderlist->order->order_status  }}</span>

                                        @else
                                        <span

                                        class=" badge badge-success text-black">
                                        {{ $orderlist->order->order_status  }}</span>

                                        @endif
                                    </td>

                                    <td>
                                        {{ $orderlist->quantity }}

                                    </td>

                                    <td>
                                        {{ $orderlist->price }}

                                    </td>






                                </tr>
                                @php $total +=$orderlist->price * $orderlist->quantity ; @endphp
                            @endforeach

                                    </tbody>
                                </table><br>



                            </div>

                            <div class="row" style="margin-right: 0;
                            margin-left: 0;">

                                    <div class="col-md-12 " style="background-color: #f3f3f3;padding-bottom: 15px; ">
                                    <strong style="float: right;background-color: #000000;color:#ffffff;padding-left: 95px;width:240px;">Total :  {{  $total }}</strong>
                                </div>

                                </div>
                            <div style="">
                                <h5>
                                    TERMS & CONDTION
                                </h5>
                                <P>Payment is due with in 30 days</P>
                            </div>
                            <div>
                                <h5>
                                   NOTES
                                </h5>
                                <P>Please pay due with in time</P>
                            </div>
                            <hr class="mt-0 mb-3 pb-2" />

                                <a href="{{ ('/products') }}" class="btn btn-dark">Go Shop</a>
                        </div>
                    </div>
                </div><!-- End .tab-pane -->
            </div>
            <div class="col-md-2"></div>



</body>
</html>













