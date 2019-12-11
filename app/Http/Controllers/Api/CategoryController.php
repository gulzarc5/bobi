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
}
