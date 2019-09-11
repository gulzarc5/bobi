<?php

namespace App\Http\Controllers\Web\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CategoryController extends Controller
{
    public function index()
    {
    	 return view('web.index');
    }

    public function SecondCategory($first_Catgory)
    {
    	try{
            $first_Catgory = decrypt($first_Catgory);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $first_category = DB::table('first_category')->where('id',$first_Catgory)->first();

        $second_category = DB::table('second_category')
            ->where('first_category_id',$first_category->id)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->get();

    	return view('web.product.product_subcategory',compact('first_category','second_category'));
    }
}
