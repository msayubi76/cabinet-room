<?php

namespace App\Http\Controllers;

use App\Models\RequestQuote;
use Illuminate\Http\Request;
use App\Http\Requests\QuoteRequest;
use App\Services\RequestQuoteService;

class RequestQuoteController extends Controller
{

    public function index(){
    $quotes = RequestQuote::orderBy('id','DESC')->get();
    return view('admin.quote.quotelist',compact('quotes'));

    }

    public function store(QuoteRequest $request)
    {   
            $requestQuote = RequestQuoteService::store($request);

            return redirect()->back()->with('success', 'Quote requested successfully');
    }
    public function updateStatus($id,$status){
        $requestQuote = RequestQuoteService::updateQuoteStatus($id,$status);
        return redirect()->back()->with('success', 'Quote accepted successfully');
    }
    public function update(QuoteRequest $request)
    {
        try {
        $requestQuote = RequestQuoteService::update($request);
        return $requestQuote;
        } catch (\Throwable $th) {
        return $th;
        }
    }
}
