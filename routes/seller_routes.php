<?php

Route::get('seller_login', function () {
	return view('web.seller-login');
})->name('seller_login');

Route::group(['prefix'=>'Seller','namespace'=>'Seller'],function(){

	Route::post('/Login', 'SellerLoginController@sellerLogin')->name('seller.login');
	Route::post('/logout', 'SellerLoginController@logout')->name('seller.logout');

	Route::get('first/Category/{id}', 'SellerController@sellerFirstCategoryWithCategory');
		Route::get('second/Category/{id}', 'SellerController@sellerSecondCategoryWithFirstCategory');

	Route::group(['middleware'=>'auth:seller'],function(){

		require __DIR__.'/seller_product_routes.php';
	 
		Route::get('/Deshboard', 'SellerController@index')->name('seller.deshboard');
		Route::get('/MyProfile', 'SellerController@myProfileForm')->name('seller.MyprofileForm');
		Route::get('/Category/{status?}', 'SellerController@myCategoryForm')->name('seller.MyCategoryForm');
		Route::post('/Category/Update', 'SellerController@myCategoryUpdate')->name('seller.MyCategoryUpdate');
		Route::get('/Category/delete/{id}', 'SellerController@myCategoryDelete')->name('seller.MyCategoryDelete');
		Route::post('/MyProfile', 'SellerController@sellerUpdate')->name('seller.MyprofileUpdate');
		Route::get('/change/Password', 'SellerController@viewChangePasswordForm')->name('seller.change_password_form');
		Route::post('/change/Password', 'SellerController@ChangePassword')->name('seller.change_password');

		Route::get('/all/Orders','OrderController@allOrders')->name('seller.all_orders');
		Route::get('ajax/all/Orders','OrderController@allOrdersAjax')->name('seller.ajax_all_orders');
		Route::get('view/Orders/{order_details_id}','OrderController@OrdersView')->name('seller.order_view');
		Route::get('order/dispatch/{order_details_id}','OrderController@dispatchOrder')->name('seller.order_dispatch');
		Route::post('order/dispatch/Update','OrderController@dispatchOrderUpdate')->name('seller.order_dispatch_update');
		Route::get('Order/Status/Update/{order_id}/{order_details_id}/{status}','OrderController@orderStatusUpdate')->name('seller.order_status_update');
	});
});

