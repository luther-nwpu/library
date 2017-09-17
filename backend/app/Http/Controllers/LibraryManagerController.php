<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LibraryManagerController extends Controller
{
    //
    public function login(Request $request){
        $request->session()->flush();
        if($request->email=='admin' && $request->password=='admin'){
            $request->session()->put('admin', 'admin');
            return response()->json(['logined' => true], 200);
        } else {
            return response()->json(['logined' => false], 200);
        }
    }
    // user_id
    public function createLibraryManager(Request $request){
        if(!session('admin')){
            return response()->json(['logined' => false], 200);
        } else {
            $user = \App\User::find($request->user_id);
                if($user){
                $item = \App\Model\LibraryManager::where('user_id', $request->user_id)
                                                ->first();
                if($item){
                    return response()->json(['created' => false], 200);
                } else {
                    $manager = new \App\Model\LibraryManager();
                    $manager->user_id = $request->user_id;
                    $manager->created_at = date('Y-m-d H:i:s');
                    $manager->updated_at = date('Y-m-d H:i:s');
                    $manager->save();
                    return response()->json(['created' => true, 'manager' => $manager], 200);
                }
            } else {
                return response()->json(['created' => false], 200);
            }
        }
    }

    // email
    public function getUser(Request $request){
        if(!session('admin')){
            return response()->json(['logined' => false], 200);
        } else {
            $user = \App\User::where('email', $request->email)
                                ->first();
            if($user){
                return response()->json(['search' => true, 'user' => $user], 200);
            } else {
                return response()->json(['search' => false], 200);
            }
        }
    }

    public function deleteLibraryManager(Request $request) {
        if(!session('admin')){
            return response()->json(['logined' => false], 200);
        } else {
            $item = \App\Model\LibraryManager::find($request->id);
            $res = $item->delete();
            if($res){
                return response()->json(['deleted' => true], 200);
            } else {
                return response()->json(['deleted' => false], 200);
            }
        }
    }

    public function getAllLibraryManager(){
        if(!session('admin')){
            return response()->json(['logined' => false], 200);
        } else {
            $item = \App\Model\LibraryManager::all();
            return response()->json(['get' => true, 'libraryManager'=>$item], 200);
        }
    }

}
