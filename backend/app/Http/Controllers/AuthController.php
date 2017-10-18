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
        if($request->email=='admin' && $request->password=='admin'){
            $request->session()->put('name', 'admin');
            $request->session()->put('email', 'admin');
            $request->session()->put('id', 0);
            $request->session()->put('role', 2);
            $request->session()->put('imageid', 1);
            return response()->json(['logined' => true], 200);
        } else {
            $User = \App\User::where('email', $request->email)
                            ->where('password', $request->password)
                            ->first();
            if(!$User){
                return response()->json(['logined' => false], 200);
            } else {
                $request->session()->put('name', $User->name);
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
    }
    public function register(Request $request){
        if($request->email == "admin"){
            return response()->json(['registed' => true, 'error'=> "对不起，不能是admin"], 200);
        }
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
            $User->ImageId = $request->imageid;
            $User->save();
            return response()->json(['registed' => false, 'User'=> $User], 200);
        }
    }
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
}
