<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    // 所有人都可以借， request 存的是当前用户id与书的id book_id    user_id
    public function BorrowBook(Request $request) {
        $book = \App\Model\Order::where('book_id', $request->book_id)
                                ->where('type_id', '<>', 2)
                                ->first();
        $user = \App\User::find($request->user_id);
        if(!$user)
        {
            return response()->json(['create' => false, 'err' => 'No user'], 200);
        }
        $borrowbook = \App\Model\Book::find($request->book_id);
        $hborrowed = \App\Model\Order::where('book_id', $request->book_id)
                                        -> where('user_id', $request->user_id)
                                        ->first();
        if(!$borrowbook)
        {
            return response()->json(['create' => false], 200);
        }
        if($book){
            return response()->json(['create' => false], 200);
        } else {
            // 新建模型对象
            if($hborrowed){
                return response()->json(['create' => false, 'err' => 'Cannt borrow the same book'], 200);
            }
            $order = new \App\Model\Order() ;
            $order->user_id = $request->user_id;
            $order->book_id = $request->book_id;
            $order->return_time = date('Y-m-d H:i:s',strtotime('+1 month'));
            $order->created_at = date('Y-m-d H:i:s');
            $order->updated_at = date('Y-m-d H:i:s');
            $order->type_id = 0;
            $order->save();
            return response()->json(['create' => true], 200);
        }
    }

    // 登录后自己借书 request 
    public function BorrowMyBook(Request $request) {
        $book = \App\Model\Order::where('book_id', $request->book_id)
                                ->first();
        if($book){
            return response()->json(['create' => false], 200);
        } else {
        // 新建模型对象
            $order = new \App\Model\order() ;
            $order->user_id = session('id');
            $order->book_id = $request->book_id;
            $order->return_time = date('Y-m-d H:i:s',strtotime('+1 month'));
            $order->created_at = date('Y-m-d H:i:s');
            $order->updated_at = date('Y-m-d H:i:s');
            $order->type_id = 0;
            $order->save();
            return response()->json(['create' => true], 200);
        }
    }

    // request book_id 直接还书
    public function ReturnBook(Request $request) {
        $order = \App\Model\Order::where('book_id', $request->book_id)
                -> where('type_id', 0)
                ->first();
        if($order){
            $order->type_id = 2;
            $order->save();
            return response()->json(['delete' => true], 200);
        } else {
            return response()->json(['delete' => false], 200);
        }
    }

    //通过 session
    public function GetMyAllBorrowedBook(Request $request) {

        $user_id = session('id');
        $orders = \App\Model\Order::where('user_id', $user_id)
                                    ->where('type_id','<>', 2 )
                                    ->get();
        $array = array();
        foreach($orders as $order){
            $book = \App\Model\Book::where('id', $order->book_id)
                                    ->first();
            
            $subarray = array();
            array_push($subarray, $order, $book);
            array_push($array, $subarray);
        }
        return $array;
    }

    // 所有人都可以借， request 存的是当前用户id与书的id book_id    uset_id
    public function RenewBook(Request $request){
        $book = \App\Model\Order::where('book_id', $request->book_id)
                                ->where('user_id', $request->user_id)
                                ->where('type_id', 0)
                                ->first();
        $user = \App\User::find($request->user_id);
        if(!$user)
        {
            return response()->json(['renew' => false], 200);
        }
        $borrowbook = \App\Model\Book::find($request->book_id);
        if(!$borrowbook)
        {
            return response()->json(['renew' => false], 200);
        }
        if($book){
            return response()->json(['renew' => false], 200);
        } else {
            // 新建模型对象
            $book->return_time = $book->return_time + 3600*24*10;
            $book->type = 1;
            $book->save();
            return response()->json(['renew' => true], 200);
        }
    }
    // 自己可以借,book_id
    public function RenewMyBook(Request $request){
        $book = \App\Model\Order::where('book_id', $request->book_id)
                                ->where('user_id', session('id'))
                                ->where('type_id', 0)
                                ->first();
        $borrowbook = \App\Model\Book::find($request->book_id);
        if(!$borrowbook)
        {
            return response()->json(['renew' => false], 200);
        }
        if($book){
            return response()->json(['renew' => false], 200);
        } else {
            // 新建模型对象
            $book->return_time = $book->return_time + 3600*24*10;
            $book->type = 1;
            $book->save();
            return response()->json(['renew' => true], 200);
        }
    }

    public function GetBorrowedBook(Request $request) {
        $user = \App\User::find($request->user_id);
        if(!$user){
            return response()->json(['get' => false], 200);
        }
        $orders = \App\Model\Order::where('user_id', $request->user_id)
                                ->where('type_id', '<', 2)
                                ->get();
        $array = array();
        foreach($orders as $order){
        $book = \App\Model\Book::where('id', $order->book_id)
                ->first();
        $subarray = array();
        array_push($subarray, $order, $book);
        array_push($array, $subarray);
        }
        return $array;
    }

    // 我的所有历史读书
    public function GetMyHistoryBook(){
        $user_id = session('id');
        $user = \App\User::where('id', $user_id)
                            ->first();
        if(!$user){
            return response()->json(['get' => false], 200);
        }
        $orders = \App\Model\Order::where('user_id', $user_id)
                                ->get();
        $array = array();
        foreach($orders as $order){
            $book = \App\Model\Book::where('id', $order->book_id)
                                      ->first();
            $subarray = array();
            array_push($subarray, $order, $book);
            array_push($array, $subarray);
        }
        return $array;
    }

    public function GetHistoryBookById(){

    }

}
