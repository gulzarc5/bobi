<?php
namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromArray;
use DB;

class ProcessingOrders implements FromArray
{
    public function array(): array
    {
        $query =DB::table('order_details')
            ->select('order_details.*','user.name as u_name','user.mobile as u_mobile','orders.payment_status as pay_status')
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
            ->get();

        $data[] = ['Waybill','Reference No','Consignee Name','City','State','Country','Address','Pincode','Phone','Mobile','Weight','Payment Mode','Package Amount','Cod Amount','Product to be Shipped','Return Address','Return Pin','Seller Name','Seller Address','Seller CST No','Seller TIN','Invoice No','Invoice Date','Quantity','Commodity Value','Tax Value','Category of Goods','Seller_GST_TIN','HSN_Code','Return Reason','Vendor Pickup Location','EWBN']; 
        foreach ($query as $key => $value) {
            $shipping_address = DB::table('shipping_address')
                ->select('shipping_address.*','state.name as s_name','city.name as c_name')
                ->leftjoin('state','state.id','=','shipping_address.state_id')
                ->leftjoin('city','city.id','=','shipping_address.city_id')
                ->where('shipping_address.id',$value->shipping_address_id)
                ->first();
            $user_details =  DB::table('user_details')->where('seller_id',$value->user_id)->first();
            $payment_method = null;
            $package_amount = $value->total;
            $cod_amount = 0;
            if ($value->payment_method == '1') {
                $payment_method = 'COD';
                $cod_amount = $value->total;
            } else {
                $payment_method = 'prepaid';
                
            }
            $seller_name = ' BIBIBOBI MARKET SERVICES (OPC) PVT LTD';
            $seller_address = 'House No. 453, Halwa Gaon, Dhekial, Golaghat, Golaghat, Assam - 785621';
            if ($value->seller_id != 'A') {
                $seller_address_fetch = DB::table('user')
                    ->select('state.name as s_name','city.name as c_name','user.name as u_name','user_details.*')
                    ->leftjoin('user_details','user_details.seller_id','=','user.id')
                    ->leftjoin('state','state.id','=','user_details.state_id')
                    ->leftjoin('city','city.id','=','user_details.city_id')
                    ->where('user.id',$value->seller_id)
                    ->first();
                $seller_name =  $seller_address_fetch->s_name;
                $seller_address = $seller_address_fetch->address.','.$seller_address_fetch->c_name.','.$seller_address_fetch->s_name;    
            }

            $return_address = $shipping_address->address.",".$shipping_address->c_name.",".$shipping_address->s_name;
            $data[] = [ null,$value->id, $value->u_name,$shipping_address->c_name,$shipping_address->s_name,'India',$shipping_address->address,$user_details->pin,$value->u_mobile,$value->u_mobile,null,$payment_method,$package_amount,$cod_amount,'Clothing',$seller_address,$shipping_address->pin,$seller_name,$seller_address,null,null,null,null,$value->quantity,];
        }
        return $data;
    }
}