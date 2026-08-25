<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * Validation rules.
     */
    public function rules(): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | ENCARREGADO DE EDUCAÇÃO
            |--------------------------------------------------------------------------
            */

            'parent_id' => [
                'required',

                Rule::exists('users', 'id')
                    ->where(function ($query) {

                        $query->where(
                            'function',
                            'Parent'
                        );

                    }),
            ],


            /*
            |--------------------------------------------------------------------------
            | DADOS DO ALUNO
            |--------------------------------------------------------------------------
            */

            'nome' => [
                'required',
                'string',
                'max:255',
            ],


            'apelido' => [
                'required',
                'string',
                'max:255',
            ],


            'sexo' => [
                'required',
                'string',
                'max:20',
            ],


            'data_nascimento' => [
                'required',
                'date',
            ],


            'endereco' => [
                'nullable',
                'string',
                'max:255',
            ],


            'telefone' => [
                'nullable',
                'string',
                'max:50',
            ],

        ];
    }


    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | ENCARREGADO
            |--------------------------------------------------------------------------
            */

            'parent_id.required' =>
                'O encarregado de educação é obrigatório.',

            'parent_id.exists' =>
                'O utilizador selecionado deve ser um encarregado de educação.',


            /*
            |--------------------------------------------------------------------------
            | NOME
            |--------------------------------------------------------------------------
            */

            'nome.required' =>
                'O nome do aluno é obrigatório.',

            'nome.max' =>
                'O nome não pode ter mais de 255 caracteres.',


            /*
            |--------------------------------------------------------------------------
            | APELIDO
            |--------------------------------------------------------------------------
            */

            'apelido.required' =>
                'O apelido do aluno é obrigatório.',

            'apelido.max' =>
                'O apelido não pode ter mais de 255 caracteres.',


            /*
            |--------------------------------------------------------------------------
            | SEXO
            |--------------------------------------------------------------------------
            */

            'sexo.required' =>
                'O sexo do aluno é obrigatório.',

            'sexo.max' =>
                'O sexo não pode ter mais de 20 caracteres.',


            /*
            |--------------------------------------------------------------------------
            | DATA DE NASCIMENTO
            |--------------------------------------------------------------------------
            */

            'data_nascimento.required' =>
                'A data de nascimento é obrigatória.',

            'data_nascimento.date' =>
                'A data de nascimento não é válida.',


            /*
            |--------------------------------------------------------------------------
            | ENDEREÇO
            |--------------------------------------------------------------------------
            */

            'endereco.max' =>
                'O endereço não pode ter mais de 255 caracteres.',


            /*
            |--------------------------------------------------------------------------
            | TELEFONE
            |--------------------------------------------------------------------------
            */

            'telefone.max' =>
                'O telefone não pode ter mais de 50 caracteres.',

        ];
    }
}