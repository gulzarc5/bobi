<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Validator;

class OrderController extends Controller
{
    public function pinAvailability($pin)
    {
        $check = DB::table('delhivery_pin_code')->where('pin_code',$pin)->count();
        if ($check > 0) {
            $pin_chk = DB::table('delhivery_pin_code')->where('pin_code',$pin)->first();
            $response = [
                'status' => true,
                'message' => 'Service Available',
                'data' => $pin_chk,
            ];
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => false,
                'message' => 'Service Not Available',
                'data' => [],
            ];
            return response()->json($response, 200);
        }
    }

    public function placeOrder(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'address' => 'required',
            'pay_method' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => 'Required Field Can not be Empty',
                'payment_status' => false,
                'data' => [],
                'error_code' => true,
                'error_message' => $validator->errors(),
            ];
            return response()->json($response, 200);
        }

        $address_id = $request->input('address');
        $pay_method = $request->input('pay_method');
        $user_id = $request->input('user_id');

        $shipping_addr = DB::table('shipping_address')
            ->where('id',$address_id)->first();
        if ($shipping_addr) {
            $check = DB::table('delhivery_pin_code')->where('pin_code',$shipping_addr->pin)->count();
            if ($check < 1) {
                $response = [
                    'status' => false,
                    'message' => 'Service Not Available At this pin code',
                    'payment_status' => false,
                    'data' => [],
                    'error_code' => false,
                    'error_message' => null,
                    ];
                return response()->json($response, 200);
            }
        } else {
            $response = [
                'status' => false,
                'message' => 'Shipping Address Not Found',
                'payment_status' => false,
                'data' => [],
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200);
        }
        
        $cart = DB::table('cart')->where('user_id',$user_id)->get();
        foreach ($cart as $cart_data) {
            $p_stock = $this->checkProductStock($cart_data->product_id,$cart_data->size_id);
            if (isset($p_stock->stock)) {
                if ($p_stock->stock < $cart_data->quantity) {
                    $response = [
                        'status' => false,
                        'message' => 'Product '.$p_stock->p_name.' Is Out Of Stock',
                        'payment_status' => false,
                        'data' => [],
                        'error_code' => false,
                        'error_message' => null,
                    ];
                    return response()->json($response, 200);
                }
            }else{
                $response = [
                    'status' => false,
                    'message' => 'Something Went Wrong Please try Again',
                    'payment_status' => false,
                    'data' => [],
                    'error_code' => false,
                    'error_message' => null,
                ];
                return response()->json($response, 200);
            }

        }

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

        $update_order = DB::table('orders')
                ->where('id',$order)
                ->update([
                    'quantity' => $total_qtty,
                    'amount' => $total,
                ]);
        if ($update_order) {
            DB::table('cart')->where('user_id',$user_id)->delete();
        }else{
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong',
                'payment_status' => false,
                'data' => [],
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200);
        }
        if ($pay_method == 1) {
            $this->productStockUpdate($order);
            $response = [
                'status' => true,
                'message' => 'Order Placed Successfully',
                'payment_status' => false,
                'data' => null,
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200);           
        }else{
            $total_cost =  $total;
            $user_details = DB::table('user')->where('id',$user_id)->first();
            $user_name =   $user_details->name;
            $user_email =   $user_details ->email;
            $user_mobile =  $user_details ->mobile;
            $data = [
                'purpose' => "Ecommerce Bplus Payment",
                'amount' => $total_cost,
                'buyer_name' => $user_name,
                'email' => $user_email,
                'phone' => $user_mobile,
                'order_id' => $order,
            ];
            $response = [
                'status' => true,
                'message' => 'Order Placed Successfully',
                'payment_status' => true,
                'data' => $data,
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200); 
        }
    }

    public function checkProductStock($product_id,$size_id)
    {
        if (empty($quantity)) {
            $quantity = 1 ;
        }
        $product_stock = DB::table('products')
                ->select('product_sizes.stock as stock','products.id as p_id','products.name as p_name')
                ->join('product_sizes','product_sizes.product_id','=','products.id')
                ->where('products.id',$product_id)
                ->where('product_sizes.size_id',$size_id)
                ->first();
        return $product_stock;
        
    }

    public function productStockUpdate($order_id)
    {
        $order = DB::table('order_details')->where('order_id',$order_id)->get();
        if ($order) {
            foreach ($order as $key => $value) {
                $update = DB::table('product_sizes')
                    ->where('product_id',$value->product_id)
                    ->where('size_id',$value->size_id)
                    ->update([
                        'stock' => DB::raw("`stock`-".($value->quantity)),
                        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    ]);
            }
        }        
        return true;
    }

    public function updatePaymentRequestId($order_id,$payment_rqst_id)
    {
        $update = DB::table('orders')
        ->where('id',$order_id)
        ->update([
            'payment_request_id' => $payment_rqst_id,
            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
        ]);

        if ($update) {
            $response = [
                'status' => true,
                'message' => 'Payment Request Id Updated Successfully',
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

    public function updatePaymentId($order_id,$payment_rqst_id,$payment_id)
    {
        $update = DB::table('orders')
        ->where('id',$order_id)
        ->where('payment_request_id',$payment_rqst_id)
        ->update([
            'payment_id' => $payment_id,
            'payment_status' => '2',
            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
        ]);
        $this->productStockUpdate($order);
        if ($update) {
            $response = [
                'status' => true,
                'message' => 'Payment Id Updated Successfully',
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

    public function orderHistory($user_id)
    {
        $orders = DB::table('order_details')
            ->select('order_details.*','products.name as p_name','products.main_image as p_image','color.value as c_value')
            ->join('products','products.id','=','order_details.product_id')
            ->join('color','color.id','=','order_details.color')
            ->where('order_details.user_id',$user_id)
            ->orderBy('order_details.id','desc')
            ->get();
        if ($orders->count() > 0) {
            $response = [
                'status' => true,
                'message' => 'Order History',
                'data' => $orders,
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'status' => false,
                'message' => 'No Order History Found',
                'data' => [],
            ];
            return response()->json($response, 200);
        }
        
    }

    public function orderCancel($order_id)
    {
        $update = DB::table('order_details')
        ->where('id',$order_id)
        ->update([
            'order_status' => 4,
            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
        ]);

        if ($update) {
            $response = [
                'status' => true,
                'message' => 'Order Cancelled Successfully',
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
}
