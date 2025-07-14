<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoStoreRequest;
use App\Http\Requests\ProdutoUpdateRequest;
use App\Models\Produto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProdutoController extends Controller
{
    public function index(Request $request): View
    {
        $produtos = Produto::all();

        return view('produto.index', [
            'produtos' => $produtos,
        ]);
    }

    public function create(Request $request): View
    {
        return view('produto.create');
    }

    public function store(ProdutoStoreRequest $request): RedirectResponse
    {
        $produto = Produto::create($request->validated());

        $request->session()->flash('produto.id', $produto->id);

        return redirect()->route('produtos.index');
    }

    public function show(Request $request, Produto $produto): View
    {
        return view('produto.show', [
            'produto' => $produto,
        ]);
    }

    public function edit(Request $request, Produto $produto): View
    {
        return view('produto.edit', [
            'produto' => $produto,
        ]);
    }

    public function update(ProdutoUpdateRequest $request, Produto $produto): RedirectResponse
    {
        $produto->update($request->validated());

        $request->session()->flash('produto.id', $produto->id);

        return redirect()->route('produtos.index');
    }

    public function destroy(Request $request, Produto $produto): RedirectResponse
    {
        $produto->delete();

        return redirect()->route('produtos.index');
    }
}
