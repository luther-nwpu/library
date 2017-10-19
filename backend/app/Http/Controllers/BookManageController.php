<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookManageController extends Controller
{
    public function storeBook(Request $request){
        for ($i=0; $i<$request->booknum; $i++) {
            $book = new \App\Model\Book();
            // 添加表字段内容
            if($request->category){
                $book->category = $request->category;
            } else {
                $book->category = '';
            }
            if($request->isbn) {
                $book->isbn = $request->isbn;
            } else {
                $book->isbn = '';
            }
            if($book->title) {
                $book->title = $request->title;
            } else {
                $book->title = '';
            }
            if($request->image) {
                $book->image = $request->image;
            } else {
                $book->image = '';       
            }
            if($request->author) {
                $book->author = $request->author;          
            } else {
                $book->author = '';                        
            }
            if($request->translator) {
                $book->translator = $request->translator;               
            } else {
                $book->translator = '';                                               
            }
            if($request->publisher) {
                $book->publisher = $request->publisher;                                        
            } else {
                $book->publisher = '';                                                               
            }
            if($request->pudate){
                $book->pudate = $request->pudate;
            } else {
                $book->pudate = '';
            }
            if($request->authorintro){
                $book->authorintro = $request->authorintro;
            } else {
                $book->authorintro = '';
            }
            if($request->summary){
                $book->summary = $request->summary;
            } else {
                $book->summary = '';                
            }
            if($request->catalog){
                $book->catalog = $request->catalog;
            } else {
                $book->catalog = '';       
            }
            if($request->price){
                $book->price = $request->price;
            } else {
                $book->price = '';
            }
            if($request->pages){
                $book->pages = $request->pages;
            } else {
                $book->pages = '';
            }
            if($request->location){
                $book->location = $request->location;
            } else {
                $book->location = '';
            }
            $book->created_at = date('Y-m-d H:i:s');
            $book->updated_at = date('Y-m-d H:i:s');
            $book->save();
        }
        return response()->json(['create' => true], 200);
    }
    // 查询
    public function findBook(Request $request){
        // 新建模型对象
        $book = \App\Model\Book::where('id', $request->id)
            ->first();
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
        $book = \App\Model\Book::find($request->id);
        if($book){ 
            $book2 = \App\Model\Book::where('bookcode', $book->bookcode)
                        ->first();
            if($book2->id != $request->id){
                return response()->json(['update' => false, 'err' => "this bookcode already exist"], 200);
            }
            $book->bookname = $request->bookname;
            $book->bookcode = $request->bookcode;
            $book->description = $request->description;
            $book->category_id = $request->category_id;
            $book->ISBN = $request->ISBN;
            $book->bookpublishtime = $request->bookpublishtime;
            $book->booklocation = $request->booklocation;
            $book->bookauthor = $request->bookauthor;
            $book->save();
            return response()->json(['update' => true], 200);
        }else{
            return response()->json(['update' => false, 'err' => 'Not Exist This Id'], 200);
        }
    }
    public function getAllBook(){
        $books = \App\Model\Book::all()
				->groupBy('isbn');
		return $books;
    }
}
