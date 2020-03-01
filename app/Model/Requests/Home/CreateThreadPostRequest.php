<?php

namespace App\Model\Requests\Home;

use App\Model\Requests\PostRequest;

class CreateThreadPostRequest extends PostRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:200',
            'content' => 'required|string'
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
            'title.required' => 'Title must not be empty',
            'title.max' => 'Title must not exceed :max characters',
            'content.required' => 'Content must not be empty'
        ];
    }
}
