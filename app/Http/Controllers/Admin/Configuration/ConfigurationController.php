<?php

namespace App\Http\Controllers\Admin\Configuration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\FirstCategory;
use App\SecondCategory;
use App\Model\Configuration\Sizes;
use Validator;
use DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use File;

class ConfigurationController extends Controller
{



    public function AjaxSizeWithCategory($first_category){
        $size = DB::table('size_name')
        ->whereNull('deleted_at')
        ->where('first_category',$first_category)
        ->get()
        ->pluck('name','id');
        echo $size;
    }    

    public function viewSizeForm(){
        $main_category = Category::where('status','1')->get()->pluck('name','id');
        return view('admin.configuration.add_size_form',compact('main_category','size_name_list'));
    }

    public function AjaxSizeValues($size_id){
        $size_value = DB::table('size_value')
        ->where('size','=',$size_id)
        ->where('status','=','1')
        ->get()
        ->pluck('value','id');
        echo $size_value;
    }

    public function addSize(Request $request){
        $validatedData = $request->validate([
        'category' => 'required',
        'first_category' => 'required',
        ]);
        $size = $request->input('size'); //array of Size Value

        for ($i=0; $i < count((array)$size) ; $i++) { 
            /// Validation For check Size Is already exist or Not
            
            if (!empty($size[$i])) {
               
                $check_size = DB::table('sizes')
                    ->where('category','=',$request->input('category'))
                    ->where('first_category','=',$request->input('first_category'))
                    ->where('name',$size[$i])
                    ->count();

                if ($check_size <= 0) {                    
                    DB::table('sizes')
                        ->insert([
                            'category' => $request->input('category'),
                            'first_category' => $request->input('first_category'),
                            'name' => $size[$i],
                            'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                        ]);
                }
            }         
        }
        return redirect()->back()->with('message','Size Added Successfully');
    }


    public function sizeList(Request $request){
      
        return view('admin.configuration.size_list');
    }

    public function sizeLists(Request $request){
        $query = DB::table('sizes')
        ->select('sizes.*','category.name as category_name','first_category.name as first_category_name')
        ->join('category','sizes.category','=','category.id')
        ->join('first_category','sizes.first_category','=','first_category.id');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                //    $btn = '<a href="#" class="btn btn-warning btn-sm">Edit</a>';
                   if ($row->status == '1') {
                       $btn = '<a href="'.route('admin.size_status_update',['size_id'=>encrypt($row->id),'status'=>encrypt(2)]).'" class="btn btn-danger btn-sm">Disable</a>';
                        return $btn;
                    }else{
                       $btn = '<a href="'.route('admin.size_status_update',['size_id'=>encrypt($row->id),'status'=>encrypt(1)]).'" class="btn btn-success btn-sm">Enable</a>';
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

    public function sizeStatusUpdate($size_id,$status)
    {
        try {
            $size_id = decrypt($size_id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        DB::table('sizes')
            ->where('id',$size_id)
            ->update([
                'status' => $status,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        return redirect()->back();

    }


    //************************ Color Section*****************************
    
    public function viewColorNameForm(){
        $colors = DB::table('color')->get();
        $main_category = Category::where('status','1')->get()->pluck('name','id');
        return view('admin.configuration.add_color_name_form',compact('colors','main_category'));
    }

    public function AddColor(Request $request){
        $validatedData = $request->validate([
            'category' => 'required',
            'first_category' => 'required',
            'color_name' => 'required',
            'color_value' => 'required',
            ]);
        $category_id = $request->input('category');
        $first_category = $request->input('first_category');
        $color_name = $request->input('color_name'); // array of color name
        $color_value = $request->input('color_value'); // array of color name
        // dd($color_name);
        for ($i=0; $i < count((array)$color_name); $i++) { 
            if (!empty($color_name[$i]) && !empty($color_value[$i])) {
                $check_color = DB::table('color')->where('name',$color_name[$i])->where('first_category_id',$first_category)->count();
                if ( $check_color <= 0 ) {
                    DB::table('color')
                    ->insert([
                        'name' => $color_name[$i],
                        'value' => $color_value[$i],
                        'category_id' => $category_id,
                        'first_category_id' => $first_category,
                    ]);
                }
            }
        }
        return redirect()->back()->with('message','Color Added Successfully');
    }

    public function ajaxGetColor($color_id){
        $color = DB::table('color')
        ->where('id',$color_id)
        ->first();
        echo $color->value;
    }

    public function viewColorList(){
         return view('admin.configuration.color_list');
    }

    public function ajaxColorList(){
        $query = DB::table('color')
        ->select('color.*','category.name as category_name','first_category.name as first_category_name')
        ->join('category','color.category_id','=','category.id')
        ->join('first_category','color.first_category_id','=','first_category.id');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   if ($row->status == '1') {
                       $btn = '<a href="'.route('admin.color_status_update',['color_id'=>encrypt($row->id),'status'=> encrypt(2)]).'" class="btn btn-danger btn-sm">Disable</a>';
                    }else{
                       $btn = '<a href="'.route('admin.color_status_update',['color_id'=>encrypt($row->id),'status'=> encrypt(1)]).'" class="btn btn-success btn-sm">Enable</a>';
                    }
                    $btn .= '<a href="'.route('admin.view_color_edit_form',['color_id'=>encrypt($row->id)]).'" class="btn btn-primary btn-sm">Edit</a>';
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
            ->addColumn('show_color', function($row){
                
                $btn = '<div class="circle_green" style="padding: 10px 11px; background:'.$row->value.'"></div>';
                    return $btn;
                
            })
            ->rawColumns(['action','status_tab','show_color'])
            ->make(true);
    }

    public function viewColorEditForm($color_id)
    {
        try {
            $color_id = decrypt($color_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $color = DB::table('color')
        ->where('id',$color_id)
        ->first();
        $main_category = Category::where('status','1')->get();
        $first_category = null;
        if (isset($color->category_id) && !empty(($color->category_id))) {
            $first_category = DB::table('first_category')
                ->where('category_id',$color->category_id)
                ->whereNull('deleted_at')
                ->where('status',1)
                ->get();
        }
        // dd($first_category);
        return view('admin.configuration.colors_edit',compact('main_category','first_category','color'));
    }

    public function colorUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'color_id' => 'required',
            'category' => 'required',
            'first_category' => 'required',
            'color_name' => 'required',
            'color_value' => 'required',
        ]);
        try {
            $color_id = decrypt($request->input('color_id'));
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $category_id = $request->input('category');
        $first_category = $request->input('first_category');
        $color_name = $request->input('color_name');
        $color_value = $request->input('color_value');

        $check_color = DB::table('color')
            ->where('name',$color_name)
            ->where('first_category_id',$first_category)
            ->where('id','!=',$color_id)
            ->whereNull('deleted_at')
            ->count();
        if ( $check_color <= 0 ) {
            DB::table('color')
            ->where('id',$color_id)
            ->update([
                'name' => $color_name,
                'value' => $color_value,
                'category_id' => $category_id,
                'first_category_id' => $first_category,
            ]);
        }

        return redirect()->back()->with('message','Color Updated Successfully');
    }

    public function colorStatusUpdate($color_id,$status)
    {
        try {
            $color_id = decrypt($color_id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        DB::table('color')
            ->where('id',$color_id)
            ->update([
                'status' => $status,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        return redirect()->back();

    }

    //*****************Brand Configuration*************************

    public function viewBrandForm(){
        $main_category = Category::where('status','1')
        ->whereNull('deleted_at')
        ->get()->pluck('name','id');
       return view('admin.configuration.add_brand_name_form',compact('main_category'));
    }

    public function addBrand(Request $request){
        
        $validatedData = $request->validate([
            'category' => 'required',
            'first_category' => 'required',
            ]);
        
        $category = $request->input('category');
        $first_category = $request->input('first_category');
        $brand_name = $request->input('name'); //an array of colors
        
        if (!empty($brand_name)) {
            for ($i=0; $i <count((array)$brand_name) ; $i++) { 
                $brand_check = DB::table('brand_name')
                ->where('name',$brand_name[$i])
                ->whereNull('deleted_at')
                ->where('category',$request->input('category'))
                ->where('first_category',$request->input('first_category'))
                ->count();

                if ($brand_check <= 0) {
                    $brand = DB::table('brand_name')
                    ->insert([
                        'first_category' => $first_category,
                        'category' => $category,
                        'name' => $brand_name[$i],
                    ]);
                }
            }
        }
        return redirect()->back()->with('message','Brand Name Added Successfully');
    }

    public function brandNameList(){
        return view('admin.configuration.brand_name_list');
    }

    public function ajaxBrandNameList(){
        $query = DB::table('brand_name')
        ->select('brand_name.*','category.name as c_name','first_category.name as first_c_name')
        ->join('category','brand_name.category','=','category.id')
        ->join('first_category','brand_name.first_category','=','first_category.id')
        ->whereNull('brand_name.deleted_at');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                  
                   if ($row->status == '1') {
                       $btn = '<a href="'.route('admin.brand_status_update',['brand_id'=>encrypt($row->id),'status'=> encrypt(2)]).'" class="btn btn-danger btn-sm">Disable</a>';
                        return $btn;
                    }else{
                       $btn = '<a href="'.route('admin.brand_status_update',['brand_id'=>encrypt($row->id),'status'=> encrypt(1)]).'" class="btn btn-success btn-sm">Enable</a>';
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

   

    public function AjaxBrandNames($first_category){
        $brands = DB::table('brand_name')
       ->where('first_category',$first_category)
       ->whereNull('deleted_at')
       ->where('status','1')
       ->get()
       ->pluck('name','id');
       return $brands;
    }

    public function brandStatusUpdate($brand_id,$status)
    {
        try {
            $brand_id = decrypt($brand_id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        DB::table('brand_name')
            ->where('id',$brand_id)
            ->update([
                'status' => $status,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        return redirect()->back();

    }

    //******************State Section******************

    public function ViewStateForm()
    {
        $state = DB::table('state')->whereNull('deleted_at')->get();
        return view('admin.configuration.add_state',compact('state'));
    }

    public function AddStateForm(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $state = DB::table('state')
        ->insert([
            'name' => $request->input('name'),
        ]);

        if ($state) {
            return redirect()->back()->with('message','State Added Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function EditState($id)
    {
        $state_edit = DB::table('state')->where('id',$id)->first();

        $state = DB::table('state')->whereNull('deleted_at')->get();
        return view('admin.configuration.add_state',compact('state','state_edit'));

    }

    public function updateState(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'id' => 'required',
        ]);

        $state = DB::table('state')
        ->where('id',$request->input('id'))
        ->update([
            'name' => $request->input('name'),
        ]);

        if ($state) {
            return redirect()->back()->with('message','State Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function deleteState($id)
    {
        $timestamp = now()->toDateTimeString();
        $state = DB::table('state')
        ->where('id',$id)
        ->update([
            'deleted_at' => $timestamp,
        ]);

        if ($state) {
            return redirect()->back()->with('message','State Deleted Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    //***************City Section***************

    public function ViewCityForm()
    {
        $states = DB::table('state')->whereNull('deleted_at')->get()->pluck('name','id');
        return view('admin.configuration.add_city',compact('states'));
    }

    public function AddCity(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'state_id' => 'required',
        ]);

        $state = DB::table('city')
        ->insert([
            'name' => $request->input('name'),
            'state_id' => $request->input('state_id'),
        ]);

        if ($state) {
            return redirect()->back()->with('message','City Added Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function cityList()
    {
       return view('admin.configuration.city_list');
    }

    public function ajaxCityList()
    {
       $query = DB::table('city')
        ->select('city.*','state.name as s_name')
        ->join('state','city.state_id','=','state.id')
        ->whereNull('city.deleted_at');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '
                   <a href="'.route('admin.edit_city',['id'=>$row->id]).'" class="btn btn-warning btn-sm">Edit</a>
                   <a href="'.route('admin.delete_city',['id'=>$row->id]).'" class="btn btn-danger btn-sm">Delete</a>                   
                   ';
                    return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function EditCity($id)
    {
        $states = DB::table('state')->whereNull('deleted_at')->get()->pluck('name','id');
        $city = DB::table('city')->where('id',$id)->first();


        return view('admin.configuration.add_city',compact('states','city'));
    }

    public function updateCity(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'state_id' => 'required',
            'id' => 'required',
        ]);

        $state = DB::table('city')
        ->where('id',$request->input('id'))
        ->update([
            'name' => $request->input('name'),
            'state_id' => $request->input('state_id'),
        ]);

        if ($state) {
            return redirect()->back()->with('message','City Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function deleteCity($id)
    {
       $city_delete = DB::table('city')->where('id',$id)->delete();
       if ($city_delete) {
            return redirect()->back()->with('message','City Deleted Successfully');
       }else{
             return redirect()->back()->with('error','Something Went Wrong Please Try Again');
       }
    }

    public function cityWithState($id)
    {
       $city = DB::table('city')->where('state_id',$id)->get()->pluck('name','id');
       return $city;
    }

    public function ViewAppSliderForm()
    {
        $slider = DB::table('sliders')->get();
        return view('admin.configuration.app_slider',compact('slider'));
    }

    public function appSliderInsert(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required',
            'slider' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('slider');
        $image_name = null;
        if($request->hasfile('slider')){
            $destination = public_path('images/slider/');
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);
            $thumb_path = public_path('images/slider/thumb/').$image_name;
            $image = Image::make($image);
            $image->resize(null, 600, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($thumb_path);
        }
        $date = Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString();
        $slider = DB::table('sliders')
        ->insert([
            'type' => $request->input('type'),
            'image' => $image_name,
            'created_at' => $date,
            'updated_at' => $date,
        ]);
        if ($slider) {
            return redirect()->back()->with('message','Slider Added Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }
    }

    public function AppSliderEdit($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $slider_edit = DB::table('sliders')->where('id',$id)->first();
        return view('admin.configuration.app_slider',compact('slider_edit'));
    }

    public function appSliderUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required',
            'slider' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id' => 'required',
        ]);

        $image = $request->file('slider');
        $image_name = null;
        if($request->hasfile('slider')){
            $destination = public_path('images/slider/');
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);
            $thumb_path = public_path('images/slider/thumb/').$image_name;
            $image = Image::make($image);
            $image->resize(null, 600, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($thumb_path);

            $slider_image = DB::table('sliders')
              ->where('id',$request->input('id'))
              ->first();

            $date = Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString();
            $slider_image_update = DB::table('sliders')
            ->where('id',$request->input('id'))
            ->update([
                'image' => $image_name,
                'type' => $request->input('type'),
                'updated_at' => $date,
            ]);

            if ($slider_image) {
               $image_path = public_path('images/slider/').$slider_image->image;
                $image_path_thumb = public_path('images/slider/thumb/').$slider_image->image;
                if (file_exists($image_path)) {
                     File::delete($image_path);
                }
                if (file_exists($image_path_thumb)) {
                     File::delete($image_path_thumb);
                }
            }

        }

        return redirect()->back()->with('message','Slider Updated Successfully');
    }

    public function appSliderDelete($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $slider_image = DB::table('sliders')->where('id',$id)->first();

        $slider = DB::table('sliders')->where('id',$id)->delete();
        if ($slider && $slider_image) {
            $image_path = public_path('images/slider/').$slider_image->image;
            $image_path_thumb = public_path('images/slider/thumb/').$slider_image->image;
            if (file_exists($image_path)) {
                    File::delete($image_path);
            }
            if (file_exists($image_path_thumb)) {
                    File::delete($image_path_thumb);
            }
        }
        return redirect()->back()->with('message','Slider Deleted Successfully');
    }
}
