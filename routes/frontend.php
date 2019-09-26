<?php

// Route::group(['namespace'=> 'Web'], function(){

//     Route::group(['namespace'=> 'Category'], function(){
//         Route::get('/', 'CategoryController@index')->name('index_page');

//         Route::get('Sub/Category/{first_id}', 'CategoryController@SecondCategory')->name('web.sub_category');
//     });

//      Route::group(['namespace'=> 'Product','prefix'=>'Product'], function(){
//         Route::get('Sellers/{second_category}', 'ProductController@productSellerWithSecondCategory')->name('web.product_sellers');
//      });

// });



Route::get('/', function () {
    return view('web.index');
});
Route::get('/Seller-Login', function () {
    return view('web.seller-login');
});
Route::get('/Seller-Register', function () {
    return view('web.seller-register');
});
Route::get('/Product_Detail', function () {
    return view('web.product_detail');
});
Route::get('/Product_List', function () {
    return view('web.product_list');
});