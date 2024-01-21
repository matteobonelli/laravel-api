<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [Rule::unique('categories')->ignore($this->category), 'required', 'max:200']
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Il nome della categoria è già stato utilizzato',
            'name.max' => 'Il nome della categoria può avere massimo :max caratteri',
            'name.required' => 'Il nome della categoria è richiesto'
        ];
    }
}
