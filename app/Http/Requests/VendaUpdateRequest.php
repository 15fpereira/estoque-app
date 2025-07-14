<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendaUpdateRequest extends FormRequest
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
            'usuario_id' => ['required', 'integer', 'exists:nullables,id'],
            'cliente_nome' => ['required', 'string', 'max:100'],
            'total' => ['required', 'numeric', 'between:-99999999.99,99999999.99'],
            'forma_pagamento' => ['required', 'in:Cartão,PIX,Dinheiro,Boleto'],
            'nota_fiscal' => ['required', 'string', 'max:50'],
        ];
    }
}
