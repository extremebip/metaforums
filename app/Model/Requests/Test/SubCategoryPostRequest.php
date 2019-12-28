<?php

namespace App\Model\Requests\Test;

use App\Model\Requests\PostRequest;

class SubCategoryPostRequest extends PostRequest
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
            'subcategory-id' => 'required',
            'subcategory-category_id' => 'required',
            'subcategory-name' => 'required|max:20'
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
            'subcategory-name.required' => 'SubCategory name must not be empty',
            'subcategory-name.max' => 'SubCategory name must not exceed :max characters'
        ];
    }
}
