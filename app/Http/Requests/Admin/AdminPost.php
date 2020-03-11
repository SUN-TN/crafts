<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class AdminPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 判断用户是否有权限做出此请求
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('admin')->check();
    }


    /**
     * 添加自定义验证规则
     *
     * @return bool
     */
    public function addValidator()
    {
        //验证原密码是否正确
        Validator::extend('check_password', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value,Auth::guard('admin')->user()->password);
        });

    }

    /**
     * Get the validation rules that apply to the request.
     * 获取适用于请求的验证规则。
     *
     * @return array
     */
    public function rules()
    {
        $this->addValidator();
        return [
            //required 表单是否填写  |confirmed xx字段与xx_confirmation字段是否一致
            'original_password' => 'sometimes|required|check_password',
            'password' => 'sometimes|required|confirmed',
            'password_confirmation' => 'sometimes|required',
        ];
    }

    /**
     * 获取已定义的验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'original_password.required'  => '原密码不能为空',
            'original_password.check_password'  => '原密码错误',
            'password.required' => '新密码不能为空',
            'password.confirmed' => '两次密码不一致',
            'password_confirmation.required'  => '确认密码不能为空',
        ];
    }


}
