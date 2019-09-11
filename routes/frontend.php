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



Route::get('seller_register', function () {
    return view('web.seller.seller_register');
});