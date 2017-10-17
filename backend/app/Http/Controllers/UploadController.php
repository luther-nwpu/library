<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    // 上传图片
    public function uploadImage(Request $request) {
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $photo = $request->file('photo');
            $extension = $photo->extension();
            $name = $photo->getClientOriginalName();
            $store_result = $photo->store('photo');
            $output = [
                'name' => $name,
                'extension' => $extension,
                'store_result' => $store_result
            ];
            print_r($output);exit();
        }
        exit('未获取到上传文件或上传过程出错');
    }
}
