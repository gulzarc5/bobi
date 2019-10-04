<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Auth;
use Carbon\Carbon;

class CartController extends Controller
{
    public function viewCart()
    {
        if( Auth::guard('buyer')->user() && !empty(Auth::guard('buyer')->user()->id)) {
            $cart_data =[];
            $user_id = Auth::guard('buyer')->user()->id;

            $cart = DB::table('cart')->where('user_id',$user_id)->get();
            if (count($cart) > 0) {
                foreach ($cart as $key => $item) {
                    $product = DB::table('products')->where('id',$item->product_id)
                        ->whereNull('deleted_at')
                        ->where('status',1)
                        ->first();
                    
                    $size = DB::table('product_sizes')
                        ->select('product_sizes.*','sizes.name as size_name')
                        ->join('sizes','sizes.id','=','product_sizes.size_id')
                        ->where('size_id',$item->size_id)
                        ->where('product_id',$item->product_id)
                        ->first();
                    
                    $color = DB::table('color')
                        ->where('id',$item->color_id)
                        ->first();

                    $cart_data[] = [
                        'product_id' => $product->id,
                        'title' => $product->name,
                        'image' => $product->main_image,
                        'quantity' => $item->quantity,
                        'color_name' => $color->name,
                        'color_value' => $color->value,
                        'size' => $size->size_name,
                        'price' => $size->price,
                       ];
                }
            }else{
                $cart_data = false;
            }

            return view('web.cart',compact('cart_data'));
        }else{
            if (Session::has('cart') && !empty(Session::get('cart'))) {
                $cart = Session::get('cart');
                $cart_data =[];

                if (count($cart) > 0) {
                    foreach ($cart as $product_id => $value) {
                        $product = DB::table('products')->where('id',$product_id)
                        ->whereNull('deleted_at')
                        ->where('status',1)
                        ->first();
                        $size = DB::table('product_sizes')
                            ->select('product_sizes.*','sizes.name as size_name')
                            ->join('sizes','sizes.id','=','product_sizes.size_id')
                            ->where('size_id',$value['size_id'])
                            ->where('product_id',$product_id)
                            ->first();
                        
                        $color = DB::table('color')
                            ->where('id',$value['color'])
                            ->first();
                       $cart_data[] = [
                        'product_id' => $product->id,
                        'title' => $product->name,
                        'image' => $product->main_image,
                        'quantity' => $value['quantity'],
                        'color_name' => $color->name,
                        'color_value' => $color->value,
                        'size' => $size->size_name,
                        'price' => $size->price,
                       ];
                    }
                }else{
                    $cart_data = false;
                }
            }else{
                $cart_data = false;
            }
            // dd($cart_data);
            return view('web.cart',compact('cart_data'));
        }

         
    }
    public function AddCart(Request $request)
    {
       
    	$product_id = $request->input('product_id');
    	$quantity = $request->input('quantity');
        $color = $request->input('color');
        $size_id = $request->input('size');
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
        // Session::forget('cart');
        // dd($size_id);
        //*********************if user is logged in*********************
        if( Auth::guard('buyer')->user() && !empty(Auth::guard('buyer')->user()->id)) {
            $user_id = Auth::guard('buyer')->user()->id;

            // Check This Product Is already Exist in Cart Or Not
            $check_cart_product = DB::table('cart')
                ->where('product_id',$product_id)
                ->where('user_id',$user_id)
                ->count();

            if ($check_cart_product) {
                if ($check_cart_product > 0 ) {
                    return redirect()->route('web.viewCart');
                }
            }

            $cart_insert = DB::table('cart')
             ->insert([
                    'product_id' =>  $product_id,
                    'user_id' => Auth::guard('buyer')->user()->id,
                    'color_id' => $color,
                    'quantity' => $quantity,
                    'size_id' => $size_id,
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
             return redirect()->route('web.viewCart');
        }else{
            //***************If Guest User***************
            if (Session::has('cart') && !empty(Session::get('cart'))) {
                $cart = Session::get('cart');
                $cart[$product_id] =[
                     'quantity' => $quantity,
                     'color' => $color,
                     'size_id'=>$size_id,
                 ];
            }else{
                $cart = [
                    $product_id => [
                     'quantity' => $quantity,
                     'color' => $color,
                     'size_id'=>$size_id,
                    ],
                ];
            }
            Session::put('cart', $cart);
            Session::save();
            return redirect()->route('web.viewCart');
        }
        // dd(session()->all());
       // Session::forget('cart.'.$product_id);

        dd(Session::get('cart'));
    }

    public function updateCart(Request $request)
    {
        $validatedData = $request->validate([
            'p_id' => 'required',
            'quantity' => ['required', 'numeric'],
        ]);

        $product_id = $request->input('p_id');
        $quantity = $request->input('quantity');

        try{
            $product_id = decrypt($product_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        //**********Minimum Order Quantity Check**************
        if (Auth::guard('buyer')->user() && !empty(Auth::guard('buyer')->user()->id)) {
            $user_id = Auth::guard('buyer')->user()->id;

            $updateCart = DB::table('cart')
            ->where('user_id',$user_id)
            ->where('product_id',$product_id)
            ->update([
                    'quantity' => $quantity
                ]);
            return redirect()->route('web.viewCart')->with('message','Cart Updated Successfully');
        }elseif(Session::has('cart') && !empty(Session::get('cart'))){
            $cart = Session::get('cart');
            $item = $cart[$product_id]['quantity'] = $quantity;

            Session::put('cart', $cart);
            Session::save();
            return redirect()->route('web.viewCart')->with('message','Cart Updated Successfully');
        }

    }

    public function cartItemRemove($product_id)
    {
        try{
            $product_id = decrypt($product_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        if (Auth::guard('buyer')->user() && !empty(Auth::guard('buyer')->user()->id)) {
            $user_id = Auth::guard('buyer')->user()->id;
            $delete_cart = DB::table('cart')
            ->where('user_id',$user_id)
            ->where('product_id',$product_id)
            ->delete();
            return redirect()->route('web.viewCart')->with('message','Product Removed From Cart');
        }elseif(Session::has('cart') && !empty(Session::get('cart'))){
            Session::forget('cart.'.$product_id);
            return redirect()->route('web.viewCart')->with('message','Product Removed From Cart');
        }


    }
}
