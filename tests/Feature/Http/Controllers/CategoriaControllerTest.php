<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Categoria;
use App\Models\Categorium;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CategoriaController
 */
final class CategoriaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $categoria = Categoria::factory()->count(3)->create();

        $response = $this->get(route('categoria.index'));

        $response->assertOk();
        $response->assertViewIs('categorium.index');
        $response->assertViewHas('categoria');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('categoria.create'));

        $response->assertOk();
        $response->assertViewIs('categorium.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CategoriaController::class,
            'store',
            \App\Http\Requests\CategoriaControllerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $nome = fake()->word();

        $response = $this->post(route('categoria.store'), [
            'nome' => $nome,
        ]);

        $categoria = Categorium::query()
            ->where('nome', $nome)
            ->get();
        $this->assertCount(1, $categoria);
        $categorium = $categoria->first();

        $response->assertRedirect(route('categoria.index'));
        $response->assertSessionHas('categorium.id', $categorium->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $categorium = Categoria::factory()->create();

        $response = $this->get(route('categoria.show', $categorium));

        $response->assertOk();
        $response->assertViewIs('categorium.show');
        $response->assertViewHas('categorium');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $categorium = Categoria::factory()->create();

        $response = $this->get(route('categoria.edit', $categorium));

        $response->assertOk();
        $response->assertViewIs('categorium.edit');
        $response->assertViewHas('categorium');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CategoriaController::class,
            'update',
            \App\Http\Requests\CategoriaControllerUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $categorium = Categoria::factory()->create();
        $nome = fake()->word();

        $response = $this->put(route('categoria.update', $categorium), [
            'nome' => $nome,
        ]);

        $categorium->refresh();

        $response->assertRedirect(route('categoria.index'));
        $response->assertSessionHas('categorium.id', $categorium->id);

        $this->assertEquals($nome, $categorium->nome);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $categorium = Categoria::factory()->create();
        $categorium = Categorium::factory()->create();

        $response = $this->delete(route('categoria.destroy', $categorium));

        $response->assertRedirect(route('categoria.index'));

        $this->assertModelMissing($categorium);
    }
}
