<?php

namespace App\Http\Controllers\Api;

use App\Models\Jugadora;
use Illuminate\Http\Request;
use App\Http\Resources\JugadoraCollection;
use App\Http\Resources\JugadoraResource;
use App\Http\Requests\StoreJugadoraRequest;
use App\Http\Requests\UpdateJugadoraRequest;

class JugadoraController extends ApiController
{
    public function index()
    {
        return new JugadoraCollection(Jugadora::paginate(100));
    }
    public function show(Jugadora $jugadora)
    {
        return $this->sendResponse(new JugadoraResource($jugadora), 'Jugadora Recuperada amb exit', 200);
    }
    public function store(StoreJugadoraRequest $request)
    {
        $jugadora = Jugadora::create($request->validated());
        return $this->sendResponse(new JugadoraResource($jugadora), 'Jugadora Creada amb exit', 201);
    }

    public function update(UpdateJugadoraRequest $request, Jugadora $jugadora)
    {
        $jugadora->update($request->validated());
        return $this->sendResponse($jugadora, 'Jugadora Actualitzada amb èxit', 200);
    }
    public function destroy(Jugadora $jugadora)
    {
        $jugadora->delete();
        return $this->sendResponse(null, 'Jugadora Eliminada amb exit', 200);
    }
}
