<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:60',
            'course' => 'required|string|max:60'
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
            'required' => 'The field :attribute is required',
            'string' => 'The field :attribute must be string',
            'max' => 'The field :attribute must have at most 60 characters'
        ];
    }
}
