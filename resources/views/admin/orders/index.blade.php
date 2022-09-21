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
                                <h4 class="card-title">Customers Orders </h4>
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
                                        <th>Sr No</th>
                                        <th>Order Date</th>
                                        <th>price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table_id">
                                    @foreach ($orders as $order)
                                        <tr class="order_data" id='row_{{ $order->id }}'>
                                            <td>{{ $order->id }}</td>
                                            <td> {{ date('d-m-y', strtotime($order->created_at)) }}</td>
                                            <td>{{ $order->payments->payment }}</td>
                                            <td>
                                                <input type="hidden" class="id"  value={{$order->id}} >
                                                <select class="form-select order_status " name="order_status" style="height: 29px;
                                                border-radius: 5px;
                                                background: content-box;">
                                                    <option >--Select Status--</option>

                                                    <option  {{ $order->order_status =='pending' ? 'selected':'' }} value="pending" class="update-status">Pending</option>
                                                    <option {{ $order->order_status =='accepted' ? 'selected':'' }} value="accepted">Accepted</option>
                                                    <option {{ $order->order_status =='completed' ? 'selected':'' }} value="completed">Completed</option>
                                                    <option {{ $order->order_status =='proccing' ? 'selected':'' }} value="proccing">Proccing</option>
                                                    <option {{ $order->order_status =='rejecting' ? 'selected':'' }} value="rejecting">Rejecting</option>

                                                  </select>

                                                  <a href="" class="btn btn-sm btn-primary update-status" > Update Status</a>
                                                {{-- <span
                                                class="badge badge-{{ $order->order_status == 'padding' ? 'success' : 'warning' }}">
                                                {{ $order->order_status == 'padding' ? 'not-padding' : 'padding' }}</span> --}}
                                            </td>




                                            <td>
                                                <a href="{{ url('admin/view-order/'.$order->id) }}" class="btn btn-sm btn-primary" >View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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

@endsection
@section('scripts')
<script>
    $(document).ready(function () {




$('.update-status').click(function (e) {
    e.preventDefault();

    var id = $(this).closest('.order_data').find('.id').val();
    var order_status = $(this).closest('.order_data').find('.order_status').val();
    console.log(id);
    console.log(order_status);


    data = {
        'id':id,
        'order_status' :order_status,
    }


    $.ajax({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
           },

        method: "POST",
        url: "update-status",
        data: data,

        success: function (data) {
            console.log(data);
            window.location.reload();
            swal({
                   title: "",
                   text: data.message,
                   icon: "success",
               });
        }
    });



});
});
</script>
@endsection
