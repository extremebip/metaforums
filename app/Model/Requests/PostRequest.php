<?php

namespace App\Model\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Return validated form data into array
     * 
     * @return array
     */
    // public function validatedIntoDataArray()
    // {
    //     $validated = $this->validated();
    //     $data = array();
    //     foreach ($validated as $input_name => $value) {
    //         $keys = explode('-', $input_name);
    //         $new_key = implode('.', $keys);

    //         data_set($data, $new_key, $value);
    //     }
    //     return $data;
    // }

    /**
     * Return validated form data into collection
     * 
     * @return \Illuminate\Support\Collection
     */
    // public function validatedIntoDataCollection()
    // {
    //     return collect($this->validatedIntoDataArray());
    // }

    /**
     * Return validated form data into collection
     * 
     * @return \Illuminate\Support\Collection
     */
    public function validatedIntoCollection()
    {
        return collect($this->validated());
    }
}