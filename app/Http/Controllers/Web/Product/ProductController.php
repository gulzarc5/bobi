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
        // dd($second_category);
        $page = 1;
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

        // dd($product_list);
        $data = [
            'product_list' => $product_list,
        ];
    	return view('web.product_list',compact('data'));
    }
}
