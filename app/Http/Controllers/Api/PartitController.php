<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\Partit;
use Illuminate\Http\Request;
use App\Http\Resources\PartitCollection;
use App\Http\Resources\PartitResource;
use App\Http\Requests\StorePartitRequest;
use App\Http\Requests\UpdatePartitRequest;

class PartitController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PartitCollection(Partit::paginate(100));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartitRequest $request)
    {
        $partit = Partit::create($request->validated());
        return $this->sendResponse(new PartitResource($partit), 'Partit creat amb èxit', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Partit $partit)
    {
        return $this->sendResponse(new PartitResource($partit), 'Partit recuperat amb èxit', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartitRequest $request, Partit $partit)
    {
        $partit->update($request->validated());
        return $this->sendResponse($partit, 'Partit actualitzat amb èxit', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partit $partit)
    {
        $partit->delete();
        return $this->sendResponse(null, 'Partit eliminat amb èxit', 200);
    }
}
