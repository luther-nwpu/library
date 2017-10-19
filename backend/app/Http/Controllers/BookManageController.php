<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookManageController extends Controller
{
	public function findAllBookByISBN(Request $request) {
		$books = \App\Model\Book::where('isbn', $request->isbn)
								->get();
		if($books){
			$array = array();
			foreach($books as $book) {
				$twoarray = array();
				$order = \App\Model\Order::where('book_id', $book->id)
										->where('type_id', '<', 2)
										->first();
				array_push($twoarray, $book, $order);
				array_push($array, $twoarray);
			}
			return response()->json(['find' => true, 'book' => $array], 200);
		} else {
			return response()->json(['find' => false], 200);
		}
	}
    public function storeBook(Request $request){
        for ($i=0; $i<$request->booknum; $i++) {
            $book = new \App\Model\Book();
            // 添加表字段内容
            if($request->category){
                $book->category = $request->category;
            } else {
				return response()->json(['create' => false], 200);
                $book->category = '';
            }
            if($request->isbn) {
                $book->isbn = $request->isbn;
            } else {
				return response()->json(['create' => false], 200);
                $book->isbn = '';
            }
            if($request->title) {
                $book->title = $request->title;
            } else {
				return response()->json(['create' => false], 200);
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
	public function findBookByISBN(Request $request){
		$books = \App\Model\Book::where('isbn', $request->isbn)
								->get();
		if($books) {
			$array = array();
			foreach($books as $book) {
				$twoarray = array();
				$order = \App\Model\Order::where('book_id', $book->id)
										 ->where('type_id', '<', 2)
										 ->first();
				array_push($twoarray, $book, $order);
				array_push($array, $twoarray);
			}
			return response()->json(['get' => false, 'book' => $array], 200);
		} else {
			return response()->json(['get' => false, 'err' => "this isbn not exist"], 200);
		}
		return $books;
	}
    // 删除
    public function deleteBookById(Request $request){
        $info = \App\Model\Book::where('id', $request->id)
								->first();
		if($info){
			$orders = \App\Model\Order::where('book_id', $request->id)
										->get();
			foreach($orders as $order){
				$order->delete();
			}
			$res = $info->delete();
			if($res){
				return response()->json(['delete' => true], 200);
			} else {
				return response()->json(['delete' => false], 200);
			}
		} else {
			return response()->json(['delete' => true], 200);
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
	public function deleteBookByISBN(Request $request) {
		$books = \App\Model\Book::where('isbn', $request->isbn)
								->get();
		foreach($books as $book) {
			$orders = \App\Model\Order::where('book_id', $book->id)
									  ->first();
			foreach($orders as $order) {
				$order->delete();
			}
			$book->delete();
		}
		response()->json(['delete' => true], 200);
	}
	
}
