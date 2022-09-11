@extends('website.master')
@section('title' , "Shopping Cart")
@section('content')

    <div class="container">
        <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
            <li class="active">
                <a href="">Shopping Cart</a>
            </li>
            <li>
                <a href="">Checkout</a>
            </li>
            <li class="disabled">
                <a href="cart.html">Order Complete</a>
            </li>
        </ul>

        <div class="row">
            <div class="col-lg-8 ">
                <div class="cart-table-container ">
                    {{-- <div class="row">
                        <div class="col-md-2"> Image</div>
                        <div class="col-md-2"><strong class="text-center">Nmae</strong> </div>
                        <div class="col-md-2">Nmae</div>
                        <div class="col-md-2">Nmae</div>
                        <div class="col-md-2">Nmae</div>
                        <div class="col-md-2">Nmae</div>

                    </div> --}}
                    @php $total = 0; @endphp
                    @php $alltotal = 0; @endphp
                    @foreach ($cart as  $cartlist)
                    <table class="table table-cart product_data ">
                        {{-- <thead>
                            <tr>
                                <th class="thumbnail-col"></th>
                                <th class="product-col">Product</th>
                                <th class="price-col">Price</th>
                                <th class="qty-col">Quantity</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                        </thead> --}}

                        <tbody >

                            <tr class="product-row ">
                                <div class="">

                                <td>
                                    <figure class="product-image-container">

                                        <a href="product.html" class="product-image">
                                            <img src="{{asset($cartlist->product->feature_image)}}" alt="product">
                                        </a>

                                        <a href="#" class=" btn-remove icon-cancel delete-cart-item" title="Remove Product"></a>
                                    </figure>
                                </td>
                                <td class="text-center">
                                    <h5 class="product-title">
                                        <a href="product.html">{{$cartlist->product->name}}</a>
                                    </h5>
                                </td>
                                <td class="text-center">{{$cartlist->product->currency}}{{$cartlist->product->saleprice}}</td>
                                <td class="text-center">
                                    <input type="hidden" class="product_id"  value={{$cartlist->product_id}} >
                                    <div class="product-single-qty">

                                        <input class="horizontal-quantity form-control" name="quantity" type="text" value="{{$cartlist->quantity}}">
                                    </div><!-- End .product-single-qty -->
                                </td>
                                @php $total =$cartlist->product->saleprice * $cartlist->quantity ; @endphp
                                <td class="text-center"><span class="subtotal-price"></span>{{$cartlist->product->currency}}{{ $total }}</td>

                                <td class="text-center">


                                    <div class="float-right">
                                        <button type="submit" class="btn btn-shop update-cart">
                                            Update
                                        </button>
                                    </div><!-- End .float-right -->
                                </td>
                            </div>
                            </tr>


                            @php $alltotal +=$cartlist->product->saleprice * $cartlist->quantity ; @endphp

                        </tbody>



                        <tfoot>
                            <tr>

                            </tr>
                        </tfoot>
                    </table>
                    @endforeach
                </div><!-- End .cart-table-container -->
            </div><!-- End .col-lg-8 -->

            <div class="col-lg-4">
                <div class="cart-summary">
                    <h3>CART TOTALS</h3>

                    <table class="table table-totals">
                        <tbody>
                            <tr>
                                <td>Subtotal</td>
                                <td>{{$cartlist->product->currency}}{{$alltotal}}</td>
                            </tr>


                        </tbody>

                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td>{{$cartlist->product->currency}}{{ $alltotal }}</td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="checkout-methods">
                        <a href="{{ url('check-out') }}" class="btn btn-block btn-dark ">Proceed to Checkout
                            <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div><!-- End .cart-summary -->
            </div><!-- End .col-lg-4 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-6"></div><!-- margin -->

@endsection
@section('scripts')
<script>
$(document).ready(function () {
    $('.delete-cart-item').click(function (e) {
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.product_id').val();
// alert(product_id);

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $.ajax({
            method: "GET",
            url: "delete",
            data: {
                'product_id':product_id,
            },

            success: function (response) {
                window.location.reload();
// alert(response);
swal("",response.status,"success");
            }
        });


    });
    $('.update-cart').click(function (e) {
    e.preventDefault();

    var product_id = $(this).closest('.product_data').find('.product_id').val();
    var quantity = $(this).closest('.product_data').find('.horizontal-quantity').val();


    data = {
        'product_id':product_id,
        'quantity' :quantity,
    }


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });
    $.ajax({
        method: "POST",
        url: "update",
        data: data,

        success: function (response) {
            window.location.reload();
            toster.success("",response.status,"success");
        }
    });



});
});
</script>
@endsection
