<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Products APIS
Route::get('/getProducts','App\Http\Controllers\Api\ProductsController@getProducts');
Route::post('/addProduct','App\Http\Controllers\Api\ProductsController@addProduct');
Route::post('/updateProduct','App\Http\Controllers\Api\ProductsController@updateProduct');
Route::post('/deleteProduct','App\Http\Controllers\Api\ProductsController@deleteProduct');

//Categories APIS
Route::get('/getAllCategories','App\Http\Controllers\Api\CategoriesController@getAll');
Route::get('/getCategories','App\Http\Controllers\Api\CategoriesController@getCategories');
Route::post('/addCategory','App\Http\Controllers\Api\CategoriesController@addCategory');
Route::post('/updateCategory','App\Http\Controllers\Api\CategoriesController@updateCategory');
Route::post('/deleteCategory','App\Http\Controllers\Api\CategoriesController@deleteCategory');

//Upload API
Route::post('/uploadImage','App\Http\Controllers\Api\UploadController@uploadImage');
