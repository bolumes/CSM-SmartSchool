<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'firstname' => 'required',
            'lastname' => 'required',
            'telephone' => 'required',
            'address' => 'required',
            'function' => 'required',
            'email' => 'required|email|unique:users,email,' . ($this->user?->id ?? 'null'),
            'password' => 'required|min:6',
            'description' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'firstname.required' => 'O campo nome é obrigatório.',
            'lastname.required' => 'O campo sobrenome é obrigatório.',
            'telephone.required' => 'O campo telefone é obrigatório.',
            'address.required' => 'O campo endereço é obrigatório.',
            'function.required' => 'O campo função é obrigatório.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail deve ser um endereço de e-mail válido.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
        ];
    }
    public function attributes(): array
    {
        return [
            'firstname' => 'nome',
            'lastname' => 'sobrenome',
            'telephone' => 'telefone',
            'address' => 'endereço',
            'function' => 'função',
            'email' => 'e-mail',
            'password' => 'senha',
        ];
    }
}
