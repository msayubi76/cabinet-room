<?php

namespace App\Services;


use App\Models\RequestQuote;

use Illuminate\Support\Facades\DB;

use App\Http\Requests\QuoteRequest;
use Illuminate\Support\Facades\Hash;


class RequestQuoteService
{


    public  static function store(QuoteRequest $request)
    {

        DB::beginTransaction();
        $data = $request->validated();


        $requestQuote = RequestQuote::create($data);
       
        DB::commit();
        $response = ['status' => true, 'message' => 'Request Quote added successfully.',];

        return $response;
    }





}
