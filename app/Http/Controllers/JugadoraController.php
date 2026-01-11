<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJugadoraRequest;
use App\Http\Requests\UpdateJugadoraRequest;
use App\Models\Equip;
use App\Models\Jugadora;
use App\Services\JugadoraService;
use Illuminate\Http\Request;

class JugadoraController extends Controller
{
    public function __construct(private JugadoraService $servei)
    {
    }

    // GET /jugadores
    public function index()
    {
        return view('jugadores.index', [
            'jugadores' => $this->servei->getAllJugadores()
        ]);
    }

    // GET /jugadoras/create
    public function create()
    {
        $this->authorize('create', Jugadora::class);
        $equips = Equip::all(); // Para mostrar en dropdown
        return view('jugadores.create', compact('equips'));
    }

    // POST /jugadores
    public function store(StoreJugadoraRequest $request)
    {
        $this->authorize('create', Jugadora::class);
        $this->servei->createJugadora($request->validated());
        return redirect()->route('jugadores.index')->with('ok', 'Jugadora creada');
    }

    // GET /jugadores/{id}
    public function show(Jugadora $jugadora)
    {
        $jugadora->load('equip');
        return view('jugadores.show', compact('jugadora'));
    }

    // GET /jugadores/{id}/edit
    public function edit(Jugadora $jugadora)
    {
        $this->authorize('update', $jugadora);
        $equips = Equip::all();
        return view('jugadores.edit', compact('jugadora', 'equips'));
    }

    // PUT /jugadores/{id}
    public function update(UpdateJugadoraRequest $request, Jugadora $jugadora)
    {
        $this->authorize('update', $jugadora);
        $this->servei->updateJugadora($jugadora->id, $request->validated());
        return redirect()->route('jugadores.index')->with('ok', 'Jugadora actualizada');
    }

    // DELETE /jugadores/{id}
    public function destroy(Jugadora $jugadora)
    {
        $this->authorize('delete', $jugadora);
        $this->servei->deleteJugadora($jugadora->id);
        return redirect()->route('jugadores.index')->with('ok', 'Jugadora eliminada');
    }
}
