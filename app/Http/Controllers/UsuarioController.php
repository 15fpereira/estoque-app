<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioStoreRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsuarioController extends Controller
{
    public function index(Request $request): View
    {
        $usuarios = Usuario::all();

        return view('usuario.index', [
            'usuarios' => $usuarios,
        ]);
    }

    public function create(Request $request): View
    {
        return view('usuario.create');
    }

    public function store(UsuarioStoreRequest $request): RedirectResponse
    {
        $usuario = Usuario::create($request->validated());

        $request->session()->flash('usuario.id', $usuario->id);

        return redirect()->route('usuarios.index');
    }

    public function show(Request $request, Usuario $usuario): View
    {
        return view('usuario.show', [
            'usuario' => $usuario,
        ]);
    }

    public function edit(Request $request, Usuario $usuario): View
    {
        return view('usuario.edit', [
            'usuario' => $usuario,
        ]);
    }

    public function update(UsuarioUpdateRequest $request, Usuario $usuario): RedirectResponse
    {
        $usuario->update($request->validated());

        $request->session()->flash('usuario.id', $usuario->id);

        return redirect()->route('usuarios.index');
    }

    public function destroy(Request $request, Usuario $usuario): RedirectResponse
    {
        $usuario->delete();

        return redirect()->route('usuarios.index');
    }
}
