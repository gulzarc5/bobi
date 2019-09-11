<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use DB;

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
        Schema::defaultStringLength(191);

        View::composer('web.include.header', function ($view) {

            $category = DB::table('category')->whereNull('deleted_at')->where('status',1)->get();

            $category_list = [];
            foreach ($category as $key => $value) {
                $first_category = DB::table('first_category')
                ->where('category_id',$value->id)
                ->whereNull('deleted_at')
                ->where('status',1)
                ->get();

                $category_list[] = [
                    'id' => $value->id,
                    'name' => $value->name,
                    'image' => $value->image,
                    'first_category' => $first_category,
                ];
            }
            $view->with('category_list', $category_list);
        });
    }
}
