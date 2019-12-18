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

	Route::group(['namespace'=> 'Users'], function(){
		Route::get('/sellers/List','UsersController@allSellers')->name('admin.allSellers');
		Route::get('Ajax/sellers/','UsersController@ajaxAllSellers')->name('admin.ajaxAllSellers');

		Route::get('/Buyers/List','UsersController@allBuyers')->name('admin.allBuyers');
		Route::get('Ajax/Buyers/','UsersController@ajaxAllBuyers')->name('admin.ajaxAllBuyers');

		Route::get('/Seller/Details/{seller_id}','UsersController@sellerView')->name('admin.seller_view');
		Route::get('/Seller/verification/{seller_id}','UsersController@sellerUpdateVerification')->name('admin.sellerUpdateVerification');
		Route::get('/Seller/Status/{seller_id}/{status}','UsersController@sellerUpdateStatus')->name('admin.sellerUpdateStatus');
	});
	 
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
		Route::get('/Add/Size', 'ConfigurationController@viewSizeForm')->name('admin.add_size_form');
		Route::post('/Add/Size', 'ConfigurationController@addSize')->name('admin.add_size');
		Route::get('/size/values/{size_id}', 'ConfigurationController@AjaxSizeValues');
		Route::get('ajax/size/{first_category}', 'ConfigurationController@AjaxSizeWithCategory');


		Route::get('/Size/List', 'ConfigurationController@sizeList')->name('admin.size_list');
		Route::get('/Size/Lists', 'ConfigurationController@sizeLists')->name('admin.size_lists');
		Route::get('/Size/Status/Update/{size_id}/{status}', 'ConfigurationController@sizeStatusUpdate')->name('admin.size_status_update');

		//********************Color Configuration Route*************************
		Route::get('/Add/Color/Name', 'ConfigurationController@viewColorNameForm')->name('admin.add_color_name_form');
		Route::post('/Add/Color', 'ConfigurationController@AddColor')->name('admin.add_color');

		Route::get('Ajax/Color/List', 'ConfigurationController@ajaxColorList')->name('admin.ajax_color_list');
		Route::get('Color/List', 'ConfigurationController@viewColorList')->name('admin.view_color_list');
		Route::get('Color/Edit/{color_id}', 'ConfigurationController@viewColorEditForm')->name('admin.view_color_edit_form');
		Route::post('Color/Update', 'ConfigurationController@colorUpdate')->name('admin.color_update');

		Route::get('/Color/Status/Update/{color_id}/{status}', 'ConfigurationController@colorStatusUpdate')->name('admin.color_status_update');

		//********************Brand Configuration Route*************************
		Route::get('/Add/Brand/', 'ConfigurationController@viewBrandForm')->name('admin.add_brand_form');
		Route::post('/Add/Brand', 'ConfigurationController@addBrand')->name('admin.add_brand');
		Route::get('/Brand/Name/list', 'ConfigurationController@brandNameList')->name('admin.brand_name_list');
		Route::get('Ajax/Brand/Name/List', 'ConfigurationController@ajaxBrandNameList')->name('admin.ajax_brand_name_list');
		Route::get('/Ajax/brand/{first_category}', 'ConfigurationController@AjaxBrandNames');
		Route::get('/Brand/Status/Update/{brand_id}/{status}', 'ConfigurationController@brandStatusUpdate')->name('admin.brand_status_update');
		

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


		Route::get('App/Slider/Form', 'ConfigurationController@ViewAppSliderForm')->name('admin.app_slider_form');
		Route::post('App/Slider/Insert', 'ConfigurationController@appSliderInsert')->name('admin.app_slider_insert');
		Route::get('App/Slider/Edit/{id}', 'ConfigurationController@AppSliderEdit')->name('admin.sliderEdit');
		Route::get('App/Slider/Delete/{id}', 'ConfigurationController@appSliderDelete')->name('admin.sliderDelete');
		Route::post('App/Slider/Update', 'ConfigurationController@appSliderUpdate')->name('admin.app_slider_update');
	});

});


//////////////////// Routes For accessing admin And seller /////////////////////////////

Route::group(['middleware'=>'auth:admin,seller','prefix'=>'admin','namespace'=>'Admin'],function(){

	Route::group(['namespace'=> 'Category'], function(){
		Route::get('first/Category/{id}', 'CategoryController@firstCategoryWithCategory');
		Route::get('second/Category/{id}', 'CategoryController@secondCategoryWithFirstCategory');
	});

	Route::group(['namespace'=> 'Products','prefix'=>'Products'], function(){
		Route::get('ajax/form/load/data/{category}/{first_category}','ProductController@ajaxGetLoadFormData');
	});

});