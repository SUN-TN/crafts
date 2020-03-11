<?php

namespace App\Http\Middleware;

use Closure;
use Cache;
use Auth;
use Cookie;
use Session;


class SingleLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()){
            $singleToken = $request->cookie('SINGLETOKEN');
            if($singleToken) {
                $user = Auth::user();
                $loginTime = Cache::get('STRING_SINGLETOKEN_'.$user->id);
                $ip = $request->getClientIp();
                $secret = md5($ip . $user->id . $loginTime);

                //如果已在其他地方登录 则退出退出本地登录
                if ($singleToken != $secret){
                    //退出登录
                    Auth::logout();
                    //设置重复登录为true
                    Session::put('isRepeatLogin',true);
                }else{
                    //设置重复登录为false
                    Session::put('isRepeatLogin',false);

                    //Cookie:;queue() 在回应之前先积累 cookie，回应时统一返回
                    //重置登录的Cookie Token为30分钟 会自动添加到下一个返回的response(响应)中
                    Cookie::queue('SINGLETOKEN', $singleToken, 30);
                }
            }

        }

        return $next($request);
    }
}
