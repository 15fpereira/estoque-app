<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categorias')->insert([
            ['nome' => 'Eletrônicos'],
            ['nome' => 'Roupas'],
            ['nome' => 'Papelaria'],
        ]);
    }
}
