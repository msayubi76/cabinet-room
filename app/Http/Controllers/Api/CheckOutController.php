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
            $category = Category::where('is_active', '0')->get();
            $subcategory = SubCategory::where('is_active', '0')->get();
            $cart = Cart::where('user_id', Auth::id())->get();
            return view('website.pages.checkout', compact('category', 'subcategory', 'cart'));
        } catch (\Throwable $th) {
            return redirect(route('website.pages.checkout'))->with('error', $th->getMessage());
        }
    }

    public function store(ShippingRequest $request)
    {
        try {
            $order = OrderService::store($request);
            return redirect(route('check-out.index'))->with('success', 'Your Shipping detail added successfully.');


        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
