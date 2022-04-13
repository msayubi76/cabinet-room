@extends('layouts.theme')
@section('title','User')
@section('style')
    <!-- DataTables -->
    <link href="{{url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{url('libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid customer-search">
            <!-- start page title -->
            <div class="card  w-100">
                <div class="card-body">
                    @include('alertsInfo')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row d-flex">
                                        <div class="col-lg-6  ">

                                            <h5 class="card-title">Users Lists</h5>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="float-right d-print-none">
                                                @can('user.create')
                                                    <a class="btn btn-primary" href="{{url('user/create')}}">
                                                        Create User</a>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered w-100 user_table">
                                            <thead>
                                            <tr>
                                                <th>Sr. #</th>
                                                <th>Name</th>
                                                <th>User name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Role</th>
                                                <th>Active</th>

                                                @if (Auth::user()->hasAnyPermission(['user.update', 'user.delete', 'user.assign-permission']) || Auth::user()->hasRole('Super Admin') )
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                            </thead>
                                            <?php $count=1;?>
                                            @foreach ($users as $value)
                                                @if(!$value->hasRole('Super Admin'))
                                                    <tr class="gradeX">
                                                        <td>
                                                            {{$count++}}
                                                        </td>
                                                        <td class="text-capitalize"> {{$value->name}}</td>
                                                        <td> {{$value->username}}</td>
                                                        <td><a href="mailto:{{$value->email}}">{{$value->email}}</a></td>
                                                        <td><a href="tel:{{$value->phone}}">{{$value->phone}}</a> </td>
                                                        <td> {{$value->address}}</td>
                                                        <td>
                                                            @foreach ($value->roles as $role)
                                                                <span class="badge badge-boxed  badge-success">  {{ $role->name}} </span>
                                                            @endforeach
                                                        </td>
                                                        
                                                        <td> 
                                                            <input type="checkbox" id="{{$count.'status'}}" class="status" data-id="{{encrypt($value->id)}}" switch="success"  {{$value->is_active? 'checked':''}} />
                                                            <label for="{{$count.'status'}}"  data-on-label="Yes" data-off-label="No"></label>
                                                        </td>

                                                        @if (Auth::user()->hasAnyPermission(['user.update', 'user.delete', 'user.assign-permission', 'user.update password']) || Auth::user()->hasRole('Super Admin'))
                                                            <td>
                                                                <div class="btn-group ">
                                                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="mdi mdi-chevron-down"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu view-dropdown-menu ">
                                                                        @can('user.update password')
                                                                            <a class="dropdown-item update-passsword" href="javascript:;" data-id="{{encrypt($value->id)}}" > <span class="fas fa-lock " > </span> Update password</a>
                                                                        @endcan
                                                                        @can('user.update')
                                                                            <a class="dropdown-item" href="{{url('user/'.encrypt($value->id).'/edit')}}"> <span class="mdi mdi-square-edit-outline edit-icon" > </span> Edit</a>
                                                                        @endcan
                                                                        @can('user.delete')
                                                                            <a  data-toggle="modal" href="#delete_model" class="action_imgs delete dropdown-item"  data-id="{{encrypt($value->id)}}">
                                                                                <span class=" mdi mdi-minus-circle minus-icon"></span> Delete</a>
                                                                        @endcan
                                                                        {{--@can('user.assign-permission')--}}
                                                                            {{--<a class="dropdown-item" href="{{url('/permission/assign-permission/'.encrypt($value->id))}}"> <span class=" mdi mdi-view-compact-outline view-icon"></span> Assign Permission </a>--}}
                                                                        {{--@endcan--}}
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endif
                                            @endforeach

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->



                </div>
            </div>
            <div class="row"> 
                <div class="col-md-6 col-xl-6">  
                            <!-- Modal -->
                            <div class="modal fade" id="updatePasswordModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title align-self-center mt-0" id="updatePasswordModal">Update Password</h5> 
                                        </div>
                                        <div class="modal-body">
                                                <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="password" class="control-label">Password</label>
                                                        <input type="password" id="password" class="form-control"  placeholder="Password">
                                                        <p id="err_password" style="display: block" class="invalid-feedback">  </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="change-password" class="control-label">Confirm Password</label>
                                                        <input type="password" id="update-password"  class="form-control"  placeholder="Confirm Password">
                                                        <p id="err_password_confirmation"  style="display: block" class="invalid-feedback">  </p>
                                                    </div>
                                                </div>
                                            </div>
                                             
                                        </div>                                          
                                        <div class="modal-footer">
                                            <button type="button" onclick="updatePssword()" class="btn btn-primary">Update</button>
                                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                </div>
            </div>
            
        </div>
    </div>
@endsection
@section('script')
    <!-- Required datatable js -->
    <script src="{{url('libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{url('libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{url('libs/jszip/jszip.min.js')}}"></script>
    <script src="{{url('libs/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{url('libs/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{url('libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{url('libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{url('libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{url('libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

    <!-- Datatable init js -->
    <script src="{{url('js/pages/datatables.init.js')}}"></script>

    <script src="{{url('libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <script>

 
        $('.update-passsword').click(function () {
            $("#password").val("");
            $("#update-password").val("");
            $("#err_password").text(""); 
            $("#err_password_confirmation").text("");
            
            uid = $(this).data('id');
            $("#updatePasswordModal").modal('toggle');
           
        });
       

        function updatePssword(){
           var userid = uid;
           var password = $("#password").val();
           var confirm = $("#update-password").val();

           if(password == '' || confirm == ""){
            Swal.fire("Aleret!","Both field are required", "error");
               return;
           }
           if(password != confirm){
            Swal.fire("Aleret!","Password not match", "error");
            return;
           }
           $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:'POST',
                url: '{{url('user/updatePssword')}}',
                data: {id:userid,password:password,password_confirmation:confirm},
                success:function(response){
                    if( response.status ){
                         Swal.fire("Success", response.success, "success");
                         $("#password").val("");
                         $("#update-password").val("");
                         $("#err_password").text(""); 
                         $("#err_password_confirmation").text("");

                         $('#updatePasswordModal').modal('toggle'); 
                         
                     }else{
                        Swal.fire("Cancelled", "Something Wrong", "error");
                     }
                },
                error:function(response){
     
                    $.each(response.responseJSON.errors, function (key, value) {
                        console.log(key);
                        $("#err_"+key).text(value);
                    });
                  
                }
            })
        }
        $('.delete').click(function () {
            var uid = $(this).data('id');
            var tr = $(this).closest('tr');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value)
            {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: 'post',
                    data: {'_method': 'DELETE'},
                    url: '{{url('user/')}}/' + uid,
                }).done(function (responce) {
                    console.log(responce);
                    if(responce.status){ 
                        Swal.fire("Deleted!",responce.success, "success");
                        var table = $('#datatable-buttons').DataTable();
                        table.row(tr).remove().draw();
                    }else{
                        swal.fire("Cancelled",responce.error, "error");
                    }
                }).fail(function (responce) {
                    swal.fire("Cancelled",responce.error, "error");
                });
            }
        })
        });

        $(".status").on('click', function(e){
            var id = $(this).data('id');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:'POST',
                url: '{{url('user/updateStatus')}}/' + id,
                success:function(response){
                    Swal.fire("Message", response.msg, "success");
                },
                error:function(response){
                    
                    Swal.fire("Cancelled", response.responseJSON.message, "error");
                }
            })
        })

    </script>
@endsection

