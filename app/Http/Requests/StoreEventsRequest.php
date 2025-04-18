<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventsRequest extends FormRequest
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
            'type' => 'required|string|max:255',
            'matiere_id' => 'required|integer|max:100',
            'professor_id' => 'required|integer|max:100',
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'O campo tipo é obrigatório.',
            'matiere_id.required' => 'O campo matéria é obrigatório.',
            'professor_id.required' => 'O campo professor é obrigatório.',
        ];
    }
}
