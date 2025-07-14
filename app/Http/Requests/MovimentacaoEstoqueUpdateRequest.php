<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovimentacaoEstoqueUpdateRequest extends FormRequest
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
            'produto_id' => ['required', 'integer', 'exists:produtos,id'],
            'usuario_id' => ['required', 'integer', 'exists:nullables,id'],
            'tipo' => ['required', 'in:entrada,saida'],
            'quantidade' => ['required', 'integer'],
            'motivo' => ['required', 'string', 'max:255'],
        ];
    }
}
