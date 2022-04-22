@extends('layouts.theme')
@section('title','Assign Permission')
@section('style')
    <link href="{{url('libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" /> 
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid customer-registrition">
            <!-- start page title -->
            <div class="row">
                <div class="card w-100">
                    <div class="card-body customer-card"> 
                        <form action="{{url('/permission/save-assign-permission')}}" method="post" role="form" id="form"  enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{encrypt($user->id)}}" name="user_id" >
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Assign Role</h5>
                                    <div class="input-group mb-3 assign-role {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="typcn typcn-cog-outline"></i>
                                                    </span>
                                        </div>
                                        <select data-placeholder="Select Role" multiple  id="roles" name ="roles[]" class="form-control select2"  style="width: 100%;">
                                            <option value="">Select</option>
                                            @foreach ($roles as $role)  
                                                <option   
                                                @foreach ($user->roles as $item)
                                                    {{$role->id == $item->id?'selected ':''}}
                                                @endforeach  
                                                value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>  
                                    </div> 
                                </div>
                            </div>
                                <div class="permission-list"> 
                                    
                                    <h5>Assign Direct Permission</h5>
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
                                                 <div class="col-md-1 sub-module"> 
                                                     <div class="form-check-inline my-2">
                                                         <div class="custom-control custom-checkbox">
                                                            <?php 
                                                                $str = $item->name;
                                                                $arr = explode('.', $str);
                                                                $size = count($arr)-1;
                                                            ?>
                                                         <input type="checkbox"  
                                                         @foreach ($user->permissions as $role_per)
                                                            {{$role_per->id == $item->id ?' checked ':''}}
                                                         @endforeach 
                                                         name="permission[]" value="{{$item->id}}" class="custom-control-input {{$value}}" id="{{$item->name}}"  >
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
                                        <button class="btn btn-light mb-0 pull-right"  type="submit">Assign</button>
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
<script src="{{url('libs/select2/js/select2.min.js')}}"></script>
<script>
    $(".select2").select2({
            minimumResultsForSearch: -1,
            placeholder: function(){
                $(this).data('placeholder');
            }
        });
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


