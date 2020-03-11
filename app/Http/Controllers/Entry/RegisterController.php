<?php

namespace App\Http\Controllers\Entry;

use App\Http\Controllers\Component\MasterResponseController;
use App\Http\Requests\Entry\RegisterRequest;
use Cache;
use App\Model\User;
use Webpatser\Uuid\Uuid;

class RegisterController extends MasterResponseController
{

    //注册界面
    public function registerForm()
    {
        return view('entry.register');
    }

    //注册
    public function register(RegisterRequest $request)
    {
        $message = '注册成功!快去登录吧！！';
        $error = '抱歉，您的验证码已失效！请重新获取验证码，并在获取验证码后的10分钟内完成注册';

        //尝试从cookie中取出securityCodeKey
        $securityCodeKey = $request->cookie('securityCodeKey');
        //判断Cookie是是否存在
        if ($securityCodeKey) {
            //从缓存中取出securityCodeKey
            $securityCode = Cache::get($securityCodeKey);
            //判断缓存是否存在
            if ($securityCode) {
                //判断用户提交的验证码与缓存中的验证码是否一致
                if ($securityCode == $request['security_code']){

                    //创建写入新用户数据
                    User::create([
                        'id' => Uuid::generate(4),
                        'name' => $request['username'],
                        'email' => $request['email'],
                        'password' => bcrypt($request['password']),
                    ]);
                    //用户数据写入后清除验证码缓存
                    Cache::forget($securityCodeKey);
                    return parent::success($message);
                }else{
                   return parent::error('您的验证码错误！');
                }
            } else {
                return parent::error($error);
            }
        } else {
            return parent::error($error);
        }
    }

}
