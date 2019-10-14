<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use DB;
use Auth;
use Session;

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
            $cart_count =0;
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

            // Shopping Cart Data
            $wish_list_count = 0;
              if( Auth::guard('buyer')->user() && !empty(Auth::guard('buyer')->user()->id)) 
              {
                  $user_id = Auth::guard('buyer')->user()->id;
                  $cart_count = DB::table('cart')->where('user_id',$user_id)->count();
                  $wish_list_count = DB::table('wish_list')->where('user_id',$user_id)->count();
  
              }else{
                  if (Session::has('cart') && !empty(Session::get('cart'))) {
                      $cart_count = count(Session::get('cart'));
                  }else{
                      $cart_count = 0;
                  }
              }

            $category_list = [
                'category_list_men' => $category_list_men,
                'category_list_women' => $category_list_women,
                'category_list_menTraditional' => $category_list_menTraditional,
                'category_list_womenTraditional' => $category_list_womenTraditional,
                'cart_count' => $cart_count,
                'wish_list_count' => $wish_list_count,
            ];

           
            //  echo($cart_data);
            //  die();
            $view->with('category_list', $category_list);
        });

        if (Auth::guard('admin')) {
            View::composer('admin.include.header', function ($view) {
                $new_order_count = DB::table('orders')
                    ->where('admin_view_status',1)
                    ->count();
                $seller_view_count = DB::table('user')
                    ->where('view_status',1)
                    ->where('user_role',2)
                    ->count();
                $buyer_view_count = DB::table('user')
                    ->where('view_status',1)
                    ->where('user_role',1)
                    ->count();
                $total_count = $new_order_count+$buyer_view_count+$seller_view_count ;
                $admin_data = [
                    'new_order_count' => $new_order_count,
                    'seller_view_count' => $seller_view_count,
                    'buyer_view_count' => $buyer_view_count,
                    'total_count' => $total_count,
                ];
    
               
                //  echo($cart_data);
                //  die();
                $view->with('admin_data', $admin_data);
            });
        }

        if (Auth::guard('admin')) {
            View::composer('admin.include.header', function ($view) {
                $new_order_count = DB::table('orders')
                    ->where('admin_view_status',1)
                    ->count();
                $seller_view_count = DB::table('user')
                    ->where('view_status',1)
                    ->where('user_role',2)
                    ->count();
                $buyer_view_count = DB::table('user')
                    ->where('view_status',1)
                    ->where('user_role',1)
                    ->count();
                $total_count = $new_order_count+$buyer_view_count+$seller_view_count ;
                $admin_data = [
                    'new_order_count' => $new_order_count,
                    'seller_view_count' => $seller_view_count,
                    'buyer_view_count' => $buyer_view_count,
                    'total_count' => $total_count,
                ];
    
               
                //  echo($cart_data);
                //  die();
                $view->with('admin_data', $admin_data);
            });
        }if (Auth::guard('seller')) {
            View::composer('seller.include.header', function ($view) {
                $seller_id = Auth::guard('seller')->user()->id;
                $new_order_view_count = DB::table('order_details')
                    ->where('seller_view_status',1)
                    ->where('seller_id',$seller_id )
                    ->count();
                $seller_data = [
                    'new_order_view_count' => $new_order_view_count,
                ];
                $view->with('seller_data', $seller_data);
            });
        }
    }
}
