<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Seller;
use DB;
use Auth;
use Carbon\Carbon;

class SellerController extends Controller
{
    // Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString();
    
    public function index(){
        return view('seller.seller_deshboard');
    }

    public function myProfileForm()
    {
        $seller_id = Auth::guard('seller')->user()->id;
        $seller = DB::table('user')
        ->select('user.name as name','user.email as email', 'user.mobile as mobile','user_details.dob as dob','user_details.pan as pan', 'user_details.gst as gst','user_details.gender as gender','user_details.state_id as state', 'user_details.city_id as city','user_details.pin as pin','user_details.address as address','seller_bank.bank_name as bank_name','seller_bank.branch_name as branch_name','seller_bank.account as account','seller_bank.ifsc as ifsc','seller_bank.micr as micr')
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
        
        return view('seller.profile.myprofile',compact('seller','state','city'));
    }

    public function sellerUpdate(Request $request)
    {
        $seller_id = Auth::guard('seller')->user()->id;

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mobile' =>  ['required','digits:10','numeric'],
            'pan' => 'required',
            'gst' => 'required',
            'gender' => 'required',
            'pin' => 'required',
            'state' => 'required',
            'city' => 'required',
            'bank_name' => 'required',
            'branch_name' => 'required',
            'account_no' => 'required',
            'ifsc' => 'required',
        ]);

        $seller = DB::table('user')
        ->where('id',$seller_id)
        ->update([
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
        ]);

        $seller_details = DB::table('user_details')
        ->where('seller_id',$seller_id)
        ->update([
            'state_id' => $request->input('state'),
            'city_id' => $request->input('city'),
            'address' => $request->input('address'),
            'pin' => $request->input('pin'),
            'gst' => $request->input('gst'),
            'pan' => $request->input('pan'),
            'dob' => $request->input('dob'),
            'gender' => $request->input('gender'),
            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
        ]);

         $seller_bank = DB::table('seller_bank')
        ->where('seller_id',$seller_id)
        ->update([
            'bank_name' => $request->input('bank_name'),
            'branch_name' => $request->input('branch_name'),
            'account' => $request->input('account_no'),
            'ifsc' => $request->input('ifsc'),
            'micr' => $request->input('micr'),
            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
        ]);

        return redirect()->back();

    }

    public function viewChangePasswordForm()
    {
        return view('seller.profile.change_password');
    }

    public function ChangePassword(Request $request)
    {
        $validatedData = $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'string', 'min:8', 'same:new_password'],
        ]);

        $current_password = Auth::guard('seller')->user()->password;   

        if(Hash::check($request->input('current_password'), $current_password)){           
            $user_id = Auth::guard('seller')->user()->id; 
            $password_change = DB::table('user')
            ->where('id',$user_id)
            ->update([
                'password' => Hash::make($request->input('confirm_password')),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);

            return redirect()->back()->with('message','Your Password Changed Successfully');
            
        }else{           
            return redirect()->back()->with('error','Sorry Current Password Does Not matched');
       }
    }
    
}
