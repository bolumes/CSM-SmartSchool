<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
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
            'eleve_id' => 'required|string|max:255',
            'matiere_id' => 'required|string|max:255',
            'professor_id' => 'required|string|max:255',
            'nota' => 'required|string|max:5',
            'trimestre' => 'required|string|max:15',
            'ano_letivo' => 'required|string|max:15',
            'observation' => 'nullable|string|max:1000',
            'observation' => 'nullable|string',
            // Adicione outras regras de validação conforme necessário
        ];
    }

    public function messages()
    {
        return [
            'eleve_id.required' => 'O campo eleve é obrigatório.',
            'matiere_id.required' => 'O campo matiere é obrigatório.',
            'professor_id.required' => 'O campo professor é obrigatório.',
            'nota.required' => 'O campo nota é obrigatório.',
            'trimestre.required' => 'O campo trimestre é obrigatório.',
            'ano_letivo.required' => 'O campo ano_letivo é obrigatório.',
            'observation.max' => 'A descrição não pode ter mais de 1000 caracteres.',
        ];
    }

}
