<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\BillingDetails;
use App\Services\OrderService;
use App\Models\ShippingDetails;
use App\Services\BillingService;
use App\Services\PaymentService;
use App\Http\Controllers\Controller;
use App\Services\OrderDetailService;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\ShippingRequest;

class CheckOutController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::where('is_active', '1')->with('subcategories')->limit(12)->get();

            $cart = Cart::where('user_id', Auth::id())->get();
            return view('website.pages.checkout', compact('categories',  'cart'));
        } catch (\Throwable $th) {
            return redirect(route('website.pages.checkout'))->with('error', $th->getMessage());
        }
    }

    public function store(ShippingRequest $request)
    {
        try {
            $order = OrderService::store($request);
            return redirect(route('user-dashboard'))->with('message', 'Your Shipping detail added successfully.');


        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
