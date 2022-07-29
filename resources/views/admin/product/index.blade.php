@extends('layouts.theme')
@section('title', 'Home')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if(session('message'))
                        <div class="alert alert-success"> {{ session('message') }}</div>
                        @endif
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-sm-8 text-left">
                                <h4 class="card-title">Products Table</h4>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-4 text-right">
                              <a href="{{url('admin/products/create')}}" class="btn btn-sm btn-primary">Add
                                    Products</a>

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration" id="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Category </th>
                                        <th>Sub Category</th>
                                        <th>Feature Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>



                                <tbody id="table_id">
                                    @foreach ($product as $list)
                                        <tr id='row_{{$list->id}}'>
                                            <td>{{$list->name}}</td>
                                            <td>{{$list->category->name}}</td>
                                            <td>{{$list->subcategory->name}}</td>
                                            <td><img src="{{asset('uploads/product/'.$list->feature_image)}}" width="50px" height="50px" alt="img">
                                            </td>

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
                                                                    href="{{url('admin/products/update/'.$list->id)}}">Edit</a>
                                                                <a class="dropdown-item" href="javascript:openDeleteDialog()">Delete</a>
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
    @endsection
