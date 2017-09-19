<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookManageController extends Controller
{
    public function storeBook(Request $request){
        // 新建模型对象
        $oldbook = \App\Model\Book::where('bookcode', $request->bookcode)
                                 ->first();
        if($oldbook){
            return response()->json(['create' => false, 'err' => "this book already exist"], 200);
        }
        $book = new \App\Model\Book();
        // 添加表字段内容
        $book->bookname = $request->bookname;
        $book->bookcode = $request->bookcode;
        $book->created_at = date('Y-m-d H:i:s');
        $book->updated_at = date('Y-m-d H:i:s');
        $book->description = $request->description;
        $book->category_id = $request->category_id;
        $book->ISBN = $request->ISBN;
        $book->bookpublishtime = $request->bookpublishtime;
        $book->booklocation = $request->booklocation;
        $book->save();
        return response()->json(['create' => true, 'book' => $book], 200);
    }
    // 查询
    public function findBook(Request $request){
        // 新建模型对象
        $book = \App\Model\Book::where('id', $request->id);
        return $book;
    }
    // 删除
    public function deleteBook(Request $request){
        $info = \App\Model\Book::find($request->id) ;
        $res = $info->delete() ;
        if($res){
            return response()->json(['delete' => true], 200);
        } else {
            return response()->json(['delete' => false], 200);
        }
    }
    // 更新
    public function updateBook(Request $request){
        $book = \App\Model\Book::find($request->id) ;
        if($book){  
            $book->bookname = $request->bookname;
            $book->bookcode = $request->bookcode;
            $book->description = $request->description;
            $book->category_id = $request->category_id;
            $book->ISBN = $request->ISBN;
            $book->bookpublishtime = $request->bookpublishtime;
            $book->booklocation = $request->booklocation;
            $book->save();
            return response()->json(['update' => true], 200);
        }else{
            return response()->json(['update' => false], 200);
        }
    }
    public function getAllBook(){
        $books = \App\Model\Book::all();
        $array = array();
        foreach($books as $book){
            $borrow = \App\Model\Order::where('book_id', $book->id)
                                        ->where('type_id', 0||1)
                                        ->first();
            $rootarray = array();
            array_push($rootarray, $book, $borrow);
            array_push($array, $rootarray);
        }
        return $array;
    }
}
