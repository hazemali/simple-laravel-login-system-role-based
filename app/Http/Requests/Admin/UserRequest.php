<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

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
        $id=@request()->segments()[2];

        if(!$id)
        return [
            'name'=>'required|min:2|max:64',
            'email'=>'required|email|max:255|unique:users,email'.($id?",$id":''),
            'password'=>'required|min:2',
            'role_id.*'=>'exists:roles,id'
        ];

        return [
            'name'=>'required|min:2|max:64',
            'email'=>'required|email|max:255|unique:users,email'.($id?",$id":''),
            'role_id.*'=>'exists:roles,id'
        ];

    }
}
