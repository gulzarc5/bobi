<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Seller;
use DB;
use Auth;

class SellerController extends Controller
{
    public function sellerRegistration(Request $request)
    {
    	$validatedData = $request->validate([
	        'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:seller'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'mobile' =>  ['required','digits:10','numeric','unique:seller'],
        ]);

        $seller = Seller::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'mobile' => $request->input('mobile'),
        ]);


        if ($seller) {

            $seller_id = $seller->id;

            $seller_details = DB::table('seller_details')
            ->insert([
                'seller_id' => $seller_id,
            ]);

            $bank_details = DB::table('seller_bank')
            ->insert([
                'seller_id' => $seller_id,
            ]);


        	return redirect()->route('seller_login')->with('message','Thank You For Registering With Us Please Login To See The Action');
        }else{
        	return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }
    }

    public function index(){
        return view('seller.seller_deshboard');
    }

    public function myProfileForm()
    {
        $seller_id = Auth::guard('seller')->user()->id;
        $seller = DB::table('seller')
        ->select('seller.name as name','seller.email as email', 'seller.mobile as mobile','seller_details.dob as dob','seller_details.pan as pan', 'seller_details.gst as gst','seller_details.gender as gender','seller_details.state_id as state', 'seller_details.city_id as city','seller_details.pin as pin','seller_details.address as address','seller_bank.bank_name as bank_name','seller_bank.branch_name as branch_name','seller_bank.account as account','seller_bank.ifsc as ifsc','seller_bank.micr as micr')
        ->join('seller_bank','seller.id','=','seller_bank.seller_id')
        ->join('seller_details','seller.id','=','seller_details.seller_id')
        ->where('seller.id',$seller_id)
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

        $seller = DB::table('seller')
        ->where('id',$seller_id)
        ->update([
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
        ]);

        $seller_details = DB::table('seller_details')
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
        ]);

         $seller_bank = DB::table('seller_bank')
        ->where('seller_id',$seller_id)
        ->update([
            'bank_name' => $request->input('bank_name'),
            'branch_name' => $request->input('branch_name'),
            'account' => $request->input('account_no'),
            'ifsc' => $request->input('ifsc'),
            'micr' => $request->input('micr'),
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
            'new_password' => ['required', 'string', 'min:8','same:new_password'],
            'confirm_password' => ['required', 'string', 'min:8', 'same:new_password'],
        ]);

        $current_password = Auth::guard('seller')->user()->password;   

        if(Hash::check($request->input('current_password'), $current_password)){           
            $user_id = Auth::guard('seller')->user()->id; 
            $password_change = DB::table('seller')
            ->where('id',$user_id)
            ->update([
                'password' => Hash::make($request->input('confirm_password')),
            ]);

            return redirect()->back()->with('message','Your Password Changed Successfully');
            
        }else{           
            return redirect()->back()->with('error','Sorry Current Password Does Not matched');
       }
    }
    
}
