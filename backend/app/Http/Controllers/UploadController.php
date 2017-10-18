<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\facades\route;

class UploadController extends Controller
{
    // 上传图片
    public function uploadImage(Request $request) {
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $photo = $request->file('photo');
            $extension = $photo->extension();
            $name = $photo->getClientOriginalName();
            $store_result = $photo->store('photo');
            $Image = new \App\Model\Image();
            $Image->filename = $name;
            $Image->filepath = $store_result;
            $Image->save();
            $output = [
                'ImageId' => $Image->id,
                'name' => $name,
                'extension' => $extension,
                'store_result' => $store_result
            ];
            return response()->json(['upload' => true, 'output' => $output], 200);
        }
        return response()->json(['upload' => false], 504);
    }
    public function getImage(Request $request) {
        $id= $request->input('ImageId');
        $Image = \App\Model\Image::where('id', $id)
                                ->first();
        $path = storage_path() . '/app/' . $Image->filepath;
        header('Content-type: image/jpg');
        return file_get_contents($path);
    }
}
