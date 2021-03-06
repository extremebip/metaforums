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
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::prefix('/subcategories/{subCategoryId}')->group(function ($subCategoryId)
{
    Route::get('threads', 'HomeController@threads')->name('getThread');
    Route::get('threads/create', 'HomeController@createThread')->name('createThread');
    Route::post('threads', 'HomeController@saveThread')->name('saveThread');
});
Route::get('/thread/{threadId}', 'HomeController@posts')->name('getPost');