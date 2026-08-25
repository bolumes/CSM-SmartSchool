<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
{
    /**
     * Autorizar o pedido.
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

            'classe_id' => [
                'required',
                'exists:classes,id'
            ],

            'matiere_id' => [
                'required',
                'exists:matieres,id'
            ],

            'professor_id' => [
                'required',
                'exists:professors,id'
            ],

            'lesson_number' => [
                'required',
                'integer',
                'min:1'
            ],

            'attendance_date' => [
                'required',
                'date'
            ],

            'attendance' => [
                'required',
                'array',
                'min:1'
            ],

            'attendance.*' => [
                'required',
                'in:present,absent,late,justified'
            ],

            'remarks' => [
                'nullable',
                'array'
            ],

            'remarks.*' => [
                'nullable',
                'string',
                'max:255'
            ],

        ];
    }

    /**
     * Mensagens personalizadas.
     */
    public function messages(): array
    {
        return [

            'classe_id.required' => 'Selecione a turma.',

            'classe_id.exists' => 'A turma selecionada não existe.',

            'matiere_id.required' => 'Selecione a disciplina.',

            'matiere_id.exists' => 'A disciplina selecionada não existe.',

            'professor_id.required' => 'Selecione o professor.',

            'lesson_number.required' => 'Informe o número da aula.',

            'lesson_number.integer' => 'O número da aula deve ser numérico.',

            'attendance_date.required' => 'Informe a data.',

            'attendance.required' => 'Registe a assiduidade dos alunos.',

            'attendance.*.in' => 'Estado de assiduidade inválido.',

        ];
    }

    /**
     * Nomes amigáveis dos campos.
     */
    public function attributes(): array
    {
        return [

            'classe_id' => 'turma',

            'matiere_id' => 'disciplina',

            'professor_id' => 'professor',

            'lesson_number' => 'número da aula',

            'attendance_date' => 'data',

        ];
    }
}
