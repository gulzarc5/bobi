<?php

namespace App\Http\Controllers\Web\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ProductController extends Controller
{
    public function productList($second_category)
    {
        try {
            $second_category = decrypt($second_category);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        
        $category_name = DB::table('second_category')
            ->select('category.name as category_name','second_category.name as second_cat_name','second_category.first_category_id as first_category_id')
            ->where('second_category.id',$second_category)
            ->join('category','category.id','=','second_category.category_id')
            ->first();
        $sub_category = DB::table('second_category')
            ->where('first_category_id',$category_name->first_category_id)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->get();
        
        $products = DB::table('products')
            ->where('second_category',$second_category)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->get();
        $product_list = [];
        foreach ($products as $key => $value) {
           $sizes = DB::table('product_sizes')
                ->where('product_id',$value->id)
                ->whereNull('deleted_at')
                ->get()           
                ->min('price');
            $product_list[] =[
                'id' => $value->id,
                'name' => $value->name,
                'price' => $sizes,
                'image' => $value->main_image,
            ];
        }

        $colors = DB::table('color')
            ->where('first_category_id',$category_name->first_category_id)
            ->where('status',1)
            ->whereNull('deleted_at')
            ->get();
        
        $sizes = DB::table('sizes')
            ->where('first_category',$category_name->first_category_id)
            ->where('status',1)
            ->whereNull('deleted_at')
            ->get();
        $price_range = DB::table('products')
            ->select(DB::raw('min(product_sizes.price) as min_price'),DB::raw('max(product_sizes.price) as max_price'))
            ->join('product_sizes','product_sizes.product_id','=','products.id')
            ->where('products.second_category',$second_category)
            ->whereNull('products.deleted_at')
            ->where('products.status',1)
            ->first();
            
        $data = [
            'category_name' => $category_name,
            'product_list' => $product_list,
            'sub_category' => $sub_category,
            'colors' => $colors,
            'sizes'=> $sizes,
            'price_range' => $price_range,
        ];
    	return view('web.product_list',compact('data'));
    }

    public function productDetail($product_id)
    {
        try {
            $product_id = decrypt($product_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $product = DB::table('products')
            ->where('id',$product_id)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->first();
        $sizes = DB::table('product_sizes')
            ->where('product_id',$product_id)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->get();
        $colors = DB::table('product_colors')
            ->where('product_id',$product_id)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->get();
        $images = DB::table('product_image')
            ->where('product_id',$product_id)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->get();
        $data = [
            'product' =>$product,
            'colors' => $colors,
            'sizes' => $sizes,
            'images' => $images,
        ];

        return view('web.product_detail',compact('data'));
    }
}
