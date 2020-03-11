<?php

namespace App\Http\Controllers\Entry;

use App\Http\Controllers\Component\MasterResponseController;
use App\Http\Requests\Entry\ResetPasswordRequest;
use App\Model\User;
use Cache;

class ForgotPasswordController extends MasterResponseController
{
    public function forgotPasswordForm()
    {
        return view('entry.forgotPassword');
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $message = '密码已修改!快去登录吧！！';
        $error = '抱歉，您的验证码已失效！请在获取验证码后的10分钟内完成验证';

        //尝试从cookie中取出securityCodeKey
        $securityCodeKey = $request->cookie('securityCodeKey');
        //判断Cookie是是否存在
        if ($securityCodeKey) {
            //从缓存中取出securityCodeKey
            $securityCode = Cache::get($securityCodeKey);
            //判断缓存是否存在
            if ($securityCode) {
                //判断用户提交的验证码与缓存中的验证码是否一致
                if ($securityCode == $request['security_code']) {
                    //修改当前用户密码
                    User::where('email', $request['email'])
                        ->update(['password' => bcrypt($request['password'])]);
                    //密码更改后清除验证码缓存
                    Cache::forget($securityCodeKey);
                    return parent::success($message);
                } else {
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
