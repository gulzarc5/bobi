<?php

Route::group(['namespace'=> 'Products','prefix'=>'Products'], function(){

	Route::get('/Add/Form', 'ProductController@viewProductAddForm')->name('admin.add_product_form');

	Route::post('/Add', 'ProductController@addNewProduct')->name('admin.add_new_product');

	Route::get('/list', 'ProductController@productList')->name('admin.product_list');

	Route::get('/list/export', 'ProductController@productListExcelExport')->name('admin.product_list_excel');

	Route::get('ajax/Get/List/','ProductController@ajaxGetProductList')->name('admin.ajax.get_product_list');

	Route::get('/view/{product_id}', 'ProductController@productView')->name('admin.product_view');

	Route::get('/Edit/{product_id}', 'ProductController@productEdit')->name('admin.product_edit');

	Route::post('/updates/id/', 'ProductController@productUpdate')->name('admin.update_product');

	Route::get('ajax/Get/Brands/{category}/{first_category}/{second_category}','ProductController@ajaxGetLoadFormData');

	Route::get('/Images/{product_id}', 'ProductController@productImages')->name('admin.product_images');

	Route::get('/Thumb/Set/{product_id}/{image_id}', 'ProductController@productSetThumb')->name('admin.product_set_thumb');

	Route::get('/Images/Status/Update/{product_id}/{image_id}/{status}', 'ProductController@productUpdateImageStatus')->name('admin.product_images_status_update');

	Route::get('/Images/Delete/{product_id}/{image_id}', 'ProductController@productDeleteImage')->name('admin.product_images_delete');
	Route::post('/More/Image/Add/', 'ProductController@productMoreImageAdd')->name('admin.product_more_image_add');

	Route::get('/Sizes/{product_id}', 'ProductController@productSizes')->name('admin.product_sizes');
	Route::post('/Size/Update/', 'ProductController@productSizeUpdate')->name('admin.product_size_update');
	Route::get('/Size/Status/{size_id}/{status}/{product_id}', 'ProductController@productSizeStatusUpdate')->name('admin.product_size_status_update');
	Route::post('/New/Size/Add/', 'ProductController@productNewSizeAdd')->name('admin.product_new_size_add');

	

	Route::get('/Colors/Edit/{product_id}', 'ProductController@productColorEdit')->name('admin.product_Color_edit');
	Route::post('/Color/Update/', 'ProductController@productColorUpdate')->name('admin.product_color_update');
	Route::post('/New/Color/Add/', 'ProductController@productNewColorAdd')->name('admin.product_new_color_add');

	Route::get('/Status/Update/{product_id}/{status}', 'ProductController@productStatusUpdate')->name('admin.product_status_update');
});

Route::group(['namespace' => 'Order'],function(){
	Route::get('/All/Orders/', 'OrderController@orderListAll')->name('admin.all_order_list');	
	Route::get('Order/Details/{order_id}','OrderController@orderDetails')->name('admin.order_details');
	Route::get('Order/Status/Update/{order_id}/{order_details_id}/{status}','OrderController@orderStatusUpdate')->name('admin.order_status_update');
	Route::get('ajax/all/orders','OrderController@ajaxOrderListAll')->name('admin.ajax_order_all');
	Route::get('/Processing/Orders/', 'OrderController@processingOrders')->name('admin.processing_orders');	
	Route::get('/Processing/Orders/Excel', 'OrderController@processingOrdersExcel')->name('admin.processing_orders_excel');	
	Route::get('ajax/processing/orders','OrderController@ajaxProcessingOrders')->name('admin.ajax_processing_orders');
	Route::get('/Dispatched/Orders/', 'OrderController@dispatchedOrders')->name('admin.dispatched_orders');		
	Route::get('ajax/dispatched/orders','OrderController@ajaxdispatchedOrders')->name('admin.ajax_dispatched_orders');

	Route::get('Order/Details/OrderDetail/{order_id}','OrderController@orderDetailsFromOrderDetail')->name('admin.order_details_of_order_detail');

	Route::get('order/dispatch/{order_details_id}','OrderController@dispatchOrder')->name('admin.order_dispatch');
	Route::get('order/dispatch/Update/{order_details_id}/{awb_no}','OrderController@dispatchOrderUpdate')->name('admin.order_dispatch_update');
});