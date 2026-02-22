<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnuncioRequest extends FormRequest
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
            'date' => 'required|string|max:255',
            'titre' => 'required|string|max:1000',
            'description' => 'nullable|string|max:1000',
            //'fichier' => 'required|mimetypes:application/pdf,image/jpeg,image/png,image/jpg|max:2048',
            'fichier' => 'required|mimes:pdf,jpeg,png,jpg|max:2048',

        ];

    }

    public function messages()
    {
        return [
        'date.required' => 'O campo data é obrigatório.',
        'titre.required' => 'O campo título é obrigatório.',
        'fichier.required' => 'O campo arquivo é obrigatório.',
        'fichier.mimes' => 'O arquivo deve ser do tipo: PDF, JPEG ou PNG.',
        'fichier.max' => 'O arquivo não pode ter mais de 2MB.',
    ];
    }
    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
}
