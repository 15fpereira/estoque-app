<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FornecedorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('fornecedors')->insert([
            [
                'nome' => 'Fornecedor A',
                'contato' => 'Contato A',
                'cnpj' => '11111111000111',
                'email' => 'a@fornecedor.com',
                'telefone' => '1111-1111',
            ],
            [
                'nome' => 'Fornecedor B',
                'contato' => 'Contato B',
                'cnpj' => '22222222000122',
                'email' => 'b@fornecedor.com',
                'telefone' => '2222-2222',
            ],
        ]);
    }
}
