@extends('layouts.website_theme')
@section('web_title','About')

@section('website_content')
<style>
    
    p{
        color: #000;
        font-size: 16px;
    }
    .detail {
        border: 1px solid;
        padding: 20px;
    }
</style>
<div class="container pb-5 pt-5">
    <div class="row">
        <div class="col-md-12 ">
            <h4 class="text-uppercase">Contact us</h4> 
            <p>Please feel free to contact us at any time if further information is needed. Our tel-phone no is 0081-03-6424-5019</p>
            <hr>
        </div>
        <div class="col-md-12 ">
            <h4 class="text-uppercase">Head Office Japan</h4> 
            <p>{{ $generalSetting->head_office_address }}</p>
            <hr>
        </div>
        <div class="col-md-12 ">
            <h4 class="text-uppercase">Branch Office Pakistan</h4> 
            <p>{{ $generalSetting->branch_address }}</p>
            <hr>
        </div>
        <div class="col-md-12">
            <h4 class="text-uppercase">Contact Detail</h4> 
            <p><b>Mobile No Japan: </b>{{ $generalSetting->mobile_1 }}</p>
            <p><b>Mobile No Pakistan: </b>{{ $generalSetting->mobile_2 }}</p>
            <p><b>Tel: </b>{{ $generalSetting->tel_1 }}</p>
            <p><b>Fax: </b>{{ $generalSetting->fax_1 }}</p>
            <hr>
        </div>
        <div class="col-md-12 ">
            <h4 class="text-uppercase">E-Maiil</h4> 
            <p><b>Email 1: </b>{{ $generalSetting->email_1 }}</p> 
            <p><b>Email 2: </b>{{ $generalSetting->email_2 }}</p>  
            <p><b>Email 3: </b>{{ $generalSetting->email_3 }}</p>
            <hr>
        </div>
        
        {{--  <div class="col-md-12 ">
            <h4 class="text-uppercase">Address</h4> 
            <p>Nagoyashi, Mindori-Ku-Shikayama 2-1-1 Royal Shikayama A503, Japan</p>  
            <hr>
        </div>  --}}
        
    </div>
   
</div>
@include('footer.website_footer') 
@endsection
