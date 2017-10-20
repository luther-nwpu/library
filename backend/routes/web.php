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
Route::get("/api/auth/admininfo", 'AuthController@MyLoginInformation');
Route::post("/api/auth/logout", 'AuthController@logout');

Route::post("/api/order/borrowbook", 'OrderController@BorrowBook');
Route::post("/api/order/renewbook", 'OrderController@RenewBook');
Route::post("/api/order/returnbook", 'OrderController@ReturnBook');
Route::post("/api/order/myborrowbookbyuser", 'OrderController@GetBorrowedBook');

Route::post("/api/order/getUserByUserCode", 'OrderController@GetUserByUserCode');

Route::post("/api/order/findbook" , 'BookManageController@findBook');


Route::post("/api/book/findbookByISBN" , 'BookManageController@findBookByISBN');
Route::post("/api/book/findAllBookByISBN" , 'BookManageController@findAllBookByISBN');
Route::get("/api/book/getall" , 'BookManageController@getAllBook');

Route::group(['middleware' => ['auth']], function () {
    Route::get("/api/order/myallbook", 'OrderController@GetMyAllBorrowedBook');
    Route::post("/api/order/borrowmybook", 'OrderController@BorrowMyBook');
    Route::post("/api/order/renewmyBook", 'OrderController@RenewMyBook');
    Route::get("/api/order/myhistorybook", 'OrderController@GetMyHistoryBook');
    Route::get("/api/auth/myuserinfo", 'AuthController@MyUserInfo');
    Route::post('/api/auth/updateuserinfo', 'AuthController@updateUserInfo');
    Route::post('/api/auth/resetMyPassword', 'AuthController@resetMyPassword');
    Route::post('/api/auth/resetMyImage', 'AuthController@resetMyImage');
    Route::post('/api/auth/resetMyUserCode', 'AuthController@resetMyUserCode'); 
});

Route::post("/api/book/getBookAllImage" , 'BookManageController@getBookAllImage');
Route::group(['middleware' => ['manager']], function () {
    Route::post("/api/book/createbook" , 'BookManageController@storeBook');
	Route::post("/api/book/updatebookByISBN" , 'BookManageController@updateBookISBN');
	Route::post("/api/book/updatebooklocationById" , 'BookManageController@updateBooklocation');
	Route::post("/api/book/deletebookById" , 'BookManageController@deleteBookById');
	Route::post("/api/book/bindBookImage" , 'BookManageController@bindBookImage');
	Route::post("/api/book/CancelBindBookImage" , 'BookManageController@CancelBindBookImage');

	Route::post("/api/book/deletebyIsbn" , 'BookManageController@deleteBookByISBN');
    Route::post("/api/book/updatebookbyName" , 'BookManageController@updateBook');
});



Route::post("/api/upload", 'UploadController@uploadImage');
Route::get("/api/getImage", 'UploadController@getImage');



Route::group(['middleware' => ['admin']], function () {
	
    Route::post("/api/admin/createmanager" , 'LibraryManagerController@createLibraryManager');
    Route::post("/api/admin/deletemanager" , 'LibraryManagerController@deleteLibraryManager');
    Route::get("/api/admin/getallmanager",  'LibraryManagerController@getAllLibraryManager');
	Route::post("/api/admin/getuserbyemail", 'LibraryManagerController@getUser');
	
    // 书籍管理      
    Route::get('/api/auth/getAllUser', 'AuthController@getAllUser');
    Route::post('/api/auth/deleteUser', 'AuthController@deleteUser');
    Route::post('/api/auth/resetPassword', 'AuthController@resetPassword');
});
