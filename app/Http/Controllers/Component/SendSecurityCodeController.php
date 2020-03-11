<?php

namespace App\Http\Controllers\Component;

use App\Http\Requests\EmailRequest;
use App\Model\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Cache;


class SendSecurityCodeController extends MasterResponseController
{


    /**
     * 发送验证码 并保存在缓存中10分钟
     * @param EmailRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendSecurityCode(EmailRequest $request)
    {
        //判断用户在不同情况下请求验证码的邮箱是否注册
        $count = User::where('email', $request['email'])->count();
        if ($request['option'] == 'registered' && $count > 0) {
           return parent::error('此邮箱已注册');
        } elseif ($request['option'] == 'unregistered' && $count <= 0) {
          return parent::error('此邮箱未注册');
        }

        //如果当前用户客户端中有key为securityCodeKey的cookie信息 则表明用户在3分钟内再次申请了验证码
        $securityCodeKeyCookie = $request->cookie('securityCodeKey');
        if ($securityCodeKeyCookie) {
            //删除之前验证码的缓存
            Cache::forget($securityCodeKeyCookie);
        }

        //发送验证码到用户邮件
        $to = $request['email'];
        $securityCode = mt_rand(100000, 999999);//生成随机6位数验证码
        $message = "您是验证码是：  " . $securityCode . "此验证码10分钟内有效！";
        Mail::raw($message, function ($message) use ($to) {
            $message->to($to);
            $message->subject("Crafts验证码");
        });

        //将用户邮箱与通过md5加密的当前时间戳字符串连接为将验证码存储在redis中的key
        $securityCodeKey = $to . md5(Carbon::now());
        //将验证码存入缓存 并设置有效时间为10分钟
        Cache::put($securityCodeKey, $securityCode, 10);


        //生成json数据
        $value = [
            "status_code" => 200,
            "message" => "验证码已发往您的邮箱！请尽快前往查看并进行验证",
        ];
        $content = json_encode($value);
        $cookieName = 'securityCodeKey';

        //返回json数据设置cookie信息 并设置Cookie保存10分钟
        return parent::successWithCookie($count,$cookieName,$securityCodeKey,10);
//        return response($content, 200)->cookie('securityCodeKey', $securityCodeKey, 10);

    }
}

