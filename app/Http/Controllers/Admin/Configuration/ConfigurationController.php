<?php

namespace App\Http\Controllers\Admin\Configuration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\FirstCategory;
use App\SecondCategory;
use App\Model\Configuration\SizeName;
use Validator;
use DataTables;
use Illuminate\Support\Facades\DB;

class ConfigurationController extends Controller
{

    //*********************** Size Section*************************
    public function viewSizeNameForm(){
        $size_name = SizeName::whereNull('deleted_at')
        ->get();

        $main_category = Category::where('status','1')->get()->pluck('name','id');

        return View('admin.configuration.add_size_name',compact('size_name','main_category'));
    }

    public function AjaxSizeWithCategory($first_category){
        $size = DB::table('size_name')
        ->whereNull('deleted_at')
        ->where('first_category',$first_category)
        ->get()
        ->pluck('name','id');
        echo $size;
    }

    public function AddSizeName(Request $request){
        $validatedData = $request->validate([
        'name' => 'required',
        'category' => 'required',
        'first_category' => 'required',
        ]);

        $size_name =SizeName::create([
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'first_category' => $request->input('first_category'),
        ]);

        if ($size_name) {
            return redirect()->back()->with('message','Size Name Added Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        } 
    }

    public function UpdateSizeName(Request $request){
        
        $validatedData = $request->validate([
        'id' => 'required',
        'name' => 'required',
        'category' => 'required',
        'first_category' => 'required',
        ]);

        $size_name = SizeName::where('id',$request->input('id'))->update([
        'name' => $request->input('name'),
        'category' => $request->input('category'),
        'first_category' => $request->input('first_category'),
        ]);
        if ($size_name) {
            return redirect()->back()->with('message','Size Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }
    }

    public function UpdateSizeNameStatus($size_name_id,$status)
    {
        $size_name = SizeName::where('id',$size_name_id)
        ->update([
            'status' => $status,
        ]);
        if ($size_name) {
            return redirect()->back()->with('message','Size Name Status Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }
    }

    public function EditSizeName($id){
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $size_name = SizeName::whereNull('deleted_at')->get();
        $size_name_edit = SizeName::where('id',$id)->first();

        $main_category = Category::where('status','1')->get()->pluck('name','id');
        $first_category = FirstCategory::where('status',1)
        ->where('category_id',$size_name_edit->category)
        ->get()->pluck('name','id');

        return View('admin.configuration.add_size_name',compact('size_name_edit','size_name','main_category','first_category'));


    }

    public function deleteSizeName($id)
    {
        $size_name = SizeName::where('id',$id)
        ->delete();
        if ($size_name) {
            return redirect()->back()->with('message','Size Name Deleted Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }
    }

    public function AddSizeValueForm($sizeId){
        try {
            $sizeId = decrypt($sizeId);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $size_value = DB::table('size_value')
        ->select('size_value.*', 'size_name.name AS s_name')
        ->join('size_name','size_value.size','=','size_name.id')
        ->whereNull('size_value.deleted_at')
        ->where('size_value.size',$sizeId)        
        ->get();

        $sizes = DB::table('size_name')
        ->where('status','=', 1)
        ->where('id',$sizeId)
        ->first();
        return View('admin.configuration.add_size_value',compact('size_value','sizes'));


    }

    public function AddSizeValue(Request $request){
      

        $validatedData = $request->validate([
            'size' => 'required',
            'value' => 'required',
        ]);

        $size_value_check = DB::table('size_value')
        ->where('size',$request->input('size'))
        ->where('value',$request->input('value'))
        ->whereNull('deleted_at')
        ->count();

        if ($size_value_check > 0) {
            return redirect()->back()->with('error','Sorry Size '.$request->input('value').' Already Exist');
        }

        $size_value = DB::table('size_value')
        ->insert([
            'size' => $request->input('size'),
            'value' => $request->input('value'),
        ]);
        
        if ($size_value) {
            return redirect()->back()->with('message','Size Value Added Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        } 


   }

   public function sizeValueStatusUpdate($value_id,$size_id,$status)
   {
        $size_value = DB::table('size_value')
        ->where('id' , $value_id)
        ->update([
            'status' => $status,
        ]);
        
        if ($size_value) {
            return redirect()->back()->with('message','Size Value Status Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        } 
   }


   public function sizeValueEdit($value_id,$size_id)
   {
       $size_value = DB::table('size_value')
        ->select('size_value.*', 'size_name.name AS s_name')
        ->join('size_name','size_value.size','=','size_name.id')
        ->whereNull('size_value.deleted_at')
        ->where('size_value.size',$size_id)        
        ->get();

        $sizes = DB::table('size_name')
        ->where('status','=', 1)
        ->where('id',$size_id)
        ->first();

        $size_edit_value = DB::table('size_value')
        ->where('id',$value_id)
        ->first();

        return View('admin.configuration.add_size_value',compact('size_value','sizes','size_edit_value'));
   }

   public function sizeValueUpdate(Request $request)
   {
       $validatedData = $request->validate([
            'id' => 'required',
            'value' => 'required',
        ]);

        $size_value = DB::table('size_value')
        ->where('id' , $request->input('id'))
        ->update([
            'value' => $request->input('value'),
        ]);
        
        if ($size_value) {
            return redirect()->back()->with('message','Size Value Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        } 

   }

    public function sizeValueDelete($value_id,$size_id)
    {
        $timestamp = now()->toDateTimeString();
        $size_value = DB::table('size_value')
        ->where('id' , $value_id)
        ->update([
            'deleted_at' =>$timestamp,
        ]);
        
        if ($size_value) {
            return redirect()->back()->with('message','Size Value Deleted Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        } 
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
        'second_category' => 'required',
        'size_value_id' => 'required',
        'size_id' => 'required',
        ]);

        $size_value_id = $request->input('size_value_id'); //array of Size Value

        for ($i=0; $i < count($size_value_id) ; $i++) { 
            /// Validation For check Size Is already exist or Not
            $check_size = DB::table('add_size')
            ->where('category','=',$request->input('category'))
            ->where('first_category','=',$request->input('first_category'))
            ->where('second_category','=',$request->input('second_category'))
            ->where('size_value_id','=',$size_value_id[$i])
            ->where('size_id','=',$request->input('size_id'))
            ->count();
            
            if ($check_size <= 0) {
               $size = DB::table('add_size')
                ->insert([
                    'category' => $request->input('category'),
                    'first_category' => $request->input('first_category'),
                    'second_category' => $request->input('second_category'),
                    'size_value_id' => $size_value_id[$i],
                    'size_id' => $request->input('size_id'),
                ]);
            }            
        }
        
        return redirect()->back()->with('message','Size Added Successfully');

    }


    public function sizeList(Request $request){
      
        return view('admin.configuration.size_list');
    }

    public function sizeLists(Request $request){
        $query = DB::table('add_size')
        ->select('size_name.name as s_name','size_value.value as s_value','category.name as category_name','first_category.name as first_category_name','second_category.name as second_category_name','add_size.status as status')
        ->join('size_name','add_size.size_id','=','size_name.id')
        ->join('size_value','add_size.size_value_id','=','size_value.id')
        ->join('category','add_size.category','=','category.id')
        ->join('first_category','add_size.first_category','=','first_category.id')
        ->join('second_category','add_size.second_category','=','second_category.id');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '<a href="#" class="btn btn-primary btn-sm">View</a>
                   <a href="#" class="btn btn-warning btn-sm">Edit</a>                   
                   ';
                   if ($row->status == '1') {
                       $btn .= '<a href="#" class="btn btn-danger btn-sm">Disable</a>';
                        return $btn;
                    }else{
                       $btn .= '<a href="#" class="btn btn-success btn-sm">Enable</a>';
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


        //************************ Color Section*****************************
    
    public function viewColorNameForm(){
        $colors = DB::table('color')->get();
        return view('admin.configuration.add_color_name_form',compact('colors'));
    }

    public function AddColorName(Request $request){
        $validatedData = $request->validate([
        'name' => 'required',
        'value' => 'required',
        ]);

        $color_check = DB::table('color')
        ->where('name','=',$request->input('name'))
        ->count();

        if ($color_check > 0 ) {
            return redirect()->back()->with('error','Color Already Exist');
        }

        $color = DB::table('color')
        ->insert([
            'name' => $request->input('name'),
            'value' => $request->input('value')
        ]);

        if ($color) {
            return redirect()->back()->with('message','Color Added Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }

    }

    public function viewMapColorForm(){
        $main_category = Category::where('status','1')->get()->pluck('name','id');

        $color = DB::table('color')
        ->where('status','=','1')
        ->get();
        return view('admin.configuration.map_color_form',compact('main_category','color'));
    }

    public function addColorMap(Request $request){
        $validatedData = $request->validate([
        'category' => 'required',
        'first_category' => 'required',
        'second_category' => 'required',
        'color_id' => 'required',
        ]);

        $check_color = DB::table('color_map')
        ->where('color_id',$request->input('color_id'))
        ->where('first_category',$request->input('first_category'))
        ->where('second_category',$request->input('second_category'))
        ->where('category',$request->input('category'))
        ->count();

        if ($check_color > 0) {
            return redirect()->back()->with('error','Color Already Exist Under This Category');
        }

        $color = DB::table('color_map')
        ->insert([
            'category' => $request->input('category'),
            'first_category' => $request->input('first_category'),
            'second_category' => $request->input('second_category'),
            'color_id' => $request->input('color_id'),
        ]);

        if ($color) {
            return redirect()->back()->with('message','Color Mapped Successfully Under This Category');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }
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
        $query = DB::table('color_map')
        ->select('color.name as c_name','color.value as c_value','category.name as category_name','first_category.name as first_category_name','second_category.name as second_category_name','color.status as status')
        ->join('color','color_map.color_id','=','color.id')
        ->join('category','color_map.category','=','category.id')
        ->join('first_category','color_map.first_category','=','first_category.id')
        ->join('second_category','color_map.second_category','=','second_category.id');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '<a href="#" class="btn btn-primary btn-sm">View</a>
                   <a href="#" class="btn btn-warning btn-sm">Edit</a>                   
                   ';
                   if ($row->status == '1') {
                       $btn .= '<a href="#" class="btn btn-danger btn-sm">Disable</a>';
                        return $btn;
                    }else{
                       $btn .= '<a href="#" class="btn btn-success btn-sm">Enable</a>';
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
            ->addColumn('show_color', function($row){
                
                $btn = '<div class="circle_green" style="padding: 10px 11px; background:'.$row->c_value.'"></div>';
                    return $btn;
                
            })
            ->rawColumns(['action','status_tab','show_color'])
            ->toJson();
    }

        //************************ Varient Section*****************************
    public function viewVarientNameForm(){
        $main_category = Category::where('status','1')->get()->pluck('name','id');

        return view('admin.configuration.add_varient_name_form',compact('main_category'));
    }

    public function addVarientName(Request $request){
        $validatedData = $request->validate([
        'name' => 'required',
        'category' => 'required',
        'first_category' => 'required',
        ]);

        $varient_check = DB::table('varient_name')
        ->where('name','=',$request->input('name'))
        ->whereNull('deleted_at')
        ->where('category',$request->input('category'))
        ->where('first_category',$request->input('first_category'))
        ->count();

        if ($varient_check > 0 ) {
            return redirect()->back()->with('error','Varient Name '.$request->input('name').' Already Exist');
        }

        $varient = DB::table('varient_name')
        ->insert([
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'first_category' => $request->input('first_category'),
        ]);

        if ($varient) {
            return redirect()->back()->with('message','Varient Name Added Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }
    }

    

    public function varientNameList(){
        return view('admin.configuration.varient_name_list');
    }

    public function ajaxVarientNameList(){
        $query = DB::table('varient_name')
        ->select('varient_name.*','category.name as c_name','first_category.name as first_c_name')
        ->join('category','varient_name.category','=','category.id')
        ->join('first_category','varient_name.first_category','=','first_category.id')
        ->whereNull('varient_name.deleted_at');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '<a href="'.route('admin.varient_value_form',['varient_id' => encrypt($row->id)]).'" class="btn btn-primary btn-sm">Add Varient Value</a>
                   <a href="#" class="btn btn-warning btn-sm">Edit</a>                   
                   ';
                   if ($row->status == '1') {
                       $btn .= '<a href="#" class="btn btn-danger btn-sm">Disable</a>';
                        return $btn;
                    }else{
                       $btn .= '<a href="#" class="btn btn-success btn-sm">Enable</a>';
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

    public function AjaxVarientNames($first_category){
       $varient = DB::table('varient_name')
       ->where('first_category',$first_category)
       ->whereNull('deleted_at')
       ->where('status','1')
       ->get()
       ->pluck('name','id');
       return $varient;
    }

    public function viewVarientValueForm($varientId){
        try {
            $varientId = decrypt($varientId);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $varient_value = DB::table('varient_value')
        ->select('varient_value.*', 'varient_name.name AS v_name')
        ->join('varient_name','varient_value.varient_id','=','varient_name.id')
        ->where('varient_value.status','=', '1')   
        ->where('varient_value.varient_id',$varientId) 
        ->whereNull('varient_value.deleted_at')    
        ->get();

        $varient_name = DB::table('varient_name')
        ->where('status','=', 1)
        ->whereNull('deleted_at')
        ->where('id',$varientId)
        ->first();

        return View('admin.configuration.varient_value_form',compact('varient_value','varient_name'));


    }

    public function addVarientValue(Request $request){
      

        $validatedData = $request->validate([
            'varient_id' => 'required',
            'value' => 'required',
        ]);

        $varient_value_check =  DB::table('varient_value')
        ->where('varient_id',$request->input('varient_id'))
        ->where('value',$request->input('value'))
        ->count();
        if ($varient_value_check > 0) {
            return redirect()->back()->with('error',$request->input('value').' Already Exist');
        }


        $varient_value = DB::table('varient_value')
        ->insert([
            'varient_id' => $request->input('varient_id'),
            'value' => $request->input('value'),
        ]);
        
        if ($varient_value) {
            return redirect()->back()->with('message','Varient Value Added Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        } 


   }


    public function viewMapVarientForm(){
        $main_category = Category::where('status','1')->get()->pluck('name','id');

     
        return view('admin.configuration.map_varient_form',compact('main_category'));
    }

    public function AjaxVarientValueWithVarientId($varient_id){
        $varient = DB::table('varient_value')
        ->whereNull('deleted_at')
        ->where('varient_id',$varient_id)
        ->where('status','1')
        ->get()
        ->pluck('value','id');
        return $varient;
    }

    public function addMapVarient(Request $request){
       
       $validatedData = $request->validate([
            'category' => 'required',
            'first_category' => 'required',
            'second_category' => 'required',
            'varient_id' => 'required',
            'varient_value_id' => 'required',
        ]);

       $varient_value_id = $request->input('varient_value_id'); // Array Of Varient Value Id

       for ($i=0; $i < count($varient_value_id) ; $i++) { 
           
           $map_varient_check = DB::table('varient_map')
           ->where('category',$request->input('category'))
           ->where('first_category',$request->input('first_category'))
           ->where('second_category',$request->input('second_category'))
           ->where('varient_id',$request->input('varient_id'))
           ->where('varient_value_id',$varient_value_id[$i])
           ->whereNull('deleted_at')
           ->count();

           if ($map_varient_check <= 0) {
               $map_varient_insert = DB::table('varient_map')
               ->insert([
                   'category' => $request->input('category'),
                   'first_category' => $request->input('first_category'),
                   'second_category' => $request->input('second_category'),
                   'varient_id' => $request->input('varient_id'),
                   'varient_value_id' => $varient_value_id[$i],
               ]);

           }

       }
    
    return redirect()->back()->with('message','Varient Value Mapped Successfully');
      
    }

    public function ViewMappedVarientList(){
        return view('admin.configuration.varient_map_list');
    }

    public function ajaxMappedVarientList(){
        $query = DB::table('varient_map')
        ->select('varient_map.*','category.name as c_name','first_category.name as first_c_name','second_category.name as second_c_name','varient_value.value as varient_value','varient_name.name as varient_name')
        ->join('category','varient_map.category','=','category.id')
        ->join('first_category','varient_map.first_category','=','first_category.id')
        ->join('second_category','varient_map.second_category','=','second_category.id')
        ->join('varient_value','varient_map.varient_value_id','=','varient_value.id')
        ->join('varient_name','varient_map.varient_id','=','varient_name.id')
        ->whereNull('varient_map.deleted_at');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '
                   <a href="#" class="btn btn-warning btn-sm">Edit</a>                   
                   ';
                   if ($row->status == '1') {
                       $btn .= '<a href="#" class="btn btn-danger btn-sm">Disable</a>';
                        return $btn;
                    }else{
                       $btn .= '<a href="#" class="btn btn-success btn-sm">Enable</a>';
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

    //*****************Brand Configuration*************************

    public function viewBrandNameForm(){
        $main_category = Category::where('status','1')
        ->whereNull('deleted_at')
        ->get()->pluck('name','id');
       return view('admin.configuration.add_brand_name_form',compact('main_category'));
    }

    public function addBrandName(Request $request){
        
        $validatedData = $request->validate([
        'name' => 'required',
        'category' => 'required',
        'first_category' => 'required',
        ]);

        $varient_check = DB::table('brand_name')
        ->where('name','=',$request->input('name'))
        ->whereNull('deleted_at')
        ->where('category',$request->input('category'))
        ->where('first_category',$request->input('first_category'))
        ->count();

        if ($varient_check > 0 ) {
            return redirect()->back()->with('error','Brand Name '.$request->input('name').' Already Exist');
        }

        $varient = DB::table('brand_name')
        ->insert([
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'first_category' => $request->input('first_category'),
        ]);

        if ($varient) {
            return redirect()->back()->with('message','Brand Name Added Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        }
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
                   $btn = '
                   <a href="#" class="btn btn-warning btn-sm">Edit</a>                   
                   ';
                   if ($row->status == '1') {
                       $btn .= '<a href="#" class="btn btn-danger btn-sm">Disable</a>';
                        return $btn;
                    }else{
                       $btn .= '<a href="#" class="btn btn-success btn-sm">Enable</a>';
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

    public function viewMapBrandForm(){
        $main_category = Category::where('status','1')->get()->pluck('name','id');

     
        return view('admin.configuration.map_brand_form',compact('main_category'));
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

    public function addMapBrand(Request $request){
       
       $validatedData = $request->validate([
            'category' => 'required',
            'first_category' => 'required',
            'second_category' => 'required',
            'brand_id' => 'required',
        ]);

       $map_varient_check = DB::table('map_brand')
       ->where('category',$request->input('category'))
       ->where('first_category',$request->input('first_category'))
       ->where('second_category',$request->input('second_category'))
       ->where('brand_id',$request->input('brand_id'))
       ->whereNull('deleted_at')
       ->count();

       if ($map_varient_check > 0) {
           return redirect()->back()->with('error','Brand Already Exist Under This Category');
       }

       $map_varient_insert = DB::table('map_brand')
       ->insert([
           'category' => $request->input('category'),
           'first_category' => $request->input('first_category'),
           'second_category' => $request->input('second_category'),
           'brand_id' => $request->input('brand_id'),
       ]);

       if ($map_varient_insert) {
            return redirect()->back()->with('message','Brand Mapped Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please try Again');
        } 
    }

    public function ViewMappedBrandList(){
        return view('admin.configuration.map_brand_list');
    }

    public function ajaxMappedBrandList(){
        $query = DB::table('map_brand')
        ->select('map_brand.*','category.name as c_name','first_category.name as first_c_name','second_category.name as second_c_name','brand_name.name as brand_name')
        ->join('category','map_brand.category','=','category.id')
        ->join('first_category','map_brand.first_category','=','first_category.id')
        ->join('second_category','map_brand.second_category','=','second_category.id')
        ->join('brand_name','map_brand.brand_id','=','brand_name.id')
        ->whereNull('map_brand.deleted_at');
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '
                   <a href="#" class="btn btn-warning btn-sm">Edit</a>                   
                   ';
                   if ($row->status == '1') {
                       $btn .= '<a href="#" class="btn btn-danger btn-sm">Disable</a>';
                        return $btn;
                    }else{
                       $btn .= '<a href="#" class="btn btn-success btn-sm">Enable</a>';
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
}
