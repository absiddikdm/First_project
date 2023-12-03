<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_id'=>'required',
            'title'=>'required',
            'desp'=>'required',
            'thumbnail'=>'required',
            'cover_image'=>'required',
            'tags'=>'required',
        ];
    }
    public function messages(): array
    {
        return [
            'category_id.required'=>'Please Select Your Category',
             'title.required'=>'Please Enter Your title ',
             'desp.required'=>'Please Enter Your Despcription',
             'thumbnail.required'=>'Please Select Your Thumbnail',
             'cover_image.required'=>'Please Select Your Image',
             'tags.required'=>'Please Select Your Tags',
        ];
    }
}
