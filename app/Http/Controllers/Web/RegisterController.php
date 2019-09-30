<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Seller;

class RegisterController extends Controller
{
    // Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString();

    public function sellerRegistrationForm()
    {
        return view('web.seller-register');
    }

    public function Registration(Request $request)
    {
    	$validatedData = $request->validate([
	        'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user'],
            'password' => ['required', 'string', 'min:8', 'same:confirmed'],
            'mobile' =>  ['required','digits:10','numeric','unique:user'],
        ]);

        $seller = Seller::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'mobile' => $request->input('mobile'),
            'user_role' => 2,
        ]);


        if ($seller) {

            $seller_id = $seller->id;

            $seller_details = DB::table('user_details')
            ->insert([
                'seller_id' => $seller_id,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);

            $bank_details = DB::table('seller_bank')
            ->insert([
                'seller_id' => $seller_id,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);


        	return redirect()->route('seller_login')->with('message','Registered Successfully');
        }else{
        	return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }
    }
}
