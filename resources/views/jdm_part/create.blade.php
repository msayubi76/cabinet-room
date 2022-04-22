@extends('layouts.theme')
@section('title','General Setting')
@section('style') 
<link href="{{url('libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid  ">
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title">Create Part</h5>
                       @include('alertsInfo')
                      
                        <div class="row">
                            <div class="col-md-8 mx-auto"> 
                                <form class="custom-validation" action="{{url('jdm_part') }}" enctype="multipart/form-data" method="post">
                                    @csrf 
                                    @include('jdm_part/fields')
                                    <div class="text-center mt-3">
                                        <input type="submit" value="Save" class="btn btn-primary">
                                    </div> 
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->


        </div> <!-- end row -->
    </div>
</div>
@endsection
@section('script')
<script src="{{url('libs/select2/js/select2.min.js')}}"></script>
<script>
    $(".select2").select2();
</script>
@endsection
 
