@extends('layouts.website_theme')
@section('web_title','About')

@section('website_content')
<style>
    h4{
        text-align: center;
    }
    table td{
        color: #000;
    }
    .detail {
        border: 1px solid;
        padding: 20px;
    }
</style>
<div class="container-fluid pb-5">
    <div class="row">
        <div class="col-md-6 detail text-uppercase">
            <h4>Banking Details</h4>
            <table class="table">
                <tr>
                    <td>Bank Name</td>
                    <td>Mitsubishi UFJ</td>
                </tr>
                <tr>
                    <td>Account Name</td>
                    <td>JDM Trading Co.Ltd</td>
                </tr>
                <tr>
                    <td>Branch Address</td>
                    <td>1-203, Takbata, Nakagawa-Ku, Nagaoya-Shi, AICHI 454-0911, Japan</td>
                </tr>
                <tr>
                    <td>Account No</td>
                    <td>0282462</td>
                </tr>
                <tr>
                    <td>Swift Code</td>
                    <td>BOTKJPJT</td>
                </tr>
            </table>
        </div>

        <div class="col-md-6 detail text-uppercase">
            <h4>Intermediary Banking Details</h4>
            <table class="table">
                <tr>
                    <td>Bank Name</td>
                    <td>Bank of Tokyo Mitsubishi UFJ, LTD</td>
                </tr>
                <tr>
                    <td>Branch Name</td>
                    <td>New York Branch</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>1251 Avenue of the Americas, New York</td>
                </tr>
                <tr>
                    <td>Post Code</td>
                    <td>10020-1104</td>
                </tr>
                <tr>
                    <td>Swift Code</td>
                    <td>BOTKUS33</td>
                </tr>
            </table>
        </div>

    </div>
</div>

@endsection
