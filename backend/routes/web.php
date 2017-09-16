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

// 目录管理
Route::post("/api/category/create" , 'CategoryManageController@createCategory');
Route::post("/api/category/del" , 'CategoryManageController@deleteCategory'); 
Route::get("/api/category/getall" , 'CategoryManageController@getAllCategory');

// 登录 
Route::post("/api/auth/register" , 'AuthController@register');
Route::post("/api/auth/login" , 'AuthController@login');

// 测试
Route::get("/api/test" , function() {
    return response()->json(['foo' => 'bar'], 200);
});

// 书籍管理
