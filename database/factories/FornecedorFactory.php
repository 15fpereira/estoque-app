<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Fornecedor;

class FornecedorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fornecedor::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->regexify('[A-Za-z0-9]{100}'),
            'contato' => fake()->regexify('[A-Za-z0-9]{100}'),
            'cnpj' => fake()->regexify('[A-Za-z0-9]{20}'),
            'email' => fake()->safeEmail(),
            'telefone' => fake()->regexify('[A-Za-z0-9]{20}'),
        ];
    }
}
