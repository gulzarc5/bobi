<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Seller;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    public function userLoginForm()
	{
		return view('web.login');
	}

	public function myProfileForm()
	{
		$user_id = Auth::guard('buyer')->id();
        $states = DB::table('state')
        ->whereNull('deleted_at')
        ->get();

        $user = DB::table('user')
        ->where('id',$user_id)
        ->first();

        $user_details = DB::table('user_details')
        ->where('seller_id',$user_id)
        ->first();

        $city = null;
        if (!empty($user_details->state_id)) {
            $city = DB::table('city')
            ->where('state_id',$user_details->state_id)
            ->get();
        }
        $user_data = [
            'user' => $user,
            'user_details' => $user_details,
            'city_list' => $city,
		];
		
		$shipping_address = DB::table('shipping_address')
			->where('user_id',$user_id)
			->get();
        // dd(count($shipping_address));
    	return view('web.my_account',compact('user_data','states','city','shipping_address'));
	}

	public function myProfileUpdate(Request $request)
    {
        $user_id = Auth::guard('buyer')->id();
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'dob' => 'required',
            'gender' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pin' => 'required',
        ]);

        $user_update = Seller::where('id',$user_id)
            ->update([
                'name' => $request->input('name'),
            ]);
        $user_profile_update = DB::table('user_details')
        ->where('seller_id',$user_id)
        ->update([
            'state_id' => $request->input('state'),
            'city_id' => $request->input('city'),
            'address' => $request->input('address'),
            'dob' => $request->input('dob'),
            'pin' => $request->input('pin'),
        ]);

        return redirect()->back()->with('message','Your Profile Has Been Updated Successfully');
    }
}
