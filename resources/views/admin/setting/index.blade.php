@extends('layouts.theme')
@section('title', 'Home')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('alerts')
                <div class="card">
                    <div class="card-body">
                        @if(session('message'))
                        <div class="alert alert-success"> {{ session('message') }}</div>
                        @endif
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-sm-8 text-left">
                                <h4 class="card-title">Settings</h4>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-4 text-right">
                              <a href="{{url('admin/settings/create')}}" class="btn btn-sm btn-primary">Add Page Setting</a>

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration" id="table">
                                <thead>
                                    <tr>
                                      <th>    About Us
                                     </th>
                                     <th>   Contact Us
                                    </th>
                                    <th>    Privacy And Policy
                                    </th>



                                        <th>Action</th>
                                    </tr>
                                </thead>



                                <tbody id="table_id">
                                    @foreach ($setting as $list)
                                        <tr id='row_{{$list->id}}'>


                                            <td>{{$list->about_us_detail}}</td>
                                            <td>{{$list->contact_us_detail}}</td>
                                            <td>{{$list->privacy_and_policy_detail}}</td>


                                            <td>
                                                <div class="button-group">
                                                    <div class="btn-group">
                                                        <div class="btn-group">
                                                            <button id="btnGroupDrop1" type="button"
                                                                class="btn btn-primary dropdown-toggle py-0 px-2"
                                                                data-toggle="dropdown"></button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    onclick="openViewModal( )">View</a>
                                                                <a class="dropdown-item"
                                                                    href="{{url('admin/settings/'.$list->id.'/edit')}}">Edit</a>
                                                                <a class="dropdown-item" href="javascript:openDeleteDialog({{$list->id}})">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
    <div class="modal fade" id="deleteModal" tabindex="-1"
    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <input type="hidden" value="-1" id="deleteID">

                <h5 class="modal-title" id="exampleModalLongTitle">Delete Product
                </h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this product?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">No</button>
                <button type="button" id="button-delete" class="btn btn-primary"
                    onclick="deleteProduct()">Yes</button>
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

 function deleteProduct() {
    $("#button-delete").text('Loading...');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        url: "/admin/products/" + $("#deleteID").val(), // the endpoint
        type: "DELETE", // http method
        processData: false,
        contentType: false,
        success: function (data) {
            $("#button-delete").prop("disabled", false);
            $("#button-delete").text("Yes");
            $('.alert-success').html(data.success).fadeIn('slow');
            // $('.alert-success').delay(3000).fadeOut('slow');
            document.getElementById("row_" + $("#deleteID").val()).remove();
                 swal({
                    title: "",
                    text: data.message,
                    icon: "success",
                });
                $('#deleteModal').modal('hide');
        },
        error: function (error) {
            $("#button-delete").prop("disabled", false);
            $("#button-delete").text("Yes");
            alert(error);


        },
    });
}
    </script>
    @endsection
