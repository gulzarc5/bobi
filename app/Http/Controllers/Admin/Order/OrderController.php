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
        return view('admin.orders.all_orders');
    }

    public function ajaxOrderListAll()
    {
        $query = DB::table('orders')
            ->select('orders.*','user.name as u_name')
            ->join('user','user.id','=','orders.user_id')
            ->orderBy('orders.id','desc');

            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '
                   <a href="#" class="btn btn-info btn-sm" target="_blank">View</a>';
                   if ($row->status == '1') {
                       $btn .= '<a href="'.route('admin.product_status_update', [encrypt($row->id),encrypt(2)]).'" class="btn btn-danger btn-sm">Disable</a>';
                        return $btn;
                    }else{
                       $btn .= '<a href="'.route('admin.product_status_update', [encrypt($row->id),encrypt(1)]).'" class="btn btn-success btn-sm">Enable</a>';
                        return $btn;
                    }
                    return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
