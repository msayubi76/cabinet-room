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
                            <h4 class="card-title">Request Quote</h4>
                        </div>
                        {{-- <div class="col-lg-4 col-md-6 col-sm-4 text-right">
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addcategory">Add
                                    Category</button>
                            </div> --}}
                    </div>

                    <div class="table-responsive" style="min-height: 145px;">
                        <table class="table table-striped table-bordered zero-configuration" id="table">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>

                            <tbody id="table_id">
                                @foreach ($quotes as $list)
                                <tr class="order_data" id='row_{{ $list->id }}'>
                                    <td>{{ $list->id }}</td>
                                    <td> {{ date('d F, Y h:i A', strtotime($list->created_at)) }}</td>
                                    <td>{{ $list->name }}</td>
                                    <td>
                                        @if ($list->status==1)
                                        <span class="badge badge-success">Accepted</span>
                                        @elseif($list->status==2)
                                        <span class="badge badge-danger">Rejected</span>
                                        @else
                                        <span class="badge badge-warning">Pending</span>
                                        @endif
                                    </td>


                                    <td>
                                        <div class="button-group">
                                            <div class="btn-group">
                                                <div class="btn-group">
                                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle py-0 px-2" data-toggle="dropdown"></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:openQuoteModal({{ json_encode($list) }})">View</a>
                                                        @if ($list->status==1)
                                                        <a class="dropdown-item" href="{{route('updateQuoteStatus',[$list->id,2])}}">Reject</a>
                                                        @elseif ($list->status==2)
                                                        <a class="dropdown-item" href="{{route('updateQuoteStatus',[$list->id,1])}}">Accept</a>
                                                        @else
                                                        <a class="dropdown-item" href="{{route('updateQuoteStatus',[$list->id,2])}}">Reject</a>
                                                        <a class="dropdown-item" href="{{route('updateQuoteStatus',[$list->id,1])}}">Accept</a>
                                                        @endif
                                                        <a class="dropdown-item" href="javascript:openrequestModal({{ json_encode($list) }})">Edit</a>

                                                        <!-- <a class="dropdown-item"
                                                             href="javascript:openPaymentModal({{ json_encode($list) }})">Payment</a>


                                                             <a class="dropdown-item"

                                                             href="{{ url('admin/view-order/'.$list->id) }}" class="btn btn-sm btn-primary" >View</a>
                                                             <a class="dropdown-item"

                                                             href="{{ url('admin/order/'.$list->id) }}" class="btn btn-sm btn-primary" >Payment History</a> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                    </div>
                    @endforeach
                    </tbody>


                    </table>
                </div>





                <div class="pagination justify-content-center">

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                <button type="button" id="button-delete" class="btn btn-primary" onclick="deleteCategory()">Yes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="quoteModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Quote Detail</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table-responsive">
                    <tbody>
                        <tr>
                            <td width="100">Name</td>
                            <td><span id="quote_name"></span></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><span id="quote_email"></span></td>
                        </tr>
                        <tr>
                            <td>Mobile no</td>
                            <td> <span id="quote_phone"></span></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td> <span id="quote_address"></span></td>
                        </tr>
                        <tr>
                            <td>discription</td>
                            <td> <span id="quote_description"></span></td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
    <!--Request Quote Modal -->
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style=" width: 550px;
margin: auto;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Request a Quote.</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-valide"  method="post" id="requestEdit"
                        enctype="multipart/form-data" >
            <div class="modal-body">
                <div class="form-title text-center"> </div>
                <div class="d-flex flex-column text-center">
                    
                        @csrf
                        <!-- {{ $errors }} -->
                        <input type="hidden" name="quote_id" id="quote_id">
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="row">
                            <div class="col-md-6 pb-2">
                                <input type="email" name="email" class="form-control"
                                id="email1"placeholder="Your email address...">
                            @error('email')
                                <span class="text-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 pb-2">
                            <input type="name" name="name" class="form-control"
                            id="name"placeholder="Your name address...">
                        @error('name')
                            <span class="text-danger" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6 pb-2">
                                <input type="address" name="address" class="form-control"
                                id="address"placeholder="Your address address...">
                            @error('address')
                                <span class="text-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 pb-2">
                            <input type="phone" name="phone" class="form-control"
                            id="phone"placeholder="Your phone address...">
                        @error('phone')
                            <span class="text-danger" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                        </div>
                        <div class="">
                            <textarea name="discription" id="discription" class="form-control" cols="30" rows="6"></textarea>

                            @error('password')
                                <span class="text-danger " role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>



                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" id="button-update" class="btn btn-info btn-sm btn-round" onclick="editQuote(this)">Edit Quote</button>

            </div>
            </form>

        </div>
    </div>
</div>


@endsection
@section('scripts')
<script>
    function openQuoteModal(quote) {
        console.log('quote', quote.discription);

        document.getElementById('quote_name').innerHTML = quote.name;
        document.getElementById('quote_email').innerHTML = quote.email;
        document.getElementById('quote_phone').innerHTML = quote.phone;
        document.getElementById('quote_address').innerHTML = quote.address;
        document.getElementById('quote_description').innerHTML = quote.discription;

        $("#quoteModal").modal()
    }
    function openrequestModal(quote){
        console.log('quote',quote);
        document.getElementById('quote_id').value = quote.id;
        document.getElementById('user_id').value = quote.user_id;
        document.getElementById('email1').value = quote.email;
        document.getElementById('name').value = quote.name;
        
        document.getElementById('phone').value = quote.phone;
        document.getElementById('address').value = quote.address;
        document.getElementById('discription').innerHTML = quote.discription;
        $("#requestModal").modal()

    }
    function editQuote() {
       var form = $('#requestEdit')[0];
       $("#button-update").text('Loading...');
       const myFormData = new FormData(form);


       $.ajax({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
           },
           url: "/admin/quote" , // the endpoint
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
               $("#button-update").text("Edit Quote");

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
               window.location.reload();

           },
           error: function(error) {
               $(form)
               $("#button-update").prop("disabled", false);
               $("#button-update").text("Edit Quote");
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