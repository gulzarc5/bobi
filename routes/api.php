<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['namespace'=>'Api'], function(){
    Route::get('category/list/{main_cat_id}/{traditional_type?}','CategoryController@CategoryList');
    
    Route::get('product/list/second/category/{second_category}/{page}','ProductController@productList');
    Route::post('product/filter','ProductController@productListWithFilter');
    Route::get('product/single/view/{product_id}','ProductController@singleProductView');
    Route::get('releted/product/{second_category}','ProductController@reletedProducts');

    Route::post('user/registration','UsersController@userRegistration');
    Route::post('user/login','UsersController@userLogin');
    Route::get('user/Shipping/pin/check/{pin}','OrderController@pinAvailability');
    Route::group(['middleware'=>'auth:api'],function(){
        Route::get('user/profile/{user_id}','UsersController@userProfile');
        Route::post('user/profile/update','UsersController@userProfileUpdate');

        Route::post('user/shipping/add','UsersController@userShippingAdd');
        Route::get('user/shipping/list/{user_id}','UsersController@userShippingList');
        Route::get('user/shipping/single/{user_id}/{address_id}','UsersController@userShippingSingleView');
        Route::post('user/shipping/update','UsersController@userShippingUpdate');

        Route::post('user/add/to/cart','CartController@addToCart');
        Route::get('user/cart/all/product/{user_id}','CartController@cartProduct');
        Route::post('user/cart/update/quantity','CartController@cartUpdate');
        Route::get('user/cart/remove/item/{cart_id}','CartController@cartRemove');

        Route::get('user/add/to/wish/list/{product_id}/{user_id}','CartController@addToWishList');
        Route::get('user/wish/list/items/{user_id}','CartController@wishListProducts');
        Route::get('user/wish/to/cart/{user_id}/{wish_list_id}','CartController@wishListToCart');
        Route::get('user/wish/item/remove/{user_id}/{wish_list_id}','CartController@wishListItemRemove');

        Route::post('user/place/order','OrderController@placeOrder');
        Route::get('user/update/payment/request/id/{order_id}/{payment_rqst_id}','OrderController@updatePaymentRequestId');
        Route::get('user/update/payment/id/{order_id}/{payment_rqst_id}/{payment_id}','OrderController@updatePaymentId');

        Route::get('user/order/history/{user_id}','OrderController@orderHistory');

        Route::get('user/order/cancel/{order_id}','OrderController@orderCancel');
    });



});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
