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
                        <form>
                            <div class="form-group mb-8">
                                <input type="text" class="form-control input-default" placeholder="Input Default" value="{{Auth::user()->name }}">
                            </div><br>
                            <div class="form-group">
                                <h4 class="card-title">User</h4>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" value="">Create User </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" value="">Update User </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" value="">Delete User </label>
                                    </div>
                                    <div class="form-check form-check-inline disabled">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" value="" disabled="disabled">Disabled</label>
                                    </div>
                              </div><br>
                              <div class="form-group">
                                <h4 class="card-title">Permission</h4>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" value="">Create Permission </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" value="">Update Permission </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" value="">Delete Permission </label>
                                    </div>
                                    <div class="form-check form-check-inline disabled">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" value="" disabled="disabled">Disabled</label>
                                    </div>
                              </div><br>
                              <div class="form-group">
                                <h4 class="card-title">Role</h4>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" value="">Create Role </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" value="">Update Role </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" value="">Delete Role </label>
                                    </div>
                                    <div class="form-check form-check-inline disabled">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" value="" disabled="disabled">Disabled</label>
                                    </div>
                              </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
 </div>
</div>



@endsection
