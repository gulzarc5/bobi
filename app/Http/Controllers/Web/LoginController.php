<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
use Carbon\Carbon;
use DB;

class LoginController extends Controller
{
    public function buyerLogin(Request $request){
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::guard('buyer')->attempt(['email' => $request->email, 'password' => $request->password,'status' => '1' ])) {
        	//************Check Session Shopping Cart**********************
                 if (Session::has('cart') && !empty(Session::get('cart'))) {
                    $cart = Session::get('cart');
                    if (count($cart) > 0) {
                        foreach ($cart as $product_id => $value) {
                       
                        $color = null;
                        $size_id = null;
                        if ( isset($value['color']) && !empty($value['color'])) {
                            $color = $value['color'];
                        }
                        if ( isset($value['size_id']) && !empty($value['size_id'])) {
                            $size_id = $value['size_id'];
                        }
                        $check_cart_product = DB::table('cart')
                            ->where('product_id',$product_id)
                            ->where('user_id',Auth::guard('buyer')->user()->id)
                            ->count();
                        if ($check_cart_product < 1 ) {
                            DB::table('cart')
                                ->insert([
                                'product_id' =>  $product_id,
                                'user_id' => Auth::guard('buyer')->user()->id,
                                'color_id' => $color,
                                'size_id' => $size_id,
                                'quantity' => $value['quantity'],
                                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                                ]);
                        }
                        }
                    }
                    Session::forget('cart');
                    Session::save();
                 }

            //
            return redirect()->intended('User/my_profile');
        }
        return back()->withInput($request->only('email', 'remember'))->with('login_error','Username or password incorrect');
    }

    public function logout()
    {
        Auth::guard('buyer')->logout();
        return redirect()->route('web.buyerLogin');
    }
}
