<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; 
use App\Models\backend\BannerModel;
use App\Models\backend\AboutCompany;
use App\Models\backend\HomeCounts;
use App\Models\backend\Footer;
use App\Models\backend\Profile;
use App\Models\backend\Contact;
use App\Models\backend\Gallery;
use App\Models\backend\HomeProduct;
use App\Models\backend\ProductTextile;
use App\Models\backend\Textile;
use App\Models\backend\ProductFood;
use App\Models\backend\Food;
use App\Models\backend\OEM;
use App\Models\backend\ProductOEM;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('frontend.home', function ($view) {
            $view->with('banners', BannerModel::all());
        });
        View::composer('frontend.home', function ($view) {
            $view->with('aboutus', AboutCompany::all());
        });
       
        View::composer('frontend.home', function ($view) {
            $view->with('HomeCounts', HomeCounts::all());
        });

        View::share('footerS', Footer::all());
        
        View::composer('frontend.profile', function ($view) {
            $view->with('profiles', Profile::all());
        });

        View::composer('frontend.contact', function ($view) {
            $view->with('contacts', Contact::all());
        });

        View::share('homepageproducts', HomeProduct::all());

        View::share('gallerys', Gallery::all());

        View::share('ProductTextiles', ProductTextile::all());
        View::share('Textiles', Textile::all());

        View::share('ProductFoods', ProductFood::all());
        View::share('Foods', Food::all());

        View::share('ProductOEMS', ProductOEM::all());
        View::share('OEMS', OEM::all());


        
    }

    
}
