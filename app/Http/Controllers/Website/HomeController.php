<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\JdmParts;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $countries;
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['show', 'partDetail']]);
    }

    public function index()
    {
        $items = Product::where('is_damage', 0)->orderBy('id', 'desc')
            ->take(16)->get();
        $old_products = $this->getOldProducts();
        $page = "home";

        $heading = "Latest Products";

        return view('website/index', compact('items', 'old_products', 'page',  'heading'));
    }
    public function getOldProducts()
    {
        $old_date = Carbon::now()->subDays(365)->toDateTimeString();

        return   Product::where('status', 0)->where('created_at', '<=', $old_date)
            ->orderBy('id', 'desc')->get();
    }

    public function getDamageProducts()
    {
        $type = "Damage Products";
        $title = "Products"; 
        $items = Product::orderBy('id', 'desc')->where('is_damage', 1)->paginate(10); 
        $page = "damage_products";
        $is_damage = 1; 
        return view('website/products', compact('type', 'title', 'items', 'page', 'is_damage'));
    }

    public function getAllProducts()
    {
        $type = "All Products";
        $title = "Products";
        $items = Product::orderBy('id', 'desc')->where('is_damage', 0)->paginate(10);

        $page = "products";
        $is_damage = 0;

        return view('website/products', compact('type', 'title', 'items', 'page', 'is_damage'));
    }
    public function show($id)
    {
        $product = Product::find(decrypt($id));

        return view('website/show', compact('product'));
    }
    public function searchProducts(Request $request)
    {
        try {
            $type = "Search Results";
            $title = "Products";
            $is_damage = $request->is_damage;


            $items =  Product::orderBy('id', 'desc')->where('is_damage', $is_damage);
            if ($request->make != null) {
                $items->OrWhere('make', 'LIKE', "%{$request->make}%");
            }
            if ($request->model != null) {
                $items->OrWhere('model', 'LIKE', "%{$request->model}%");
            }
            if ($request->min_year != null && $request->max_year != null) {
                $items->orwherebetween('year', [$request->min_year, $request->max_year]);
            }
            if ($request->max_price != null && $request->min_price != null) {
                $items->orwherebetween('price', [$request->max_price, $request->min_price]);
            }
            if ($request->min_cc != null && $request->max_cc != null) {
                $items->orwherebetween('cc', [$request->min_cc, $request->max_cc]);
            }
            if ($request->mileage_from != null && $request->mileage_to != null) {
                $items->orwherebetween('mileage', [$request->mileage_from, $request->mileage_to]);
            }

            if ($request->transmission != null) {
                $items->OrWhere('transmission', 'LIKE', "%{$request->transmission}%");
            }
            if ($request->color != null) {
                $items->OrWhere('color', 'LIKE', "%{$request->color}%");
            }
            if ($request->hybrid_petrol_diesel != null) {
                $items->OrWhere('hybrid_petrol_diesel', 'LIKE', "%{$request->hybrid_petrol_diesel}%");
            }
            $items = $items->paginate(1000000000000000);


            $page = "products";

            return view('website/products', compact(
                'type',
                'title',
                'items',
                'page',
                'is_damage'
            ));
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function about()
    {
        $page = "about";
        return view('website/about', compact('page'));
    }
    public function bankDetail()
    {
        $page = "bank";
        return view('website/bank-detail', compact('page'));
    }
    public function contact()
    {
        $page = "contact";
        return view('website/contact-us', compact('page'));
    }

    public function parts()
    {
        $page = "parts";
        $parts = JdmParts::orderBy('id', 'desc')
            ->paginate(50);
        $items = Product::where('status', 0)->orderBy('id', 'desc')->take(8)->get();

        return view('website/parts/parts', compact('page',  'parts', 'items'));
    }
    public function productparts()
    {
        $page = "productpart";
        $items = Product::latest()->first()
            ->paginate(8);
        dd($items);
        return view('website/parts/productpart', compact('page', 'items'));
    }
    public function partstop()
    {
        $page = "left-sidebar";
        $parts = JdmParts::latest()->first()
            ->paginate(8);

        // dd($partstop1);
        return view('website/left-sidebar', compact('page',  'parts'));
    }
    public function partDetail($id)
    {
        $page = "parts";
        $id = decrypt($id);
        $part = JdmParts::find($id);
        $files = $part->getMedia($id, 'jdm_parts');
      
        $part_category = $part->getCategory;

        return view('website/parts/show', compact('page',  'part', 'files', 'part_product', 'part_category'));
    }

    public function searchByCountry($country)
    {
        try {
            $items = Product::where('country', 'LIKE', "%{$country}%")
                ->orderBy('id', 'desc')
                ->paginate(50);
            $old_products = $this->getOldProducts();
            $page = "stock-list";

            $heading = "Search Results " . count($items);

            return view('website/index', compact('items', 'old_products', 'page',  'heading'));
        } catch (\Throwable $th) {
            return response()->json(["status" => false, "message" => $th->getMessage()]);
        }
    }
}
