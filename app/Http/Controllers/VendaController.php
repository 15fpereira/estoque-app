<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendaStoreRequest;
use App\Http\Requests\VendaUpdateRequest;
use App\Models\Venda;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VendaController extends Controller
{
    public function index(Request $request): View
    {
        $vendas = Venda::all();

        return view('venda.index', [
            'vendas' => $vendas,
        ]);
    }

    public function create(Request $request): View
    {
        return view('venda.create');
    }

    public function store(VendaStoreRequest $request): RedirectResponse
    {
        $venda = Venda::create($request->validated());

        $request->session()->flash('venda.id', $venda->id);

        return redirect()->route('vendas.index');
    }

    public function show(Request $request, Venda $venda): View
    {
        return view('venda.show', [
            'venda' => $venda,
        ]);
    }

    public function edit(Request $request, Venda $venda): View
    {
        return view('venda.edit', [
            'venda' => $venda,
        ]);
    }

    public function update(VendaUpdateRequest $request, Venda $venda): RedirectResponse
    {
        $venda->update($request->validated());

        $request->session()->flash('venda.id', $venda->id);

        return redirect()->route('vendas.index');
    }

    public function destroy(Request $request, Venda $venda): RedirectResponse
    {
        $venda->delete();

        return redirect()->route('vendas.index');
    }
}
