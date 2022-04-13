@extends('layouts.theme')
@section('title','Create Role')
@section('content')
    <div class="page-content">
        <div class="container-fluid customer-registrition">
            <!-- start page title -->
            <div class="row">
                <div class="card w-100">
                    <div class="card-body customer-card">
                        <h3>Create Permission</h3>
                        <p>Below is create permission form</p>

                        <form action="{{url('permission')}}" method="POST" role="form" id="form"  enctype="multipart/form-data">
                            @csrf
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
                                               name="module_name" placeholder="Module Name"  value="{{old('module_name')}}"  >
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
                                               name="name" placeholder="Name"  value="{{old('name')}}"  >
                                        @if ($errors->has('name')) <div class="invalid-feedback" style="display: block">  {{ $errors->first('name') }} </div>  @endif
                                    </div>
 
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <p style="opacity:0">Create</p>
                                        <button class="btn btn-light mb-0 pull-right"  type="submit">Create Permission</button>
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




