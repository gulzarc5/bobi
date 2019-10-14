<?php

namespace App\Http\Controllers\Seller\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Support\Facades\DB;
use Auth;
use Intervention\Image\Facades\Image;
use File;
use Carbon\Carbon;

class ProductController extends Controller
{
    // Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString();
    public function viewProductAddForm()
    {
        $seller_id = Auth::guard('seller')->user()->id;

        $seller_category = DB::table('seller_deals')
            ->where('seller_id',$seller_id)
            ->whereNull('deleted_at')
            ->distinct()
            ->get(['category_id']);
        // dd($seller_category);
        $category_list = [];
        foreach ($seller_category as $category) {
            $cat = DB::table('category')
            ->where('status','1')
            ->whereNull('deleted_at')
            ->where('id',$category->category_id)
            ->first();
            $category_list[] = [
                'id' => $cat->id,
                'name' => $cat->name,
            ];
        }
    	return view('seller.products.add_product_form',compact('category_list'));
    }

    public function addNewProduct(Request $request)
    {
      
        $validatedData = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'first_category' => 'required',
            'second_category' => 'required',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $seller_id = Auth::guard('seller')->id();
        $name = $request->input('name');
        $tag_name = $request->input('tag_name');
        $size_wearing = $request->input('size_wearing');
        $fit_wearing = $request->input('fit_wearing');
        $category = $request->input('category');
        $first_category = $request->input('first_category');
        $second_category = $request->input('second_category');
        $brand = $request->input('brand');
        $color = $request->input('color'); ///This Is An Array Of Color


        $size = $request->input('size'); ///This Is An Array Of Size Value
        $mrp = $request->input('mrp'); ///This Is An Array Of MRP Against Size
        $price = $request->input('price'); ///This Is An Array Of price Against Size
        $stock = $request->input('stock'); ///This Is An Array Of stock Against Size

        $image = $request->file('image');
        $short_description = $request->input('short_description');
        $long_description = $request->input('long_description');

        $brand_fetch = DB::table('seller_deals')
            ->select('id')
            ->where('seller_id',$seller_id)
            ->where('first_category_id',$first_category)
            ->first();

        $product_insert = DB::table('products')
        ->insertGetId([
            'name' => $name,
            'tag_name' => $tag_name,
            'size_wearing' => $size_wearing,
            'fit_wearing' => $fit_wearing,
            'brand_id' => $brand_fetch->id,
            'seller_id' => $seller_id,
            'category' => $category,
            'first_category' => $first_category,
            'second_category' => $second_category,
            'short_description' => $short_description,
            'long_description' => $long_description,
            'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
        ]);

        if ($product_insert) {
            $product_id = $product_insert; 

            //*******************Insert Color**************
            foreach ($color as $colors) {
                if (!empty($colors)) {
                    $check_colors = DB::table('product_colors')
                        ->where('product_id',$product_id)
                        ->where('color_id',$colors)
                        ->count();
                    if ($check_colors <=0 ) {
                        $color_insert = DB::table('product_colors')
                            ->insert([
                                'product_id' => $product_id,
                                'color_id' => $colors,
                                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                            ]);
                    }                    
                }                
            }


            //*******************Insert Product Sizes**************
            for ($i=0; $i <count((array)$size) ; $i++) {
                if (!empty($size[$i]) && !empty($price[$i])) {
                    $check_size =  DB::table('product_sizes')
                        ->where('product_id',$product_id)
                        ->where('size_id',$size[$i])
                        ->count();
                    if ($check_size <= 0 ) {
                        $sizes_insert = DB::table('product_sizes')
                            ->insert([
                                'product_id' => $product_id,
                                'size_id' => $size[$i],
                                'mrp' => $mrp[$i],
                                'price' => $price[$i],
                                'stock' => $stock[$i],
                                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                            ]);
                    }
                }                
            }

            $product_price_update = DB::table('products')
            ->where('id',$product_id)
            ->update([
                'min_price' => DB::raw('(SELECT min(price) FROM product_sizes WHERE product_id ='.$product_id.')'),
            ]);
            //*****************insert Product Images******************
            if($request->hasfile('image'))
            {
                $image_count = 1;
                $image_array = $request->file('image');

                foreach($image_array as $image)
                {
                    // $image = $request->file('img');
                    $destination = base_path().'/public/images/product/';
                    $image_extension = $image->getClientOriginalExtension();
                    $image_name = md5(date('now').time()).uniqid('img')."."."$image_extension";
                    $original_path = $destination.$image_name;
                    Image::make($image)->save($original_path);
                    $thumb_path = base_path().'/public/images/product/thumb/'.$image_name;
                    Image::make($image)
                    ->resize(300, 400)
                    ->save($thumb_path);

                    if ($image_count == 1) {
                        $product_update = DB::table('products')
                        ->where('id', $product_id)
                        ->update(['main_image' => $image_name]);
                    }

                    $product_insert = DB::table('product_image')
                    ->insert([
                        'product_id' => $product_id,
                        'image' => $image_name,
                    ]);
                    $image_count++;
                }
            }

            return redirect()->back()->with('message','Product Added Successfully');
        }else{
             return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }

    }


   public function productList()
   {
    	return view('seller.products.product_list');
   }

    public function ajaxGetProductList()
    {
    	$seller_id = Auth::guard('seller')->id();       
        $query = DB::table('products')
        ->select('products.*','category.name as c_name','first_category.name as first_c_name','second_category.name as second_c_name','brand_name.name as brand_name')
        ->join('category','products.category','=','category.id')
        ->join('first_category','products.first_category','=','first_category.id')
        ->join('second_category','products.second_category','=','second_category.id')
        ->join('brand_name','products.brand_id','=','brand_name.id')
        ->where('products.seller_id',$seller_id)
        ->whereNull('products.deleted_at');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '
                   <a href="'.route('seller.product_view', [encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank">View</a>
                   <a href="'.route('seller.product_edit', [encrypt($row->id)]).'" class="btn btn-warning btn-sm">Edit</a>   
                   <a href="'.route('seller.product_images', [encrypt($row->id)]).'" class="btn btn-warning btn-sm">Images</a>
                   <a href="'.route('seller.product_sizes', [encrypt($row->id)]).'" class="btn btn-warning btn-sm">Sizes</a> 
                   <a href="'.route('seller.product_Color_edit', [encrypt($row->id)]).'" class="btn btn-warning btn-sm">Colors</a>                  
                   ';
                   if ($row->status == '1') {
                       $btn .= '<a href="'.route('seller.product_status_update', [encrypt($row->id),encrypt(2)]).'" class="btn btn-danger btn-sm">Disable</a>';
                        return $btn;
                    }else{
                       $btn .= '<a href="'.route('seller.product_status_update', [encrypt($row->id),encrypt(1)]).'" class="btn btn-success btn-sm">Enable</a>';
                        return $btn;
                    }
                    return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();
    }



    public function productView($product_id)
    {
        try {
            $product_id = decrypt($product_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $product = DB::table('products')
        ->select('products.*','category.name as c_name','first_category.name as first_c_name','second_category.name as second_c_name','brand_name.name as brand_name')
        ->join('category','products.category','=','category.id')
        ->join('first_category','products.first_category','=','first_category.id')
        ->join('second_category','products.second_category','=','second_category.id')
        ->join('brand_name','products.brand_id','=','brand_name.id')
        ->where('products.id','=',$product_id)
        ->first();

        $sizes = DB::table('product_sizes')
        ->select('product_sizes.*','sizes.name as s_name')
        ->join('sizes','product_sizes.size_id','=','sizes.id')
        ->where('product_sizes.product_id',$product_id)
        ->whereNull('product_sizes.deleted_at')
        ->get();

        $colors = DB::table('product_colors')
        ->select('product_colors.*','color.name as c_name','color.value as c_value')
        ->join('color','product_colors.color_id','=','color.id')
        ->where('product_colors.product_id',$product_id)
        ->whereNull('product_colors.deleted_at')
        ->get();

        return view('seller.products.product_details',compact('product','sizes','colors'));
    }

    public function productEdit($product_id)
    {
        try {
            $product_id = decrypt($product_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $category = DB::table('category')
        ->where('status','1')
        ->whereNull('deleted_at')
        ->get();

        $product = DB::table('products')
        ->where('id',$product_id)
        ->first();

        $first_category = DB::table('first_category')
        ->where('status','1')
        ->where('category_id',$product->category)
        ->whereNull('deleted_at')
        ->get();

        $second_category = DB::table('second_category')
        ->where('status','1')
        ->where('first_category_id',$product->first_category)
        ->whereNull('deleted_at')
        ->get();

        // $brands = DB::table('brand_name')
        // ->where('brand_name.category',$product->category)
        // ->where('brand_name.first_category',$product->first_category)
        // ->where('brand_name.status','1')
        // ->whereNull('brand_name.deleted_at')
        // ->get();

        return view('seller.products.edit_product',compact('category','product','first_category','second_category'));
    }

    public function AjaxGetBrandFirstCategory($first_category)
    {
       $brands = DB::table('brand_name')->where('first_category',$first_category)->whereNull('deleted_at')->get();
       return $brands;
    }

   	public function productUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'name' => 'required',
            'category' => 'required',
            'first_category' => 'required',
            'second_category' => 'required',
            // 'brand' => 'required',
        ]);

        try {
            $product_id = decrypt($request->input('product_id'));
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        
        $product_update = DB::table('products')
        ->where('id',$product_id)
        ->update([
            'name' => $request->input('name'),
            'tag_name' => $request->input('tag_name'),
            'size_wearing' => $request->input('size_wearing'),
            'fit_wearing' => $request->input('fit_wearing'),
            'category' => $request->input('category'),
            'first_category' => $request->input('first_category'),
            'second_category' => $request->input('second_category'),
            // 'brand_id' => $request->input('brand'),
            'short_description' => $request->input('short_description'),
            'long_description' => $request->input('long_description'),
        ]);

        if ($product_update) {
            return redirect()->route('seller.product_edit', encrypt($product_id))->with('message','Product Updated Successfully');
        }else{
            return redirect()->route('seller.product_edit', encrypt($product_id))->with('error','Something Went Wrong Please try Again');
        } 

    }


    public function productImages($product_id)
    {
        try {
            $product_id = decrypt($product_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $product = DB::table('products')
        ->where('id',$product_id)
        ->first();

        $image = DB::table('product_image')
        ->where('product_id',$product_id)
        ->whereNull('deleted_at')
        ->get();

        return view('seller.products.images',compact('product','image'));
    }

    public function productSetThumb($product_id,$image_id)
    {
        try {
            $product_id = decrypt($product_id);
            $image_id = decrypt($image_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

         $image = DB::table('product_image')
        ->where('id',$image_id)
        ->whereNull('deleted_at')
        ->first();

        $product_update =  DB::table('products')
        ->where('id',$product_id)
        ->update([
            'main_image' => $image->image,
        ]);

        if ($product_update) {
            return redirect()->route('seller.product_images', encrypt($product_id))->with('message','Product Thumb Successfully');
        }else{
            return redirect()->route('seller.product_images', encrypt($product_id))->with('error','Something Went Wrong Please try Again');
        } 
    }

    public function productUpdateImageStatus($product_id,$image_id,$status)
    {
        try {
            $product_id = decrypt($product_id);
            $status = decrypt($status);
            $image_id = decrypt($image_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $image = DB::table('product_image')
        ->where('id',$image_id)
        ->update([
            'status'=> $status,
        ]);

        if ($image) {
            return redirect()->route('seller.product_images', encrypt($product_id))->with('message','Image Status Changed Successfully');
        }else{
            return redirect()->route('seller.product_images', encrypt($product_id))->with('error','Something Went Wrong Please try Again');
        } 
    }

    public function productDeleteImage($product_id,$image_id)
    {
        try {
            $product_id = decrypt($product_id);
            $image_id = decrypt($image_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $image = DB::table('product_image')
        ->where('id',$image_id)
        ->first();

        $image_delete = DB::table('product_image')
        ->where('id',$image_id)
        ->delete();

        $destination_thumb = base_path().'/public/images/product/thumb/'.$image->image;
        File::delete($destination_thumb);

        $destination = base_path().'/public/images/product/'.$image->image;
        File::delete($destination);

        if ($image_delete) {
            return redirect()->route('seller.product_images', encrypt($product_id))->with('message','Image Status Changed Successfully');
        }else{
            return redirect()->route('seller.product_images', encrypt($product_id))->with('error','Something Went Wrong Please try Again');
        } 

    }

    public function productMoreImageAdd(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $product_id = decrypt($request->input('product_id'));
        }catch(DecryptException $e) {
            return redirect()->back();
        }


        $image_add = false;

        if($request->hasfile('image'))
            {
                $image_array = $request->file('image');
                foreach($image_array as $image)
                {
                    // $image = $request->file('img');
                    $destination = base_path().'/public/images/product/';
                    $image_extension = $image->getClientOriginalExtension();
                    $image_name = md5(date('now').time())."-".$request->input('category_name')."."."$image_extension";
                    $original_path = $destination.$image_name;
                    Image::make($image)->save($original_path);
                    $thumb_path = base_path().'/public/images/product/thumb/'.$image_name;
                    Image::make($image)
                    ->resize(300, 400)
                    ->save($thumb_path);

                    $image_insert = DB::table('product_image')
                    ->insert([
                        'product_id' => $product_id,
                        'image' => $image_name,
                    ]);

                    if ($image_insert) {
                        $image_add = true;
                    }else{
                        $image_add = false;
                    }
                }
            }

        if ($image_add == true) {
             return redirect()->route('seller.product_images', encrypt($product_id))->with('message','Image Added Successfully');
        }else{
            return redirect()->route('seller.product_images', encrypt($product_id))->with('error','Something Went Wrong Please try Again');
        }
    }

    public function productSizes($product_id)
    {
        try {
            $product_id = decrypt($product_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $product = DB::table('products')
        ->where('id',$product_id)
        ->first();
        $product_sizes = DB::table('product_sizes')
            ->where('product_id',$product_id)
            ->whereNull('deleted_at')
            ->get();
        $sizes = DB::table('sizes')
            ->where('category',$product->category)
            ->where('first_category',$product->first_category)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->get();
        return view('seller.products.product_sizes',compact('product_sizes','sizes','product_id'));
    }


    public function productSizeUpdate(Request $request)
    {

        $size_id = $request->input('size_id');
        $size = $request->input('size');
        $mrp = $request->input('mrp');
        $price = $request->input('price');
        $stock = $request->input('stock');
        $product_id = $request->input('product_id');

        if (isset($size_id) && !empty($size_id) && isset($size) && !empty($size)  && isset($price) && !empty($price)) {
            
            $size_check = DB::table('product_sizes')
            ->where('product_id',$request->input('product_id'))
            ->where('size_id',$request->input('size'))
            ->where('id','!=',$size_id)
            ->whereNull('deleted_at')
            ->count();

            if ($size_check > 0) {
                return 4;
            }

            $size_update = DB::table('product_sizes')
            ->where('id',$size_id)
            ->where('product_id',$product_id)
            ->update([
                'size_id' => $size,
                'mrp' => $mrp,
                'price' => $price,
                'stock' => $stock,
            ]);

            $product_price_update = DB::table('products')
                ->where('id',$product_id)
                ->update([
                    'min_price' => DB::raw('(SELECT min(price) FROM product_sizes WHERE product_id ='.$product_id.')'),
                ]);

            if ($size_update) {
               return 2;
            }else{
                return 3;
            }
        }else{
            return 1;
        }
    }

    public function productSizeStatusUpdate($id,$status,$product_id)
    {
        try {
            $size_id = decrypt($id);
            $status = decrypt($status);
            $product_id = decrypt($product_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $size_status_update = DB::table('product_sizes')
        ->where('id',$size_id)
        ->update([
            'status'=>$status,
        ]);

       return redirect()->route('seller.product_sizes', ['product_id' => encrypt($product_id)]);
    }

    public function productNewSizeAdd(Request $request)
    {
        $product_id = $request->input('product_id');
        $size = $request->input('size');
        $mrp = $request->input('mrp');
        $price = $request->input('price');
        $stock = $request->input('stock');


        for ($i=0; $i <count((array)$size) ; $i++) {
            if (!empty($size[$i]) && !empty($price[$i])) {
                $check_size =  DB::table('product_sizes')
                    ->where('product_id',$product_id)
                    ->where('size_id',$size[$i])
                    ->count();
                if ($check_size <= 0 ) {
                    $sizes_insert = DB::table('product_sizes')
                        ->insert([
                            'product_id' => $product_id,
                            'size_id' => $size[$i],
                            'mrp' => $mrp[$i],
                            'price' => $price[$i],
                            'stock' => $stock[$i],
                            'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                        ]);
                }
            }                
        }

        $product_price_update = DB::table('products')
        ->where('id',$product_id)
        ->update([
            'min_price' => DB::raw('(SELECT min(price) FROM product_sizes WHERE product_id ='.$product_id.')'),
        ]);

        return redirect()->route('seller.product_sizes',['product_id' => encrypt($product_id)]);
    }

      public function productColorEdit($product_id)
    {
        try {
            $product_id = decrypt($product_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $product = DB::table('products')
        ->where('id',$product_id)
        ->first();
        $product_id_color_add = $product_id;

        $product_color = DB::table('product_colors')
            ->where('product_id',$product_id)
            ->whereNull('deleted_at')
            ->get();

        $color_options = DB::table('color')
            ->where('category_id',$product->category)
            ->where('first_category_id',$product->first_category)
            ->whereNull('deleted_at')
            ->where('status',1)
            ->get();
        
        return view('seller.products.product_colors_edit',compact('color_options','product_color','product_id_color_add'));

    }

    public function productColorUpdate(Request $request)
    {
        $color_id = $request->input('color_id');
        $product_id = $request->input('product_id');
        $color = $request->input('color');

        if (isset($product_id) && !empty($product_id) && isset($color_id) && !empty($color_id)) {
            $color_update = DB::table('product_colors')
            ->where('id',$color_id)
            ->update([
                'color_id' => $color,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);

            if ($color_update) {
                 return 2;
            }else{
                return 3; 
            }

        }else{
            return 1;
        }
    }

    public function productNewColorAdd(Request $request)
    {
        $product_id = $request->input('product_id');

        if (!isset($product_id) && empty($product_id)) {
             return redirect()->route('admin.product_list');
        }

        $colors = $request->input('color'); //This is an Array of Colors

        for ($i=0; $i < count($colors) ; $i++) { 
           if (!empty($colors[$i])) {
               
               $check_color = DB::table('product_colors')
                ->where('product_id',$product_id)
                ->where('color_id',$colors[$i])
                ->count();

                if ($check_color < 1) {
                    $color_update = DB::table('product_colors')
                    ->insert([
                        'product_id' => $product_id,
                        'color_id' => $colors[$i],
                        'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    ]);
                }
           }
        }

        return redirect()->route('seller.product_Color_edit',['product_id' => encrypt($product_id)]);

    }

    public function productStatusUpdate($product_id,$status)
    {
        try {
            $product_id = decrypt($product_id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $product_status_update = DB::table('products')
        ->where('id',$product_id)
        ->update([
            'status' => $status,
            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
        ]);
        return redirect()->back();
    }

}
