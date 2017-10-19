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
			$bookimages = \App\Model\BookImage::where('book_id', $info->id)
											 ->get();
			foreach($bookimages as $bookimage) {
				$bookimage->delete();
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
    public function updateBookISBN(Request $request){
        $book = \App\Model\Book::where('id', $request->id)
								->first();
		if($book){			
			if($request->category){
                $book->category = $request->category;
            } else {
				return response()->json(['create' => false], 200);
                $book->category = '';
            }
            if($request->title) {
                $book->title = $request->title;
            } else {
				return response()->json(['create' => false], 200);
                $book->title = '';
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
			$book->save();
			return response()->json(['update' => true], 200);
		} else{
			
			return response()->json(['update' => false], 200);
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
									  ->get();
			foreach($orders as $order) {
				$order->delete();
			}
			$bookimages = \App\Model\BookImage::where('book_id', $book->id)
											 ->get();
			foreach($bookimages as $bookimage) {
				$bookimage->delete();
			}
			$book->delete();
		}
		return response()->json(['delete' => true], 200);
	}
	public function	updateBooklocation(Request $request) {
		$book = \App\Model\Book::where('id', $request->id)
								->first();
		if($book){
			$book->location = $request->location;
			$book->save();
			return response()->json(['update' => true], 200);
		} else {
			return response()->json(['update' => false], 200);
		}
	}
	
	public function bindBookImage(Request $request) {
		$books = \App\Model\Book::where('isbn', $request->isbn)
								->get();
		foreach($books as $book){
			$image = new \App\Model\BookImage();
			$image->image_id = $request->imageid;
			$image->book_id = $book->id;
			$image->save();
		}
		return response()->json(['bind' => true], 200);
	}
	
	public function getBookAllImage(Request $request) {
		$book = \App\Model\Book::where('isbn', $request->isbn)
								->first();
		if($book){
			$images = \App\Model\BookImage::where('book_id', $book->id)
											->get();
			return response()->json(['get' => true, 'images' => $images], 200);
		}else {
			return response()->json(['get' => false], 200);
		}
	}
	public function CancelBindBookImage(Request $request) {
		$bookimages = \App\Model\BookImage::where('image_id', $request->imageid)
										  ->get();
		foreach($bookimages as $bookimage) {
			$bookimage->delete();
		}
		return response()->json(['cancel' => true], 200);
	}
	/* public function deleteBookById(Request $request){
		$book = \App\Model\Book::where('id', $request->id)
								->first();
		if($book) {
			$orders = \App\Model\Order::where('id', $book->id)
									->get();
			foreach($orders as $order) {
				$order->delete();
			}
			$book->delete();
			return response()->json(['delete' => true], 200);
		} else {
			return response()->json(['delete' => true], 200);
		}
	} */
}
