@extends('layouts.theme')
@section('title', 'Home')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Assign Permission</h4>
                    <p class="text-muted m-b-15 f-s-12">Assign Permission for selected user </p>
                    <div class="basic-form">
                        <form method="POST" action="{{route('roles.store')}}">
                            @csrf
                            <input type="hidden" name="role_id">
                            <div class="form-group mb-8">
                                <input type="text" class="form-control input-default" placeholder="Input Default" value="{!!$roles->name!!}">
                            </div><br>
                            @foreach ($modules as $module => $permissions)


                            <div class="form-group">
                                <h4 class="card-title">{!! $module !!}</h4>
                                @foreach ($permissions as $key => $permission)

                                    <div class="form-check form-check-inline">

                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="permission[]" value="{{ $permission->id}}">{{$permission->name}} </label>
                                    </div>



                                @endforeach


                              </div><br>
                              @endforeach

                              <div class="modal-footer">
                                <a href="{{url('admin/roles')}}"  class="btn btn-secondary"> Close </a>
                             <a href=""  class="btn btn-primary"> Add Permission </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
 </div>
</div>



@endsection
