<?php

namespace App\Http\Controllers\Web\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ProductController extends Controller
{
    public function productSellerWithSecondCategory($second_category)
    {
    	return view('web.product.product_saller');
    }
}
