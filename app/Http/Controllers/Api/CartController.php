<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Validator;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'product_id' => 'required',
            'color' => 'required',
            'size' => 'required',
            'user_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => 'Required Field Can not be Empty',
                'error_code' => true,
                'error_message' => $validator->errors(),
            ];
            return response()->json($response, 200);
        }

        $quantity = $request->input('quantity');
        $product_id = $request->input('product_id');
        $color = $request->input('color');
        $size_id = $request->input('size');
        $user_id = $request->input('user_id');

        if (empty($size_id)) {
            $size = DB::table('product_sizes')
            ->where('price','=',DB::raw('(SELECT min(price) FROM product_sizes WHERE product_id ='.$product_id.')'))
            ->where('product_id',$product_id)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->first(); 
            $size_id = $size->size_id;
        }
        if (empty($color)) {
            $colors = DB::table('product_colors')
            ->where('product_id',$product_id)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->first(); 
            $color = $colors->color_id;
        }

        if (empty($quantity)) {
            $quantity = 1;
        }

        $check_cart_product = DB::table('cart')
                ->where('product_id',$product_id)
                ->where('user_id',$user_id)
                ->count();

        if ($check_cart_product) {
            if ($check_cart_product > 0 ) {
                $response = [
                    'status' => true,
                    'message' => 'Product Added To Cart',
                    'error_code' => false,
                    'error_message' => null,
                ];
                return response()->json($response, 200);
            }
        }

        $cart_insert = DB::table('cart')
        ->insert([
               'product_id' =>  $product_id,
               'user_id' => $user_id,
               'color_id' => $color,
               'quantity' => $quantity,
               'size_id' => $size_id,
               'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
           ]);
        if ($cart_insert) {
            $response = [
                'status' => true,
                'message' => 'Product Added To Cart',
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong Please Try Again',
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200);
        }
    }

    public function cartProduct($user_id)
    {
        $cart = DB::table('cart')
            ->select('cart.*','products.name as p_name','products.main_image as main_image','products.tag_name as tag_name','brand_name.name as designer','color.name as color_name','color.value as color_value','sizes.name as size_name')
            ->leftjoin('products','products.id','=','cart.product_id')
            ->leftjoin('brand_name','brand_name.id','=','products.brand_id')
            ->leftjoin('color','color.id','=','cart.color_id')
            ->leftjoin('sizes','sizes.id','=','cart.size_id')
            ->where('cart.user_id',$user_id)->get();
        
        foreach ($cart as $key => $value) {
            $price_det = DB::table('product_sizes')
                ->where('product_id',$value->product_id)
                ->where('size_id',$value->size_id)
                ->first();
            $value->mrp = $price_det->mrp;
            $value->price = $price_det->price;
            $value->stock = $price_det->stock;
        }

        if ($cart->count() > 0) {
            $response = [
                'status' => true,
                'message' => 'Cart Product List',
                'data' => $cart,
            ];
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => false,
                'message' => 'No Product Found In The Cart',
                'data' => [],
            ];
            return response()->json($response, 200);
        }

    }

    public function cartUpdate(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'user_id' => 'required',
            'cart_id' => 'required',
            'quantity' => ['required', 'numeric'],
        ]);
    
        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => 'Required Field Can not be Empty',
                'error_code' => true,
                'error_message' => $validator->errors(),
            ];
            return response()->json($response, 200);
        }

        $updateCart = DB::table('cart')
            ->where('user_id',$request->input('user_id'))
            ->where('id',$request->input('cart_id'))
            ->update([
                'quantity' => $request->input('quantity'),
            ]);
        if ($updateCart) {
            $response = [
                'status' => true,
                'message' => 'Cart Quantity Updated Successfully',
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong Please Try Again',
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200);
        }
    }

    public function cartRemove($cart_id)
    {
        $Cart = DB::table('cart')
        ->where('id',$cart_id)
        ->delete();

        if ($Cart) {
            $response = [
                'status' => true,
                'message' => 'Cart Item Removed Successfully',
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong Please Try Again',
            ];
            return response()->json($response, 200);
        }
    }

    public function addToWishList($product_id,$user_id)
    {  
        $color = null;
        $size_id = null;
        if (empty($size_id)) {
            $size = DB::table('product_sizes')
            ->where('price','=',DB::raw('(SELECT min(price) FROM product_sizes WHERE product_id ='.$product_id.')'))
            ->where('product_id',$product_id)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->first(); 
            $size_id = $size->size_id;
        }
        if (empty($color)) {
            $colors = DB::table('product_colors')
            ->where('product_id',$product_id)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->first(); 
            $color = $colors->color_id;
        }

        $check_wish_list = DB::table('wish_list')
        ->where('user_id',$user_id)
        ->where('product_id',$product_id)
        ->count();
    
        if ($check_wish_list < 1) {
            DB::table('wish_list')
            ->insert([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'size_id' => $size_id,
                'color_id' => $color,
                'quantity' => 1,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        }

        $response = [
            'status' => true,
            'message' => 'Product Added To Wish List',
        ];
        return response()->json($response, 200);

    }

    public function wishListProducts($user_id)
    {
        $wish_list = DB::table('wish_list')
            ->select('wish_list.*','products.name as p_name','products.main_image as main_image','products.tag_name as tag_name','brand_name.name as designer')
            ->leftjoin('products','products.id','=','wish_list.product_id')
            ->leftjoin('brand_name','brand_name.id','=','products.brand_id')
            ->where('wish_list.user_id',$user_id)
            ->get();
        foreach ($wish_list as $key => $value) {
            $price_det = DB::table('product_sizes')
                ->where('product_id',$value->product_id)
                ->where('size_id',$value->size_id)
                ->first();
            $value->mrp = $price_det->mrp;
            $value->price = $price_det->price;
            $value->stock = $price_det->stock;
        }
        if ($wish_list->count() > 0) {
            $response = [
                'status' => true,
                'message' => 'Wish List items',
                'data' => $wish_list,
            ];
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => false,
                'message' => 'No Products Found In Wishlist',
                'data' => [],
            ];
            return response()->json($response, 200);
        }
    }

    public function wishListToCart($user_id,$wish_list_id)
    {
        $wish_list = DB::table('wish_list')->where('id',$wish_list_id)->first();
        if ($wish_list) {
            $check_cart_product = DB::table('cart')
                ->where('product_id',$wish_list->product_id)
                ->where('user_id',$user_id)
                ->count();
            if ($check_cart_product < 1 ) {
                DB::table('cart')->insert([
                    'product_id' =>  $wish_list->product_id,
                    'user_id' => $user_id,
                    'color_id' => $wish_list->color_id,
                    'quantity' => $wish_list->quantity,
                    'size_id' => $wish_list->size_id,
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
            }    
            $wish_list = DB::table('wish_list')->where('id',$wish_list_id)->delete();
            $response = [
                'status' => true,
                'message' => 'Item Moved To Cart',
            ];
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong',
            ];
            return response()->json($response, 200);
        }
    }

    public function wishListItemRemove($user_id,$wish_list_id)
    {
        $wish_list = DB::table('wish_list')->where('id',$wish_list_id)->delete();
        if ($wish_list) {
            $response = [
                'status' => true,
                'message' => 'Item Removed From Wishlist',
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong',
            ];
            return response()->json($response, 200);
        }
        
    }
    
}
