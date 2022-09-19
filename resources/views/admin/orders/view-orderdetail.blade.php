@extends('layouts.theme')
@section('title', 'Home')
@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Shipping Detail</h4>
                    </div>
                    <div class="table-responsive">
                        <form class="form-valide" id="category-form" method="post" enctype="multipart/form-data">
                            @csrf
                           
                            <div class="form-validation">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="" for="name">First Name <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Category name.." value="{{ $shipping_detail->first_name }}">
                                            <div id="name_text" class="text-danger backend-error-text"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="" for="name">Last Name <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Category name.." value="{{ $shipping_detail->last_name }}">
                                            <div id="name_text" class="text-danger backend-error-text"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="" for="name">Address <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Category name.." value="{{ $shipping_detail->address }}">
                                            <div id="name_text" class="text-danger backend-error-text"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="" for="name">City <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Category name.." value="{{ $shipping_detail->city }}">
                                            <div id="name_text" class="text-danger backend-error-text"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="" for="name">Country <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Category name.." value="{{ $shipping_detail->country }}">
                                            <div id="name_text" class="text-danger backend-error-text"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="" for="name">Post Code <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Category name.." value="{{ $shipping_detail->post_code }}">
                                            <div id="name_text" class="text-danger backend-error-text"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="" for="name">Phone Number <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Category name.." value="{{ $shipping_detail->phone_number }}">
                                            <div id="name_text" class="text-danger backend-error-text"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="" for="name">Email <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Category name.." value="{{ $shipping_detail->email }}">
                                            <div id="name_text" class="text-danger backend-error-text"></div>
                                        </div>
                                    </div>
                                </div>
                               
                              
                             
                            </div>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- /# column -->
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
                                        <span
                                            class="badge badge-{{ $orderlist->order_status == 'padding' ? 'success' : 'warning' }}">
                                            {{ $orderlist->order_status == 'padding' ? 'active' : 'not-active' }}</span>
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
                    <div class="row">
                            <div class="col-md-10" >
                                <label for="">Order Status</label><br>
                                <select class="form-select" name="order_status">
                                    
                                    <option {{ $orderlist->order_status =='pending' ? 'selected':'' }} value="0"></option>
                                    <option value="1">completed</option>
                               
                                  </select>
                            </div>
                            <div class="col-md-2 " style="background-color: #f3f3f3;">  {{ $orderlist->price }} * {{ $orderlist->quantity }}
                            <br><br>
                            <strong>Total : </strong> {{  $total }}
                        </div>
                            
                        </div>
                </div>
            </div>
        </div>
       
       
       
       
    </div>
</div>
  
@endsection

