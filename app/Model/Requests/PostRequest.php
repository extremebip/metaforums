<?php

namespace App\Model\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * Return validated form data into collection
     * 
     * @return \Illuminate\Support\Collection
     */
    public function validatedIntoCollection()
    {
        return collect($this->validated());
    }

    /**
     * Return all form inputs into collection
     * 
     * @return \Illuminate\Support\Collection
     */
    public function intoCollection()
    {
        return collect($this->all());
    }
}