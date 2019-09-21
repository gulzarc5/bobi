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
                   $btn = '<a href="#" class="btn btn-warning btn-sm">Edit</a>';
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
        $main_category = Category::where('status','1')->get()->pluck('name','id');
        return view('admin.configuration.add_color_name_form',compact('colors','main_category'));
    }

    public function AddColor(Request $request){
        $validatedData = $request->validate([
            'category' => 'required',
            'first_category' => 'required',
            ]);
        $category_id = $request->input('category');
        $first_category = $request->input('first_category');
        $color_name = $request->input('color_name'); // array of color name
        $color_value = $request->input('color_value'); // array of color name
        
        for ($i=0; $i < count((array)$color_name); $i++) { 
            if (!empty($color_name[$i]) && !empty($color_value[$i])) {
                $check_color = DB::table('color')->where('name',$color_name[$i])->count();
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

    // public function viewMapColorForm(){
    //     $main_category = Category::where('status','1')->get()->pluck('name','id');

    //     $color = DB::table('color')
    //     ->where('status','=','1')
    //     ->get();
    //     return view('admin.configuration.map_color_form',compact('main_category','color'));
    // }

    // public function addColorMap(Request $request){
    //     $validatedData = $request->validate([
    //     'category' => 'required',
    //     'first_category' => 'required',
    //     'second_category' => 'required',
    //     'color_id' => 'required',
    //     ]);

    //     $check_color = DB::table('color_map')
    //     ->where('color_id',$request->input('color_id'))
    //     ->where('first_category',$request->input('first_category'))
    //     ->where('second_category',$request->input('second_category'))
    //     ->where('category',$request->input('category'))
    //     ->count();

    //     if ($check_color > 0) {
    //         return redirect()->back()->with('error','Color Already Exist Under This Category');
    //     }

    //     $color = DB::table('color_map')
    //     ->insert([
    //         'category' => $request->input('category'),
    //         'first_category' => $request->input('first_category'),
    //         'second_category' => $request->input('second_category'),
    //         'color_id' => $request->input('color_id'),
    //     ]);

    //     if ($color) {
    //         return redirect()->back()->with('message','Color Mapped Successfully Under This Category');
    //     }else{
    //         return redirect()->back()->with('error','Something Went Wrong Please try Again');
    //     }
    // }

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
                
                $btn = '<div class="circle_green" style="padding: 10px 11px; background:'.$row->value.'"></div>';
                    return $btn;
                
            })
            ->rawColumns(['action','status_tab','show_color'])
            ->toJson();
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

   

    public function AjaxBrandNames($first_category){
        $brands = DB::table('brand_name')
       ->where('first_category',$first_category)
       ->whereNull('deleted_at')
       ->where('status','1')
       ->get()
       ->pluck('name','id');
       return $brands;
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
