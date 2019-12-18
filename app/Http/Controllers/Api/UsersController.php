<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Seller;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function userRegistration(Request $request)
    {
        $validator =  Validator::make($request->all(),[
	        'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'same:confirm_password'],
            'mobile' =>  ['required','digits:10','numeric','unique:user'],
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => 'Required Field Can not be Empty',
                'error_code' => true,
                'error_message' => $validator->errors(),
    
            ];    	
            return response()->json($response, 200);
        }

        $seller = Seller::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'mobile' => $request->input('mobile'),
            'user_role' => 1,
        ]);

        if ($seller) {
            $seller_id = $seller->id;
            $seller_details = DB::table('user_details')
            ->insert([
                'seller_id' => $seller_id,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
            $response = [
                'status' => true,
                'message' => 'User Registered Successfully',
                'error_code' => false,
                'error_message' => null,    
            ];    	
            return response()->json($response, 200);
        }else{
        	$response = [
                'status' => false,
                'message' => 'Something Went Wrong Please Try Again',
                'error_code' => false,
                'error_message' => null,    
            ];    	
            return response()->json($response, 200);
        }                 
    }

    public function userLogin(Request $request)
    {
        $user_mobile = $request->input('mobile');
        $user_pass = $request->input('password');
        
        if (!empty($user_mobile) && !empty($user_pass)) {
            $user = Seller::where('mobile',$user_mobile)->first();
            if ($user) {
                if(Hash::check($user_pass, $user->password)){ 
                    $user_update = Seller::where('id',$user->id)
                        ->update([
                        'api_token' => Str::random(60),
                    ]);
    
                    $user = Seller::where('id',$user->id)->first();
                    $response = [
                        'status' => true,
                        'message' => 'User Logged In Successfully',    
                        'data' => $user,
                    ];    	
                    return response()->json($response, 200);
                }else{
                    $response = [
                        'status' => false,
                        'message' => 'Mobile No or password Wrong',   
                        'data' => null,
                    ];    	
                    return response()->json($response, 200);
                }
            }else{
                $response = [
                    'status' => false,
                    'message' => 'Mobile No or password Wrong',  
                    'data' => null,  
                ];    	
                return response()->json($response, 200);
            }
        }else{
            $response = [
                'status' => false,
                'message' => 'Required Field Can Not be Empty',  
                'data' => null,  
            ];    	
            return response()->json($response, 200);
        }       
    }

    public function userProfile($user_id)
    {
        $user = Seller::where('id',$user_id)
        ->first();

        $user_details = DB::table('user_details')
        ->select('user_details.*','state.name as s_name','city.name as c_name')
        ->leftjoin('state','state.id','=','user_details.state_id')
        ->leftjoin('city','city.id','=','user_details.city_id')
        ->where('seller_id',$user_id)
        ->first();

        if ($user) {
            $data = [
                'user'=>$user,
                'user_details' => $user_details,
            ];
            $response = [
                'status' => true,
                'message' => 'User Details',
                'data' => $data,
            ];    	
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong',
                'data' => [],
            ];    	
            return response()->json($response, 200);
        }
    }

    public function userProfileUpdate(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'dob' => 'required',
            'gender' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pin' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => 'Required Field Can not be Empty',
                'error_code' => true,
                'error_message' => $validator->errors(),    
            ];    	
            return response()->json($response, 200);
        }
        $user_id = $request->input('user_id');
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

        if ($user_update) {
             $response = [
                'status' => true,
                'message' => 'Profile Updated Successfully',
                'error_code' => false,
                'error_message' => null,    
            ];    	
            return response()->json($response, 200);
        } else {
             $response = [
                'status' => false,
                'message' => 'Something Went Wrong Please Try Again',
                'error_code' => false,
                'error_message' => null,    
            ];    	
            return response()->json($response, 200);
        }
    }

    public function userShippingAdd(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'state' => 'required',
            'city' => 'required',
            'pin' => 'required',
            'address' => 'required',
            'mobile' =>  ['required','digits:10','numeric'],
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => 'Required Field Can not be Empty',
                'error_code' => true,
                'error_message' => $validator->errors(),    
            ];    	
            return response()->json($response, 200);
        }
        $user_id = $request->input('user_id');
        $shipping_address = DB::table('shipping_address')
            ->insert([
                'user_id'=>  $user_id,
                'address'=> $request->input('address'),
                'city_id'=> $request->input('city'),
                'state_id'=> $request->input('state'),
                'pin'=> $request->input('pin'),
                'mobile'=> $request->input('mobile'),
                'email'=> $request->input('email'),
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($shipping_address) {
            $response = [
                'status' => true,
                'message' => 'Shipping Address Added SuccessFully',
                'error_code' => false,
                'error_message' => null,    
            ];    	
            return response()->json($response, 200);
        } else {
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong Please Try Again',
                'error_code' => false,
                'error_message' => null,    
            ];
            return response()->json($response, 200);
        }
        
    }

    public function userShippingList($user_id)
    {
        $shipping_address = DB::table('shipping_address')
            ->select('shipping_address.*','city.name as c_name','state.name as s_name')
            ->leftjoin('city','city.id','=','shipping_address.city_id')
            ->leftjoin('state','state.id','=','shipping_address.state_id')
            ->where('shipping_address.user_id',$user_id)
            ->whereNull('shipping_address.deleted_at')
            ->get();
        if ($shipping_address->count() > 0) {
            $response = [
                'status' => true,
                'message' => 'Shipping Address List',
                'data' => $shipping_address,
            ];
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => false,
                'message' => 'No Address Found',
                'data' => [],   
            ];
            return response()->json($response, 200);
        }
    }

    public function userShippingSingleView($user_id,$address_id)
    {
        $shipping_address = DB::table('shipping_address')
        ->select('shipping_address.*','city.name as c_name','state.name as s_name')
        ->leftjoin('city','city.id','=','shipping_address.city_id')
        ->leftjoin('state','state.id','=','shipping_address.state_id')
        ->where('shipping_address.user_id',$user_id)
        ->where('shipping_address.id',$address_id)
        ->first();
        if ($shipping_address) {
            $response = [
                'status' => true,
                'message' => 'Shipping Address',
                'data' => $shipping_address,
            ];
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => false,
                'message' => 'No Address Found',
                'data' => null,   
            ];
            return response()->json($response, 200);
        }
    }

    public function userShippingUpdate(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'state' => 'required',
            'city' => 'required',
            'pin' => 'required',
            'address' => 'required',
            'mobile' =>  ['required','digits:10','numeric'],
            'address_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => 'Required Field Can not be Empty',
                'error_code' => true,
                'error_message' => $validator->errors(),    
            ];    	
            return response()->json($response, 200);
        }

        $shipping_address = DB::table('shipping_address')
        ->where('id',$request->input('address_id'))
            ->update([
                'address'=> $request->input('address'),
                'city_id'=> $request->input('city'),
                'state_id'=> $request->input('state'),
                'pin'=> $request->input('pin'),
                'email'=> $request->input('email'),
                'mobile'=> $request->input('mobile'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($shipping_address) {
            $response = [
                'status' => true,
                'message' => 'Address Updated SuccessFully',
                'error_code' => false,
                'error_message' => null,    
            ];
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong Please Try Again',
                'error_code' => false,
                'error_message' => null,    
            ];
            return response()->json($response, 200);
        }
    }

    public function userChangePassword(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'user_id' => 'required',
            'current_pass' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8', 'same:confirm_password'],
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => 'Required Field Can not be Empty',
                'error_code' => true,
                'error_message' => $validator->errors(),    
            ];    	
            return response()->json($response, 200);
        }

        $user = DB::table('user')->where('id',$request->input('user_id'))->first();
        if ($user) {
            if(Hash::check($request->input('current_pass'), $user->password)){           
                $password_change = DB::table('user')
                ->where('id',$request->input('user_id'))
                ->update([
                    'password' => Hash::make($request->input('confirm_password')),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);

                if ($password_change) {
                    $response = [
                        'status' => true,
                        'message' => 'Password Changed Successfully',
                        'error_code' => false,
                        'error_message' => null,    
                    ];    	
                    return response()->json($response, 200);
                }else{
                    $response = [
                        'status' => false,
                        'message' => 'Something Went Wrong Please Try Again',
                        'error_code' => false,
                        'error_message' => null,    
                    ];    	
                    return response()->json($response, 200);
                }
            }else{           
                $response = [
                    'status' => false,
                    'message' => 'Current Password Does Not Matched',
                    'error_code' => false,
                    'error_message' => null,    
                ];    	
                return response()->json($response, 200);
           }
        } else {
            $response = [
                'status' => false,
                'message' => 'User Not Found Please Try Again',
                'error_code' => false,
                'error_message' => null,    
            ];    	
            return response()->json($response, 200);
        }
    }

    public function userLogout($user_id)
    {
        $password_change = DB::table('user')
                ->where('id',$user_id)
                ->update([
                    'api_token' => null,
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);

        if ($password_change) {
            $response = [
                'status' => true,
                'message' => 'User Logout Successfully',  
            ];    	
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong Please Try Again',
            ];    	
            return response()->json($response, 200);
        }
    }

}
