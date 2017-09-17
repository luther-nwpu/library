<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
        // 新增
    public function login(Request $request){
        //$value = session('id');
        //return $value;
        // 新建模型对象
        $request->session()->flush();
        $User = \App\User::where('email', $request->email)
                        ->where('password', $request->password)
                        ->first();
        if(!$User){
            return response()->json(['logined' => false], 200);
        } else {
            $request->session()->put('id', $User->id);
            $request->session()->put('email', $User->email);
            $libraryManager = \App\Model\LibraryManager::where('user_id', $User->id)
                                                       ->first();
            if($libraryManager) {
                $request->session()->put('role', 1);
            } else {
                $request->session()->put('role', 0);
            }
            return response()->json(['logined' => true], 200);
        }
    }
    public function register(Request $request){
        $existUser = \App\User::where('email', $request->email)
                    ->first();
        if($existUser) {
            return response()->json(['registed' => true], 200);
        } else {
            $User = new \App\User();
            $User->name = $request->name;
            $User->created_at = date('Y-m-d H:i:s');
            $User->updated_at = date('Y-m-d H:i:s');
            $User->password = $request->password;
            $User->email = $request->email;
            $User->save();
            return response()->json(['registed' => false, 'User'=> $User], 200);
        }
    }
    public function logout(){
        $request->session()->flush();
        if(session('id')){
            return response()->json(['logout' => false], 200);
        } else {
            return response()->json(['logout' => true], 200);
        }
    }
}
