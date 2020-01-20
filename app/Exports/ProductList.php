<?php
namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromArray;
use DB;

class ProductList implements FromArray
{
    public function array(): array
    {
        $query =DB::table('products')
            ->select('products.*','user.name as u_name','category.name as main_category_name','first_category.name as first_category_name','second_category.name as second_category_name')
            ->leftjoin('user','user.id','=','products.seller_id')
            ->leftjoin('category','category.id','=','products.category')
            ->leftjoin('first_category','first_category.id','=','products.first_category')
            ->leftjoin('second_category','second_category.id','=','products.second_category')
            ->orderBy('products.id','desc')
            ->get();

        $data[] = ['Sl No','Product Id','Product Name','Seller Name','Main Category','First Category','Second Category']; 
        $count = 1;
        foreach ($query as $key => $value) {
            $count++;
            $data[] = [ $count, $value->id,  $value->name,  $value->u_name,  $value->main_category_name,$value->first_category_name,$value->second_category_name,];
        }
        return $data;
    }
}