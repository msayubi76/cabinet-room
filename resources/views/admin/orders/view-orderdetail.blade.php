@extends('layouts.theme')
@section('title', 'Home')
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h2>Order Detail</h2>
                        </div>


                        <div class="row">
                            <div class="col-md-9">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Customer Name</td>
                                            <td>{{ $shipping_detail->first_name }} {{ $shipping_detail->last_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Payment Status</td>
                                            <td>
                                                <span class="badge badge-success">{{ $payment->status }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Order Status</td>
                                            <td>
                                                <span class="badge badge-success">{{ $order->order_status }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2 ">Shipp To</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"> {{ $shipping_detail->first_name }}
                                                {{ $shipping_detail->last_name }}
                                                {{ $shipping_detail->address }} {{ $shipping_detail->city }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <a href="{{ $order->order_receipt }}" target="_blank">
            <img src="{{ $order->order_receipt }}" alt="Payment Receipt" style="max-width: 100px; height: auto;" />
        </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-3">
                                <table class="w-100">
                                    <tr>
                                        <td>Order No</td>
                                        <td>000{{ $order->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Order Date</td>
                                        <td> {{ date('d-m-y', strtotime($shipping_detail->created_at)) }}</td>

                                    </tr>
                                </table>

                            </div>
                        </div>

                        <div class="table-responsive mt-3">
                            @php $total = 0; @endphp
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total Price</th>

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

                                                @if ($orderlist->variation)
                                                   ( {{ $orderlist->variation->value }})
                                                @endif
                                            </td>
                                        
                                            <td>
                                                {{ $orderlist->quantity }}
                                            </td>

                                            <td>
                                                {{ number_format($orderlist->price, 2) }}
                                            </td>
                                            <td>
                                                {{ number_format($orderlist->price * $orderlist->quantity, 2) }}
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3">

                                        </td>
                                        <td>
                                            <b>Shipping Charges</b>
                                        </td>
                                        <td>{{number_format($payment->shipping_charges, 2)}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">

                                        </td>
                                        <td>
                                            <b>Sub Total</b>
                                        </td>
                                        <td>{{number_format($payment->payment, 2)}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">

                                        </td>
                                        <td>
                                            <b>Total Amount</b>
                                        </td>
                                        <td>{{number_format($payment->total_amount, 2)}}</td>
                                    </tr>
                                </tfoot>

                            </table>

                        </div>
                        
                        <div style="margin-top: 180px;">
                             
                        </div>
                        <div>
                            
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>

@endsection
