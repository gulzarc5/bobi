<?php

Route::group(['namespace'=> 'Web'], function(){

    Route::group(['namespace'=> 'Category'], function(){
        Route::get('/', 'CategoryController@index')->name('index_page');

        Route::get('Sub/Category/{first_id}', 'CategoryController@SecondCategory')->name('web.sub_category');
    });

     Route::group(['namespace'=> 'Product','prefix'=>'Product'], function(){
        Route::get('Sellers/{second_category}', 'ProductController@productSellerWithSecondCategory')->name('web.product_sellers');
     });

});





Route::get('/about_us', function () {
    return view('web.about_us');
});
Route::get('/contact_us', function () {
    return view('web.contact_us');
});
Route::get('/contact_us', function () {
    return view('web.contact_us');
});
Route::get('chat_history', function () {
    return view('web.chat.chat_history');
});
Route::get('chat', function () {
    return view('web.chat.chat');
});
Route::get('product_category', function () {
    return view('web.product.product_category');
});


Route::get('product_details', function () {
    return view('web.product.product_details');
});


Route::get('seller_register', function () {
    return view('web.seller.seller_register');
});