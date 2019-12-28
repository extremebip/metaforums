<?php

namespace App\Model\Requests\Test;

use App\Model\Requests\PostRequest;

class CategoryPostRequest extends PostRequest
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
            'category-id' => 'required',
            'category-name' => 'required|max:20'
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
            'category-name.required' => 'Category name must not be empty',
            'category-name.max' => 'Category name must not exceed :max characters'
        ];
    }
}
