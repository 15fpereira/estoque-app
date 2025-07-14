<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Nullable;
use App\Models\Produto;

class ProdutoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Produto::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->regexify('[A-Za-z0-9]{100}'),
            'descricao' => fake()->text(),
            'preco' => fake()->randomFloat(2, 0, 99999999.99),
            'estoque' => fake()->numberBetween(-10000, 10000),
            'categoria_id' => Nullable::factory(),
            'fornecedor_id' => Nullable::factory(),
        ];
    }
}
