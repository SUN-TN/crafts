<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class GoodsRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'sometimes|required',
            'author' => 'sometimes|required',
            'genre' => 'sometimes|required',
            'size' => 'sometimes|required',
            'price' => 'sometimes|required',
            'user' => 'sometimes|required',
            'imgUrl' => 'sometimes|required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '分类名称不能为空',
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
