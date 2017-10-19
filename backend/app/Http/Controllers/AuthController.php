<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    // 新增 ...
    public function login(Request $request){
        //$value = session('id');
        //return $value;
        // 新建模型对象
        $request->session()->flush();
        if($request->email=='admin' && $request->password=='admin'){
            $request->session()->put('name', 'admin');
            $request->session()->put('email', 'admin');
            $request->session()->put('usernumber', '0000000000');
            $request->session()->put('id', 0);
            $request->session()->put('role', 3);
            $request->session()->put('imageid', 0);
            $request->session()->put('useruniversity', 'XXXX');
            $request->session()->put('usercollege', 'XXXXX');
            return response()->json(['logined' => true], 200);
        } else {
            $User = \App\User::where('email', $request->email)
                            ->where('password', $request->password)
                            ->first();
            if(!$User){
                return response()->json(['logined' => false], 200);
            } else {
                $request->session()->put('name', $User->username);
                $request->session()->put('id', $User->id);
                $request->session()->put('email', $User->email);
                $request->session()->put('usernumber', $User->usernumber);
                $request->session()->put('useruniversity', $User->useruniversity);
                $request->session()->put('usercollege', $User->usercollege);
				$request->session()->put('imageid', $User->imageid);
                $libraryManager = \App\Model\LibraryManager::where('user_id', $User->id)
                                                        ->first();
                if($libraryManager) {
                    $request->session()->put('role', 2);
                } else {
                    $request->session()->put('role', 1);
                }
                return response()->json(['logined' => true], 200);
            }
        }
    }
    // ...
    public function register(Request $request){
        if($request->email == "admin"){
            return response()->json(['registed' => false, 'error'=> "sorry，The email isn't admin"], 200);
        }
        $existUser = \App\User::where('email', $request->email)
                              ->first();
        if($existUser) {
            return response()->json(['registed' => false], 200);
        } else {
            $existUsercode = \App\User::where('usercode', $request->usercode)
                            ->first();
            if($existUsercode) {
                return response()->json(['registed' => false], 200);
            }
            $User = new \App\User();
            $User->username = '';
            $User->created_at = date('Y-m-d H:i:s');
            $User->updated_at = date('Y-m-d H:i:s');
            $User->password = $request->password;
            $User->email = $request->email;
            $User->imageid = 1;
            $User->usercode = $request->usercode;
            $User->usernumber = '';
            $User->username = '';
            $User->userinfo = '';
            $User->useruniversity = '';
            $User->usercollege = '';
            $User->save();
            return response()->json(['registed' => true, 'User'=> $User], 200);
        }
    }
    // ...
    public function logout(Request $request){
        $request->session()->flush();
        if(session('id')){
            return response()->json(['logout' => false], 200);
        } else {
            return response()->json(['logout' => true], 200);
        }
    }
    public function MyLoginInformation(Request $request) {
        return $request->session()->all();
    }
    public function MyUserInfo(Request $request) {
        $id = session('id');
        $user = \App\User::where('id', $id)
                         ->first();
        if($user) {
            return response()->json(['get' => true, 'user' => $user], 200);
        } else {
            return response()->json(['get' => false], 200);
        }
    }
    public function updateUserInfo(Request $request){
        $id = session('id');
        $user = \App\User::where('id', $id)
                         ->first();
        if($user) {
			if($request->username) {
				$user->username = $request->username;
			} else {
				$user->username = "";
			}
            if($request->userinfo) {
				$user->userinfo = $request->userinfo;
			} else {
				$user->userinfo = "";
			}
			if($request->useruniversity) {
				$user->useruniversity = $request->useruniversity;
			} else {
				$user->useruniversity = "";
			}
			if($request->usercollege) {
				$user->usercollege = $request->usercollege;
			} else {
				$user->usercollege = "";
			}
			if($request->usernumber) {
				$user->usernumber = $request->usernumber;
			} else {
				$user->usernumber = "";
			}
            $user->save();
            $request->session()->put('usernumber', $user->usernumber);
            $request->session()->put('useruniversity', $user->useruniversity);
            $request->session()->put('usercollege', $user->usercollege);
            $request->session()->put('name', $user->username);
            return response()->json(['update' => true], 200);
        } else {
            return response()->json(['update' => false], 200);
        }
    }
    public function resetMyPassword(Request $request){
        $id = session('id');
        $user = \App\User::where('id', $id)
                        ->where('password', $request->currentpassword)
                        ->first();
        if($user) {
            if($request->password != $request->repeatpassword) {
                return response()->json(['reset' => false], 200);
            } else {
                $user->password = $request->password;
                $user->save();
                return response()->json(['reset' => true], 200);
            }
        } else {
            return response()->json(['reset' => false], 200);
        }
    }
    public function resetMyUserCode(Request $request){
        $id = session('id');
        $user = \App\User::where('id', $id)
                        ->where('usercode', $request->currentusercode)
                        ->first();
        if($user){
            if($request->usercode != $request->repeateusercode) {
                return response()->json(['reset' => false], 200);
            } else {
                $twouser = \App\User::where('id', $id)
                            ->where('usercode', '!=', $request->currentusercode)
                            ->where('usercode',  $request->usercode)
                            ->first();
                if($twouser) {
                    return response()->json(['reset' => true], 200);
                } else {
                    $user->usercode = $request->usercode;
                    $user->save();
                    return response()->json(['reset' => true], 200);
                }
            }
        } else {
            return response()->json(['reset' => false], 200);
        }
    }
    public function resetMyImage(Request $request) {
        $id = session('id');
        $user = \App\User::where('id', $id)
                        ->first();
        if($user) {
            $user->imageid = $request->imageid;
			$request->session()->put('imageid', $user->imageid);
            $user->save();
            return response()->json(['reset' => true], 200);
        } else {
            return response()->json(['reset' => false], 200);
        }
    }
    public function resetPassword(Request $request) {
        $user = \App\User::where('id', $request->id)
                        ->first();
        if($user){
            $user->password = "123qwe";
            $user->save();
            return response()->json(['reset' => true], 200);     
        } else {
            return response()->json(['reset' => false], 200);     
        }
    }
    public function getAllUser(){
        $users = \App\User::all();
        return $users;
    }
    public function deleteUser(Request $request) {
        $user = \App\User::where('id', $request->id)
                        ->first();
        if($user) {
            $orderbooks = \App\Model\Order::where('user_id', $user->id)
                                    ->get();
            foreach($orderbooks as $orderbook){
                if($orderbook->user_id == $user->id){
                    $orderbook->delete();
                }
            }
            $user->delete();
            return response()->json(['delete' => true], 200);
        } else {
            return response()->json(['delete' => true], 200);
        }
    }
    public function getUserInfoByCode(Request $request){
        $user = \App\User::where('usercode', $request->usercode)
                        ->first();
        if($user) {
            return response()->json(['get' => true, 'user' => $user], 200);
        } else {
            return response()->json(['get' => false], 200);
        }
    }
}
