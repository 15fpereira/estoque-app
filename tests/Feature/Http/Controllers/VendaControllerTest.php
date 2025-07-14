<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Nullable;
use App\Models\Venda;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\VendaController
 */
final class VendaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $vendas = Venda::factory()->count(3)->create();

        $response = $this->get(route('vendas.index'));

        $response->assertOk();
        $response->assertViewIs('venda.index');
        $response->assertViewHas('vendas');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('vendas.create'));

        $response->assertOk();
        $response->assertViewIs('venda.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VendaController::class,
            'store',
            \App\Http\Requests\VendaControllerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $usuario = Nullable::factory()->create();
        $cliente_nome = fake()->word();
        $total = fake()->randomFloat(/** decimal_attributes **/);
        $forma_pagamento = fake()->randomElement(/** enum_attributes **/);
        $nota_fiscal = fake()->word();

        $response = $this->post(route('vendas.store'), [
            'usuario_id' => $usuario->id,
            'cliente_nome' => $cliente_nome,
            'total' => $total,
            'forma_pagamento' => $forma_pagamento,
            'nota_fiscal' => $nota_fiscal,
        ]);

        $vendas = Venda::query()
            ->where('usuario_id', $usuario->id)
            ->where('cliente_nome', $cliente_nome)
            ->where('total', $total)
            ->where('forma_pagamento', $forma_pagamento)
            ->where('nota_fiscal', $nota_fiscal)
            ->get();
        $this->assertCount(1, $vendas);
        $venda = $vendas->first();

        $response->assertRedirect(route('vendas.index'));
        $response->assertSessionHas('venda.id', $venda->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $venda = Venda::factory()->create();

        $response = $this->get(route('vendas.show', $venda));

        $response->assertOk();
        $response->assertViewIs('venda.show');
        $response->assertViewHas('venda');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $venda = Venda::factory()->create();

        $response = $this->get(route('vendas.edit', $venda));

        $response->assertOk();
        $response->assertViewIs('venda.edit');
        $response->assertViewHas('venda');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VendaController::class,
            'update',
            \App\Http\Requests\VendaControllerUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $venda = Venda::factory()->create();
        $usuario = Nullable::factory()->create();
        $cliente_nome = fake()->word();
        $total = fake()->randomFloat(/** decimal_attributes **/);
        $forma_pagamento = fake()->randomElement(/** enum_attributes **/);
        $nota_fiscal = fake()->word();

        $response = $this->put(route('vendas.update', $venda), [
            'usuario_id' => $usuario->id,
            'cliente_nome' => $cliente_nome,
            'total' => $total,
            'forma_pagamento' => $forma_pagamento,
            'nota_fiscal' => $nota_fiscal,
        ]);

        $venda->refresh();

        $response->assertRedirect(route('vendas.index'));
        $response->assertSessionHas('venda.id', $venda->id);

        $this->assertEquals($usuario->id, $venda->usuario_id);
        $this->assertEquals($cliente_nome, $venda->cliente_nome);
        $this->assertEquals($total, $venda->total);
        $this->assertEquals($forma_pagamento, $venda->forma_pagamento);
        $this->assertEquals($nota_fiscal, $venda->nota_fiscal);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $venda = Venda::factory()->create();

        $response = $this->delete(route('vendas.destroy', $venda));

        $response->assertRedirect(route('vendas.index'));

        $this->assertModelMissing($venda);
    }
}
