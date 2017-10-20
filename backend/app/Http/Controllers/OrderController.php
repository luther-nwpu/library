<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    // 所有人都可以借， request 存的是当前用户id与书的id book_id    user_id
    public function BorrowBook(Request $request) {
		if(!($request->user_id&&$request->book_id)) {
			return response()->json(['borrow' => false, 'err' => 'Please Input BookID And Userid'], 200);
		}
        $book = \App\Model\Order::where('book_id', $request->book_id)
                                ->where('type_id', '<', 2)
                                ->first();
        if($book) {
			return response()->json(['borrow' => false, 'err' => 'The Book Already Borrowed'], 200);
		} else {
			$user = \App\User::where('id', $request->user_id)
							->first();
			if($user) {
				$orders = \App\Model\Order::where('user_id', $request->user_id)
											->where('type_id', '<', 2)
											->get();
				if(count($orders)>=5){
					return response()->json(['borrow' => false, 'err' => "The User Only Borrow 5 Books"], 200);
				} else {
					foreach($orders as $order){
						$mybook = \App\Model\Book::where('id', $order->book_id)
												->first();
						if($mybook){
							foreach($orders as $order1) {
								if($order1->id == $order->id) {
									continue;
								}
								$mybook1 = \App\Model\Book::where('id', $order->book_id)
														->first();
								if($mybook1) {
									if($mybook1->isbn == $mybook->isbn) {
										return response()->json(['borrow' => false, 'err' => "This Type Book Can't Be Borrowed Two"], 200);
									}
								} else {
									continue;
								}									
							}
						} else {
							continue;
						}
					}
				}
				$order = new \App\Model\Order() ;
				$order->user_id = $request->user_id;
				$order->book_id = $request->book_id;
				$order->return_time = date('Y-m-d H:i:s',strtotime('+1 month'));
				$order->created_at = date('Y-m-d H:i:s');
				$order->updated_at = date('Y-m-d H:i:s');
				$order->type_id = 0;
				$order->save();
				$array = array();
				$book = \App\Model\Book::where('id', $order->book_id)
										->first();
				array_push($array, $order, $book);
				return response()->json(['borrow' => true, 'book' => $array], 200);
			} else {
				return response()->json(['borrow' => false, 'err' => 'No user'], 200);
			}
		}
    }

    // request book_id 直接还书
    public function ReturnBook(Request $request) {
		if(!$request->book_id) {
			return response()->json(['delete' => false], 200);
		}
        $order = \App\Model\Order::where('book_id', $request->book_id)
                -> where('type_id', '<', 2)
                ->first();
        if($order){
            $order->type_id = 2;
            $order->save();
            return response()->json(['delete' => true], 200);
        } else {
            return response()->json(['delete' => true], 200);
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

    // 所有人都可以借， request 存的是当前用户id与书的id book_id
    public function RenewBook(Request $request){
        $order = \App\Model\Order::where('book_id', $request->book_id)
                                ->where('type_id', 0)
                                ->first();
        if(!$order)
        {
            return response()->json(['renew' => false, 'err' => 'No this BorrowBook'], 200);
        } else {
            // 新建模型对象
			$order->return_time = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($order->return_time)));
            $order->type_id = 1;
            $order->save();		
            return response()->json(['renew' => true], 200);
        }
    }
    // 自己可以借,book_id
    public function RenewMyBook(Request $request){
        $order = \App\Model\Order::where('book_id', $request->book_id)
                                ->where('type_id', 0)
                                ->first();
        if(!$order)
        {
            return response()->json(['renew' => false, 'err' => 'No this BorrowBook'], 200);
        } else {
            // 新建模型对象
			$order->return_time = date($order->return_time,strtotime('+1 month'));
            $order->type_id = 1;
            $order->save();		
            return response()->json(['renew' => true], 200);
        }
    }

    public function GetBorrowedBook(Request $request) {
        $user = \App\User::where('id', $request->user_id)
							->first();
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
        return response()->json(['get' => true, 'book' => $array], 200);
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

	public function GetUserByUserCode(Request $request) {
		$user = \App\User::where('usercode', $request->usercode)
							->first();
		if($user){
            return response()->json(['get' => true, 'user' => $user], 200);
		} else {
            return response()->json(['get' => false], 200);
		}
	}

}
