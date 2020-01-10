<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CategoryController extends Controller
{
    public function CategoryList($main_cat_id,$traditional_type=null)
    {
        if (!empty($traditional_type)) {
            $first_category = DB::table('first_category')
            ->whereNull('deleted_at')
            ->where('category_id',$main_cat_id)
            ->where('status',1)
            ->get();
            foreach ($first_category as $key1 => $value1) {
                $second_category = DB::table('second_category')
                    ->whereNull('deleted_at')
                    ->where('first_category_id',$value1->id)
                    ->where('tribe_category',$traditional_type)
                    ->where('status',1)
                    ->get();
                $value1->second_category = $second_category;
            }
            $response = [
                'status' => true,
                'message' => 'category list',
                'data' => $first_category,
            ];    	
            return response()->json($response, 200);
        }else{
            $first_category = DB::table('first_category')
            ->whereNull('deleted_at')
            ->where('category_id',$main_cat_id)
            ->where('status',1)
            ->get();
            foreach ($first_category as $key1 => $value1) {
                $second_category = DB::table('second_category')
                    ->whereNull('deleted_at')
                    ->where('first_category_id',$value1->id)
                    ->where('status',1)
                    ->get();
                $value1->second_category = $second_category;
            }
            $response = [
                'status' => true,
                'message' => 'category list',
                'data' => $first_category,
            ];    	
            return response()->json($response, 200);
        }
        
    }

    public function appLoadApi()
    {
        $sliders = DB::table('sliders')->get();        
        
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
        $random = DB::table('products')
            ->whereNull('deleted_at')
            ->where('status',1)
            ->where('category',3)              
            ->inRandomOrder()
            ->limit(10)
            ->get(); 
        $promotion1_image = null;
        $promotion2_image = null;
        $promotion1_image = DB::table('app_promotional')->where('id',1)->first();
        $promotion2_image = DB::table('app_promotional')->where('id',2)->first();
        $data = [
            'sliders' => $sliders,
            'women_traditional_products' => $women_traditional_products,
            'men_traditional_products' => $men_traditional_products,
            'special_products' => $special_products,
            'random' => $random,
            'promotion1_image' => $promotion1_image,
            'promotion2_image' => $promotion2_image,
        ];
        $response = [
            'status' => true,
            'message' => 'App Load Api',
            'data' => $data,
        ];    	
        return response()->json($response, 200);

    }
}
