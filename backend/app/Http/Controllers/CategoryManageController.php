<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryManageController extends Controller
{
    // 新增
    public function create(){
            // 新建模型对象
        $post = new \App\Model\Category();
        // 添加表字段内容
        $post->name = "这是测试文章内容" ;
        $post->created_at = date('Y-m-d H:i:s') ;
        $post->updated_at = date('Y-m-d H:i:s') ;
        $post->save();
    }
        // 查询
    public function find(Request $request){
        // 新建模型对象
        $info = \App\Model\Category::find(3) ;
        echo "delete success！";
        echo $request;
        return $request;        
        // 对表进行删除操作
    }
    // 删除
    public function delete(){
        $info = \App\Model\Category::find(3) ;
        $res = $info->delete() ;
        if($res){
            echo "delete success！" ;
        }
        // dd($res);
    }
    // 更新
    public  function update(){
        $info = \App\Model\Category::find(4) ;
        if($info){
            $info->name("这是一个新的测试标题") ;
            $info->save();
        }else{
            echo "sorry , not found" ;
        }
    }
    // 操作数据表数据
    public function getData(){
        $data = \App\Model\Category::get() ;
        $dataList = \App\Model\Category::orderBy("id" , "desc")
                                ->where("id" , "<" , 100)
                                ->get() ;
    }
}
