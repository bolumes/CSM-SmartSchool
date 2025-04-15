<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMatiereRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10',
            'level' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            // Adicione outras regras de validação conforme necessário
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'code.required' => 'O campo código é obrigatório.',
            'level.required' => 'O campo nível é obrigatório.',
            'description.max' => 'A descrição não pode ter mais de 1000 caracteres.',
        ];
    }

}
