<?php

namespace App\Http\Controllers\websit;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
   public function index(){
    $category = Category::where('is_active','0')->get();
    return view('website.index',compact('category'));
   }
}
