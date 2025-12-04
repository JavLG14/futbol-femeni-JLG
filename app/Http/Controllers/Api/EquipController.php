<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\Equip;
use Illuminate\Http\Request;
use App\Http\Resources\EquipCollection;
use App\Http\Resources\EquipResource;
use App\Http\Requests\StoreEquipRequest;
use App\Http\Requests\UpdateEquipRequest;

class EquipController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new EquipCollection(Equip::paginate(100));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEquipRequest $request)
    {
        $equip = Equip::create($request->validated());
        return $this->sendResponse(new EquipResource($equip), 'Equip creat amb èxit', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Equip $equip)
    {
        return $this->sendResponse(new EquipResource($equip), 'Equip recuperat amb èxit', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEquipRequest $request, Equip $equip)
    {
        $equip->update($request->validated());
        return $this->sendResponse($equip, 'Equip actualitzat amb èxit', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equip $equip)
    {
        $equip->delete();
        return $this->sendResponse(null, 'Equip eliminat amb èxit', 200);
    }
}
