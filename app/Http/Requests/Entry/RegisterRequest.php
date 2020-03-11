<?php

namespace App\Http\Requests\Entry;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use App\Model\User;

class RegisterRequest extends FormRequest
{



    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function addValidator()
    {
        //验证此邮箱是否已注册
        Validator::extend('registed', function ($attribute, $value, $parameters, $validator) {
            $count = User::where('email', $value)->count();
            if ($count > 0) {
                return false;
            } else {
                return true;
            }
        });

        //验证此用户名是否已存在
        Validator::extend('name_is_had', function ($attribute, $value, $parameters, $validator) {
            $count = User::where('name', $value)->count();
            if ($count > 0) {
                return false;
            } else {
                return true;
            }
        });

    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->addValidator();
        return [
            'username' => [
                'sometimes',
                'required',
                'between:4,16',
                'regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u',
                'name_is_had',
            ],
            'email' => 'sometimes|required|email|registed',
            'password' => 'sometimes|required|confirmed|alpha_dash|between:8,16',
            'password_confirmation' => 'sometimes|required',
        ];
    }

    public function messages()
    {
        return [
            'username.required' =>'用户名不能为空',
            'username.between' =>'用户名长度只能在4-16个字符之间',
            'username.regex' =>'用户名只能由 汉字 字母 数字 下划线 组成',
            'username.name_is_had' => '用户名已存在',

            'email.required' => '邮箱不能为空',
            'email.email' => '请填写正确的邮箱格式',
            'email.registed' => '此邮箱已注册',

            'password.required' => '密码不能为空',
            'password.confirmed' => '再次密码不一致',
            'password.alpha_dash' => '密码仅可用 字母 数字 破折号(-) 以及 下线线(_) 构成',
            'password.between' => '密码长度必须在8-16之间',

            'password_confirmation.required' => '确认密码不能为空'

        ];
    }


    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
{
    throw (new HttpResponseException(response()->json([
        'status_code' => 500,
        'error' => $validator->errors()->all(),
    ], 200)));
}
}
