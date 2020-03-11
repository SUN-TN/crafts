<?php

namespace App\Http\Controllers\Component;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    public function  upload(Request $request){
        $upload = $request->file;
        if($upload->isValid()){
            $path= $upload->store('','goods');
            return response()->json([
                'status_code' => 200,
                'message' => '上传成功',
                'path' => '/images/goods/'.$path,
                ]);
        }
        return response()->json([
           'status_code' => 500,
           'message' => '上传失败！请刷新重试！'
        ]);

    }
}
