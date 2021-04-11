<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Country;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
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
        if(env('APP_DEBUG')) {
            DB::listen(function($query) {
                File::append(
                    storage_path('/logs/query.log'),
                    $query->sql . ' [' . implode(', ', $query->bindings) . ']' . PHP_EOL
                );
            });
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Paginator::useBootstrap();
        $navCountries = Cache::remember('navCountries' , 60*60 , function () {
            return Country::select(['id' , 'name' , 'slug'])->take(5)->get();
        });
        $navCategories = Cache::remember('navCategories', 60*60 , function (){
            return Category::OnLyName()->get()->take(10);
        }) ;

       View::composer('client.layout.nav' , function ($view) use ($navCategories, $navCountries) {
          $view->with([
                'navCountries' => $navCountries,
                'navCategories' =>$navCategories
          ]) ;
       });



    }
}
