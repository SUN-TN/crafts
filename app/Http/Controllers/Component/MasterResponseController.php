<?php

namespace App\Http\Controllers\Component;

use App\Http\Controllers\Controller;

class MasterResponseController extends Controller
{
    public function success($message){
        return response()->json([
           'status_code' => 200,
           'message' => $message,
        ],200);
    }


    public function error(...$error){
        return response()->json([
            'status_code' => 500,
            'error' => $error,
        ],200);
    }

    public function successWithCookie($message,$cookieName,$value,$time = 30){
        return response($message,200)->cookie($cookieName,$value,$time);
    }


}
