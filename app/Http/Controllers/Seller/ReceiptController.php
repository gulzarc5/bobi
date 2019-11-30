<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use DB;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Auth;

class ReceiptController extends Controller
{
    private $apiKey;
    private $baseUrl;

    public function __construct()
    {
        //blockio init
        $this->apiKey = 'cea16ba7837ec73056cff577c27e92a3f57f1745';
        $this->baseUrl = 'https://track.delhivery.com/';
    }

    public function ReceiptPrint($awb)
    {
        try {
            $awb = decrypt($awb);
        }catch(DecryptException $e) {
            return abort(404);
        }

        if(!empty($awb)){
            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => $this->baseUrl,
                // You can set any number of default request options.
                'timeout'  => 2.0,
            ]);
            
            try {
                $response = $client->request('GET', '/api/p/packing_slip/', [
                    'headers' => [
                        'Accept'     => 'application/json',
                        'authorization' => "Token ".$this->apiKey,
                    ],
                    'query'      => ['wbns'=>$awb]
                ]);
                
                if ($response->getStatusCode() == 200) {
                   $data =  json_decode($response->getBody(),true);
                   if ($data['packages_found'] == 0) {
                      return abort(404);
                   } else {
                    $data = $data['packages'][0];
                    return view('seller.receipt',compact('data'));
                   }                  
                   
                }else{
                    return abort(404);
                }
            } catch (RequestException $e) {
                return abort(404);
            }
        }else{
            return abort(404);
        }
       
    }
    


}
