<?php

namespace App\Http\Controllers;

use App\Http\Requests\FornecedorStoreRequest;
use App\Http\Requests\FornecedorUpdateRequest;
use App\Models\Fornecedor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FornecedorController extends Controller
{
    public function index(Request $request): View
    {
        $fornecedors = Fornecedor::all();

        return view('fornecedor.index', [
            'fornecedors' => $fornecedors,
        ]);
    }

    public function create(Request $request): View
    {
        return view('fornecedor.create');
    }

    public function store(FornecedorStoreRequest $request): RedirectResponse
    {
        $fornecedor = Fornecedor::create($request->validated());

        $request->session()->flash('fornecedor.id', $fornecedor->id);

        return redirect()->route('fornecedors.index');
    }

    public function show(Request $request, Fornecedor $fornecedor): View
    {
        return view('fornecedor.show', [
            'fornecedor' => $fornecedor,
        ]);
    }

    public function edit(Request $request, Fornecedor $fornecedor): View
    {
        return view('fornecedor.edit', [
            'fornecedor' => $fornecedor,
        ]);
    }

    public function update(FornecedorUpdateRequest $request, Fornecedor $fornecedor): RedirectResponse
    {
        $fornecedor->update($request->validated());

        $request->session()->flash('fornecedor.id', $fornecedor->id);

        return redirect()->route('fornecedors.index');
    }

    public function destroy(Request $request, Fornecedor $fornecedor): RedirectResponse
    {
        $fornecedor->delete();

        return redirect()->route('fornecedors.index');
    }
}
