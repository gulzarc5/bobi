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
            $category_list_men = null;
            $category_list_women = null;
            $category_list_menTraditional = null;
            $category_list_womenTraditional = null;
            $f_category_men = DB::table('first_category')
                ->whereNull('deleted_at')
                ->where('category_id',1)
                ->where('status',1)
                ->orderBy('name','DESC')
                ->get();
            
            foreach ($f_category_men as $key => $f_cat) {
                $s_category_men = DB::table('second_category')
                ->where('category_id',$f_cat->category_id)
                ->where('first_category_id',$f_cat->id)
                ->whereNull('deleted_at')
                ->where('status',1)
                ->get();
                $category_list_men[] = [
                    'id' => $f_cat->id,
                    'name' => $f_cat->name,
                    'image' => $f_cat->image,
                    'second_category' => $s_category_men,
                ];
            }

            $f_category_women = DB::table('first_category')
                ->whereNull('deleted_at')
                ->where('category_id',2)
                ->where('status',1)
                ->orderBy('name','DESC')
                ->get();
            
            foreach ($f_category_women as $key => $f_cat) {
                $s_category_women = DB::table('second_category')
                ->where('category_id',$f_cat->category_id)
                ->where('first_category_id',$f_cat->id)
                ->whereNull('deleted_at')
                ->where('status',1)
                ->get();
                $category_list_women[] = [
                    'id' => $f_cat->id,
                    'name' => $f_cat->name,
                    'image' => $f_cat->image,
                    'second_category' => $s_category_women,
                ];
            }


            $f_category_womenTraditional = DB::table('first_category')
                ->whereNull('deleted_at')
                ->where('category_id',3)
                ->where('status',1)
                ->orderBy('name','ASC')
                ->get();
            
            foreach ($f_category_womenTraditional as $key => $f_cat) {
                $s_category_womenTraditional = DB::table('second_category')
                ->where('category_id',$f_cat->category_id)
                ->where('first_category_id',$f_cat->id)
                ->whereNull('deleted_at')
                ->where('status',1)
                ->where('tribe_category',3)
                ->orderBy('name','ASC')
                ->get();
                $category_list_womenTraditional[] = [
                    'id' => $f_cat->id,
                    'name' => $f_cat->name,
                    'image' => $f_cat->image,
                    'second_category' => $s_category_womenTraditional,
                ];
            }

            $f_category_menTraditional = DB::table('first_category')
                ->whereNull('deleted_at')
                ->where('category_id',3)
                ->where('status',1)
                ->orderBy('name','ASC')
                ->get();
            
            foreach ($f_category_menTraditional as $key => $f_cat) {
                $s_category_menTraditional = DB::table('second_category')
                ->where('category_id',$f_cat->category_id)
                ->where('first_category_id',$f_cat->id)
                ->whereNull('deleted_at')
                ->where('status',1)
                ->where('tribe_category',2)
                ->orderBy('name','ASC')
                ->get();
                $category_list_menTraditional[] = [
                    'id' => $f_cat->id,
                    'name' => $f_cat->name,
                    'image' => $f_cat->image,
                    'second_category' => $s_category_menTraditional,
                ];
            }

            $category_list = [
                'category_list_men' => $category_list_men,
                'category_list_women' => $category_list_women,
                'category_list_menTraditional' => $category_list_menTraditional,
                'category_list_womenTraditional' => $category_list_womenTraditional,
            ];
            $view->with('category_list', $category_list);
        });
    }
}
