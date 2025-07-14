<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Produto;
use App\Models\Venda;
use App\Models\VendaProduto;

class VendaProdutoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VendaProduto::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'venda_id' => Venda::factory(),
            'produto_id' => Produto::factory(),
            'quantidade' => fake()->numberBetween(-10000, 10000),
            'preco_unitario' => fake()->randomFloat(2, 0, 99999999.99),
        ];
    }
}
