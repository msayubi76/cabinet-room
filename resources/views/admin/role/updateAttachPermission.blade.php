@extends('layouts.theme')
@section('title', 'Home')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Permission</h4>
                        <p class="text-muted m-b-15 f-s-12">Update Permission for selected Role </p>
                        <div class="basic-form">
                            <form method="POST" action="{{ route('update-attach-permissions') }}">
                                @csrf

                                <input type="hidden" name="id">
                                <input type="hidden" name="role_id" value="{{$role->id}}">
                                <div class="form-group mb-8">
                                    <input type="text" class="form-control input-default" placeholder="Input Default"
                                        value="{{ $role->name }}">
                                </div><br>
                                @foreach ($modules as $module => $permissions)
                                    <div class="form-group">
                                        <h4 class="card-title">{{ $module }}</h4>
                                        @foreach ($permissions as $key => $permission)
                                            <div class="form-check form-check-inline">

                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="permissions[]"
                                                    value="{{$permission->id}}"  @if(count($role->permissions->where('id',$permission->id)))
                                                    checked
                                                  @endif
                                                ><span class="ml-2 text-gray-700">{{ $permission->name }}</span>
                                             </label>
                                            </div>
                                        @endforeach


                                    </div><br>
                                @endforeach

                                <div class="modal-footer">
                                    <a href="{{ url('admin/roles') }}" class="btn btn-secondary"> Close </a>
                                    <button type="submit" class="btn btn-primary"> Update Permission </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
