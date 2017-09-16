<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookManageController extends Controller
{
       public function create(){
        // 新建模型对象
        $post = new \App\Book() ;
        // 添加表字段内容
        $post->title = "这是测试文章标题" ;
        $post->content = "这是测试文章内容" ;
        $post->created_at = date('Y-m-d H:i:s') ;
        $post->updated_at = date('Y-m-d H:i:s') ;
        $post->save() ;
        dd($post) ;
    }
    // 查询
    public function find(){
        // 新建模型对象
        $info = \App\Post::find(3) ;
    }
    // 删除
    public function delete(){
        $info = \App\Post::find(3) ;
        $res = $info->delete() ;
        if($res){
            echo "delete success！" ;
        }
        // dd($res);
    }
    // 更新
    public  function update(){
        $info = \App\Post::find(4) ;
        if($info){
            $info->title("这是一个新的测试标题") ;
            $info->save();
        }else{
            echo "sorry , not found" ;
        }
    }
}
