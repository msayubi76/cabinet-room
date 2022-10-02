@extends('website.master')
@section('title', 'My Account')

@section('content')

    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('products') }}">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            My Account
                        </li>
                    </ol>
                </div>
            </nav>

            <h1>My Account</h1>

        </div>
    </div>

    <div class="container account-container custom-account-container">
        <div class="row">
            <div class="sidebar widget widget-dashboard mb-lg-0 mb-3 col-lg-3 order-0">
                <h2 class="text-uppercase">My Account</h2>
                <ul class="nav nav-tabs list flex-column mb-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab"
                            aria-controls="dashboard" aria-selected="true">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="order-tab" data-toggle="tab" href="#order" role="tab"
                            aria-controls="order" aria-selected="true">Orders</a>
                    </li>






                    <li class="nav-item">
                        <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab"
                            aria-controls="edit" aria-selected="false">Account
                            details</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-9 order-lg-last order-1 tab-content">
                <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                    <div class="dashboard-content">
                        @if (session('message'))
                            <div class="alert alert-success">
                                <h6>{{ session('message') }}</h6>
                            </div>
                        @endif


                        <div class="mb-4"></div>

                        <div class="row row-lg">
                            <div class="col-6 col-md-4">
                                <div class="feature-box text-center pb-4">
                                    <a href="#order" class="link-to-tab"><i class="sicon-social-dropbox"></i></a>
                                    <div class="feature-box-content">
                                        <h3> {{ $orders->count() }} ORDERS</h3>
                                        <h3>  ORDERS Status</h3>
                                        @foreach ($orders as $orderlist)
                                        @if ($orderlist->order_status == 'pending')
                                        <span

                                        class="badge badge-warning text-black">
                                        {{ $orderlist->order_status  }}</span>
                                        @elseif ($orderlist->order_status == 'rejected')
                                        <span

                                        class="badge badge-danger text-black">
                                        {{ $orderlist->order_status  }}</span>

                                        @else
                                        <span

                                        class=" badge badge-success text-black">
                                        {{ $orderlist->order_status  }}</span>

                                        @endif

                                        @endforeach



                                    </div>
                                </div>
                            </div>









                        </div><!-- End .row -->
                    </div>
                </div><!-- End .tab-pane -->

                <div class="tab-pane fade" id="order" role="tabpanel">
                    <div class="order-content">
                        <h3 class="account-sub-title d-none d-md-block"><i
                                class="sicon-social-dropbox align-middle mr-3"></i>Orders</h3>
                        <div class="order-table-container text-center">
                            @if ($orders->count() > 0)
                            <table class="table table-order text-left">
                                <thead>
                                    <tr>
                                        <th class="order-id">Sr No</th>

                                        <th class="order-status">Status</th>


                                        <th class="order-price">Total Price</th>

                                        <th class="order-status">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($orders as $orderlist)
                                    <tr>
                                      <td>
                                        {{ $loop->count }}
                                      </td>


                                        <td >
                                            @if ($orderlist->order_status == 'pending')
                                            <span

                                            class="badge badge-warning text-black">
                                            {{ $orderlist->order_status  }}</span>
                                            @elseif ($orderlist->order_status == 'rejected')
                                            <span

                                            class="badge badge-danger text-black">
                                            {{ $orderlist->order_status  }}</span>

                                            @else
                                            <span

                                            class=" badge badge-success text-black">
                                            {{ $orderlist->order_status  }}</span>

                                            @endif

                                        </td>


                                        <td>
                                            {{ $orderlist->payment->payment }}

                                        </td>

                                        <td>
                                            <a href="{{ url('user-dashboard/order-detail/'.$orderlist->id) }}" ><i class="fas fa-external-link-alt " style="margin-left: 20px;"></i> <h5 class="porto-sicon-title ">Order Detail</h5></a>


                                        </td>

                                    </tr>
                                @endforeach



                                </tbody>
                            </table>
                            @else
                            <h5>No Order Available Yet</h5>
                                @endif
                            <hr class="mt-0 mb-3 pb-2" />

                            <a href="{{ '/products' }}" class="btn btn-dark">Go Shop</a>
                        </div>
                    </div>
                </div><!-- End .tab-pane -->






                <div class="tab-pane fade" id="edit" role="tabpanel">
                    <h3 class="account-sub-title d-none d-md-block mt-0 pt-1 ml-1"><i
                            class="icon-user-2 align-middle mr-3 pr-1"></i>Account Details</h3>
                    <div class="account-content">
                        <form action="{{ route('updateinfo') }}" method="POST" id="adminIninfo">
                            @csrf
                            {{-- <input type="hidden" value="-1" id="user_id"> --}}
                            <input type="hidden" value="PUT" name="_method">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="acc-name">First name <span class="required">*</span></label>
                                        <input type="text" class="form-control" id="edit_name" name="name"
                                            placeholder="Enter a name.." value="{{ Auth::user()->name }}">
                                        <div id="edit_name_text" class="text-danger backend-error-text"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="acc-lastname">Last name <span class="required">*</span></label>
                                        <input type="text" class="form-control" id="edit_last_name" name="last_name"
                                            placeholder="Enter a name.." value="{{ Auth::user()->last_name }}">
                                        <div id="edit_last_name_text" class="text-danger backend-error-text"></div>

                                    </div>
                                </div>
                            </div>





                            <div class="form-footer mt-3 mb-0">
                                <button type="submit" name="submit" class="btn btn-dark mr-0">
                                    Save changes
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="account-content mt-3 mb-0">
                        <form action="{{ route('changePassword') }}" method="POST" id="changepassword">
                            <div class="change-password">
                                <h3 class="text-uppercase mb-2">Password Change</h3>

                                <div class="form-group">
                                    <label for="acc-password">Current Password (leave blank to leave
                                        unchanged)</label>
                                    <input type="password" class="form-control" id="oldpassword" name="oldpassword" />
                                    <div id="edit_oldpassword_text" class="text-danger"></div>
                                </div>

                                <div class="form-group">
                                    <label for="acc-password">New Password (leave blank to leave
                                        unchanged)</label>
                                    <input type="password" class="form-control" id="password" name="password" />
                                    <div id="edit_password_text" class="text-danger"></div>
                                </div>

                                <div class="form-group">
                                    <label for="acc-password">Confirm New Password</label>
                                    <input type="password" class="form-control" id="password"
                                        name="password_confirmation" />
                                    <div id="edit_password_confirmation_text" class="text-danger"></div>
                                </div>
                            </div>

                            <div class="form-footer mt-3 mb-0">
                                <button type="submit" class="btn btn-dark mr-0">
                                    Save changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div><!-- End .tab-pane -->



            </div><!-- End .tab-content -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-5"></div><!-- margin -->


@endsection
@section('scripts')
    <script>
        (function($) {
            "use strict"




        })(jQuery);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(function() {
            /* UPDATE ADMIN PERSONAL INFO */
            $('#adminIninfo').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $('#adminIninfo')
                        $('.backend-error-text').text('')
                            .prop("disabled", true);
                    },
                    success: function(data) {


                        $('#adminIninfo')
                            .find('[type="button"]')
                            .prop("disabled", false);
                        swal({
                            title: "",
                            text: data.message,
                            icon: "success",
                        });
                    },
                    error: function(error) {
                        $('#adminIninfo')
                            .find('[type="button"]')
                            .prop("disabled", false);
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
                        // toastr.error(errorMessage, "Error");
                        // hideLoader();
                    },
                });
            });
        });

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

        $('#changepassword').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $('#changepassword')
                        .find('[type="button"]')
                        .prop("disabled", true);
                },
                success: function(data) {

                    $('#changepassword')
                        .find('[type="button"]')
                        .prop("disabled", false);
                    swal({
                        title: "",
                        text: data.msg,
                        icon: "success",
                    });
                },
                error: function(error) {
                    $('#adminIninfo')
                        .find('[type="button"]')
                        .prop("disabled", false);
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
                    // toastr.error(errorMessage, "Error");
                    // hideLoader();
                },
            });
        });
    </script>
@endsection
