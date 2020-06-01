<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes([
    'reset'     => false,
    'confirm'   => false,
]);
Route::get('logout','Auth\LoginController@logout')->name('get-logout');

Route::middleware(['auth'])->group(function (){

    Route::group(['prefix'=>'person', 'namespace'=>'Person', 'as'=>'person.'], function (){

        Route::get('/orders', 'OrdersController@index')->name('order.index');
        Route::get('/orders/{orders}', 'OrdersController@show')->name('orders.show');
    });

    //Админка
    Route::group(['namespace' => 'Admin', 'prefix'=>'admin'], function () {
        Route::group(['middleware' => 'is_admin',], function (){

            Route::get('/orders', 'OrdersController@index')->name('home');
            Route::get('/orders/{orders}', 'OrdersController@show')->name('orders.show');
            Route::resource('products', 'ProductController');
            Route::resource('categories', 'CategoryController');
        });
    });


});


//Корзина
Route::post('/basket/add/{id}','BasketController@basketAdd')->name('basket-add');
Route::group(['middleware' => 'basket_not_empty', 'prefix'=>'basket' ], function () {
        Route::get('/','BasketController@basket')->name('basket');
        Route::get('/palace','BasketController@basketPlace')->name('basket-place');
        Route::post('/palace','BasketController@basketConfirm')->name('basket-confirm');
        Route::post('/remove/{id}','BasketController@basketRemove')->name('basket-remove');
});



Route::get('/','MainController@index')->name('index');
Route::get('/categories','MainController@categories')->name('categories');
Route::get('/{category}','MainController@category')->name('category');
Route::get('/{categories}/{product}','MainController@product')->name('product');



