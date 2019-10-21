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
            ->select('category.name as category_name','second_category.name as second_cat_name','second_category.id as second_cat_id','second_category.first_category_id as first_category_id')
            ->where('second_category.id',$second_category)
            ->join('category','category.id','=','second_category.category_id')
            ->first();
        $sub_category = DB::table('second_category')
            ->where('first_category_id',$category_name->first_category_id)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->get();
        
        $designers = DB::table('brand_name')
            ->where('first_category',$category_name->first_category_id)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->get();
        
        $products = DB::table('products')
            ->where('second_category',$second_category)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->get();
        // $product_list = [];
        // foreach ($products as $key => $value) {
        //    $sizes = DB::table('product_sizes')
        //         ->where('product_id',$value->id)
        //         ->whereNull('deleted_at')
        //         ->get()           
        //         ->min('price');
        //     $product_list[] =[
        //         'id' => $value->id,
        //         'name' => $value->name,
        //         'price' => $sizes,
        //         'image' => $value->main_image,
        //     ];
        // }

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
            'product_list' => $products,
            'sub_category' => $sub_category,
            'colors' => $colors,
            'sizes'=> $sizes,
            'price_range' => $price_range,
            'designers' => $designers,
        ];
    	return view('web.product_list',compact('data'));
    }

    public function productDetail($product_id,$size_id=null)
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
            ->select('product_sizes.*','sizes.name as size_name')
            ->join('sizes','sizes.id','=','product_sizes.size_id')
            ->where('product_sizes.product_id',$product_id)
            ->whereNull('product_sizes.deleted_at')
            ->where('product_sizes.status',1)
            ->get();
        if (isset($size_id) && !empty($size_id)) {
            $min_price = DB::table('product_sizes')
            ->where('size_id',$size_id)
            ->where('product_id',$product_id)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->first(); 
        }else{
            $min_price = DB::table('product_sizes')
            ->where('price','=',DB::raw('(SELECT min(price) FROM product_sizes WHERE product_id ='.$product_id.')'))
            ->where('product_id',$product_id)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->first(); 
        }
        
        $colors = DB::table('product_colors')
            ->select('product_colors.color_id as color_id','color.name as color_name','color.value as color_value')
            ->join('color','product_colors.color_id','=','color.id')
            ->where('product_colors.product_id',$product_id)
            ->whereNull('product_colors.deleted_at')
            ->where('product_colors.status',1)
            ->get();
        $images = DB::table('product_image')
            ->where('product_id',$product_id)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->get();
        
        $related_products = [];
        if (isset($product->first_category) && !empty($product->first_category)) {
            $related_products = DB::table('products')
            ->where('first_category',$product->first_category)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->inRandomOrder()
            ->limit(10)
            ->get();
        }
        
        $data = [
            'product' =>$product,
            'colors' => $colors,
            'sizes' => $sizes,
            'images' => $images,
            'min_price' => $min_price,
            'related_products' => $related_products,
        ];
        return view('web.product_detail',compact('data'));
    }


    public function productFilter(Request $request)
    {
        $this->validate($request, [
            'category'   => 'required',
        ]);

        $second_category = $request->input('category');
        $designers = $request->input('designers');
        $sizes = $request->input('sizes');
        $prices = $request->input('prices');
        $colors = $request->input('colors');
        $sort = $request->input('sort');
        
        $current_page = 1;
        
        $product_count = DB::table('products')
            ->select('products.*')
            ->join('product_sizes','products.id', '=', 'product_sizes.product_id')
            ->whereNull('products.deleted_at')
            ->where('products.status',1)
            ->where('products.second_category',$second_category)
            ->where(function($q) use ($designers) {
                if (isset($designers) && !empty($designers) && count((array)$designers) > 0 ) {
                    $seller_count = 1;
                    foreach ($designers as $key => $designer) {
                        if ($seller_count == 1) {
                            $q->where('products.brand_id',$designer);
                        }else{
                            $q->orWhere('products.brand_id',$designer);
                        }                       
                       $seller_count++;
                    }            
                 }
            })
            ->where(function($q2) use ($prices) {  
                if ((isset($prices) && !empty($prices) && count((array)$prices) > 0)) {
                    if (isset($prices) && !empty($prices) ) {
                        $prices = explode(";",$prices);
                        $q2->whereBetween('products.min_price',[$prices[0],$prices[1]]);                     
                    }
                }
            })
            ->where(function($q2) use ($sizes,$prices) {  
                if ((isset($sizes) && !empty($sizes) && count((array)$sizes) > 0) ) {                  
                    $sizes_flag = 1;
                    if (isset($sizes) && !empty($sizes)) {
                        foreach ($sizes as $key => $size) {
                            if ($sizes_flag == 1) {
                                $q2->where('product_sizes.size_id',$sizes);
                                
                            }else{
                                $q2->orWhere('product_sizes.size_id',$sizes);
                            }
                            $sizes_flag++;
                        }
                    }
                }
            });
            if (isset($colors) && !empty($colors) && count((array)$colors) > 0 ) {
                $product_count->join('product_colors','products.id', '=', 'product_colors.product_id')
                ->where(function($q2) use ($colors) {                    
                        $colors_count = 1;
                        foreach ($colors as $key => $color) {
                            if ($colors_count == 1) {
                                $q2->where('product_colors.color_id',$color);
                            }else{
                                $q2->orWhere('product_colors.color_id',$color);
                            }                       
                        $colors_count++;
                        }            
                    
                });
            };

        $product_Query = $product_count;
        $total_product = $product_count->count();
            // dd($total_product);
        $total_page = intval(ceil($total_product / 12 ));
        $limit = ($current_page*12)-12;
        $pagination = [
            'current_page' => $current_page,
            'total_page' => $total_page,
            'total_product' => $total_product,
        ];

        // DB::enableQueryLog();
        $product_against_seller=$product_Query
            ->distinct('products.id')
            ->skip($limit)
            ->take(12);
        if (isset($sort) && !empty($sort)) {
            if ($sort == 'newest') {
                $product_against_seller->orderBy('products.id', 'asc');
            }
            elseif ($sort == 'low') {
                $product_against_seller->orderBy('products.min_price', 'asc');
            }elseif ($sort == 'high') {
                $product_against_seller->orderBy('products.min_price', 'desc');
            }elseif ($sort == 'title_asc') {
                $product_against_seller->orderBy('products.name', 'asc');
            }elseif ($sort == 'title_dsc') {
                $product_against_seller->orderBy('products.name', 'desc');
            }
        }
        $product_against_seller = $product_against_seller->get();
                //    dd(str_replace_array('?', \DB::getQueryLog()[0]['bindings'], 
                // \DB::getQueryLog()[0]['query']));

       
        // foreach ($product_against_seller as $key => $value) {
        //     $value->price = DB::table('product_sizes')
        //     ->where('price','=',DB::raw('(SELECT min(price) FROM product_sizes WHERE product_id ='.$value->id.')'))
        //     ->where('product_id',$value->id)
        //     ->whereNull('deleted_at')
        //     ->where('status',1)
        //     ->first(); 
        // }
        // dd($product_against_seller);
            // dd(str_replace_array('?', \DB::getQueryLog()[0]['bindings'], 
            //     \DB::getQueryLog()[0]['query']));


        $response=[
            'pagination'=> $pagination,
            'products' => $product_against_seller,
        ];

        return response()->json($response, 200);

    }
}




