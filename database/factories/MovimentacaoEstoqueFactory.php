<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\MovimentacaoEstoque;
use App\Models\Nullable;
use App\Models\Produto;

class MovimentacaoEstoqueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MovimentacaoEstoque::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'produto_id' => Produto::factory(),
            'usuario_id' => Nullable::factory(),
            'tipo' => fake()->randomElement(["entrada","saida"]),
            'quantidade' => fake()->numberBetween(-10000, 10000),
            'motivo' => fake()->regexify('[A-Za-z0-9]{255}'),
        ];
    }
}
