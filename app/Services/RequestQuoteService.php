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
    public static function updateQuoteStatus($id,$status){
        DB::beginTransaction();
        $requestQuote = RequestQuote::findorFail($id);
        $requestQuote->update(['status' => $status,]);
        DB::commit();
        $response = ['status' => true, 'message' => 'Request Quote Status updated successfully.',];

        return $response;
    }

    public static function update($request){
        DB::beginTransaction();
        $id = $request->quote_id;
        $requestQuote = RequestQuote::findorFail($id);
        $data = $request->validated();
        $requestQuote->update($data);
        DB::commit();
        $response = ['status' => true, 'message' => 'Quote updated successfully.'];
        return $response;
    }



}
