<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
            DB::table('usuarios')->insert([
        [
            'nome' => 'Admin',
            'email' => 'admin@estoque.com',
            'pin' => '1234',
            'senha' => '123456', // pode ignorar se não usar mais
            'tipo' => 'Administrador',
        ],
        [
            'nome' => 'João Vendedor',
            'email' => 'vendedor@estoque.com',
            'pin' => '1111',
            'senha' => '123456',
            'tipo' => 'Vendedor',
        ],
        [
            'nome' => 'Maria Estoquista',
            'email' => 'estoquista@estoque.com',
            'pin' => '2222',
            'senha' => '123456',
            'tipo' => 'Estoquista',
        ],
    ]);

    }
}
