@extends('layouts.theme')
@section('title','Create Role')
@section('content')
    <div class="page-content">
        <div class="container-fluid customer-registrition">
            <!-- start page title -->
            <div class="row">
                <div class="card w-100">
                    <div class="card-body customer-card">
                        <h3>Create Role</h3>
                        <p>Below is create role form</p>

                        <form action="{{url('role')}}" method="POST" role="form" id="form"  enctype="multipart/form-data">
                            @csrf
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
                                               name="name" placeholder="Role Name"  value="{{old('name')}}"  >
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
                                                <label class="custom-control-label text-capitalize" for="{{$value}}">Select all</label> 
                                            </div>
                                        </div>
                                        <div class="row"> 
                                            @foreach ($permission as $item)  
                                                 <div class="col-md-2 sub-module"> 
                                                     <div class="form-check-inline my-2">
                                                         <div class="custom-control custom-checkbox">
                                                            <?php 
                                                                $str = $item->name;
                                                                $arr = explode('.', $str);
                                                                $size = count($arr)-1;
                                                            ?>
                                                         <input type="checkbox"    name="permission[]" value="{{$item->id}}" class="custom-control-input {{$value}}" id="{{$item->name}}"  >
                                                             <label class="custom-control-label" for="{{$item->name}}">{{$arr[$size]}}</label>
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
                                    <div class="form-group"> 
                                        <button class="btn btn-light mb-0 pull-right"  type="submit">Save</button>
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


