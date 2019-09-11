<?php

namespace App\Http\Controllers\Seller\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Support\Facades\DB;
use Auth;
use Intervention\Image\Facades\Image;
use File;

class ProductController extends Controller
{
    public function viewProductAddForm()
    {
    	$category = DB::table('category')
    	->where('status','1')
    	->whereNull('deleted_at')
    	->get();
    	return view('seller.products.add_product_form',compact('category'));
    }

    public function addNewProduct(Request $request)
    {
       
        $validatedData = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'first_category' => 'required',
            'second_category' => 'required',
            'brand' => 'required',
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

        $size_name_id = $request->input('size_id'); ///This Is An Array Of Size Name Id
        $size = $request->input('size'); ///This Is An Array Of Size Value
        $mrp = $request->input('mrp'); ///This Is An Array Of MRP Against Size
        $price = $request->input('price'); ///This Is An Array Of price Against Size
        $stock = $request->input('stock'); ///This Is An Array Of stock Against Size


        $varient_name_id = $request->input('varient_name_id');///This Is An Array Of varient_name_id
        $varients_value_id = $request->input('varients');///This Is An Array Of varient_value_id
        $short_description = $request->input('short_description');
        $long_description = $request->input('long_description');
        $image = $request->file('image');


        $product_insert = DB::table('products')
        ->insertGetId([
            'name' => $name,
            'tag_name' => $tag_name,
            'size_wearing' => $size_wearing,
            'fit_wearing' => $fit_wearing,
            'brand_id' => $brand,
            'seller_id' => $seller_id,
            'category' => $category,
            'first_category' => $first_category,
            'second_category' => $second_category,
            'short_description' => $short_description,
            'long_description' => $long_description,
        ]);

        if ($product_insert) {
            $product_id = $product_insert; 

            //*******************Insert Color**************
            foreach ($color as $colors) {
                $color_insert = DB::table('product_colors')
                ->insert([
                    'product_id' => $product_id,
                    'color_id' => $colors,
                ]);
            }

            //*******************Insert Color**************
            for ($i=0; $i <count($varient_name_id) ; $i++) { 
                $varients_insert = DB::table('product_varients')
                ->insert([
                    'product_id' => $product_id,
                    'varient_name_id' => $varient_name_id[$i],
                    'varient_value_id' => $varients_value_id[$i],
                ]);
            }

            //*******************Insert Product Sizes**************
            for ($i=0; $i <count($size_name_id) ; $i++) { 
                $sizes_insert = DB::table('product_sizes')
                ->insert([
                    'product_id' => $product_id,
                    'size_name_id' => $size_name_id[$i],
                    'size_value_id' => $size[$i],
                    'mrp' => $mrp[$i],
                    'price' => $price[$i],
                    'stock' => $stock[$i],
                ]);
            }

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
                    $image_name = md5(date('now').time())."-".$request->input('category_name')."."."$image_extension";
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
                   <a href="'.route('seller.product_varient_edit', [encrypt($row->id)]).'" class="btn btn-warning btn-sm">Varients</a>
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
            ->addColumn('status_tab', function($row){
                if ($row->status == '1') {

                   $btn = '<a href="#" class="btn btn-success btn-sm">Enabled</a>';
                    return $btn;
                }else{

                   $btn = '<a href="#" class="btn btn-danger btn-sm">Disabled</a>';
                    return $btn;
                }
            })
            ->rawColumns(['action','status_tab'])
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
        ->select('product_sizes.*','size_name.name as s_name','size_value.value as s_value')
        ->join('size_name','product_sizes.size_name_id','=','size_name.id')
        ->join('size_value','product_sizes.size_value_id','=','size_value.id')
        ->where('product_sizes.product_id',$product_id)
        ->whereNull('product_sizes.deleted_at')
        ->get();

        $colors = DB::table('product_colors')
        ->select('product_colors.*','color.name as c_name','color.value as c_value')
        ->join('color','product_colors.color_id','=','color.id')
        ->where('product_colors.product_id',$product_id)
        ->whereNull('product_colors.deleted_at')
        ->get();

        $varients = DB::table('product_varients')
        ->select('product_varients.*','varient_name.name as v_name','varient_value.value as v_value')
        ->join('varient_name','product_varients.varient_name_id','=','varient_name.id')
        ->join('varient_value','product_varients.varient_value_id','=','varient_value.id')
        ->where('product_varients.product_id',$product_id)
        ->whereNull('product_varients.deleted_at')
        ->get();

        return view('seller.products.product_details',compact('product','sizes','colors','varients'));
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

        $brands = DB::table('map_brand')
        ->select('brand_name.name as brand_name','map_brand.*')
        ->join('brand_name','map_brand.brand_id','=','brand_name.id')
        ->where('map_brand.category',$product->category)
        ->where('map_brand.first_category',$product->first_category)
        ->where('map_brand.second_category',$product->second_category)
        ->where('map_brand.status','1')
        ->whereNull('map_brand.deleted_at')
        ->get();

        return view('seller.products.edit_product',compact('category','product','first_category','second_category','brands'));
    }

   	public function productUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'name' => 'required',
            'category' => 'required',
            'first_category' => 'required',
            'second_category' => 'required',
            'brand' => 'required',
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
            'brand_id' => $request->input('brand'),
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

       $size_id_fetch = DB::table('add_size')
        ->where('category',$product->category)
        ->where('first_category',$product->first_category)
        ->where('second_category',$product->second_category)
        ->where('status','1')
        ->whereNull('deleted_at')    
        ->distinct()    
        ->get(['size_id']);

        $sizes_options =[];

        foreach ($size_id_fetch as $size_id) {
            $size_name = DB::table('size_name')->where('id',$size_id->size_id)->first();
            // print $size_name->name;
            $sizes_options [$size_name->name] =  DB::table('add_size')
            ->select('size_name.name as size_name','size_value.value as size_value','add_size.*')
            ->join('size_name','add_size.size_id','=','size_name.id')
            ->join('size_value','add_size.size_value_id','=','size_value.id')
            ->where('add_size.category',$product->category)
            ->where('add_size.first_category',$product->first_category)
            ->where('add_size.second_category',$product->second_category)
            ->where('add_size.status','1')
            ->where('add_size.size_id', $size_id->size_id)
            ->whereNull('add_size.deleted_at')
            ->get();
        }


        $product_size_id_fetch = DB::table('product_sizes')
        ->where('product_id',$product_id)
        ->whereNull('deleted_at')    
        ->distinct()    
        ->get(['size_name_id']);

        $sizes =[];
        foreach ($product_size_id_fetch as $product_size_id) {
            $size_name = DB::table('size_name')->where('id',$product_size_id->size_name_id)->first();
            // print $size_name->name;
            $sizes [$size_name->name] =  DB::table('product_sizes')
            ->select('product_sizes.*','size_name.name as s_name','size_value.value as s_value')
            ->join('size_name','product_sizes.size_name_id','=','size_name.id')
            ->join('size_value','product_sizes.size_value_id','=','size_value.id')
            ->where('product_sizes.product_id',$product_id)
            ->where('size_name_id',$size_name->id)
            ->whereNull('product_sizes.deleted_at')
            ->get();
        }


        $size_id_fetch_add = DB::table('add_size')
        ->where('category',$product->category)
        ->where('first_category',$product->first_category)
        ->where('second_category',$product->second_category)
        ->where('status','1')
        ->whereNull('deleted_at')    
        ->distinct()    
        ->get(['size_id']);

        $sizes_add =[];
        foreach ($size_id_fetch_add as $size_id_add) {
            $size_name = DB::table('size_name')->where('id',$size_id_add->size_id)->first();
            // print $size_name->name;
            $sizes_add [$size_name->name] =  DB::table('add_size')
            ->select('size_name.name as size_name','size_value.value as size_value','add_size.*')
            ->join('size_name','add_size.size_id','=','size_name.id')
            ->join('size_value','add_size.size_value_id','=','size_value.id')
            ->where('add_size.category',$product->category)
            ->where('add_size.first_category',$product->first_category)
            ->where('add_size.second_category',$product->second_category)
            ->where('add_size.status','1')
            ->where('add_size.size_id', $size_id_add->size_id)
            ->whereNull('add_size.deleted_at')
            ->get();
        }

        // dd($sizes_add);
        return view('seller.products.product_sizes',compact('sizes','sizes_options','sizes_add'));
    }


     public function productSizeUpdate(Request $request)
    {

        $size_id = $request->input('size_id');
        $size = $request->input('size');
        $mrp = $request->input('mrp');
        $price = $request->input('price');
        $stock = $request->input('stock');

        if (isset($size_id) && !empty($size_id) && isset($size) && !empty($size)  && isset($price) && !empty($price)) {
            
            $size_check = DB::table('product_sizes')
            ->where('product_id',$request->input('product_id'))
            ->where('size_name_id',$request->input('size_name_id'))
            ->where('size_value_id',$request->input('size'))
            ->where('id','!=',$size_id)
            ->whereNull('deleted_at')
            ->count();

            if ($size_check > 0) {
                return 4;

            }

            $size_update = DB::table('product_sizes')
            ->where('id',$size_id)
            ->update([
                'size_value_id' => $size,
                'mrp' => $mrp,
                'price' => $price,
                'stock' => $stock,
            ]);

            if ($size_update) {
               // return 2;
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

        $size_name_id = $request->input('size_name_id');
        $size = $request->input('size');
        $mrp = $request->input('mrp');
        $price = $request->input('price');
        $stock = $request->input('stock');

        $blade_product_id = $product_id[0];

        for($i = 0; $i < count($size_name_id); $i++){
            if (isset($product_id[$i]) && !empty($product_id[$i]) && isset($size_name_id[$i]) && !empty($size_name_id[$i]) && isset($size[$i]) && !empty($size[$i]) && isset($price[$i]) && !empty($price[$i]) && isset($stock[$i]) && !empty($stock[$i])) {

                $blade_product_id = $product_id[$i];

                $size_check = DB::table('product_sizes')
                ->where('product_id',$product_id[$i])
                ->where('size_name_id',$size_name_id[$i])
                ->where('size_value_id',$size[$i])
                ->whereNull('deleted_at')
                ->count();

                if ($size_check == 0) {                    
                    $sizes_insert = DB::table('product_sizes')
                    ->insert([
                        'product_id' => $product_id[$i],
                        'size_name_id' => $size_name_id[$i],
                        'size_value_id' => $size[$i],
                        'mrp' => $mrp[$i],
                        'price' => $price[$i],
                        'stock' => $stock[$i],
                    ]);
                }
            }
        }

        return redirect()->route('seller.product_sizes',['product_id' => encrypt($blade_product_id)]);
    }

    public function productVarientEdit($product_id)
    {
        try {
            $product_id = decrypt($product_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $product = DB::table('products')
        ->where('id',$product_id)
        ->first();

       $varient_id_fetch = DB::table('varient_map')
        ->where('category',$product->category)
        ->where('first_category',$product->first_category)
        ->where('second_category',$product->second_category)
        ->where('status','1')
        ->whereNull('deleted_at')    
        ->distinct()    
        ->get(['varient_id']);

        $varients =[];
        foreach ($varient_id_fetch as $varient_id) {
            $varient_name = DB::table('varient_name')->where('id',$varient_id->varient_id)->first();
            // print $size_name->name;
            $varients [$varient_name->name] =  DB::table('varient_map')
            ->select('varient_name.name as varient_name','varient_value.value as varient_value','varient_map.*')
            ->join('varient_name','varient_map.varient_id','=','varient_name.id')
            ->join('varient_value','varient_map.varient_value_id','=','varient_value.id')
            ->where('varient_map.category',$product->category)
            ->where('varient_map.first_category',$product->first_category)
            ->where('varient_map.second_category',$product->second_category)
            ->where('varient_map.status','1')
            ->where('varient_map.varient_id', $varient_id->varient_id)
            ->whereNull('varient_map.deleted_at')
            ->get();
        }


        $product_varient_id_fetch = DB::table('product_varients')
        ->where('product_id',$product_id)
        ->whereNull('deleted_at')    
        ->distinct()    
        ->get(['varient_name_id']);

        $product_varients =[];
        foreach ($product_varient_id_fetch as $varient_id) {

        $varient_names = DB::table('varient_name')->where('id',$varient_id->varient_name_id)->first();

        $product_varients[$varient_names->name] = DB::table('product_varients')
        ->select('product_varients.*','varient_name.name as v_name','varient_value.value as v_value')
        ->join('varient_name','product_varients.varient_name_id','=','varient_name.id')
        ->join('varient_value','product_varients.varient_value_id','=','varient_value.id')
        ->where('product_varients.product_id',$product_id)
        ->where('varient_name_id',$varient_names->id)
        ->whereNull('product_varients.deleted_at')
        ->get();
        }

        return view('seller.products.product_varients_edit',compact('product_varients','varients'));

    }


    public function productVarientUpdate(Request $request)
    {
        $product_varient_id = $request->input('product_varient_id');
        $varient_value_id = $request->input('varient_value_id');
        if (isset($product_varient_id) && !empty($product_varient_id) && isset($varient_value_id) && !empty($varient_value_id)) {
            
            $update_varient = DB::table('product_varients')
            ->where('id',$product_varient_id)
            ->update([
                'varient_value_id'=> $varient_value_id,
            ]);

            if ($update_varient) {
               return 2;
            }else{
                return 3;
            }

        }else{
            return 1;
        }
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

        $color_options = DB::table('color_map')
        ->select('color.name as color_name','color.value as color_value','color_map.*')
        ->join('color','color_map.color_id','=','color.id')
        ->where('color_map.category',$product->category)
        ->where('color_map.first_category',$product->first_category)
        ->where('color_map.second_category',$product->second_category)
        ->where('color_map.status','1')
        ->whereNull('color_map.deleted_at')
        ->get();

        $product_colors = DB::table('product_colors')
        ->where('product_id',$product_id)
        ->whereNull('deleted_at')
        ->get();

        $product_id_color_add = $product_id;
        
        return view('seller.products.product_colors_edit',compact('color_options','product_colors','product_id_color_add'));

    }

    public function productColorUpdate(Request $request)
    {
        $product_color_id = $request->input('product_color_id');
        $color = $request->input('color');

        if (isset($product_color_id) && !empty($product_color_id) && isset($color) && !empty($color)) {
            $color_update = DB::table('product_colors')
            ->where('id',$product_color_id)
            ->update([
                'color_id' => $color,
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
        ]);
        return redirect()->back();
    }

}
