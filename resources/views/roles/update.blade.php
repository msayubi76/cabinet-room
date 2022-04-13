@extends('layouts.theme')
@section('title',"Role Edit")
@section('content')
    <div class="page-content">
        <div class="container-fluid customer-registrition">
            <!-- start page title -->
            <div class="row">
                <div class="card w-100">
                    <div class="card-body customer-card">
                        <h3>Update Role</h3>
                        <p>Below is update role form</p>
                        <form action="{{url('role/'.encrypt($role->id))}}" method="POST" role="form" id="form"  enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="row">
                                <div class="col-md-6">
                                    <p for="name">Role name</p>
                                     
                                    <div class="input-group mb-3 {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="typcn typcn-cog-outline"></i>
                                                    </span>
                                        </div>
                                        <input   type="text" class="form-control {{ $errors->has('name') ? ' parsley-error' : '' }}" id="name"
                                                 name="name" placeholder="Role Name"  value="{{$role->name}}"  >
                                        @if ($errors->has('name')) <div class="invalid-feedback" style="display: block">  {{ $errors->first('name') }} </div>  @endif
                                    </div> 
                                </div>
                            </div>
                            <div class="permission-list">
                                 
                                @foreach ($permissions as $value=>$permission)
                                <div class="complete-permission"> 
                                    <div>
                                        <label  class="text-capitalize"  ><strong>{{$value}}</strong></label> 
                                    </div>
                                    <div class="form-check-inline my-2">
                                        <div class="custom-control custom-checkbox"> 
                                            <input type="checkbox" class="custom-control-input "  onclick="checkAllPermission(this)" name="{{$value}}" id="{{$value}}">
                                            <label class="custom-control-label" for="{{$value}}">Select all</label> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        @foreach ($permission as $item) 
                                        <?php 
                                                       $str = $item->name;
                                                       $arr = explode('.', $str);
                                                       $size = count($arr)-1;
                                                   ?>
                                        <div class="col-md-2 sub-module {{$arr[$size]}}"> 
                                            <div class="form-check-inline my-2">
                                                <div class="custom-control custom-checkbox">
                                                   
                                                <input type="checkbox"  
                                                @foreach ($role->permissions as $role_per)
                                                   {{$role_per->id == $item->id ?' checked ':''}}
                                                @endforeach
                                                name="permission[]" value="{{$item->id}}" class="custom-control-input {{$value}}" id="{{$item->name}}"  >
                                                    <label class="custom-control-label " for="{{$item->name}}">{{$arr[$size]}}</label>
                                                </div>
                                            </div> 
                                        </div> 
                                        @endforeach
                                    </div>  
                                </div>
                                @endforeach 
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group pull-right"> 
                                        <button class="btn btn-light mb-0 "  type="submit">Update</button>
                                    </div>
                                </div> 
                            </div> 
                        </form> 
                    </div>
                </div>
            </div> 
            <!-- end page title --> 
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
@section('script')
<script>
    function checkAllPermission(name) {
        var checkbox = $(name).attr('name'); 
        checkboxes = document.getElementsByClassName(checkbox); 
            if(name.checked) { 
                $(checkboxes).each(function() {
                    this.checked = true;                        
                });
            } else {
                $(checkboxes).each(function() {
                    this.checked = false;                       
                });
            } 
    } 
</script>
@endsection

