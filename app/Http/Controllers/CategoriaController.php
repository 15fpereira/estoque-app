<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriumStoreRequest;
use App\Http\Requests\CategoriumUpdateRequest;
use App\Models\Categoria;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoriaController extends Controller
{
    public function index(Request $request): View
    {
        $categoria = Categorium::all();

        return view('categorium.index', [
            'categoria' => $categoria,
        ]);
    }

    public function create(Request $request): View
    {
        return view('categorium.create');
    }

    public function store(CategoriumStoreRequest $request): RedirectResponse
    {
        $categorium = Categorium::create($request->validated());

        $request->session()->flash('categorium.id', $categorium->id);

        return redirect()->route('categoria.index');
    }

    public function show(Request $request, Categorium $categorium): View
    {
        return view('categorium.show', [
            'categorium' => $categorium,
        ]);
    }

    public function edit(Request $request, Categorium $categorium): View
    {
        return view('categorium.edit', [
            'categorium' => $categorium,
        ]);
    }

    public function update(CategoriumUpdateRequest $request, Categorium $categorium): RedirectResponse
    {
        $categorium->update($request->validated());

        $request->session()->flash('categorium.id', $categorium->id);

        return redirect()->route('categoria.index');
    }

    public function destroy(Request $request, Categorium $categorium): RedirectResponse
    {
        $categorium->delete();

        return redirect()->route('categoria.index');
    }
}
