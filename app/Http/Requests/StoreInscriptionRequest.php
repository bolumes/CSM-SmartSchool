<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInscriptionRequest extends FormRequest
{
    /**
     * Determinar se o utilizador está autorizado
     * a realizar uma inscrição.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Regras de validação.
     */
    public function rules(): array
    {
        return [
            'eleve_id' => [
                'required',
                'integer',
                'exists:eleves,id',
            ],

            'classe_id' => [
                'required',
                'integer',
                'exists:classes,id',
            ],

            'annee_scolaire_id' => [
                'required',
                'integer',
                'exists:annees_scolaires,id',
            ],

            'data_inscricao' => [
                'required',
                'date',
            ],
        ];
    }

    /**
     * Mensagens personalizadas.
     */
    public function messages(): array
    {
        return [
            'eleve_id.required' =>
                'O aluno é obrigatório.',

            'eleve_id.integer' =>
                'O aluno selecionado não é válido.',

            'eleve_id.exists' =>
                'O aluno selecionado não existe.',

            'classe_id.required' =>
                'A classe é obrigatória.',

            'classe_id.integer' =>
                'A classe selecionada não é válida.',

            'classe_id.exists' =>
                'A classe selecionada não existe.',

            'annee_scolaire_id.required' =>
                'O ano letivo é obrigatório.',

            'annee_scolaire_id.integer' =>
                'O ano letivo selecionado não é válido.',

            'annee_scolaire_id.exists' =>
                'O ano letivo selecionado não existe.',

            'data_inscricao.required' =>
                'A data da inscrição é obrigatória.',

            'data_inscricao.date' =>
                'A data da inscrição não é válida.',
        ];
    }

    /**
     * Nomes amigáveis dos campos.
     */
    public function attributes(): array
    {
        return [
            'eleve_id' => 'aluno',
            'classe_id' => 'classe',
            'annee_scolaire_id' => 'ano letivo',
            'data_inscricao' => 'data da inscrição',
        ];
    }
}