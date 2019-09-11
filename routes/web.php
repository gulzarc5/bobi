<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/frontend.php';



Auth::routes();

require __DIR__.'/seller_routes.php';



Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/login', 'Admin\AdminLoginController@showAdminLoginForm')->name('admin.login');
Route::post('/admin/login', 'Admin\AdminLoginController@adminLogin');
Route::post('/admin/logout', 'Admin\AdminLoginController@logout')->name('admin.logout');


Route::get('City/list/{state_id}', 'Admin\Configuration\ConfigurationController@cityWithState')->name('city_fetch_with_state_id');


Route::group(['middleware'=>'auth:admin','prefix'=>'admin','namespace'=>'Admin'],function(){

	require __DIR__.'/product_routes.php';
	 
	Route::get('/deshboard', 'AdminDeshboardController@index')->name('admin.deshboard');
	///////////////////////////////All Category////////////////////////////////
	Route::group(['namespace'=> 'Category'], function(){
		Route::get('/add_main_category', 'CategoryController@viewMainCategoryForm')->name('admin.add_main_category_form');
		Route::post('/add_main_category', 'CategoryController@insertMainCategory')->name('admin.add_main_category');
		Route::get('/Edit/Category/{id}', 'CategoryController@editCategory')->name('admin.editCategory');
		Route::post('/Edit/Category', 'CategoryController@updateCategory')->name('admin.updateCategory');
		Route::get('/Status/Update/{category_id}/{status}','CategoryController@statusUpdateCategory')->name('admin.category_status_update');
		Route::get('/Delete/{category_id}','CategoryController@DeleteCategory')->name('admin.category_delete');


		Route::get('/Add/First/Category', 'CategoryController@viewFirstCategoryForm')->name('admin.add_first_category_form');
		Route::post('/Add/First/Category', 'CategoryController@insertFirstCategory')->name('admin.add_first_category');
		Route::get('/Edit/First/Category/{id}', 'CategoryController@editFirstCategory')->name('admin.edit_first_category');
		Route::post('/Edit/First/Category', 'CategoryController@updateFirstCategory')->name('admin.update_first_category');
		
		Route::get('/first/Status/Update/{first_id}/{status}','CategoryController@statusUpdateFirstCategory')->name('admin.first_category_status_update');
		Route::get('/first/Delete/{first_id}','CategoryController@deleteFirstCategory')->name('admin.first_category_delete');


		Route::get('/Add/Second/Category', 'CategoryController@viewSecondCategoryForm')->name('admin.add_second_category_form');
		Route::post('/Add/Second/Category', 'CategoryController@insertSecondCategory')->name('admin.add_second_category');
		Route::get('/Edit/Second/Category/{id}', 'CategoryController@editSecondCategory')->name('admin.edit_second_category');
		Route::post('/Update/Second/Category', 'CategoryController@updateSecondCategory')->name('admin.update_second_category');
		
		Route::get('Second/Status/Update/{category_id}/{status}', 'CategoryController@secondStatusUpdate')->name('admin.second_category_status_update');
		Route::get('Second/Delete/{category_id}', 'CategoryController@deleteSecondCategory')->name('admin.second_category_delete');


	});
	//////////////Configuration ////////////////////////////////

	Route::group(['namespace'=> 'Configuration'], function(){

		//********************************Size Configuration Route***************************************
		Route::get('/Add/Size/Name', 'ConfigurationController@viewSizeNameForm')->name('admin.add_size_name_form');
		Route::post('/Add/Size/Name', 'ConfigurationController@AddSizeName')->name('admin.add_size_name');
		Route::get('/Edit/Size/Name/{id}', 'ConfigurationController@EditSizeName')->name('admin.edit_size_name');
		Route::post('/Update/Size/Name/', 'ConfigurationController@UpdateSizeName')->name('admin.update_size_name');
		Route::get('/Update/Size/Name/Status/{name_id}/{status}', 'ConfigurationController@UpdateSizeNameStatus')->name('admin.update_size_name_status');
		Route::get('/Delete/Size/Name/{id}', 'ConfigurationController@deleteSizeName')->name('admin.delete_size_name');


		Route::get('/Add/Size/Value/{size_id}', 'ConfigurationController@AddSizeValueForm')->name('admin.add_size_value_form');
		Route::post('/Add/Size/Value/', 'ConfigurationController@AddSizeValue')->name('admin.add_size_value');
		Route::get('/Add/Size', 'ConfigurationController@viewSizeForm')->name('admin.add_size_form');
		Route::post('/Add/Size', 'ConfigurationController@addSize')->name('admin.add_size');
		Route::get('/size/values/{size_id}', 'ConfigurationController@AjaxSizeValues');
		Route::get('ajax/size/{first_category}', 'ConfigurationController@AjaxSizeWithCategory');
		Route::get('/size/values/Status/Update/{value_id}/{size_id}/{status}', 'ConfigurationController@sizeValueStatusUpdate')->name('admin.size_value_status_update');
		Route::get('/size/value/Edit/{value_id}/{size_id}', 'ConfigurationController@sizeValueEdit')->name('admin.size_value_edit');
		Route::post('/size/value/Update', 'ConfigurationController@sizeValueUpdate')->name('admin.size_value_update');
		Route::get('/size/value/Delete/{value_id}/{size_id}', 'ConfigurationController@sizeValueDelete')->name('admin.size_value_delete');


		Route::get('/Size/List', 'ConfigurationController@sizeList')->name('admin.size_list');
		Route::get('/Size/Lists', 'ConfigurationController@sizeLists')->name('admin.size_lists');

		//********************Color Configuration Route*************************
		Route::get('/Add/Color/Name', 'ConfigurationController@viewColorNameForm')->name('admin.add_color_name_form');
		Route::post('/Add/Color/Name', 'ConfigurationController@AddColorName')->name('admin.add_color_name');

		Route::get('/Add/Color/Map', 'ConfigurationController@viewMapColorForm')->name('admin.map_color_form');
		Route::post('/Add/Color/Map', 'ConfigurationController@addColorMap')->name('admin.add_color_map');
		Route::get('Ajax/Get/Color/{color_id}', 'ConfigurationController@ajaxGetColor')->name('admin.ajax_get_color');
		Route::get('Ajax/Color/List', 'ConfigurationController@ajaxColorList')->name('admin.ajax_color_list');
		Route::get('Color/List', 'ConfigurationController@viewColorList')->name('admin.view_color_list');

		//********************Varient Configuration Route*************************
		
		Route::get('/Add/Varient/Name', 'ConfigurationController@viewVarientNameForm')->name('admin.add_varient_name_form');
		Route::post('/Add/Varient/Name', 'ConfigurationController@addVarientName')->name('admin.add_varient_name');
		Route::get('/Varient/Name/list', 'ConfigurationController@varientNameList')->name('admin.varient_name_list');
		Route::get('/Add/Varient/Value/{varient_id}', 'ConfigurationController@viewVarientValueForm')->name('admin.varient_value_form');
		Route::post('/Add/Varient/Value/', 'ConfigurationController@addVarientValue')->name('admin.add_varient_value');

		Route::get('Ajax/Varient/Name/List', 'ConfigurationController@ajaxVarientNameList')->name('admin.ajax_varient_name_list');
		Route::get('/Add/varient/Map', 'ConfigurationController@viewMapVarientForm')->name('admin.map_varient_form');
		Route::post('/Add/varient/Map', 'ConfigurationController@addMapVarient')->name('admin.map_varient_add');

		Route::get('/Ajax/varient/{first_category}', 'ConfigurationController@AjaxVarientNames');
		Route::get('/Ajax/varient/value/{varient_id}', 'ConfigurationController@AjaxVarientValueWithVarientId');
		Route::get('View/Varient/Mapped/List', 'ConfigurationController@ViewMappedVarientList')->name('admin.view_mapped_varient_list');
		Route::get('Ajax/Varient/Mapped/List', 'ConfigurationController@ajaxMappedVarientList')->name('admin.ajax_mapped_varient_list');

		//********************Brand Configuration Route*************************
		Route::get('/Add/Brand/Name', 'ConfigurationController@viewBrandNameForm')->name('admin.add_brand_name_form');
		Route::post('/Add/Brand/Name', 'ConfigurationController@addBrandName')->name('admin.add_brand_name');
		Route::get('/Brand/Name/list', 'ConfigurationController@brandNameList')->name('admin.brand_name_list');
		Route::get('Ajax/Brand/Name/List', 'ConfigurationController@ajaxBrandNameList')->name('admin.ajax_brand_name_list');
		Route::get('/Add/Brand/Map', 'ConfigurationController@viewMapBrandForm')->name('admin.map_brand_form');
		Route::get('/Ajax/brand/{first_category}', 'ConfigurationController@AjaxBrandNames');
		Route::post('/Add/Brand/Map', 'ConfigurationController@addMapBrand')->name('admin.add_map_brand');
		Route::get('View/Brand/Mapped/List', 'ConfigurationController@ViewMappedBrandList')->name('admin.view_mapped_brand_list');
		Route::get('Ajax/Brand/Mapped/List', 'ConfigurationController@ajaxMappedBrandList')->name('admin.ajax_mapped_brand_list');
		

		//*******************State Routes*********************

		Route::get('State/Add', 'ConfigurationController@ViewStateForm')->name('admin.view_state_form');
		Route::post('State/Add', 'ConfigurationController@AddStateForm')->name('admin.add_state');
		Route::get('State/Edit/{id}', 'ConfigurationController@EditState')->name('admin.edit_state');
		Route::post('State/Update', 'ConfigurationController@updateState')->name('admin.update_state');
		Route::get('State/Delete/{id}', 'ConfigurationController@deleteState')->name('admin.delete_state');

		//*******************City Routes*********************

		Route::get('City/Add', 'ConfigurationController@ViewCityForm')->name('admin.view_city_form');
		Route::post('City/Add', 'ConfigurationController@AddCity')->name('admin.add_city');
		Route::get('City/List', 'ConfigurationController@cityList')->name('admin.city_list');
		Route::get('Ajax/City/List', 'ConfigurationController@ajaxCityList')->name('admin.ajax_city_list');
		Route::get('City/Edit/{id}', 'ConfigurationController@EditCity')->name('admin.edit_city');
		Route::post('City/Update', 'ConfigurationController@updateCity')->name('admin.update_city');
		Route::get('City/Delete/{id}', 'ConfigurationController@deleteCity')->name('admin.delete_city');
	});

});


//////////////////// Routes For accessing admin And seller /////////////////////////////

Route::group(['middleware'=>'auth:admin,seller','prefix'=>'admin','namespace'=>'Admin'],function(){

	Route::group(['namespace'=> 'Category'], function(){
		Route::get('first/Category/{id}', 'CategoryController@firstCategoryWithCategory');
		Route::get('second/Category/{id}', 'CategoryController@secondCategoryWithFirstCategory');
	});

	Route::group(['namespace'=> 'Products','prefix'=>'Products'], function(){
		Route::get('ajax/form/load/data/{category}/{first_category}/{second_category}','ProductController@ajaxGetLoadFormData');
		
	});

});