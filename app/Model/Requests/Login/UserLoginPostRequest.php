<?php

namespace App\Model\Requests\Login;

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
            'user-email' => 'required|string|min:6',
            'user-password' => 'required|string|min:8',
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
            'user-email.required' => 'Username or E-Mail must not be empty',
            'user-email.min' => 'Username or E-Mail must be at least 6 characters',
            'user-password.required' => 'Password must not be empty',
            'user-password.min' => 'Password must be at least 8 characters'
        ];
    }
}
