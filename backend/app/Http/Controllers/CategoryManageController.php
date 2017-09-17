<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryManageController extends Controller
{
    // 新增
    public function createCategory(Request $request){
        // 新建模型对象
        $category = \App\Model\Category::where('name', $request->name)
                        ->first();
        if($category){
            return response()->json(['create' => false], 200);
        } else {
        $post = new \App\Model\Category();
            // 添加表字段内容
            $post->name = $request->name ;
            $post->created_at = date('Y-m-d H:i:s') ;
            $post->updated_at = date('Y-m-d H:i:s') ;
            $post->save();
            return response()->json(['create' => true], 200);
        }
    }
    // 删除
    public function deleteCategory(Request $request){
        $info = \App\Model\Category::find($request->id);
        $res = $info->delete() ;
        if($res){
            return response()->json(['delete' => true], 200);
        } else {
            return response()->json(['delete' => false], 200);
        }
    }
    // 操作数据表数据
    public function getAllCategory(){
        $data = \App\Model\Category::all();
        return $data;
    }
}
