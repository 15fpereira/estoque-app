<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\UsuarioController
 */
final class UsuarioControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $usuarios = Usuario::factory()->count(3)->create();

        $response = $this->get(route('usuarios.index'));

        $response->assertOk();
        $response->assertViewIs('usuario.index');
        $response->assertViewHas('usuarios');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('usuarios.create'));

        $response->assertOk();
        $response->assertViewIs('usuario.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UsuarioController::class,
            'store',
            \App\Http\Requests\UsuarioControllerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $nome = fake()->word();
        $email = fake()->safeEmail();
        $senha = fake()->word();
        $tipo = fake()->randomElement(/** enum_attributes **/);

        $response = $this->post(route('usuarios.store'), [
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha,
            'tipo' => $tipo,
        ]);

        $usuarios = Usuario::query()
            ->where('nome', $nome)
            ->where('email', $email)
            ->where('senha', $senha)
            ->where('tipo', $tipo)
            ->get();
        $this->assertCount(1, $usuarios);
        $usuario = $usuarios->first();

        $response->assertRedirect(route('usuarios.index'));
        $response->assertSessionHas('usuario.id', $usuario->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $usuario = Usuario::factory()->create();

        $response = $this->get(route('usuarios.show', $usuario));

        $response->assertOk();
        $response->assertViewIs('usuario.show');
        $response->assertViewHas('usuario');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $usuario = Usuario::factory()->create();

        $response = $this->get(route('usuarios.edit', $usuario));

        $response->assertOk();
        $response->assertViewIs('usuario.edit');
        $response->assertViewHas('usuario');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UsuarioController::class,
            'update',
            \App\Http\Requests\UsuarioControllerUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $usuario = Usuario::factory()->create();
        $nome = fake()->word();
        $email = fake()->safeEmail();
        $senha = fake()->word();
        $tipo = fake()->randomElement(/** enum_attributes **/);

        $response = $this->put(route('usuarios.update', $usuario), [
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha,
            'tipo' => $tipo,
        ]);

        $usuario->refresh();

        $response->assertRedirect(route('usuarios.index'));
        $response->assertSessionHas('usuario.id', $usuario->id);

        $this->assertEquals($nome, $usuario->nome);
        $this->assertEquals($email, $usuario->email);
        $this->assertEquals($senha, $usuario->senha);
        $this->assertEquals($tipo, $usuario->tipo);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $usuario = Usuario::factory()->create();

        $response = $this->delete(route('usuarios.destroy', $usuario));

        $response->assertRedirect(route('usuarios.index'));

        $this->assertModelMissing($usuario);
    }
}
