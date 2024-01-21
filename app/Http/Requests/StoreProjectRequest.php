<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'title' => ['required', 'max:200', 'unique:projects'],
            'description' => ['nullable', 'min:5'],
            'creation_date' => ['nullable', 'date'],
            'image' => ['nullable', 'image'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'technologies' => ['exists:technologies,id']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Inserisci il titolo',
            'title.max' => 'Il titolo può essere lungo massimo :max caratteri',
            'title.unique' => 'Questo titolo è già esistente',
            'description.min' => 'La descrizione deve avere almeno :min caratteri',
            'creation_date.date' => 'Inserisci la data di creazione con un formato adatto',
            'image.image' => 'L\'immagine deve essere un tipo image'
        ];
    }
}
