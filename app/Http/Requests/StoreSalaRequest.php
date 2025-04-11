<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalaRequest extends FormRequest
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
            'name' => 'required', // Nome da sala
            'reservar' => 'required|string', // Indica se a sala pode ser reservada
            'categoria' => 'required|string|max:255', // Categoria da sala
            'capacidade' => 'required|integer|min:1', // Capacidade da sala
            'edificio_id' => 'required|exists:edificios,id', // ID do edifício relacionado
            'caracteristicas' => 'nullable|string|max:255', // Características da sala (opcional)
            'localizacao' => 'nullable|string|max:255', // Localização da sala (opcional)
            'imagem' => 'nullable|image|max:2048', // Imagem da sala (opcional, deve ser uma imagem com tamanho máximo de 2MB)
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'reservar.required' => 'O campo reservar é obrigatório.',
            'categoria.required' => 'O campo categoria é obrigatório.',
            'capacidade.required' => 'O campo capacidade é obrigatório.',
            'edificio_id.required' => 'O campo edifício é obrigatório.',
            'caracteristicas.string' => 'As características devem ser uma string.',
            'localizacao.string' => 'A localização deve ser uma string.',
            'imagem.image' => 'A imagem deve ser um arquivo de imagem válido.',
        ];
    }
}
