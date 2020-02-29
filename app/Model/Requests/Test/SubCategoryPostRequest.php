<?php

namespace App\Model\Requests\Test;

use App\Model\Requests\PostRequest;

class SubCategoryPostRequest extends PostRequest
{
    /**
     * The key to be used for the view error bag.
     *
     * @var string
     */
    protected $errorBag = 'sub_category';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'category_id' => 'required',
            'name' => 'required|max:20'
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
            'name.required' => 'SubCategory name must not be empty',
            'name.max' => 'SubCategory name must not exceed :max characters'
        ];
    }
}
