<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnneeScolaireRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => [
                'required',
                'string',
                'max:20',
                'unique:annees_scolaires,nome',
            ],

            'data_inicio' => [
                'required',
                'date',
            ],

            'data_fim' => [
                'required',
                'date',
                'after:data_inicio',
            ],

            'ativo' => [
                'nullable',
                'boolean',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' =>
                'O nome do ano letivo é obrigatório.',

            'nome.string' =>
                'O nome do ano letivo deve ser um texto.',

            'nome.max' =>
                'O nome do ano letivo não pode ter mais de 20 caracteres.',

            'nome.unique' =>
                'Este ano letivo já está registado.',

            'data_inicio.required' =>
                'A data de início é obrigatória.',

            'data_inicio.date' =>
                'A data de início não é válida.',

            'data_fim.required' =>
                'A data de fim é obrigatória.',

            'data_fim.date' =>
                'A data de fim não é válida.',

            'data_fim.after' =>
                'A data de fim deve ser posterior à data de início.',

            'ativo.boolean' =>
                'O valor do campo ativo não é válido.',
        ];
    }

    public function attributes(): array
    {
        return [
            'nome' => 'ano letivo',
            'data_inicio' => 'data de início',
            'data_fim' => 'data de fim',
            'ativo' => 'estado',
        ];
    }
}