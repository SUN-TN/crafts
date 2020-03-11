<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Model\Genre;

class GenresRequest extends FormRequest
{
    /**HttpResponseException
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    /**
     * 添加自定义验证规则
     *
     * @return bool
     */
    public function addValidator()
    {
        //验证是否已存在此分类
        Validator::extend('check_repeat', function ($attribute, $value, $parameters, $validator) {
            $count = Genre::where('genre', $value)->count();
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
            'genre' => 'sometimes|required|check_repeat',
        ];
    }

    public function messages()
    {
        return [
            'genre.required' => '分类名称不能为空',
            'genre.check_repeat' => '已存在相同商品分类',
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
