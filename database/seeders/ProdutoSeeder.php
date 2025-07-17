<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('produtos')->insert([
            [
                'nome' => 'Notebook Dell',
                'descricao' => 'Intel i7, 16GB RAM',
                'preco' => 4500.00,
                'estoque' => 10,
                'categoria_id' => 1,
                'fornecedor_id' => 1,
            ],
            [
                'nome' => 'Camiseta Branca',
                'descricao' => 'Algodão, tamanho M',
                'preco' => 29.90,
                'estoque' => 50,
                'categoria_id' => 2,
                'fornecedor_id' => 2,
            ],
        ]);
    }
}
