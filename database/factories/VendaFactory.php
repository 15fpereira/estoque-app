<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Nullable;
use App\Models\Venda;

class VendaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Venda::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'usuario_id' => Nullable::factory(),
            'cliente_nome' => fake()->regexify('[A-Za-z0-9]{100}'),
            'total' => fake()->randomFloat(2, 0, 99999999.99),
            'forma_pagamento' => fake()->randomElement(["Cart\u00e3o","PIX","Dinheiro","Boleto"]),
            'nota_fiscal' => fake()->regexify('[A-Za-z0-9]{50}'),
        ];
    }
}
