<?php

Route::group(['namespace'=> 'Web'], function(){

    Route::get('/Seller-Register','RegisterController@sellerRegistrationForm')->name('web.seller_registration_form');
    Route::post('/Seller-Registeration','RegisterController@Registration')->name('web.seller_registration');

    Route::group(['namespace'=> 'Product','prefix'=>'Product'], function(){
        Route::get('/List/{second_category_id}','ProductController@productList')->name('web.product_list');
        Route::get('/Detail/{product_id}','ProductController@productDetail')->name('web.product_detail');
    });

});


Route::get('/', function () {
    return view('web.index');
})->name('web.index');
// Route::get('/Seller-Login', function () {
//     return view('web.seller-login');
// });

Route::get('/Product_Detail', function () {
    return view('web.product_detail');
});
// Route::get('/Product_List', function () {
//     return view('web.product_list');
// });
Route::get('/Login', function () {
    return view('web.login');
})->name('web.login');
Route::get('/Register', function () {
    return view('web.register');
})->name('web.register');
Route::get('/Forgot-Password', function () {
    return view('web.forgot-password');
})->name('web.forgot-password');
Route::get('/Cart', function () {
    return view('web.cart');
})->name('web.cart');
Route::get('/Shipping', function () {
    return view('web.shipping');
})->name('web.shipping');

