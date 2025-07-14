<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FornecedorUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:100'],
            'contato' => ['required', 'string', 'max:100'],
            'cnpj' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:100'],
            'telefone' => ['required', 'string', 'max:20'],
        ];
    }
}
