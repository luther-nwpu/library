<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookManageController extends Controller
{
       public function storeBook(Request $request){
        // 新建模型对象
        $book = new \App\Book() ;
        // 添加表字段内容
        $book->bookname = $request->bookname;
        $book->bookcode = $request->bookcode;
        $book->created_at = date('Y-m-d H:i:s');
        $book->updated_at = date('Y-m-d H:i:s');
        $book->description = $request->description;
        $book->category_id = $request->category_id;
        $book->save() ;
    }
    // 查询
    public function findBook(Request $request){
        // 新建模型对象
        $book = \App\Book::where('id', $request->id);
        return $book;
    }
    // 删除
    public function deleteBook(Request $request){
        $info = \App\Book::find($request->id) ;
        $res = $info->delete() ;
        if($res){
            return response()->json(['delete' => true], 200);
        } else {
            return response()->json(['delete' => false], 200);
        }
        // dd($res);
    }
    // 更新
    public function updateBook(Request $request){
        $book = \App\Book::find($request->id) ;
        if($book){
            $book->bookname = $request->bookname;
            $book->bookcode = $request->bookcode;
            $book->description = $request->description;
            $book->category_id = $request->category_id;
            $book->save();
            return response()->json(['update' => true], 200);
        }else{
            return response()->json(['update' => false], 200);
        }
    }
    public function getAllBook(){
        $books = \App\Book::all();
        return $books;
    }
}
