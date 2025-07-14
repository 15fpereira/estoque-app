<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoUpdateRequest extends FormRequest
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
            'descricao' => ['required', 'string'],
            'preco' => ['required', 'numeric', 'between:-99999999.99,99999999.99'],
            'estoque' => ['required', 'integer'],
            'categoria_id' => ['required', 'integer', 'exists:nullables,id'],
            'fornecedor_id' => ['required', 'integer', 'exists:nullables,id'],
        ];
    }
}
