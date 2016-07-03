<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();
Route::get('/admin/drinks/{id?}', 'DrinksController@destroy');
Route::get('catalog', 'HomeController@index');
Route::get('/admin', 'AdminController@index');

Route::get('/admin/drinks', 'DrinksController@index');

Route::get('/admin/updateDrinks/{id?}', 'DrinksController@edit');
Route::get('/admin/createDrinks', 'DrinksController@create');

Route::post('/admin/drinks', 'DrinksController@store');
Route::post('/admin/drinks/{id}', 'DrinksController@update');


/*
 * Electrics
 */
Route::group(['middleware' => 'auth'], function() {
    //destroy item
    Route::get('/admin/electrics/{id}', 'ElectricsController@destroy');
    //default
    Route::get('/admin/electrics', 'ElectricsController@index');
    //edit
    Route::get('/admin/electrics/edit/{id}', 'ElectricsController@edit');
    //update
    Route::post('/admin/electrics/{id}', 'ElectricsController@update');
    //add item to DB
    Route::post('/admin/electrics', 'ElectricsController@store');

});

// Phones
Route::group(['middleware' => 'auth'], function() {
    //destroy item
    Route::get('/admin/phones/{id}', 'PhoneController@destroy');

    Route::get('admin/phones', 'PhoneController@index');
    //add item to DB
    Route::post('/admin/phones', 'PhoneController@store');
});

//Каталог напитков
Route::get('/catalog/drinks', 'CatalogDrinksController@index');
Route::get('/catalog/catalogDrinks/{id?}', 'CatalogDrinksController@filter');


//    Route::post('/admin/drinks/' ,'DrinksController@update');
//})->where(['id'=>'[55]+']);
//Route::get('/goods', 'GoodsController@index');
//Route::group(['middleware' => 'auth'], function() {
//    Route::resource('/goods/', 'GoodsController');
//    Route::post('goods/store', 'GoodsController@store');
//
//});