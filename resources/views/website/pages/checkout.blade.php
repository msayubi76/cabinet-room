@extends('website.master')
@section('title', 'Checkout')

@section('content')
    <div class="container checkout-container">
        @include('alerts')
        <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
            <li>
                <a href="">Shopping Cart</a>
            </li>
            <li class="active">
                <a href="">Checkout</a>
            </li>
            <li class="disabled">
                <a href="#">Order Complete</a>
            </li>
        </ul>


        <form action="{{ url('check-out') }}" method="post" id="checkout-form">
            @csrf


            <div class="row">
                <div class="col-lg-7">
                    @if ($errors->any())
                        {{ $errors }}
                    @endif
                    <ul class="checkout-steps">
                        <li>
                            <h2 class="step-title">Billing Details</h2>
                            @if (session('message'))
                                <div class="alert alert-success"> {{ session('message') }}</div>
                            @endif


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First name
                                            <abbr class="required" title="required">*</abbr>
                                        </label>
                                        <input type="text" name="first_name" class="form-control"
                                            value="{{ old('first_name') }}" />
                                        @error('first_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last name
                                            <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" name="last_name" class="form-control"
                                            value="{{ old('last_name') }}" />
                                        @error('last_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>City <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" class="form-control" name="city" id="city">

                                        {{-- <select name="city" id="city" class="form-control"
                                            onchange="selectCity(this)">
                                            <option value="">Select City</option>
                                            @foreach ($cities as $city)
                                                <option {{ old('city') == $city['name'] ? 'selected' : '' }}
                                                    value="{{ $city['name'] }}">{{ $city['name'] }}</option>
                                            @endforeach
                                        </select> --}}
                                        @error('city')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Street address
                                            <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" name="address" class="form-control"
                                            placeholder="House number and street name" value="{{ old('address') }}" />
                                        @error('address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone <abbr class="required" title="required">*</abbr></label>
                                        <input type="tel" name="phone_number" class="form-control" placeholder="Phone"
                                            value="{{ old('phone_number') }}" />
                                        @error('phone_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email address
                                            <abbr class="required" title="required">*</abbr></label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email') }}" />
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>





                            {{-- <div class="form-group">
                                <input type="text" class="form-control" placeholder="Apartment, suite, unite, etc. (optional)" required />
                            </div> --}}









                            <div class="form-group">
                                <label class="order-comments">Order notes (optional)</label>
                                <textarea class="form-control" name="notes" value="{{ old('notes') }}"
                                    placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                @error('notes')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- End .col-lg-8 -->

                <div class="col-lg-5">
                    <div class="order-summary">
                        <h3>YOUR ORDER</h3>

                        <table class="table table-mini-cart">
                            <thead>
                                <tr>
                                    <th colspan="2">Product</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @php $all_item_total = 0; @endphp
                                @foreach ($cart as $cartitem)
                                    <tr>
                                        <td class="product-col">
                                            <h3 class="product-title">
                                                {{ $cartitem->product->name }}
                                                @if ($cartitem->variation)
                                                    ({{ $cartitem->variation->value }})
                                                @endif
                                                ×
                                                <span class="product-qty">{{ $cartitem->quantity }}</span>

                                            </h3>
                                        </td>

                                        <td class="price-col">
                                            @php
                                                $total = $cartitem->variation
                                                    ? $cartitem->variation->sale_price * $cartitem->quantity
                                                    : $cartitem->product->saleprice * $cartitem->quantity;
                                            @endphp
                                            <span> {{ $cartitem->product->currency }}{{ $total }}</span>
                                        </td>
                                    </tr>
                                    @php $all_item_total += $cartitem->variation ? $cartitem->variation->sale_price * $cartitem->quantity : $cartitem->product->saleprice * $cartitem->quantity; @endphp
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr class="cart-subtotal">
                                    <td>
                                        <h4>Sub Total</h4>
                                    </td>

                                    <td class="price-col">

                                        <span> Rs {{ $all_item_total }}</span>
                                    </td>
                                </tr>

                                <tr class="order-shipping">
                                    @php $shippingTotal = 0; @endphp
                                    @foreach ($cart as $cartitem)
                                        @php $shippingTotal = $shippingTotal+$cartitem->product->shipping_charge; @endphp
                                    @endforeach
                                    @php $all_item_total = $all_item_total+$shippingTotal; @endphp
                                    <td>
                                        <h4>Shipping Charges</h4>
                                    </td>
                                    <td class="price-col">
                                        Free Delivery
                                        {{-- <span id="shipment-charges">--</span> --}}
                                    </td>
                                </tr>
                                <tr class="order-shipping">
                                    <td class="text-left" colspan="2">
                                        <h4 class="m-b-sm">Shipping</h4>

                                        <div class="form-group form-group-custom-control">
                                            <div class="custom-control custom-radio d-flex">
                                                <input type="radio" class="custom-control-input" name="payment_method"
                                                    checked id="cash-on-deliver" value="cod" />
                                                <label class="custom-control-label" for="cash-on-deliver">Cash on
                                                    Delivery</label>
                                            </div>
                                            <!-- End .custom-checkbox -->
                                        </div>

                                        <div class="form-group form-group-custom-control">
                                            <div class="custom-control custom-radio d-flex">
                                                <input type="radio" class="custom-control-input" name="payment_method"
                                                    id="online-transfer" value="online_transfer" />
                                                <label class="custom-control-label" for="online-transfer">Online
                                                    Transfer</label>
                                            </div>
                                            <!-- End .custom-checkbox -->
                                        </div>

                                        <div class="bank-account-detail" style="display:none;">
                                            <h4>Bank Account Detail</h4>
                                            <b> Account Title</b><br>
                                            <span>RK TRADERS</span><br>

                                            <b>Bank Name</b><br>
                                            <span>Soneri Bank</span><br>

                                            <b>Account No</b><br>
                                            <span>PK86SONE0020520004454961</span><br>
                                        </div>


                                    </td>

                                </tr>

                                <tr class="order-total">
                                    <td>
                                        <h4>Total</h4>
                                    </td>
                                    <td>
                                        <b class="total-price">Rs <span id="total-price">{{ $all_item_total }}</span></b>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>



                        <button type="submit" class="btn btn-dark btn-place-order" form="checkout-form" style="border-color: #fb7d1a; background-color: #fb7d1a;">
                            Place order
                        </button>
                    </div>
                    <!-- End .cart-summary -->
                </div>
                <!-- End .col-lg-4 -->
            </div>

        </form>
        <!-- End .row -->
    </div>
    <!-- End .container -->
@endsection

@section('scripts')
    <script>
        const CITIES = @json($cities);
        const totalPrice = @json($all_item_total);

        $(document).ready(function() {
            $('input[name="payment_method"]').change(function() {
                if ($('#online-transfer').is(':checked')) {
                    $('.bank-account-detail').slideDown();
                } else {
                    $('.bank-account-detail').slideUp();
                }
            });
        });
    </script>
    <script src="{{ url('website/assets/js/checkout.js') }}"></script>
@endsection
