<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jugadora;
use Illuminate\Http\Request;
use App\Http\Resources\JugadoraCollection;
use App\Http\Resources\JugadoraResource;
use App\Http\Requests\StoreJugadoraRequest;
use App\Http\Requests\UpdateJugadoraRequest;

class JugadoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
        $this->authorizeResource(Jugadora::class, 'jugadora');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new JugadoraCollection(Jugadora::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJugadoraRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreJugadoraRequest $request)
    {
        $jugadora = Jugadora::create($request->validated());
        return response()->json($jugadora, 201); // Recurs creat
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jugadora  $jugadora
     */
    public function show(Jugadora $jugadora)
    {
        return new JugadoraResource($jugadora);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJugadoraRequest  $request
     * @param  \App\Models\Jugadora  $jugadora
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateJugadoraRequest $request, Jugadora $jugadora)
    {
        $jugadora->update($request->validated());
        return response()->json($jugadora, 200); // Actualització correcta
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jugadora  $jugadora
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jugadora $jugadora)
    {
        $jugadora->delete();
        return response()->noContent(); // 204 sense cos
    }
}