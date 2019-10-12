<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AdminDeshboardController extends Controller
{
    public function index(){
        $users_count = DB::table('user')
            ->whereNull('deleted_at')
            ->count();
        $seller_count = DB::table('user')
            ->whereNull('deleted_at')
            ->where('user_role',2)
            ->count();
        $second_cat_count = DB::table('second_category')
            ->whereNull('deleted_at')
            ->count();
        $product_count = DB::table('products')
            ->whereNull('deleted_at')
            ->count();
        $orders_count = DB::table('orders')
            ->count();
        $pending_orders_count = DB::table('orders')
            ->where('status',1)
            ->count();
        $last_ten_orders = DB::table('orders')
            ->select('orders.*','user.name as u_name')
            ->leftjoin('user','user.id','=','orders.user_id')
            ->orderBy('orders.id','desc')
            ->limit(10)
            ->get();        
        $last_ten_sellers = DB::table('user')
            ->where('user_role',2)
            ->orderBy('id','desc')
            ->limit(10)
            ->get();

        $deshboard_data = [
            'users_count' => $users_count,
            'seller_count' => $seller_count,
            'product_count' => $product_count,
            'second_cat_count' => $second_cat_count,
            'orders_count' => $orders_count,
            'pending_orders_count' => $pending_orders_count,
            'last_ten_orders' => $last_ten_orders,
            'last_ten_sellers' => $last_ten_sellers,
        ];
    	return view('admin.admindeshboard',compact('deshboard_data'));
    }
}
