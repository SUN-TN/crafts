<?php

namespace App\Http\Controllers\Entry;

use App\Http\Controllers\Component\MasterResponseController;
use App\Http\Requests\Entry\LoginRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;


class LoginController extends MasterResponseController
{
    public function loginForm()
    {
        return view('entry.login');
    }

    //登录处理
    public function login(LoginRequest $request)
    {
        $data = $request->all();
       $status = Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        if ($status){

            $user = User::where('email',$data['eamil'])->get();
            # 登录成功
            // 制作 token
            $time = time();
            // md5 加密
            $loginToken = md5($request->getClientIp() . $user->id . $time);
            // 当前 time 存入 Redis
            Cache::put('STRING_SINGLETOKEN_' . $user->id, $time);

            $message = '登录成功！,1秒后将跳转到首页';
            $cookieName = 'SINGLETOKEN';
            return parent::successWithCookie($message,$cookieName,$loginToken,60);
        }
        return parent::error($data['password']);
    }

    public function logout()
    {
        Auth::logout();;
        return redirect('/home');
    }
}
