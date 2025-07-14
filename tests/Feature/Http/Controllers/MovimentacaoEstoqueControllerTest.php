<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\MovimentacaoEstoque;
use App\Models\Nullable;
use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MovimentacaoEstoqueController
 */
final class MovimentacaoEstoqueControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $movimentacaoEstoques = MovimentacaoEstoque::factory()->count(3)->create();

        $response = $this->get(route('movimentacao-estoques.index'));

        $response->assertOk();
        $response->assertViewIs('movimentacaoEstoque.index');
        $response->assertViewHas('movimentacaoEstoques');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('movimentacao-estoques.create'));

        $response->assertOk();
        $response->assertViewIs('movimentacaoEstoque.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MovimentacaoEstoqueController::class,
            'store',
            \App\Http\Requests\MovimentacaoEstoqueControllerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $produto = Produto::factory()->create();
        $usuario = Nullable::factory()->create();
        $tipo = fake()->randomElement(/** enum_attributes **/);
        $quantidade = fake()->numberBetween(-10000, 10000);
        $motivo = fake()->word();

        $response = $this->post(route('movimentacao-estoques.store'), [
            'produto_id' => $produto->id,
            'usuario_id' => $usuario->id,
            'tipo' => $tipo,
            'quantidade' => $quantidade,
            'motivo' => $motivo,
        ]);

        $movimentacaoEstoques = MovimentacaoEstoque::query()
            ->where('produto_id', $produto->id)
            ->where('usuario_id', $usuario->id)
            ->where('tipo', $tipo)
            ->where('quantidade', $quantidade)
            ->where('motivo', $motivo)
            ->get();
        $this->assertCount(1, $movimentacaoEstoques);
        $movimentacaoEstoque = $movimentacaoEstoques->first();

        $response->assertRedirect(route('movimentacaoEstoques.index'));
        $response->assertSessionHas('movimentacaoEstoque.id', $movimentacaoEstoque->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $movimentacaoEstoque = MovimentacaoEstoque::factory()->create();

        $response = $this->get(route('movimentacao-estoques.show', $movimentacaoEstoque));

        $response->assertOk();
        $response->assertViewIs('movimentacaoEstoque.show');
        $response->assertViewHas('movimentacaoEstoque');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $movimentacaoEstoque = MovimentacaoEstoque::factory()->create();

        $response = $this->get(route('movimentacao-estoques.edit', $movimentacaoEstoque));

        $response->assertOk();
        $response->assertViewIs('movimentacaoEstoque.edit');
        $response->assertViewHas('movimentacaoEstoque');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MovimentacaoEstoqueController::class,
            'update',
            \App\Http\Requests\MovimentacaoEstoqueControllerUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $movimentacaoEstoque = MovimentacaoEstoque::factory()->create();
        $produto = Produto::factory()->create();
        $usuario = Nullable::factory()->create();
        $tipo = fake()->randomElement(/** enum_attributes **/);
        $quantidade = fake()->numberBetween(-10000, 10000);
        $motivo = fake()->word();

        $response = $this->put(route('movimentacao-estoques.update', $movimentacaoEstoque), [
            'produto_id' => $produto->id,
            'usuario_id' => $usuario->id,
            'tipo' => $tipo,
            'quantidade' => $quantidade,
            'motivo' => $motivo,
        ]);

        $movimentacaoEstoque->refresh();

        $response->assertRedirect(route('movimentacaoEstoques.index'));
        $response->assertSessionHas('movimentacaoEstoque.id', $movimentacaoEstoque->id);

        $this->assertEquals($produto->id, $movimentacaoEstoque->produto_id);
        $this->assertEquals($usuario->id, $movimentacaoEstoque->usuario_id);
        $this->assertEquals($tipo, $movimentacaoEstoque->tipo);
        $this->assertEquals($quantidade, $movimentacaoEstoque->quantidade);
        $this->assertEquals($motivo, $movimentacaoEstoque->motivo);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $movimentacaoEstoque = MovimentacaoEstoque::factory()->create();

        $response = $this->delete(route('movimentacao-estoques.destroy', $movimentacaoEstoque));

        $response->assertRedirect(route('movimentacaoEstoques.index'));

        $this->assertModelMissing($movimentacaoEstoque);
    }
}
