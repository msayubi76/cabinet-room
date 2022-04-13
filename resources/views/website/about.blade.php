@extends('layouts.website_theme')
@section('web_title','About')

@section('website_content')
<style>
    h4{
        text-align: center;
    }
    p{
        color: #000;
    }
    hr {
        background: #dc4768;
    }
</style>
 
<div class="container-fluid pb-5">
    <div class="row">
        <div class="col-md-12 text-center text-uppercase">
            <h4  >Welcome to the JDM Trading</h4>
        </div>
        <div class="col-md-12">
            <p>
               {{$generalSetting->welcome_message}}
            </p>
        </div> 
        <div class="col-md-12">
            <hr>
        </div>

    </div>

    <div class="row mt-4 ">
        <div class="col-md-3 col-lg-6 text-uppercase mt-3  ">
            <div class="top-message text-uppercase">
                <h5 class="text-center">ceo sales head</h5>
                <div class="text-center">
                    <img width="180px" height="180px" src="{{url('site_images/users/'.$generalSetting->ceo_image)}}" class="rounded  " alt="CEO">
                    <h6 class="m-3">{{$generalSetting->ceo_name}}</h6>
                    <hr class="w-25">
                </div>  
            </div>
        </div>
        <div class="col-md-4 col-lg-6 text-uppercase mt-3">
            <div>
                <h5 class="text-center">director founder</h5>
                <div class="text-center">
                    <img width="180px" height="180px" src="{{url('site_images/users/'.$generalSetting->df_image)}}" class="rounded  " alt="Director">
                    <h6 class="m-3">{{$generalSetting->df_name}}</h6>
                    <hr class="w-25">
                </div> 
                
            </div>
        </div>
        <div class="col-md-3 col-lg-6 text-uppercase mt-3">
            <div>
                <h5 class="text-center">president </h5>
                <div class="text-center">
                    <img width="180px" height="180px" src="{{url('site_images/users/'.$generalSetting->coordinator_image)}}" class="rounded  " alt="Coordinator">
                    <h6 class="m-3">{{$generalSetting->coordinator_name}}</h6>
                    <hr class="w-25">
                </div> 
                
            </div>
        </div>

        <div class="col-md-3 col-lg-6 text-uppercase mt-3">
            <div>
                <h5 class="text-center">Caribbean sales head</h5>
                <div class="text-center">
                    <img width="180px" height="180px" src="{{url('site_images/users/'.$generalSetting->hirose_president_image)}}" class="rounded  " alt="Hirose_president">
                    <h6 class="m-3">{{$generalSetting->hirose_president_name}}</h6>
                    <hr class="w-25">
                </div> 
                
            </div>
        </div>
    </div>

</div>

@endsection
