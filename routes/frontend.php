<?php

Route::group(['namespace'=> 'Web'], function(){

    Route::get('/Seller-Register','RegisterController@sellerRegistrationForm')->name('web.seller_registration_form');
    Route::post('/Seller-Registeration','RegisterController@Registration')->name('web.seller_registration');

    Route::get('/User/Registration','RegisterController@userRegistrationForm')->name('web.user_registration_form');
    Route::post('/User/Registration','RegisterController@userRegistration')->name('web.user_registration');

    Route::get('/user_login', 'UserController@userLoginForm')->name('web.userLoginForm');
    Route::post('/user_login', 'LoginController@buyerLogin')->name('web.buyerLogin');


    Route::get('/shopping_cart', 'CartController@viewCart')->name('web.viewCart');
    Route::post('/Product/Add', 'CartController@AddCart')->name('web.add_cart');
    Route::post('/cartUpdate', 'CartController@updateCart')->name('web.updateCart');
    Route::get('/cart/item/remove/{p_id}','CartController@cartItemRemove')->name('cartItemRemove');

    Route::group(['prefix'=>'User','middleware'=>'auth:buyer'], function(){
        Route::get('/my_profile', 'UserController@myProfileForm')->name('web.myprofile');
        Route::post('/my_profile/Update', 'UserController@myProfileUpdate')->name('web.myprofile_update');
        Route::post('/Shipping/Address/Add', 'UserController@shippingAdd')->name('web.new_shipping_add');
        Route::post('/Update/Address/', 'UserController@updateShippingAddress')->name('web.update_shipping_address');
        Route::get('/Delete/Address/{address_id}', 'UserController@DeleteShippingAddress')->name('web.delete_shipping_address');
        Route::post('/Change/Password/', 'UserController@changePassword')->name('web.change_password');

        Route::get('/WishList/Add/{product_id}', 'UserController@AddWishList')->name('web.add_wish_list');
        Route::get('/WishList/View', 'UserController@viewWishList')->name('web.view_wish_list');
        Route::get('/WishList/Delete/{list_id}', 'UserController@deleteWishList')->name('web.delete_wish_list');
        Route::get('/WishList/Move/{list_id}', 'UserController@wishListMove')->name('web.move_wish_list');

        Route::get('/checkout','CheckoutController@checkoutShip')->name('web.checkout_ship');

        Route::post('Place/Order','CheckoutController@placeOrder')->name('web.place_order');

        Route::post('New/Shippin/Add/Checkout','UserController@shippingAddCheckout')->name('web.new_ship_add');
        Route::post('/Logout', 'LoginController@logout')->name('web.buyerLogout');
    });
    


    Route::group(['namespace'=> 'Product','prefix'=>'Product'], function(){
        Route::get('/List/{second_category_id}','ProductController@productList')->name('web.product_list');
        Route::get('/Detail/{product_id}/{size_id?}','ProductController@productDetail')->name('web.product_detail');
        Route::post('/By/Filter/','ProductController@productFilter')->name('web.product_filter');
    });

});


Route::get('/', function () {
    return view('web.index');
})->name('web.index');
// Route::get('/Seller-Login', function () {
//     return view('web.seller-login');
// });

// Route::get('/Product_Detail', function () {
//     return view('web.product_detail');
// });
// Route::get('/Product_List', function () {
//     return view('web.product_list');
// });
// Route::get('/Login', function () {
//     return view('web.login');
// })->name('web.login');
// Route::get('/Register', function () {
//     return view('web.register');
// })->name('web.register');
Route::get('/Forgot-Password', function () {
    return view('web.forgot-password');
})->name('web.forgot-password');
// Route::get('/Cart', function () {
//     return view('web.cart');
// })->name('web.cart');
Route::get('/order', function () {
    return view('web.your_order');
})->name('web.order');

Route::get('/Shipping', function () {
    return view('web.shipping');
})->name('web.shipping');

// Route::get('/my_account', function () {
//     return view('web.my_account');
// })->name('web.my_account');

// Route::get('/wishlist', function () {
//     return view('web.wishlist');
// })->name('web.wishlist');

 Route::get('/thankyou', function () {
     return view('web.thankyou');
 })->name('web.thankyou');
 Route::get('/returnpolicy', function () {
     return view('web.returnpolicy');
 })->name('web.returnpolicy');