<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovimentacaoEstoqueStoreRequest;
use App\Http\Requests\MovimentacaoEstoqueUpdateRequest;
use App\Models\MovimentacaoEstoque;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MovimentacaoEstoqueController extends Controller
{
    public function index(Request $request): View
    {
        $movimentacaoEstoques = MovimentacaoEstoque::all();

        return view('movimentacaoEstoque.index', [
            'movimentacaoEstoques' => $movimentacaoEstoques,
        ]);
    }

    public function create(Request $request): View
    {
        return view('movimentacaoEstoque.create');
    }

    public function store(MovimentacaoEstoqueStoreRequest $request): RedirectResponse
    {
        $movimentacaoEstoque = MovimentacaoEstoque::create($request->validated());

        $request->session()->flash('movimentacaoEstoque.id', $movimentacaoEstoque->id);

        return redirect()->route('movimentacaoEstoques.index');
    }

    public function show(Request $request, MovimentacaoEstoque $movimentacaoEstoque): View
    {
        return view('movimentacaoEstoque.show', [
            'movimentacaoEstoque' => $movimentacaoEstoque,
        ]);
    }

    public function edit(Request $request, MovimentacaoEstoque $movimentacaoEstoque): View
    {
        return view('movimentacaoEstoque.edit', [
            'movimentacaoEstoque' => $movimentacaoEstoque,
        ]);
    }

    public function update(MovimentacaoEstoqueUpdateRequest $request, MovimentacaoEstoque $movimentacaoEstoque): RedirectResponse
    {
        $movimentacaoEstoque->update($request->validated());

        $request->session()->flash('movimentacaoEstoque.id', $movimentacaoEstoque->id);

        return redirect()->route('movimentacaoEstoques.index');
    }

    public function destroy(Request $request, MovimentacaoEstoque $movimentacaoEstoque): RedirectResponse
    {
        $movimentacaoEstoque->delete();

        return redirect()->route('movimentacaoEstoques.index');
    }
}
