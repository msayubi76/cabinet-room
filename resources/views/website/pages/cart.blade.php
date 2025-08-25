@extends('website.master')
@section('title', 'Shopping Cart')
@section('content')

    <div class="container">
        @include('alerts')
        <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
            <li class="active">
                <a href="javascript:;">Shopping Cart</a>
            </li>
            <li>
                <a href="javascript:;">Checkout</a>
            </li>
            <li class="disabled">
                <a href="javascript:;">Order Complete</a>
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

                        <tbody>

                            @php $total = 0; @endphp
                            @php $alltotal = 0; @endphp
                            @forelse ($cart as $cartlist)
                                <tr class="product-row ">
                                    <div class="">

                                        <td>
                                            <figure class="product-image-container">

                                                <a href="product.html" class="product-image">
                                                    <img src="{{ asset($cartlist->product->feature_image) }}"
                                                        alt="product">
                                                </a>

                                                <a href="javascript:openDeleteDialog({{ $cartlist->product_id }})"
                                                    class=" btn-remove icon-cancel" title="Remove Product"></a>
                                            </figure>
                                        </td>
                                        <td class="text-center">
                                            <h5 class="product-title">
                                                <a href="javascript:;">{{ $cartlist->product->name }}

                                                    @if ($cartlist->variation)
                                                        ({{ $cartlist->variation?->value }})
                                                    @endif
                                                </a>
                                            </h5>
                                        </td>
                                        <td class="text-center">
                                            {{ $cartlist->product->currency }}

                                            (
                                            {{ $cartlist->variation ? (int) $cartlist->variation->sale_price : $cartlist->product->saleprice }})
                                        </td>
                                        <td class="text-center">
                                            <input type="hidden" class="product_id" value='{{ $cartlist->product_id }}'>
                                            <div class="product-single-qty">

                                                <input class="horizontal-quantitys form-control " name="quantity"
                                                    min="1"
                                                    max="{{ $cartlist->variation ? $cartlist->variation->stock : $cartlist->product->stock }}"
                                                    onchange="updatePrice(this,'{{ $cartlist->product->id }}',{{ $cartlist->variation ? $cartlist->variation->sale_price : $cartlist->product->saleprice }}, {{ $cartlist }} )"
                                                    type="number" value="{{ $cartlist->quantity }}">
                                            </div><!-- End .product-single-qty -->
                                        </td>
                                        @php $total =  $cartlist->variation ? $cartlist->variation->sale_price* $cartlist->quantity  : $cartlist->product->saleprice * $cartlist->quantity ; @endphp
                                        <td class="text-center"><span
                                                class="subtotal-price">{{ $cartlist->product->currency }}<span
                                                    id="quantity_total_{{ $cartlist->product->id }}">{{ (int) $total }}</span></span>
                                        </td>

                                        <td class="text-center">


                                            <div class="float-right">
                                                <button type="submit"
                                                    class="btn btn-shop update-cart-btn   btn-sm btn-sm p-3 text-capitalize">
                                                    Update
                                                </button>
                                                <button type="button"
                                                    class="btn btn-shop  btn-sm p-3 text-capitalize btn-sm"
                                                    onclick="viewDetailDialog({{ $cartlist }})">
                                                    Detail
                                                </button>
                                            </div><!-- End .float-right -->
                                        </td>
                                    </div>
                                </tr>


                                @php $alltotal +=$cartlist->variation ? (int) $cartlist->variation->sale_price * $cartlist->quantity : $cartlist->product->saleprice * $cartlist->quantity ; @endphp


                            @empty
                                <h4 class="text-left">No item in the Cart</h4>
                            @endforelse
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div><!-- End .cart-table-container -->
            </div><!-- End .col-lg-8 -->
            @if (isset($cartlist))
                <div class="col-lg-4">
                    <div class="cart-summary">
                        <h3>CART TOTALS</h3>

                        <table class="table table-totals">
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>{{ $cartlist->product->currency }}<span id="subtotal">{{ $alltotal }}</span>
                                    </td>
                                </tr>


                            </tbody>

                            <tfoot>
                                <tr>
                                    <td>Total</td>
                                    <td>{{ $cartlist->product->currency }}<span
                                            id="totalAmount">{{ $alltotal }}</span></td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="checkout-methods">
                            <a href="{{ url('check-out') }}" class="btn btn-block btn-primary ">Proceed to Checkout
                                <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div><!-- End .cart-summary -->
                </div>
            @else
            @endif
            <!-- End .col-lg-4 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-6"></div><!-- margin -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" value="-1" id="deleteID">

                    <h3 class="modal-title" id="exampleModalLongTitle">Delete Cart Item
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Cart Item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
                    <button type="button" id="button-delete" class="btn btn-primary btn-sm"
                        onclick="deleteCartItem()">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Detail Modal -->
    <div class="modal fade" id="viewDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" value="-1" id="deleteID">

                    <h5 class="modal-title" id="exampleModalLongTitle">Product Detail
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <img id="productImage" alt="product" width=150>
                    </div>
                    <table class="table-responsive">
                        <tbody>

                            <tr>
                                <td width="120">Name</td>
                                <td>
                                    <h5 class="m-0" id="productName"></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>Sku</td>
                                <td>
                                    <p class="m-0" id="productSku"></p>
                                </td>
                            </tr>
                            <tr>
                                <td>Delivered In</td>
                                <td>
                                    <p class="m-0" id="productDeliveredIn"></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-top">Description</td>
                                <td>
                                    <p class="m-0" id="productSmallDescription"></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-4 py-3" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function openDeleteDialog(id) {
            $("#deleteID").val(id);
            $("#deleteModal").modal('show');
        }

        function viewDetailDialog(cart) {
            const product = cart.product
            console.log('product', product);
            let name = product.name
            if (cart.variation) {
                name = name + `( ${cart.variation.value} )`
            }
            $("#productImage").attr("src", product.feature_image);
            $("#productName").html(name);
            $("#productSku").html(product.sku);
            $("#productRating").html(product.rating);
            $("#productDeliveredIn").html(product.delivered_in);
            $("#productSmallDescription").html(product.short_description);
            $("#viewDetailModal").modal('show');
        }

        function deleteCartItem() {
            $("#button-delete").text('Loading...');

            var product_id = $('#deleteID').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "GET",
                url: "delete",
                data: {
                    'product_id': product_id,
                },

                success: function(response) {
                    $('#deleteModal').modal('hide');

                    window.location.reload();
                    // alert(response);
                    swal("", response.status, "success");
                }
            });
        }

        $(document).ready(function() {


            $('.update-cart-btn').click(function(e) {
                e.preventDefault();
                
                const updateButton = $(this)
                updateButton.prop('disabled', true)

                var product_id = $(this).closest('.product_data').find('.product_id').val();
                var quantity = $(this).closest('.product_data').find('.horizontal-quantitys').val();


                data = {
                    'product_id': product_id,
                    'quantity': quantity,
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

                    success: function(response) {
                        updateButton.prop('disabled', false)
                        // window.location.reload();
                        console.log('response', response);

                        if (response.status) {
                            swal({
                                title: 'Success',
                                text: response.message,
                                icon: "success",
                            });
                        } else {
                            swal({
                                type: 'error',
                                text: response.message,
                                icon: "error",
                            });
                        }
                    },

                    error: function(error) {
                        updateButton.prop('disabled', false)
                        // window.location.reload();
                        var errorMessage = error.statusText;

                        swal({
                            title: "Error",
                            text: errorMessage,
                            icon: "error",
                        });
                    }
                });



            });
        });

        function updatePrice(data, id, price, cart) {

            let priceVal = data.value * price
            let oldTotal = $('#quantity_total_' + id).html()
            let subTotal = $('#subtotal').html()

            let newTotal = (subTotal - oldTotal) + priceVal
            $('#subtotal').html(newTotal)
            $('#totalAmount').html(newTotal)
            $('#quantity_total_' + id).html(priceVal)
        }
    </script>
@endsection
