<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partit;
use App\Http\Requests\StorePartitRequest;
use App\Http\Requests\UpdatePartitRequest;
use App\Http\Resources\PartitResource;
use App\Http\Resources\PartitCollection;

class PartitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
        $this->authorizeResource(Partit::class, 'partit');
    }

    public function index()
    {
        return new PartitCollection(Partit::with(['local', 'visitant', 'estadi', 'arbitre'])->paginate(10));
    }

    public function store(StorePartitRequest $request)
    {
        $partit = Partit::create($request->validated());
        return response()->json(new PartitResource($partit), 201);
    }

    public function show(Partit $partit)
    {
        $partit->load(['local', 'visitant', 'estadi', 'arbitre']);
        return new PartitResource($partit);
    }

    public function update(UpdatePartitRequest $request, Partit $partit)
    {
        // Policy handles if user is admin or assigned arbitre
        $partit->update($request->validated());
        return response()->json(new PartitResource($partit), 200);
    }

    public function destroy(Partit $partit)
    {
        $partit->delete();
        return response()->noContent();
    }
}
