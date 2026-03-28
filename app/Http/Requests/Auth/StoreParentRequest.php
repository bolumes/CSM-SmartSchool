<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreParentRequest extends FormRequest
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
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telefone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:users,email', // Se o email for usado para login, valida unicidade na tabela users
            'adresse' => 'nullable|string|max:500',
            'profission' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nom.required' => 'O sobrenome é obrigatório.',
            'prenom.required' => 'O primeiro nome é obrigatório.',
            'telefone.max' => 'O telefone não pode ter mais de 20 caracteres.',
            'email.email' => 'O e-mail deve ser um endereço válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'adresse.max' => 'O endereço não pode ter mais de 500 caracteres.',
            'profission.max' => 'A profissão não pode ter mais de 255 caracteres.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Mapeia campos alternativos se vierem com nomes diferentes do formulário
        if ($this->has('telephone') && !$this->has('telefone')) {
            $this->merge(['telefone' => $this->telephone]);
        }
        if ($this->has('endereco') && !$this->has('adresse')) {
            $this->merge(['adresse' => $this->endereco]);
        }
        if ($this->has('profissao') && !$this->has('profission')) {
            $this->merge(['profission' => $this->profissao]);
        }
        if ($this->has('firstname') && !$this->has('prenom')) {
            $this->merge(['prenom' => $this->firstname]);
        }
        if ($this->has('lastname') && !$this->has('nom')) {
            $this->merge(['nom' => $this->lastname]);
        }
    }
}