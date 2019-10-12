<?php

namespace App\Http\Controllers\Admin\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Carbon\Carbon;
use DB;

class OrderController extends Controller
{
    public function orderListAll()
    {
        DB::table('orders')
            ->where('admin_view_status',1)
            ->update([
                'admin_view_status' => 2,
            ]);
        return view('admin.orders.all_orders');
    }

    public function ajaxOrderListAll()
    {
        $query = DB::table('orders')
            ->select('orders.id as id','orders.amount as amount','orders.quantity as quantity','orders.payment_method as payment_method','orders.payment_status as payment_status','orders.status as status','orders.created_at as created_at','user.name as u_name')
            ->join('user','user.id','=','orders.user_id')
            ->orderBy('orders.id','desc');

            return datatables()->of($query->get())
            ->addIndexColumn()
            ->editColumn('payment_method', function($row){
                if ($row->payment_method == 1) {
                   $btn =  '<a class="btn btn-info">COD</a>';
                }else{
                    $btn = '<a class="btn btn-success">Online</a>';
                }
                return $btn;
            })
            ->editColumn('payment_status', function($row){
                if ($row->payment_status == 1) {
                   $btn =  '<a class="btn btn-warning">Pending</a>';
                }else{
                    $btn = '<a class="btn btn-success">Paid</a>';
                }
                return $btn;
            })
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
                   <a href="'.route('admin.order_details',['order_id'=>encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank">View</a>';
                    return $btn;
            })
            ->rawColumns(['action', 'payment_method','payment_status','status','created_at'])
            ->make(true);
    }

    public function orderDetails($order_id)
    {
        try {
            $order_id = decrypt($order_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $orders = DB::table('orders')
            ->where('id', $order_id)
            ->first();

        $order_details = DB::table('order_details')
            ->where('order_id', $order_id)
            ->get();
        if ($orders) {
            $user_details = DB::table('user')
                ->select('user.name as u_name','user.mobile as mobile','user.email as email','user_details.gender as gender','user_details.address as address','user_details.pin as pin','state.name as state','city.name as city')
                ->leftjoin('user_details','user_details.seller_id','=','user.id')
                ->leftjoin('state','user_details.state_id','=','state.id')
                ->leftjoin('city','user_details.city_id','=','city.id')
                ->where('user.id',$orders->user_id)
                ->first();
            $shipping_address = DB::table('shipping_address')
                ->select('shipping_address.address as address','shipping_address.pin as pin','state.name as state','city.name as city')
                ->leftjoin('state','shipping_address.state_id','=','state.id')
                ->leftjoin('city','shipping_address.city_id','=','city.id')
                ->where('shipping_address.id',$orders->shipping_address_id)
                ->first();

            foreach ($order_details as $key => $value) {
                $product = DB::table('products')
                ->where('id',$value->product_id)
                ->first();
                $value->image = $product->main_image;
                $value->title = $product->name;
                if ($value->seller_id == 'A') {
                    $value->seller_name = "Admin";
                }else{
                    $seller_name = DB::table('user')->where('id',$value->seller_id)->first();
                    $value->seller_name = $seller_name->name;
                }
                $value->color_value = null;
                if (!empty($value->color)) {
                    $color = DB::table('color')->where('id',$value->color)->first();
                    $value->color_value = $color->value;
                }
                $value->order_date = Carbon::parse($value->created_at)->toDayDateTimeString();

            }
            
        }

        return view('admin.orders.order_details',compact('orders','order_details','user_details','shipping_address'));
        
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
