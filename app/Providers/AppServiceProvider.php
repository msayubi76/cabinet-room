<?php

namespace App\Providers;

use App\Models\GeneralSetting;
use App\Models\JdmParts;
use App\Models\Product;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $generalSetting  = GeneralSetting::first();
        $countries = Config::get('countries.countries');
        $countries = $countries?$countries:[];
        view()->share('generalSetting', $generalSetting);
        view()->share('countries', $countries);
        

        //share with specific view
        view()->composer('website/right-side-bar', function($view) {
            $cities   = Config::get('countries.countries');
            $cities = $cities?$cities:[];
            $view->with('cities',$cities );
        });

         
        view()->composer('website/left-sidebar', function($view) {
            $parts = JdmParts::where('status', 0)->latest()->take(8)->get();
             $view->with('parts',$parts );
         });
          
        view()->composer('website/products/damage-products', function($view) {
            $damage_products = Product:: where('is_damage',1)->orderBy('id', 'desc')->take(16)->get();
             $view->with('damage_products',$damage_products );
         });
         view()->composer('website/products/search-form', function($view) { 
              
            $make = Product::select('make')
            ->where('cc','<>',null)
            ->distinct()->get();
            $model = Product::select('model')
            ->where('make','<>',null)
            ->distinct()->get();
            $year = Product::select('year')
            ->where('year','<>',null)
            ->distinct()->get();

            $price = Product::select('price')
            ->where('price','<>',null)
            ->distinct()->get();

            $cc = Product::select('cc')
            ->where('cc','<>',null)
            ->distinct()->get();
            
            $mileage = Product::select('mileage')
            ->where('mileage','<>',null)
            ->distinct()->get();
            
            $transmission = Product::select('transmission')
            ->where('transmission','<>',null)
            ->distinct()->get();
            
            $color = Product::select('color')
            ->where('color','<>',null)
            ->distinct()->get();
            
            $fuel = Product::select('hybrid_petrol_diesel')
            ->where('hybrid_petrol_diesel','<>',null)
            ->distinct()->get();

            $view->with('make',$make );
            $view->with('model',$model );
            $view->with('year',$year );
            $view->with('price',$price );
            $view->with('cc',$cc );
            $view->with('transmission',$transmission );
            $view->with('color',$color );
            $view->with('fuel',$fuel );
            $view->with('mileage',$mileage );
          });
    }
}
