@extends('layouts.theme')
@section('title', 'Home')
@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h2>Order</h2>
                    </div>
                    <div class="row">

                        <div class="col-md-4">
                            <strong>Customer Name</strong><br>
                            {{ $shipping_detail->first_name }}  {{ $shipping_detail->last_name }}
                        </div>

                    </div><br>

                    <div class="row">
                        <div class="col-md-4">
                            <strong>Order No</strong>
                            {{ $shipping_detail->orders }}
                        </div>
                        <div class="col-md-4">
                            <strong>Order Date</strong><br>
                            {{ date('d-m-y', strtotime($shipping_detail->created_at)) }}
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

                    <div class="table-responsive">
                        @php $total = 0; @endphp
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Quantity</th>

                                    <th>Date</th>
                                    <th>Price</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_items as $orderlist)
                                <tr>
                                    <td>
                                        {{ $orderlist->id }}


                                    </td>
                                    <td>
                                        {{ $orderlist->products->name }}


                                    </td>
                                    <td >
                                        @if ($orderlist->orders->order_status == 'pending')
                                        <span

                                        class="badge badge-warning text-black">
                                        {{ $orderlist->orders->order_status  }}</span>
                                        @elseif ($orderlist->orders->order_status == 'rejected')
                                        <span

                                        class="badge badge-danger text-black">
                                        {{ $orderlist->orders->order_status  }}</span>

                                        @else
                                        <span

                                        class=" badge badge-success text-black">
                                        {{ $orderlist->orders->order_status  }}</span>

                                        @endif
                                    </td>

                                    <td>
                                        {{ $orderlist->quantity }}

                                    </td>
                                    <td>
                                        {{ date('d-m-y', strtotime($orderlist->orders->created_at)) }}

                                    </td>
                                    <td>
                                        {{ $orderlist->price }}

                                    </td>

                                    {{-- <td>
                                        {{ $orderlist->payments->payment }}

                                    </td> --}}




                                </tr>
                                @php $total +=$orderlist->price * $orderlist->quantity ; @endphp
                            @endforeach

                            </tbody>

                        </table>

                    </div>
                    <div class="row" style="margin-right: 0;
                    margin-left: 0;">

                            <div class="col-md-12 " style="background-color: #f3f3f3;padding-bottom: 15px; "><strong style="float:right;padding-right: 70px;"> Price * Quantity :   {{ $orderlist->price }} * {{ $orderlist->quantity }}</strong>
                            <br><br>
                            <strong style="float: right;background-color: #000000;color:#ffffff;padding-left: 95px;width:240px;">Total :  {{  $total }}</strong>
                        </div>

                        </div>
                        <div style="margin-top: 180px;">
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
                </div>
            </div>
        </div>




    </div>
</div>

@endsection

