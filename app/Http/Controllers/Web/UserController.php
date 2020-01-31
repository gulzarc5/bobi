<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Seller;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use SmsHelpers;

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
            ->whereNull('deleted_at')
            ->get();
        foreach ($shipping_address as $key => $value) {
            $value->cities = DB::table('city')
            ->where('state_id',$value->state_id)
            ->get();
        }  
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

    public function shippingAdd(Request $request)
    {
        $user_id = Auth::guard('buyer')->id();
        $validatedData = $request->validate([
            'state' => 'required',
            'city' => 'required',
            'pin' => 'required',
            'address' => 'required',
        ]);

        $shipping_address = DB::table('shipping_address')
            ->insert([
                'user_id'=>  $user_id,
                'address'=> $request->input('address'),
                'city_id'=> $request->input('city'),
                'state_id'=> $request->input('state'),
                'pin'=> $request->input('pin'),
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($shipping_address) {
            return 1;
        }else{
            return 2;
        }
    }

    public function shippingAddCheckout(Request $request)
    {
        $user_id = Auth::guard('buyer')->id();
        $validatedData = $request->validate([
            'state' => 'required',
            'city' => 'required',
            'pin' => 'required',
            'address' => 'required',
        ]);

        $shipping_address = DB::table('shipping_address')
            ->insert([
                'user_id'=>  $user_id,
                'address'=> $request->input('address'),
                'city_id'=> $request->input('city'),
                'state_id'=> $request->input('state'),
                'pin'=> $request->input('pin'),
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        return redirect()->back();
    }
    
    public function updateShippingAddress(Request $request)
    {
        $validatedData = $request->validate([
            'state' => 'required',
            'city' => 'required',
            'pin' => 'required',
            'address' => 'required',
            'address_id' => 'required',
        ]);

        $shipping_address = DB::table('shipping_address')
        ->where('id',$request->input('address_id'))
            ->update([
                'address'=> $request->input('address'),
                'city_id'=> $request->input('city'),
                'state_id'=> $request->input('state'),
                'pin'=> $request->input('pin'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($shipping_address) {
            return 1;
        }else{
            return 2;
        }
    }

    public function DeleteShippingAddress($address_id)
    {
        try{
            $address_id = decrypt($address_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        DB::table('shipping_address')
            ->where('id',$address_id)
            ->update([
                'deleted_at'=>Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        return redirect()->back();
    }

    public function ChangePassword(Request $request)
    {
        $validatedData = $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'string', 'min:8', 'same:new_password'],
        ]);

        $current_password = Auth::guard('buyer')->user()->password;   

        if(Hash::check($request->input('current_password'), $current_password)){           
            $user_id = Auth::guard('buyer')->user()->id; 
            $password_change = DB::table('user')
            ->where('id',$user_id)
            ->update([
                'password' => Hash::make($request->input('confirm_password')),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);

            return 1;
            
        }else{           
            return 2;
       }
    }

    public function AddWishList($product_id)
    {
        try{
            $product_id = decrypt($product_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $user_id = Auth::guard('buyer')->user()->id;   
        $color = null;
        $size_id = null;
        if (empty($size_id)) {
            $size = DB::table('product_sizes')
            ->where('price','=',DB::raw('(SELECT min(price) FROM product_sizes WHERE product_id ='.$product_id.')'))
            ->where('product_id',$product_id)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->first(); 
            $size_id = $size->size_id;
        }
        if (empty($color)) {
            $colors = DB::table('product_colors')
            ->where('product_id',$product_id)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->first(); 
            $color = $colors->color_id;
        }

        $check_wish_list = DB::table('wish_list')
            ->where('user_id',$user_id)
            ->where('product_id',$product_id)
            ->count();
        
        if ($check_wish_list < 1) {
            DB::table('wish_list')
            ->insert([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'size_id' => $size_id,
                'color_id' => $color,
                'quantity' => 1,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        }        
        return redirect()->back();
    }

    public function viewWishList()
    {
        $user_id = Auth::guard('buyer')->user()->id;
        $wish_data = [];

        $wish_list = DB::table('wish_list')->where('user_id',$user_id)->get();
        if (count($wish_list) > 0) {
            foreach ($wish_list as $key => $item) {
                $product = DB::table('products')->where('id',$item->product_id)
                    ->whereNull('deleted_at')
                    ->where('status',1)
                    ->first();
                
                $size = DB::table('product_sizes')
                    ->select('product_sizes.*','sizes.name as size_name')
                    ->join('sizes','sizes.id','=','product_sizes.size_id')
                    ->where('size_id',$item->size_id)
                    ->where('product_id',$item->product_id)
                    ->first();
                
                $color = DB::table('color')
                    ->where('id',$item->color_id)
                    ->first();

                $wish_data[] = [
                    'wish_id' => $item->id,
                    'product_id' => $product->id,
                    'title' => $product->name,
                    'image' => $product->main_image,
                    'quantity' => $item->quantity,
                    'color_name' => $color->name,
                    'color_value' => $color->value,
                    'size' => $size->size_name,
                    'price' => $size->price,
                    'mrp' => $size->mrp,
                   ];
            }
        }else{
            $wish_data = false;
        }
        // dd($wish_data);
        return view('web.wishlist',compact('wish_data'));
    }

    public function deleteWishList($wish_list_id)
    {
        try{
            $wish_list_id = decrypt($wish_list_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        DB::table('wish_list')
        ->where('id',$wish_list_id)
        ->delete();
        return redirect()->back();
    }

    public function wishListMove($wish_list_id)
    {
        try{
            $wish_list_id = decrypt($wish_list_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $user_id = Auth::guard('buyer')->user()->id;
        $wish_list = DB::table('wish_list')->where('id',$wish_list_id)->first();
        
        $check_cart_product = DB::table('cart')
                ->where('product_id',$wish_list->product_id)
                ->where('user_id',$user_id)
                ->count();


        if ($check_cart_product < 1 ) {
            // dd($check_cart_product);
            DB::table('cart')->insert([
                'product_id' =>  $wish_list->product_id,
                'user_id' => $user_id,
                'color_id' => $wish_list->color_id,
                'quantity' => $wish_list->quantity,
                'size_id' => $wish_list->size_id,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        }

        $wish_list = DB::table('wish_list')->where('id',$wish_list_id)->delete();
        return redirect()->route('web.viewCart');
    }

    public function sendOtp(Request $request)
    {
        $validatedData = $request->validate([
            'mobile' => ['required','min:10'],
        ]);

        $user = DB::table('user')->where('mobile',$request->input('mobile'))->count();
        if ($user) {
            if ($user > 0) {
                $otp = rand(111111,999999);
                DB::table('user')
                ->where('mobile',$request->input('mobile'))
                ->update([
                    'otp' => $otp,
                ]);                
                $request_info = urldecode("Your OTP is $otp . Please Do Not Share This Otp To Any One. Thank you");
                SmsHelpers::smsSend($request->input('mobile'),$request_info);
                return redirect()->route('web.verifyOtp',['mobile'=>encrypt($request->input('mobile'))])->with('message','Your One Time Password Has Been Sent To Your Mobile Number Please Enter OTP To Verify');
            }else {
                return redirect()->back()->with('error','Mobile Number Not Found');
            }
        }else {
            return redirect()->back()->with('error','Mobile Number Not Found');
        }
    }

    public function resendOtp($mobile)
    {
        try{
            $mobile = decrypt($mobile);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $user = DB::table('user')->where('mobile',$mobile)->count();
        
        if ($user) {
            if ($user > 0) {
                $otp = rand(111111,999999);
                DB::table('user')
                ->where('mobile',$mobile)
                ->update([
                    'otp' => $otp,
                ]);                
                $request_info = urldecode("Your OTP is $otp . Please Do Not Share This Otp To Any One. Thank you");
                SmsHelpers::smsSend($mobile,$request_info);
                return redirect()->route('web.verifyOtp',['mobile'=>encrypt($mobile)])->with('message','Your One Time Password Has Been Sent To Your Mobile Number Please Enter OTP To Verify');
            }else {
                return redirect()->back()->with('error','Mobile Number Not Found');
            }
        }else {
            return redirect()->back()->with('error','Mobile Number Not Found');
        }
    }

    public function verifyOtp($mobile)
    {
        try{
            $mobile = decrypt($mobile);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        return view('web.verify_otp',compact('mobile'));
    }

    public function passChangeForgot(Request $request)
    {
        $validatedData = $request->validate([
            'mobile' => ['required','min:10','numeric'],
            'otp' => ['required','numeric','digits:6'],
            'new_pass' => ['required', 'string', 'min:8', 'same:confirm_pass'],
        ]);
        $user = DB::table('user')->where('mobile',$request->input('mobile'))->where('otp',$request->input('otp'))->count();  
 
        if ($user > 0) {
            $password_change = DB::table('user')
                ->where('mobile',$request->input('mobile'))
                ->update([
                    'password' => Hash::make($request->input('confirm_pass')),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
            if ($password_change) {
                return redirect()->route('web.userLoginForm')->with('message','Password Changed Successfully Please Login With Your New Password');
            } else {
                return redirect()->back()->with('error','Please Enter Correct OTP');
            }    

        }else {
            return redirect()->back()->with('error','Please Enter Correct OTP');
        }
    }
}
