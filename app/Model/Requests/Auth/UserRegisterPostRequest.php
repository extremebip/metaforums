<?php

namespace App\Model\Requests\Auth;

use App\Model\Requests\PostRequest;

class UserRegisterPostRequest extends PostRequest
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
            'email' => 'required|string|email|unique:users',
            'username' => 'required|string|alpha_num|between:6,20|unique:users',
            'password' => 'required|string|min:8|confirmed',
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
            'email.required' => 'E-Mail must not be empty',
            'email.email' => 'Invalid e-mail format',
            'email.unique' => 'E-Mail has already existed',

            'username.required' => 'Username must not be empty',
            'username.alpha_num' => 'Username must only contain alphanumeric characters',
            'username.between' => 'Username must be between :min and :max characters long',
            'username.unique' => 'Username is already taken',

            'password.required' => 'Password must not be empty',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Please correctly confirm the password'
        ];
    }
}
