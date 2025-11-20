<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstadiRequest;
use App\Http\Requests\UpdateEstadiRequest;
use App\Models\Estadi;
use App\Services\EstadiService;

class EstadiController extends Controller
{
    public function __construct(private EstadiService $servei) {}

    public function index()
    {
        return view('estadis.index', ['estadis' => $this->servei->llistar()]);
    }

    public function show(Estadi $estadi)
    {
        return view('estadis.show', compact('estadi'));
    }

    public function create()
    {
        return view('estadis.create');
    }

    public function store(StoreEstadiRequest $request)
    {
        $this->servei->guardar($request->validated());
        return redirect()->route('estadis.index')->with('success', 'Estadi creat correctament!');
    }

    public function edit(Estadi $estadi)
    {
        return view('estadis.edit', compact('estadi'));
    }

    public function update(UpdateEstadiRequest $request, Estadi $estadi)
    {
        $this->servei->actualitzar($estadi->id, $request->validated());
        return redirect()->route('estadis.index')->with('success', 'Estadi actualitzat correctament!');
    }

    public function destroy(Estadi $estadi)
    {
        $this->servei->eliminar($estadi->id);
        return redirect()->route('estadis.index')->with('success', 'Estadi eliminat correctament!');
    }
}