<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
            'name'         => ['required', 'between:3,50', 'unique:users,name,' . Auth::id()],
            'email'        => ['required', 'email'],
            'introduction' => ['max:200'],
            'real_name'    => ['between:1,30'],
            'sex'          => ['required', 'integer'],
        ];
    }


    public function messages()
    {
        return [
            'name.required'     => '请输入用户名',
            'name.between'      => '请将用户名控制在3-50个字符内',
            'name.unique'       => '您输入的用户名已被其他人使用了',
            'email.required'    => '请输入邮箱',
            'email.email'       => '请输入正确格式的邮箱',
            'introduction.max'  => '自我介绍请控制在200字符内',
            'real_name.between' => '真实姓名请控制在1-30个字符',
            'sex.required'      => '请选择性别',
            'sex.integer'       => '性别参数类型不正确',
        ];
    }
}
