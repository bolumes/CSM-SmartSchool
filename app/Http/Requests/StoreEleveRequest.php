<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEleveRequest extends FormRequest
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
            'classe_id' => 'required|exists:classes,id',
            'matricula' => 'required|string|max:255|unique:eleves,matricula',
            'nome' => 'required|string|max:255',
            'apelido' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'endereco' => 'nullable|string|max:255',
            'telefone' => 'nullable|string|max:20',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'classe_id.required' => 'A classe é obrigatória.',
            'classe_id.exists' => 'A classe selecionada não existe.',

            'matricula.required' => 'A matrícula é obrigatória.',
            'matricula.unique' => '⚠️ Esta matrícula já está registada!',

            'nome.required' => 'O nome é obrigatório.',
            'apelido.required' => 'O apelido é obrigatório.',

            'data_nascimento.required' => 'A data de nascimento é obrigatória.',

            'endereco.max' => 'O endereço não pode ter mais de 255 caracteres.',
            'telefone.max' => 'O telefone não pode ter mais de 20 caracteres.',
        ];
    }
}
