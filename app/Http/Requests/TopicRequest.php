<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopicRequest extends FormRequest
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
        switch ($this->method()) {

            case 'POST':
            case 'PUT':
            case 'PATCH':
                $rules = [
                    'title'       => ['required', 'min:2'],
                    'body'        => ['required', 'min:3'],
                    'category_id' => ['required'],
                ];
                break;
            default:
                $rules = [];
                break;
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'title.required'       => '请输入文章标题',
            'body.required'        => '请输入文章内容',
            'title.min'            => '标题必须至少两个字符',
            'body.min'             => '文章内容必须至少三个字符',
            'category_id.required' => '请选择文章类型',
        ];
    }
}
