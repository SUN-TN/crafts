<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use App\Model\User;


class EmailRequest extends FormRequest
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

//
//    public function addValidator()
//    {
//
//        //验证此邮箱是否已注册
//        Validator::extend('registed', function ($attribute, $value, $parameters, $validator) {
//            $count = User::where('email', $value)->count();
//            if ($count > 0) {
//                return false;
//            } else {
//                return true;
//            }
//        });
//
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
//        $this->addValidator();
        return [
            'email' => 'sometimes|required|email',
        ];
    }

    public function messages()
    {

        return[
            'email.required' => '邮箱不能为空',
            'email.email' => '请填写正确的邮箱格式',
//            'email.registed' => '此邮箱已注册',
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
