<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PagesController extends Controller
{
    public function index()
    {
        $s_category_womenTraditional = DB::table('second_category')
            ->whereNull('deleted_at')
            ->where('status',1)
            ->where('tribe_category',3)
            ->get();

        $s_category_menTraditional = DB::table('second_category')
            ->whereNull('deleted_at')
            ->where('status',1)
            ->where('tribe_category',2)
            ->get();
        // dd($s_category_menTraditional);

        $men_traditional_products = DB::table('products')
            ->whereNull('deleted_at')
            ->where('status',1)
            ->where(function($q) use ($s_category_menTraditional) {
                if ($s_category_menTraditional) {
                    $men_tra_count = 1;
                    foreach ($s_category_menTraditional as $key => $value) {
                        if ($men_tra_count == 1) {
                            $q->where('second_category',$value->id);
                            $men_tra_count = 2;
                        } else {
                            $q->orWhere('second_category',$value->id);
                        }
                    }
                }
            })
            ->orderBy('id','desc')
            ->limit(10)
            ->get();
        
        $women_traditional_products = DB::table('products')
            ->whereNull('deleted_at')
            ->where('status',1)
            ->where(function($q) use ($s_category_womenTraditional) {
                if ($s_category_womenTraditional) {
                    $men_tra_count = 1;
                    foreach ($s_category_womenTraditional as $key => $value) {
                        if ($men_tra_count == 1) {
                            $q->where('second_category',$value->id);
                            $men_tra_count = 2;
                        } else {
                            $q->orWhere('second_category',$value->id);
                        }
                    }
                }
            })
            ->orderBy('id','desc')
            ->limit(10)
            ->get();
        
        $wood_craft_category = DB::table('second_category')
            ->whereNull('deleted_at')
            ->where('status',1)
            ->where('first_category_id',36)
            ->get();

        $special_products = DB::table('products')
            ->whereNull('deleted_at')
            ->where('status',1)
            ->where(function($q) use ($wood_craft_category) {
                if ($wood_craft_category) {
                    $men_tra_count = 1;
                    foreach ($wood_craft_category as $key => $value) {
                        if ($men_tra_count == 1) {
                            $q->where('second_category',$value->id);
                            $men_tra_count = 2;
                        } else {
                            $q->orWhere('second_category',$value->id);
                        }
                    }
                }
            })
            ->orderBy('id','desc')
            ->limit(10)
            ->get();   
        
        $onsale = DB::table('products')
            ->whereNull('deleted_at')
            ->where('status',1)
            ->where('category',3)              
            ->inRandomOrder()
            ->limit(5)
            ->get(); 
        
        $rendom_products = DB::table('products')
            ->whereNull('deleted_at')
            ->where('status',1)            
            ->inRandomOrder()
            ->limit(12)
            ->get(); 
        return view('web.index',compact('men_traditional_products','special_products','women_traditional_products','onsale','rendom_products'));
    }
}
