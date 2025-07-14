<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id');
            $table->string('cliente_nome', 100);
            $table->decimal('total', 10, 2);
            $table->enum('forma_pagamento', ["Cart\u00e3o","PIX","Dinheiro","Boleto"]);
            $table->string('nota_fiscal', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
