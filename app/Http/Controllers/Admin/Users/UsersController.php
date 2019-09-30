<?php

namespace App\Http\Controllers\Admin\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class UsersController extends Controller
{
    public function allSellers()
    {
    	return view('admin.users.seller_list');
    }

    public function ajaxAllSellers()
    {
    	$query = DB::table('user')        
        ->whereNull('deleted_at')
        ->where('user_role',2);
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '
                   <a href="'.route('admin.seller_view',['seller_id'=>encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank">View</a>';
                   if ($row->verification_status == 2 && $row->seller_deal_status == 2) {
                     $btn .= '<a href="'.route('admin.seller_view',['seller_id'=>encrypt($row->id)]).'" class="btn btn-warning btn-sm" target="_blank">Verify</a>';
                   }
                    if ($row->status == 1) {  
                        $btn .= '<a href="'.route('admin.sellerUpdateStatus',['seller_id'=>encrypt($row->id),'status'=>encrypt(2)]).'" class="btn btn-danger btn-sm">DeActivate</a>';
                    }else{
                        $btn .= '<a href="'.route('admin.sellerUpdateStatus',['seller_id'=>encrypt($row->id),'status'=>encrypt(1)]).'" class="btn btn-primary btn-sm">Activate</a>';
                    }
                    
             
                    return $btn;
            })
            ->addColumn('status_tab', function($row){
                if ($row->status == 1) {
                    $btn = '<a href="#" class="btn btn-success btn-sm">Enabled</a>';
                }else{
                    $btn = '<a href="#" class="btn btn-danger btn-sm">Disabled</a>';
                }
                return $btn;
            })
            ->addColumn('verification_status', function($row){
                if ($row->verification_status == 3 && $row->seller_deal_status == 3) {
                    $btn = '<a href="#" class="btn btn-success btn-sm">Verified</a>';
                }elseif ($row->verification_status == 2 && $row->seller_deal_status == 2) {
                     $btn = '<a href="#" class="btn btn-warning btn-sm">Under Review</a>';
                }else{
                    $btn = '<a href="#" class="btn btn-danger btn-sm">Details Not Set</a>';
                }
                return $btn;
            })
            ->rawColumns(['action','status_tab','verification_status'])
            ->toJson();
    }

    public function allBuyers()
    {
    	return view('admin.users.buyer_list');
    }

    public function ajaxAllBuyers()
    {
    	$query = DB::table('seller')        
        ->whereNull('deleted_at')
        ->where('user_role',1);
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '
                   <a href="#" class="btn btn-info btn-sm" target="_blank">View</a>
                   <a href="#" class="btn btn-warning btn-sm">Verify</a>   
                   <a href="#" class="btn btn-warning btn-sm">Active</a>';
             
                    return $btn;
            })
            ->addColumn('status_tab', function($row){

                   $btn = '<a href="#" class="btn btn-success btn-sm">Enabled</a>';
                    return $btn;
            })
            ->rawColumns(['action','status_tab'])
            ->toJson();
    }

    public function sellerView($seller_id)
    {
        try {
            $seller_id = decrypt($seller_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $seller = DB::table('user')
        ->select('user.id as seller_id','user.name as name','user.verification_status as verification_status','user.seller_deal_status as seller_deal_status','user.email as email', 'user.mobile as mobile','user_details.dob as dob','user_details.pan as pan', 'user_details.gst as gst','user_details.gender as gender','user_details.state_id as state', 'user_details.city_id as city','user_details.pin as pin','user_details.address as address','seller_bank.bank_name as bank_name','seller_bank.branch_name as branch_name','seller_bank.account as account','seller_bank.ifsc as ifsc','seller_bank.micr as micr')
        ->join('seller_bank','user.id','=','seller_bank.seller_id')
        ->join('user_details','user.id','=','user_details.seller_id')
        ->where('user.id',$seller_id)
        ->first();

        $state = DB::table('state')->whereNull('deleted_at')->get();

        $city = null;
        if (!empty($seller->state)) {
            $city = DB::table('city')
            ->where('state_id',$seller->state)
            ->get();
        }
        
        $dealing_category = DB::table('seller_deals')
                ->select('seller_deals.*', 'category.name as category_name','first_category.name as f_cat_name')
                ->join('category','category.id','=','seller_deals.category_id')
                ->join('first_category','first_category.id','=','seller_deals.first_category_id')
                ->where('seller_deals.seller_id',$seller_id)
                ->whereNull('seller_deals.deleted_at')->get();

        return view('admin.users.user_details',compact('seller','state','city','dealing_category'));
    }

    public function sellerUpdateVerification($seller_id)
    {
        try {
            $seller_id = decrypt($seller_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $seller_update = DB::table('user')
        ->where('id',$seller_id)
        ->update([
            'verification_status' => 3,
            'seller_deal_status' => 3,
        ]);
        return redirect()->back();
    }

    public function sellerUpdateStatus($seller_id,$status)
    {
        try {
            $seller_id = decrypt($seller_id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $seller_update = DB::table('user')
        ->where('id',$seller_id)
        ->update([
            'status'=>$status,
        ]);
        return redirect()->back();
    }
}
