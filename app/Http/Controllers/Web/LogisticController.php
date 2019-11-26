<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use DB;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Auth;
use Session;

class LogisticController extends Controller
{
    private $apiKey;
    private $baseUrl;

    public function __construct()
    {
        //blockio init
        $this->apiKey = 'e2e1c480236cf73ed9be13dbfd2afc6b7e88d5fd';
        $this->baseUrl = 'https://staging-express.delhivery.com/';
    }

    public function pinAvailiblity($pin = null)
    {
        if (empty($pin)) {
            if (Session::has('pin') && !empty(Session::get('pin'))) {
                $pin = Session::get('pin');
                
            }elseif ( Auth::guard('buyer')->user() && !empty(Auth::guard('buyer')->user()->id)) {
                $shipping_address = DB::table('shipping_address')
                    ->where('user_id',Auth::guard('buyer')->user()->id)
                    ->whereNull('deleted_at')
                    ->orderBy('id','desc')
                    ->limit(1)
                    ->first();
                $pin = $shipping_address->pin;
                if (empty($pin)) {
                    return 0 ;
                }
            }else{
                return 0;
            }
           
        }
        if(!empty($pin)){
            $check = DB::table('delhivery_pin_code')->where('pin_code',$pin)->count();
            if ($check > 0) {
                $pin_chk = DB::table('delhivery_pin_code')->where('pin_code',$pin)->first();
                Session::put('pin', $pin);
                return response()->json($pin_chk, 200);
            }else{
                return 1;
            }

        }else{
            return 0 ;
        }
    }

    public function pinAvailiblityApi($pin = null)
    {
        
        if (empty($pin)) {
            if (Session::has('pin') && !empty(Session::get('pin'))) {
                $pin = Session::get('pin');
                
            }elseif ( Auth::guard('buyer')->user() && !empty(Auth::guard('buyer')->user()->id)) {
                $shipping_address = DB::table('shipping_address')
                    ->where('user_id',Auth::guard('buyer')->user()->id)
                    ->whereNull('deleted_at')
                    ->orderBy('id','desc')
                    ->limit(1)
                    ->first();
                $pin = $shipping_address->pin;
                if (empty($pin)) {
                    return 0 ;
                }
            }else{
                return 0;
            }
           
        }
        if(!empty($pin)){
            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => $this->baseUrl,
                // You can set any number of default request options.
                'timeout'  => 2.0,
            ]);
    
            try {
                $response = $client->request('GET', '/c/api/pin-codes/json/', [
                    'headers' => [
                        'Accept'     => 'application/json',
                    ],
                    'query'      => ['token' =>$this->apiKey ,'filter_codes'=>$pin]
                ]);
                
                if ($response->getStatusCode() == 200) {
                   $data =  json_decode($response->getBody(),true);
                
                   if (count($data['delivery_codes']) > 0 ) {
                       return $data;
                   }else{
                       return 1;
                   }
                }else{
                    return 0;
                }
            } catch (RequestException $e) {
                // echo Psr7\str($e->getRequest());
                // if ($e->hasResponse()) {
                //     echo Psr7\str($e->getResponse());
                // }
                return 0;
            }
        }else{
            return 0 ;
        }
       
    }
    

}
