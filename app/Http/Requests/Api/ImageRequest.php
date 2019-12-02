<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
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
        if ($this->request->get('action') != 'delete') {
            $rules = [
                'f_type' => ['required', 'string', 'in:avatar,topic,banner,course'],
                'image'  => ['required', 'mimes:jpeg,bmp,png,gif']
            ];
            return $rules;
        } else {
            return [];
        }
    }

    public function messages()
    {
        return [
            'f_type.required' => '未获取图片所属类型',
            'f_type.string'   => '图片所属类型格式不正确',
            'f_type.in'       => '图片所属类型不正确',
            'image.required'  => '请上传图片',
            'image.mimes'     => '图片格式不正确',
        ];
    }
}
