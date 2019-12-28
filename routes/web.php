<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('test')->group(function ()
{
    Route::get('/','TestController@index');
    Route::post('category', 'TestController@saveCategory');
    Route::post('categories/{category}/sub-categories', 'TestController@getSubCategories')->name('getSubCategories');
    Route::post('sub-category', 'TestController@saveSubCategory');
});