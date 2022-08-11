<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    public function index()
    {
        $category = Category::where('is_active', '0')->get();
            $subcategory = SubCategory::where('is_active', '0')->get();
        return view('website.product.checkOut');
    }
}
