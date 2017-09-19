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

// 测试
Route::get("/api/test" , function() {
    return response()->json(['foo' => 'bar'], 200);
});

// 登录 
Route::post("/api/auth/register" , 'AuthController@register');
Route::post("/api/auth/login" , 'AuthController@login');
Route::post("/api/auth/admininfo", 'AuthController@MyLoginInformation');
Route::post("/api/auth/logout", 'AuthController@logout');

Route::post("/api/order/borrowbook", 'OrderController@BorrowBook');
Route::post("/api/order/renewbook", 'OrderController@RenewBook');
Route::post("/api/order/returnbook", 'OrderController@ReturnBook');
Route::post("/api/order/allborrowbook", 'OrderController@ReturnBook');

Route::group(['middleware' => ['auth']], function () {
    Route::get("/api/order/myallbook", 'OrderController@GetMyAllBorrowedBook');
    Route::post("/api/order/borrowmybook", 'OrderController@BorrowMyBook');
    Route::post("/api/order/renewmyBook", 'OrderController@RenewMyBook');
});
Route::group(['middleware' => ['admin']], function () {
    // 书籍管理  
    Route::post("/api/category/create" , 'CategoryManageController@createCategory');
    Route::post("/api/category/del" , 'CategoryManageController@deleteCategory'); 
    Route::get("/api/category/getall" , 'CategoryManageController@getAllCategory');
    // 目录管理
    Route::get("/api/book/getall" , 'BookManageController@getAllBook');
    Route::post("/api/book/del" , 'BookManageController@deleteBook'); 
    Route::post("/api/book/update" , 'BookManageController@updateBook');
    Route::post("/api/book/create" , 'BookManageController@storeBook');
    Route::post("/api/book/findbook" , 'BookManageController@findBook');

    Route::post("/api/admin/create" , 'LibraryManagerController@createLibraryManager');
    Route::post("/api/admin/delete" , 'LibraryManagerController@deleteLibraryManager');
    Route::get("/api/admin/getall",  'LibraryManagerController@getAllLibraryManager');
    Route::post("/api/admin/getuser", 'LibraryManagerController@getUser');
    
});
