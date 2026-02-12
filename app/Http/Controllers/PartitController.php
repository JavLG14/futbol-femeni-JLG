<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePartitRequest;
use App\Http\Requests\UpdatePartitRequest;
use App\Models\Partit;
use App\Services\PartitService;
use Illuminate\Http\Request;
use App\Events\PartitActualitzat;

class PartitController extends Controller
{
    public function __construct(private PartitService $servei)
    {
    }

    // GET /partits
    public function index()
    {
        $partits = $this->servei->getAll();
        return view('partits.index', compact('partits'));
    }

    // GET /partits/{id}
    public function show(Partit $partit)
    {
        return view('partits.show', compact('partit'));
    }

    // GET /partits/{id}/edit
    public function edit(Partit $partit)
    {
        $this->authorize('update', $partit);
        $equips = $this->servei->getEquips();
        $estadis = $this->servei->getEstadis();
        return view('partits.edit', compact('partit', 'equips', 'estadis'));
    }

    // PUT /partits/{id}
    public function update(UpdatePartitRequest $request, Partit $partit)
    {
        $this->authorize('update', $partit);
        $this->servei->update($partit->id, $request->validated());
        PartitActualitzat::dispatch($partit->id);
        return redirect()->route('partits.index')->with('ok', 'Partit actualitzat correctament.');
    }

    // DELETE /partits/{id}
    public function destroy(Partit $partit)
    {
        $this->authorize('delete', $partit);
        $this->servei->delete($partit->id);
        PartitActualitzat::dispatch($partit->id);
        return redirect()->route('partits.index')->with('ok', 'Partit eliminat correctament.');
    }

    public function historic()
    {
        return view('partits.historic');
    }
}
