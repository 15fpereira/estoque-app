<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\FornecedorController
 */
final class FornecedorControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $fornecedors = Fornecedor::factory()->count(3)->create();

        $response = $this->get(route('fornecedors.index'));

        $response->assertOk();
        $response->assertViewIs('fornecedor.index');
        $response->assertViewHas('fornecedors');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('fornecedors.create'));

        $response->assertOk();
        $response->assertViewIs('fornecedor.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FornecedorController::class,
            'store',
            \App\Http\Requests\FornecedorControllerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $nome = fake()->word();
        $contato = fake()->word();
        $cnpj = fake()->word();
        $email = fake()->safeEmail();
        $telefone = fake()->word();

        $response = $this->post(route('fornecedors.store'), [
            'nome' => $nome,
            'contato' => $contato,
            'cnpj' => $cnpj,
            'email' => $email,
            'telefone' => $telefone,
        ]);

        $fornecedors = Fornecedor::query()
            ->where('nome', $nome)
            ->where('contato', $contato)
            ->where('cnpj', $cnpj)
            ->where('email', $email)
            ->where('telefone', $telefone)
            ->get();
        $this->assertCount(1, $fornecedors);
        $fornecedor = $fornecedors->first();

        $response->assertRedirect(route('fornecedors.index'));
        $response->assertSessionHas('fornecedor.id', $fornecedor->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $fornecedor = Fornecedor::factory()->create();

        $response = $this->get(route('fornecedors.show', $fornecedor));

        $response->assertOk();
        $response->assertViewIs('fornecedor.show');
        $response->assertViewHas('fornecedor');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $fornecedor = Fornecedor::factory()->create();

        $response = $this->get(route('fornecedors.edit', $fornecedor));

        $response->assertOk();
        $response->assertViewIs('fornecedor.edit');
        $response->assertViewHas('fornecedor');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FornecedorController::class,
            'update',
            \App\Http\Requests\FornecedorControllerUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $fornecedor = Fornecedor::factory()->create();
        $nome = fake()->word();
        $contato = fake()->word();
        $cnpj = fake()->word();
        $email = fake()->safeEmail();
        $telefone = fake()->word();

        $response = $this->put(route('fornecedors.update', $fornecedor), [
            'nome' => $nome,
            'contato' => $contato,
            'cnpj' => $cnpj,
            'email' => $email,
            'telefone' => $telefone,
        ]);

        $fornecedor->refresh();

        $response->assertRedirect(route('fornecedors.index'));
        $response->assertSessionHas('fornecedor.id', $fornecedor->id);

        $this->assertEquals($nome, $fornecedor->nome);
        $this->assertEquals($contato, $fornecedor->contato);
        $this->assertEquals($cnpj, $fornecedor->cnpj);
        $this->assertEquals($email, $fornecedor->email);
        $this->assertEquals($telefone, $fornecedor->telefone);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $fornecedor = Fornecedor::factory()->create();

        $response = $this->delete(route('fornecedors.destroy', $fornecedor));

        $response->assertRedirect(route('fornecedors.index'));

        $this->assertModelMissing($fornecedor);
    }
}
