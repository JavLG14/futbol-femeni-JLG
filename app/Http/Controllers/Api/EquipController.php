<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Equip;
use App\Http\Requests\StoreEquipRequest;
use App\Http\Requests\UpdateEquipRequest;
use App\Http\Resources\EquipResource;
use App\Http\Resources\EquipCollection;

class EquipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
        $this->authorizeResource(Equip::class, 'equip');
    }

    public function index()
    {
        return new EquipCollection(Equip::with('estadi')->paginate(10));
    }

    public function store(StoreEquipRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('escut')) {
            $data['escut'] = $request->file('escut')->store('escuts', 'public');
        }

        $equip = Equip::create($data);
        return response()->json(new EquipResource($equip), 201);
    }

    public function show(Equip $equip)
    {
        $equip->load('estadi');
        return new EquipResource($equip);
    }

    public function update(UpdateEquipRequest $request, Equip $equip)
    {
        $data = $request->validated();
        if ($request->hasFile('escut')) {
            // Delete old if exists? logic is in Service usually.
            // For API MVP, just store new.
            $data['escut'] = $request->file('escut')->store('escuts', 'public');
        }

        $equip->update($data);
        return response()->json(new EquipResource($equip), 200);
    }

    public function destroy(Equip $equip)
    {
        $equip->delete();
        return response()->noContent();
    }
}
