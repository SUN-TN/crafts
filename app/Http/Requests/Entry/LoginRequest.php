<?php

namespace App\Http\Requests\Entry;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Model\User;


class LoginRequest extends FormRequest
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
        Validator::extend('unregistered', function ($attribute, $value, $parameters, $validator) {
            $count = User::where('email', $value)->count();
            if ($count > 0) {
                return true;
            } else {
                return false;
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
            'eamil' => 'sometimes|required|email|unregistered',
            'password' => 'sometimes|required|alpha_dash|between:8,16',
        ];
    }

    public function messages()
    {
        return [

            'email.required' => '邮箱不能为空',
            'email.email' => '请填写正确的邮箱格式',
            'email.unregistered' => '此邮箱未注册',

            'password.required' => '密码不能为空',
            'password.alpha_dash' => '密码仅可用 字母 数字 破折号(-) 以及 下线线(_) 构成',
            'password.between' => '密码长度必须在8-16之间',
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
