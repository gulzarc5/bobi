<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Carbon\Carbon;
use DB;
use Auth;

class OrderController extends Controller
{
    public function allOrders()
    {
        $seller_id = Auth::guard('seller')->user()->id;
        DB::table('order_details')
            ->where('seller_view_status',1)
            ->where('seller_id',''.$seller_id.'')
            ->update([
                'seller_view_status' => '2',
            ]);
        return view('seller.orders.all_orders');
    }

    public function allOrdersAjax()
    {
        $seller_id = Auth::guard('seller')->id();
        $query =  $order_details = DB::table('order_details')
                ->select('order_details.id as id','order_details.order_id as admin_order_id','order_details.rate as rate','order_details.total as total','order_details.quantity as quantity','order_details.order_status as status','order_details.created_at as created_at','user.name as u_name')
                ->join('user','user.id','=','order_details.user_id')
                ->where('order_details.seller_id', $seller_id)
                ->orderBy('order_details.id','desc');

            return datatables()->of($query->get())
            ->addIndexColumn()
            ->editColumn('status', function($row){
                if ($row->status == '1') {
                   $btn =  '<a class="btn btn-warning">Pending</a>';
                }elseif ($row->status == '2') {
                    $btn =  '<a class="btn btn-info">Dispatched</a>';
                }elseif ($row->status == '3') {
                    $btn =  '<a class="btn btn-success">Delivered</a>';
                }elseif ($row->status == '4') {
                    $btn =  '<a class="btn btn-danger">Cancelled</a>';
                }else{
                    $btn = '<a class="btn btn-default">Return</a>';
                }
                return $btn;
            })
            ->editColumn('created_at', function($row){
               
                return Carbon::parse($row->created_at)->toDayDateTimeString();
            })
            ->addColumn('action', function($row){
                   $btn = '
                   <a href="'.route('seller.order_view',['order_details_id'=>encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank">View</a>';
                    return $btn;
            })
            ->rawColumns(['action','status','created_at'])
            ->make(true);
    }

    public function OrdersView($order_details_id)
    {
        try {
            $order_details_id = decrypt($order_details_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }


        $order_details = DB::table('order_details')
            ->select('order_details.*','products.main_image as image','products.id as product_id','products.name as p_name','color.value as c_value')
            ->leftjoin('products','products.id','=','order_details.product_id')
            ->leftjoin('color','color.id','=','order_details.color')
            ->where('order_details.id', $order_details_id)
            ->first();
        if ($order_details) {
            $user_details = DB::table('user')
                ->select('user.name as u_name','user.mobile as mobile','user.email as email','user_details.gender as gender','user_details.address as address','user_details.pin as pin','state.name as state','city.name as city')
                ->leftjoin('user_details','user_details.seller_id','=','user.id')
                ->leftjoin('state','user_details.state_id','=','state.id')
                ->leftjoin('city','user_details.city_id','=','city.id')
                ->where('user.id',$order_details->user_id)
                ->first();
            $shipping_address = DB::table('shipping_address')
                ->select('shipping_address.address as address','shipping_address.pin as pin','state.name as state','city.name as city')
                ->leftjoin('state','shipping_address.state_id','=','state.id')
                ->leftjoin('city','shipping_address.city_id','=','city.id')
                ->where('shipping_address.id',$order_details->shipping_address_id)
                ->first();

                // $value->order_date = Carbon::parse($value->created_at)->toDayDateTimeString();
            
        }

        return view('seller.orders.order_details',compact('order_details','user_details','shipping_address'));
        
    }

    public function dispatchOrder($order_details_id)
    {
        try {
            $order_details_id = decrypt($order_details_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        return view('seller.orders.dispatch_orders',compact('order_details_id'));
    }

    public function dispatchOrderUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'order_details_id' => 'required',
            'transaction_no' => 'required',
        ]);
        $order_details_id = $request->input('order_details_id');
        $consign_no = $request->input('transaction_no');

        $update_order_status = DB::table('order_details')
        ->where('id',$order_details_id)
        ->update([
            'order_status' => 2,
            'consignment_no' => $consign_no,
            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
        ]);

        if($update_order_status){
            $order = DB::table('order_details')->where('id',$order_details_id)->first();
            $all_orders = DB::table('order_details')
                ->where('id',$order->order_id)
                ->get();
            $status_flag = true;
            foreach ($all_orders as $key => $value) {
                $order_id = $value->order_id;
                if ((int)$value->order_status < (int)2) {
                    $status_flag = false;                    
                    break;
                }
            }

            if ($status_flag) {
                DB::table('orders')
                    ->where('id',$all_orders->order_id)
                    ->update([
                        'status' => 2,
                        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    ]);
            }
            return redirect()->route('seller.order_view',['order_details_id'=>encrypt($order_details_id)]);
        }else{
            return redirect()->back();
        }
    }

    public function orderStatusUpdate($order_id,$order_details_id,$status)
    {
        try {
            $order_id = decrypt($order_id);
            $order_details_id = decrypt($order_details_id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $update_order_status = DB::table('order_details')
            ->where('id',$order_details_id)
            ->update([
                'order_status' => $status,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);

        // To Check all orders order status to update order status in main order table
        if($update_order_status){
            $all_orders = DB::table('order_details')
                ->where('order_id',$order_id)
                ->get();
            $status_flag = true;
            foreach ($all_orders as $key => $value) {
                if ((int)$value->order_status < (int)$status) {
                    $status_flag = false;
                    break;
                }
            }

            if ($status_flag) {
                DB::table('orders')
                    ->where('id',$order_id)
                    ->update([
                        'status' => $status,
                        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    ]);
            }
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
}
