<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDisciplinaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Permite que qualquer usuário faça essa requisição
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255', // O nome é obrigatório, deve ser uma string e ter no máximo 255 caracteres
            'codigo' => 'required|string|max:10|unique:disciplinas,codigo', // O código é obrigatório, deve ser uma string, ter no máximo 10 caracteres e ser único na tabela disciplinas
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'codigo.required' => 'O campo código é obrigatório.',
            'codigo.unique' => 'O código já está em uso.',
        ];
    }
    /**
     * Prepare the data for validation.
     */
}
