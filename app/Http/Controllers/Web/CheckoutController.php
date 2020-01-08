<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Carbon\Carbon;
use Session;

class CheckoutController extends Controller
{
    public function checkoutShip()
    {
        $user_id = Auth::guard('buyer')->user()->id;

        $cart = DB::table('cart')->where('user_id',$user_id)->get();
        $cart_total = 0;
        $cart_count = 0;
        foreach ($cart as $key => $item) {
            $cart_count = $cart_count+1;
            $size = DB::table('product_sizes')
                ->where('size_id',$item->size_id)
                ->where('product_id',$item->product_id)
                ->first();
            $cart_total += $item->quantity * $size->price;
        }
        $shipping_charge = $cart_count*50;
        
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
        return view('web.checkout',compact('cart_total','shipping_address','states','shipping_charge'));
    }

    public function paymentPage($address,$pin)
    {
        try {
            $address = decrypt($address);
            $pin = decrypt($pin);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $user_pin_details =  DB::table('delhivery_pin_code')->where('pin_code',$pin)->first();
        $user_id = Auth::guard('buyer')->user()->id;

        $cart = DB::table('cart')->where('user_id',$user_id)->get();
        $cart_total = 0;
        $cart_count = 0;
        foreach ($cart as $key => $item) {
            $cart_count = $cart_count+1;
            $size = DB::table('product_sizes')
                ->where('size_id',$item->size_id)
                ->where('product_id',$item->product_id)
                ->first();
            $cart_total += $item->quantity * $size->price;
        }
        $shipping_charge = $cart_count*50;
        return view('web.payment',compact('user_pin_details','cart_total','address','shipping_charge'));
    }

    public function proceedToPay(Request $request)
    {
        $validatedData = $request->validate([
            'address' => 'required',
        ]);
        $user_shi_addr = DB::table('shipping_address')->select('pin')->where('id',$request->input('address'))->first();
        $user_pin_details = null;
        if ($user_shi_addr) {
            $user_pin = DB::table('delhivery_pin_code')->where('pin_code',$user_shi_addr->pin)->count();
            if ($user_pin > 0) {
                return redirect()->route('web.payment_page',['address'=>encrypt($request->input('address')),'pin'=>encrypt($user_shi_addr->pin)]);
            } else {
                return redirect()->back()->with('error','Sorry Delivery Not Available At this Address Please Choose Another Address');
            }
            
        } else {
            return redirect()->back()->with('error','Sorry Delivery Not Available At this Address Please Choose Another Address');
        }
    }

    public function placeOrder(Request $request)
    {
        $validatedData = $request->validate([
            'address' => 'required',
            'pay_method' => 'required',
        ]);
        try {
            $address = decrypt($request->input('address'));
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $user_id = Auth::guard('buyer')->user()->id;
        $address_id = $address;
        $pay_method = $request->input('pay_method');

        //Before Order Check Order Stock
        $cart = DB::table('cart')->where('user_id',$user_id)->get();
        foreach ($cart as $cart_data) {
            $p_stock = $this->checkProductStock($cart_data->product_id,$cart_data->size_id);
            if (isset($p_stock->stock)) {
                if ($p_stock->stock < $cart_data->quantity) {
                    return redirect()->route('web.viewCart')->with('error','Product '.$p_stock->p_name.' Is Out Of Stock');
                }
            }else{
                return redirect()->route('web.viewCart')->with('error','Something Went Wrong Please Try Again');
            }

        }

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

        $total = 0;
        $total_qtty = 0;
        $total_item = 0;
        foreach ($cart as $cart_data) {
            $total_item = $total_item + 1;
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
                    'size_id' => $cart_data->size_id,
                    'size' => $size_name,
                    'color' => $cart_data->color_id,
                    'designer' => $designer_name,
                    'quantity' => $cart_data->quantity,
                    'rate' => $rate,
                    'total' => ($cart_data->quantity * $rate),
                    'shipping_charge' => 50,
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
                    'shipping_charge' => ($total_item*50),
                    'amount' => $total,
                ]);
        if ($update_order) {
            DB::table('cart')->where('user_id',$user_id)->delete();
        }else{
            return redirect()->back();
        }

        if ($pay_method == 1) {
            productStockUpdate($order_id);
            return redirect()->route('web.checkout_thankyou',['id'=>$order]);            
        }else{
            $total_cost =  $total+($total_item*50);
            $user_name = Auth::guard('buyer')->user()->name;
            $user_email = Auth::guard('buyer')->user()->email;
            $user_mobile = Auth::guard('buyer')->user()->mobile;

            $api = new \Instamojo\Instamojo(
                config('services.instamojo.api_key'),
                config('services.instamojo.auth_token'),
                config('services.instamojo.url')
            );
            try {
                $response = $api->paymentRequestCreate(array(
                    "purpose" => "Ecommerce Bplus Payment",
                    "amount" => $total_cost,
                    "buyer_name" => $user_name,
                    "send_email" => true,
                    "email" => $user_email,
                    "phone" => $user_mobile,
                    "redirect_url" => route('web.pay_order_amount',['order_id'=>encrypt($order)]),
                    ));
                    DB::table('orders')
                        ->where('id',$order)
                        ->update([
                            'payment_request_id' => $response['id'],
                            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                        ]);
                    
                    header('Location: ' . $response['longurl']);
                    exit();
            }catch (Exception $e) {
                print('Error: ' . $e->getMessage());
            }
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

    public function productStockUpdate($order_id,$product_id,$size_id,$quantity)
    {
        $order = DB::table('order_details')->where('order_id',$order_id)->get();
        if ($order) {
            foreach ($order as $key => $value) {
                $update = DB::table('product_sizes')
                    ->where('product_id',$value->product_id)
                    ->where('size_id',$value->size_id)
                    ->update([
                        'stock' => DB::raw("`stock`-".($quantity)),
                        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    ]);
            }
        }
        
        return true;
    }

    public function paySuccess(Request $request,$order_id)
    {
        try {
            $order_id = decrypt($order_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        try {
    
            $api = new \Instamojo\Instamojo(
                config('services.instamojo.api_key'),
                config('services.instamojo.auth_token'),
                config('services.instamojo.url')
            );
     
            $response = $api->paymentRequestStatus(request('payment_request_id'));
     
            if( !isset($response['payments'][0]['status']) ) {
             return redirect('web.order_history');
            } else if($response['payments'][0]['status'] != 'Credit') {
             return redirect('web.order_history');
            } 
          }catch (\Exception $e) {
             return redirect('web.order_history');
         }
        
        if($response['payments'][0]['status'] == 'Credit') {
 
             $user_id = Auth::guard('buyer')->user()->id;
             DB::table('orders')
                ->where('id', $order_id)
                ->where('user_id', $user_id)
                ->where('payment_request_id', $response['id'])
                ->update(['payment_id' => $response['payments'][0]['payment_id'], 'payment_status' => '2']);
            
            // $request_info = urldecode("Dear ".Auth::guard('buyer')->user()->name.", Your Order Has Been Placed Successfully We Wiill Process it Shortly. Thank You");
            // SmsHelpers::smsSend(Auth::guard('buyer')->user()->mobile,$request_info);

            //SMS Send To Seller
            // $products = DB::table('order_details')
            //     ->select('products.name as p_name','seller.name as seller_name','seller.mobile as mobile')
            //     ->leftjoin('products','products.id','=','order_details.product_id')
            //     ->leftjoin('seller','seller.id','=','products.seller_id')
            //     ->where('order_details.order_id',$order_id)
            //     ->get();
            // foreach ($products as $key => $value) {
            //     $request_info = urldecode("Dear ".$value->seller_name.", Order of ".$value->p_name." Has Been Placed By a Customer From Bplus Keep Your Product Ready and wait for further update . Thank You");
            //     SmsHelpers::smsSend($value->mobile,$request_info);
            // }
            return redirect()->route('web.checkout_thankyou',['id'=>$order_id]);  
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
