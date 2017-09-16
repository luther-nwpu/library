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

Route::get('/api', function () {
    return response('Hello World', 200)
    ->header('Content-Type', 'text/plain');
});

Route::post("/api/category/create" , 'CategoryManageController@create');
Route::post("/api/category/del" , 'CategoryManageController@delete'); 
Route::post("/api/category/find" , 'CategoryManageController@find');
Route::post("/api/category/update" , 'CategoryManageController@update');


Route::post("/api/auth/register" , 'AuthController@register');
Route::post("/api/auth/login" , 'AuthController@login');
Route::get("/api/test" , function() {
    return response()->json(['foo' => 'bar'], 200);
});
