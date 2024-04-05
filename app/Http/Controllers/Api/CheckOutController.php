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

            $cart = Cart::where('user_id', Auth::id())->with(['product', 'variation'])->get();
            $cities = config('constant.cities');
            return view('website.pages.checkout', compact('categories',  'cart', 'cities'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function store(ShippingRequest $request)
    {
 
        try {
            $order = OrderService::store($request);
            return redirect(route('user-dashboard'))->with('message', 'Order placed successfully.');
        } catch (\Throwable $th) {
            dd($$th);
            return back()->with('error', $th->getMessage());
        }
    }
}
