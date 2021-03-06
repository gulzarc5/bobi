<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function checkoutShip()
    {
        $user_id = Auth::guard('buyer')->user()->id;

        $cart = DB::table('cart')->where('user_id',$user_id)->get();
        $cart_total = 0;
        foreach ($cart as $key => $item) {
            $size = DB::table('product_sizes')
                ->where('size_id',$item->size_id)
                ->where('product_id',$item->product_id)
                ->first();
            $cart_total += $item->quantity * $size->price;
        }
        
        $shipping_address = DB::table('shipping_address')
            ->select('shipping_address.*','state.name as s_name','city.name as c_name')
            ->join('state','state.id','=','shipping_address.state_id')
            ->join('city','city.id','=','shipping_address.city_id')
            ->whereNull('shipping_address.deleted_at')
            ->where('shipping_address.user_id',$user_id)
            ->orderBy('shipping_address.id','desc')
            ->get();
        $states = DB::table('state')
            ->whereNull('deleted_at')
            ->get();
        // dd($shipping_address);
        return view('web.checkout',compact('cart_total','shipping_address','states'));
    }

    public function placeOrder(Request $request)
    {
        $validatedData = $request->validate([
            'address' => 'required',
            'pay_method' => 'required',
        ]);
        
        $user_id = Auth::guard('buyer')->user()->id;
        $address_id = $request->input('address');
        $pay_method = $request->input('pay_method');
        /* if Pay method == 1  then send to payment Gateway
            else place order as cash on delivery*/
        $order = DB::table('orders')
            ->insertGetId([
                'user_id' => $user_id,
                'payment_method' => $pay_method,
                'shipping_address_id' => $address_id,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);

        $cart = DB::table('cart')->where('user_id',$user_id)->get();
        
        $total = 0;
        $total_qtty = 0;
        if ($pay_method == 1) {
            foreach ($cart as $cart_data) {
                $product = DB::table('products')->select('seller_id','brand_id')
                    ->where('id',$cart_data->product_id)
                    ->whereNull('deleted_at')
                    ->first();
                if ($product) {
                    $size = DB::table('product_sizes')
                        ->select('product_sizes.*','sizes.name as size_name')
                        ->join('sizes','sizes.id','=','product_sizes.size_id')
                        ->where('product_sizes.size_id',$cart_data->size_id)
                        ->where('product_sizes.product_id',$cart_data->product_id)
                        ->first();

                    $size_name = null;
                    $rate = 0;
                    if (isset($size->size_name)) {
                        $size_name = $size->size_name;
                    }
                    if (isset($size->price)) {
                        $rate = $size->price;
                    }
                    $designer = DB::table('brand_name')->where('id',$product->brand_id)->first();
                    $designer_name = null;
                    if (isset($designer->name)) {
                        $designer_name = $designer->name;
                    }

                    DB::table('order_details')
                    ->insert([
                        'user_id' => $user_id,
                        'order_id' => $order,
                        'seller_id' => $product->seller_id,
                        'product_id' => $cart_data->product_id,
                        'shipping_address_id' => $address_id,
                        'size' => $size_name,
                        'color' => $cart_data->color_id,
                        'designer' => $designer_name,
                        'quantity' => $cart_data->quantity,
                        'rate' => $rate,
                        'total' => ($cart_data->quantity * $rate),
                        'payment_method' => $pay_method,
                        'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    ]);

                    $total += ($cart_data->quantity * $rate);
                    $total_qtty += $cart_data->quantity;
                }
               
            }

        }else{
            foreach ($cart as $cart_data) {
                $product = DB::table('products')->select('seller_id','brand_id')
                ->where('id',$cart_data->product_id)
                ->whereNull('deleted_at')
                ->first();
                if ($product) {
                    $size = DB::table('product_sizes')
                        ->select('product_sizes.*','sizes.name as size_name')
                        ->join('sizes','sizes.id','=','product_sizes.size_id')
                        ->where('product_sizes.size_id',$cart_data->size_id)
                        ->where('product_sizes.product_id',$cart_data->product_id)
                        ->first();
                    $size_name = null;
                    $rate = 0;
                    if (isset($size->size_name)) {
                        $size_name = $size->size_name;
                    }
                    if (isset($size->price)) {
                        $rate = $size->price;
                    }
                   
                    $designer = DB::table('brand_name')->where('id',$product->brand_id)->first();
                    $designer_name = null;
                    if (isset($designer->name)) {
                        $designer_name = $designer->name;
                    }


                    DB::table('order_details')
                    ->insert([
                        'user_id' => $user_id,
                        'order_id' => $order,
                        'seller_id' => $product->seller_id,
                        'product_id' => $cart_data->product_id,
                        'size' => $size_name,
                        'color' => $cart_data->color_id,
                        'designer' => $designer_name,
                        'quantity' => $cart_data->quantity,
                        'rate' => $rate,
                        'total' => ($cart_data->quantity * $rate),
                        'payment_method' => $pay_method,
                        'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    ]);
                    $total += ($cart_data->quantity * $rate);
                    $total_qtty += $cart_data->quantity;
                }
            }
        }


        $update_order = DB::table('orders')
            ->where('id',$order)
            ->update([
                'quantity' => $total_qtty,
                'amount' => $total,
            ]);
        if ($update_order) {
            DB::table('cart')->where('user_id',$user_id)->delete();
            return redirect()->route('web.checkout_thankyou',['id'=>$order]);
        }else{
            return redirect()->back();
        }

    }

    public function checkoutSuccess($order_id)
    {

        return view('web.thankyou',compact('order_id'));
    }

    public function orderHistory()
    {
        $user_id = Auth::guard('buyer')->user()->id;
        $orders = DB::table('order_details')
            ->select('order_details.*','products.name as p_name','products.main_image as p_image','color.value as c_value')
            ->join('products','products.id','=','order_details.product_id')
            ->join('color','color.id','=','order_details.color')
            ->where('order_details.user_id',$user_id)
            ->orderBy('order_details.id','desc')
            ->get();
        return view('web.your_order',compact('orders'));
    }

    public function orderCancel($order_details_id)
    {
        try {
            $order_details_id = decrypt($order_details_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $user_id = Auth::guard('buyer')->user()->id;

        $update_order_status = DB::table('order_details')
            ->where('id',$order_details_id)
            ->update([
                'order_status' => 4,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if($update_order_status){
            // $order = DB::table('order_details')->where('id',$order_details_id)->first();
            $all_orders = DB::table('order_details')
                ->where('id',$order_details_id)
                ->get();
            $status_flag = true;
            foreach ($all_orders as $key => $value) {
                $order_id = $value->order_id;
                if ((int)$value->order_status < (int)4) {
                    $status_flag = false;                    
                    break;
                }
            }

            if ($status_flag) {
                DB::table('orders')
                    ->where('id',$order_id)
                    ->update([
                        'status' => 4,
                        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    ]);
            }
            return redirect()->back();
        }else{
            return redirect()->back();
        }

    }
}
