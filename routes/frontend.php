<?php

Route::group(['namespace'=> 'Web'], function(){

    Route::get('/Seller-Register','RegisterController@sellerRegistrationForm')->name('web.seller_registration_form');
    Route::post('/Seller-Registeration','RegisterController@Registration')->name('web.seller_registration');

    Route::get('/User/Registration','RegisterController@userRegistrationForm')->name('web.user_registration_form');
    Route::post('/User/Registration','RegisterController@userRegistration')->name('web.user_registration');

    Route::get('/user_login', 'UserController@userLoginForm')->name('web.userLoginForm');
    Route::post('/user_login', 'LoginController@buyerLogin')->name('web.buyerLogin');
    Route::post('/Logout', 'LoginController@logout')->name('web.buyerLogout');

    Route::get('/shopping_cart', 'CartController@viewCart')->name('web.viewCart');
    Route::post('/Product/Add', 'CartController@AddCart')->name('web.add_cart');
    Route::post('/cartUpdate', 'CartController@updateCart')->name('web.updateCart');
    Route::get('/cart/item/remove/{p_id}','CartController@cartItemRemove')->name('cartItemRemove');


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
Route::get('/Cart', function () {
    return view('web.cart');
})->name('web.cart');
Route::get('/order', function () {
    return view('web.your_order');
})->name('web.order');

Route::get('/Shipping', function () {
    return view('web.shipping');
})->name('web.shipping');

Route::get('/my_account', function () {
    return view('web.my_account');
})->name('web.my_account');

Route::get('/wishlist', function () {
    return view('web.wishlist');
})->name('web.wishlist');
