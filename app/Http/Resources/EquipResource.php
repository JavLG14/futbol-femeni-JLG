<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EquipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'titols' => $this->titols,
            'escut' => $this->escut ? asset('storage/' . $this->escut) : null,
            'estadi' => $this->estadi->nom ?? null,
        ];
    }
}
