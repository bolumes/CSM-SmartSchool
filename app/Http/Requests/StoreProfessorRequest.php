<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfessorRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'apelido' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:professors,email',
            'telephone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome não pode ter mais de 255 caracteres.',
            'apelido.required' => 'O campo apelido é obrigatório.',
            'apelido.string' => 'O campo apelido deve ser uma string.',
            'apelido.max' => 'O campo apelido não pode ter mais de 255 caracteres.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo email deve ser um endereço de e-mail válido.',
            'email.max' => 'O campo email não pode ter mais de 255 caracteres.',
            'email.unique' => 'O email já está em uso.',
            'telephone.string' => 'O campo telefone deve ser uma string.',
            'telephone.max' => 'O campo telefone não pode ter mais de 20 caracteres.',
            'endereco.string' => 'O campo endereço deve ser uma string.',
            'address.max' => 'O campo endereço não pode ter mais de 255 caracteres.',
        ];
    }
}
