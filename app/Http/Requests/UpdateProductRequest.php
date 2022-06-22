<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        // Uploaded image can only be in the type of jpg, png, svg, or gif - with max size of 10 MB.

        return [
            'name' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,svg,gif|max:10000',
            'delete_image' => 'nullable'
        ];
    }
}
