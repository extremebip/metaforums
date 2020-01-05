<?php

namespace App\Model\Requests\Auth;

use App\Model\Requests\PostRequest;

class UserLoginPostRequest extends PostRequest
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
            'email' => 'required|string|min:6',
            'password' => 'required|string|min:8',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Username or E-Mail must not be empty',
            'email.min' => 'Username or E-Mail must be at least 6 characters',
            'password.required' => 'Password must not be empty',
            'password.min' => 'Password must be at least 8 characters'
        ];
    }
}
