<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\Estadi;
use Illuminate\Http\Request;
use App\Http\Resources\EstadiCollection;
use App\Http\Resources\EstadiResource;
use App\Http\Requests\StoreEstadiRequest;
use App\Http\Requests\UpdateEstadiRequest;

class EstadiController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new EstadiCollection(Estadi::paginate(100));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEstadiRequest $request)
    {
        $estadi = Estadi::create($request->validated());
        return $this->sendResponse(new EstadiResource($estadi), 'Estadi creat amb èxit', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Estadi $estadi)
    {
        return $this->sendResponse(new EstadiResource($estadi), 'Estadi recuperat amb èxit', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEstadiRequest $request, Estadi $estadi)
    {
        $estadi->update($request->validated());
        return $this->sendResponse($estadi, 'Estadi actualitzat amb èxit', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estadi $estadi)
    {
        $estadi->delete();
        return $this->sendResponse(null, 'Estadi eliminat amb èxit', 200);
    }
}
