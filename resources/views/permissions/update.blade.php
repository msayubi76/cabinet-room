@extends('layouts.theme')
@section('title',"Role Edit")
@section('content')
    <div class="page-content">
        <div class="container-fluid customer-registrition">
            <!-- start page title -->
            <div class="row">
                <div class="card w-100">
                    <div class="card-body customer-card">
                        <h3>Update Permission</h3>
                        <p>Below is update permission form</p>

                        <form action="{{url('permission/'.encrypt($permission->id))}}" method="POST" role="form" id="form"  enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="row">
                                <div class="col-md-6">
                                    <p for="name">Module name</p>
                                    <div class="input-group mb-3 {{ $errors->has('module_name') ? ' has-error' : '' }}">
                                        <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="typcn typcn-cog-outline"></i>
                                                    </span>
                                        </div>
                                        <input   type="text" class="form-control {{ $errors->has('module_name') ? ' parsley-error' : '' }}" id="module_name"
                                               name="module_name" placeholder="Module Name"  value="{{!empty(old('module_name'))?old('module_name'):$permission->module_name}}"  >
                                        @if ($errors->has('module_name')) <div class="invalid-feedback" style="display: block">  {{ $errors->first('module_name') }} </div>  @endif
                                    </div>
                                    <p for="name">Permission name</p>
                                    <div class="input-group mb-3 {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="typcn typcn-cog-outline"></i>
                                                    </span>
                                        </div>
                                        <input   type="text" class="form-control {{ $errors->has('name') ? ' parsley-error' : '' }}" id="name"
                                                 name="name" placeholder="Role Name"  value="{{$permission->name}}"  >
                                        @if ($errors->has('name')) <div class="invalid-feedback" style="display: block">  {{ $errors->first('name') }} </div>  @endif
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group pull-right">
                                        <p style="opacity:0">Update</p>
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

