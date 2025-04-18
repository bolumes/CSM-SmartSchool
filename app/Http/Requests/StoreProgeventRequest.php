<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProgeventRequest extends FormRequest
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
            'sala_id' => 'required|exists:salas,id',
            'event_id' => 'required|exists:events,id',
            'date' => 'required|date',
            'start' => 'required|date_format:H:i',
            'end' => 'required|date_format:H:i|after:start_time',
        ];
    }

    public function messages()
        {
            return [
                'sala_id.required' => 'A sala é obrigatória.',
                'event_id.required' => 'O evento é obrigatório.',
                'date.required' => 'A data é obrigatória.',
                'start_time.required' => 'A hora de início é obrigatória.',
                'end_time.required' => 'A hora de término é obrigatória.',
                'end_time.after' => 'A hora de término deve ser após a hora de início.',
            ];
        }   
}
