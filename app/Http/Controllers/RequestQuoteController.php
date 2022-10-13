<?php

namespace App\Http\Controllers;

use App\Models\RequestQuote;
use Illuminate\Http\Request;
use App\Http\Requests\QuoteRequest;
use App\Services\RequestQuoteService;

class RequestQuoteController extends Controller
{
    public function store(QuoteRequest $request)
    {
            $requestQuote = RequestQuoteService::store($request);
            dd($requestQuote);






    }
}
