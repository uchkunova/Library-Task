<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBook extends FormRequest
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
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'publish_date' => 'required|date|date_format:Y-m-d',
            'resume' => 'required|max:500',
            'format' => 'in:A4,A3',
            'page_count' => 'integer',
            'isbn'=> 'required|regex:/^(\d{13})?$/',
            'cover' => 'required|dimensions:min_width=100,min_height=100|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'isbn.regex' => 'The isbn field must consists of 13 numeric characters',
            'cover.required' => 'The upload cover field is required',
        ];
    }
}
