<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Nullable;
use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProdutoController
 */
final class ProdutoControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $produtos = Produto::factory()->count(3)->create();

        $response = $this->get(route('produtos.index'));

        $response->assertOk();
        $response->assertViewIs('produto.index');
        $response->assertViewHas('produtos');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('produtos.create'));

        $response->assertOk();
        $response->assertViewIs('produto.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProdutoController::class,
            'store',
            \App\Http\Requests\ProdutoControllerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $nome = fake()->word();
        $descricao = fake()->text();
        $preco = fake()->randomFloat(/** decimal_attributes **/);
        $estoque = fake()->numberBetween(-10000, 10000);
        $categoria = Nullable::factory()->create();
        $fornecedor = Nullable::factory()->create();

        $response = $this->post(route('produtos.store'), [
            'nome' => $nome,
            'descricao' => $descricao,
            'preco' => $preco,
            'estoque' => $estoque,
            'categoria_id' => $categoria->id,
            'fornecedor_id' => $fornecedor->id,
        ]);

        $produtos = Produto::query()
            ->where('nome', $nome)
            ->where('descricao', $descricao)
            ->where('preco', $preco)
            ->where('estoque', $estoque)
            ->where('categoria_id', $categoria->id)
            ->where('fornecedor_id', $fornecedor->id)
            ->get();
        $this->assertCount(1, $produtos);
        $produto = $produtos->first();

        $response->assertRedirect(route('produtos.index'));
        $response->assertSessionHas('produto.id', $produto->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $produto = Produto::factory()->create();

        $response = $this->get(route('produtos.show', $produto));

        $response->assertOk();
        $response->assertViewIs('produto.show');
        $response->assertViewHas('produto');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $produto = Produto::factory()->create();

        $response = $this->get(route('produtos.edit', $produto));

        $response->assertOk();
        $response->assertViewIs('produto.edit');
        $response->assertViewHas('produto');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProdutoController::class,
            'update',
            \App\Http\Requests\ProdutoControllerUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $produto = Produto::factory()->create();
        $nome = fake()->word();
        $descricao = fake()->text();
        $preco = fake()->randomFloat(/** decimal_attributes **/);
        $estoque = fake()->numberBetween(-10000, 10000);
        $categoria = Nullable::factory()->create();
        $fornecedor = Nullable::factory()->create();

        $response = $this->put(route('produtos.update', $produto), [
            'nome' => $nome,
            'descricao' => $descricao,
            'preco' => $preco,
            'estoque' => $estoque,
            'categoria_id' => $categoria->id,
            'fornecedor_id' => $fornecedor->id,
        ]);

        $produto->refresh();

        $response->assertRedirect(route('produtos.index'));
        $response->assertSessionHas('produto.id', $produto->id);

        $this->assertEquals($nome, $produto->nome);
        $this->assertEquals($descricao, $produto->descricao);
        $this->assertEquals($preco, $produto->preco);
        $this->assertEquals($estoque, $produto->estoque);
        $this->assertEquals($categoria->id, $produto->categoria_id);
        $this->assertEquals($fornecedor->id, $produto->fornecedor_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $produto = Produto::factory()->create();

        $response = $this->delete(route('produtos.destroy', $produto));

        $response->assertRedirect(route('produtos.index'));

        $this->assertModelMissing($produto);
    }
}
