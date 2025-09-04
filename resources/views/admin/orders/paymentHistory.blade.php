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
                                <h4 class="card-title">Payment History </h4>
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
                                        {{-- <th>Sr No</th> --}}
                                        <th>payment Date</th>
                                        <th>Amount</th>
                                        <th>Comment</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>

                                <tbody id="table_id">
                                    @foreach ($payment_history as $list)
                                        <tr  id='row_{{ $list->id }}'>
                                            {{-- <td>{{ $loop->count }}</td> --}}
                                            <td> {{ date('d F, Y h:i A', strtotime($list->created_at)) }}</td>

                                            <td>
                                                {{ $list->amount }}
                                           </td>
                                           <td>
                                            {{ $list->comment }}
                                       </td>


                                        </tr>
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

                    <input type="hidden"  id="order_id" name="order_id">
                    <input type="hidden"  id="user_id"  name="user_id">
                    {{-- <input type="hidden" value="PUT" name="_method"> --}}
                    <div class="form-validation">


                       <div class="modal-body row">
                         <div class="col-md-12">
                             <label class="form-label" for="name">Amount<span class="text-danger">*</span>
                             </label>
                             <input type="text" class="form-control" id="amount" name="amount"
                             placeholder="Enter a name.." value="">
                          <div id="amount_text" class="text-danger backend-error-text"></div>
                         </div>



                       </div>
                       <div class="modal-body">
                        <label class="form-label" for="name">Comment
                        </label>
                        <textarea class="form-control col-xs-12" name="comment" id="comment"  rows="7" cols="50" :value="old('comment')"></textarea>
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

@endsection

