<?php

namespace App\Http\Controllers\Admin\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Carbon\Carbon;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProcessingOrders;

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
            ->select('orders.id as id','orders.shipping_charge as shipping_charge','orders.amount as amount','orders.quantity as quantity','orders.payment_method as payment_method','orders.payment_status as payment_status','orders.status as status','orders.created_at as created_at','user.name as u_name')
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

    public function processingOrders()
    {
        return view('admin.orders.processing_orders');
    }


    public function ajaxProcessingOrders()
    {
        $query =DB::table('order_details')
        ->select('order_details.*','user.name as u_name','orders.payment_status as pay_status')
        ->leftjoin('user','user.id','=','order_details.user_id')
        ->join('orders','orders.id','=','order_details.order_id')
        ->where(function($q){
            $q->where('order_details.seller_id','=','A')
            ->where('order_details.order_status',1)
            ->where(function($q1){
                $q1->where('order_details.payment_method',1)
                    ->orWhere('orders.payment_status',2);                  
            });
        })        
        ->orWhere(function($q){
            $q->where('order_details.order_status',6);                  
        })        
        ->orderBy('order_details.id','desc');

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
                if ($row->pay_status == 1) {
                $btn =  '<a class="btn btn-warning">Pending</a>';
                }else{
                    $btn = '<a class="btn btn-success">Paid</a>';
                }
                return $btn;
            })
            ->addColumn('grand_total', function($row){
                $btn =  $row->total+$row->shipping_charge;
                return $btn;
            })
            ->editColumn('created_at', function($row){
            
                return Carbon::parse($row->created_at)->toDayDateTimeString();
            })
            ->addColumn('action', function($row){
                $btn = '
                <a href="'.route('admin.order_details_of_order_detail',['order_id'=>encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank">View</a>
                <a id="btn'.$row->id.'">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".mod'.$row->id.'">Dispatch</button>
                </a>
                <!-- Small modal -->
                <div class="modal fade bs-example-modal-sm mod'.$row->id.'" tabindex="-1" role="dialog" aria-hidden="true" >
                    <div class="modal-dialog modal-sm" style="width:500px">
                        <div class="modal-content">
                            <form>
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel2">Dispatch Order '.$row->id.'</h4>
                                </div>
                                <div class="modal-body dispatch-order">
                                    <input type="hidden" value="'.$row->id.'" id="order'.$row->id.'">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Order ID</label><br>
                                            <input type="text" disabled value="'.$row->id.'">
                                        </div>
                                        <div class="col-md-12">
                                            <label>Enter AWB number</label><br>
                                            <input type="text" id="awb'.$row->id.'">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="dispatchOrder('.$row->id.')">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /modals -->';
                
                    return $btn;
            })
            ->rawColumns(['action', 'grand_total', 'payment_method','payment_status','created_at'])
            ->make(true);
    }

    public function processingOrdersExcel()
    {
        $query =DB::table('order_details')
        ->select('order_details.*','user.name as u_name','orders.payment_status as pay_status')
        ->leftjoin('user','user.id','=','order_details.user_id')
        ->join('orders','orders.id','=','order_details.order_id')
        ->where(function($q){
            $q->where('order_details.seller_id','=','A')
            ->where('order_details.order_status',1)
            ->where(function($q1){
                $q1->where('order_details.payment_method',1)
                    ->orWhere('orders.payment_status',2);                  
            });
        })        
        ->orWhere(function($q){
            $q->where('order_details.order_status',6);                  
        })        
        ->orderBy('order_details.id','desc')
        ->get()->toArray();
        // dd($query);
        return Excel::download(new ProcessingOrders, 'users.xlsx');
    }

    public function dispatchedOrders()
    {
        return view('admin.orders.dispatched_order_list');
    }

    public function ajaxdispatchedOrders()
    {
        $query =DB::table('order_details')
            ->select('order_details.*','user.name as u_name','orders.payment_status as pay_status')
            ->leftjoin('user','user.id','=','order_details.user_id')
            ->join('orders','orders.id','=','order_details.order_id')
            ->where('order_details.order_status',2)
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
            ->addColumn('grand_total', function($row){
                $btn =  $row->total+$row->shipping_charge;
                return $btn;
            })
            ->editColumn('created_at', function($row){
               
                return Carbon::parse($row->created_at)->toDayDateTimeString();
            })
            ->addColumn('action', function($row){
                   $btn = '
                   <a href="'.route('admin.order_details_of_order_detail',['order_id'=>encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank">View</a>
                   <a href="'.route('seller.print_courier_label',['consignment_no'=>encrypt($row->consignment_no)]).'" class="btn btn-success btn-sm" target="_blank">Print Label</a>';
                    return $btn;
            })
            ->rawColumns(['action', 'grand_total','payment_method','payment_status','status','created_at'])
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

    public function orderDetailsFromOrderDetail($order_id)
    {
        try {
            $order_id = decrypt($order_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }



        $order_details = DB::table('order_details')
            ->where('id', $order_id)
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

                $product = DB::table('products')
                ->where('id',$order_details->product_id)
                ->first();
                $order_details->image = $product->main_image;
                $order_details->title = $product->name;
                if ($product->seller_id == 'A') {
                    $order_details->seller_name = "Admin";
                }else{
                    $seller_name = DB::table('user')->where('id',$product->seller_id)->first();
                    $order_details->seller_name = $seller_name->name;
                }
                $order_details->color_value = null;
                if (!empty($product->color)) {
                    $color = DB::table('color')->where('id',$product->color)->first();
                    $order_details->color_value = $color->value;
                }
                $order_details->order_date = Carbon::parse($product->created_at)->toDayDateTimeString();
            
        }
       
        return view('admin.orders.details_of_order',compact('order_details','user_details','shipping_address'));
        
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

    // public function dispatchOrder($order_details_id)
    // {
    //     try {
    //         $order_details_id = decrypt($order_details_id);
    //     }catch(DecryptException $e) {
    //         return redirect()->back();
    //     }

    //     return view('admin.orders.dispatch_orders',compact('order_details_id'));
    // }

    public function dispatchOrderUpdate($order_details_id,$awb_no)
    {

        $update_order_status = DB::table('order_details')
        ->where('id',$order_details_id)
        ->update([
            'order_status' => 2,
            'consignment_no' => $awb_no,
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
                    ->where('id',$order_id)
                    ->update([
                        'status' => 2,
                        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    ]);
            }
            return redirect()->route('admin.order_details',['order_id'=>encrypt($order_id)]);
        }else{
            return redirect()->back();
        }
    }
}
