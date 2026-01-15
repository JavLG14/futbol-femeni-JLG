<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartitResource extends JsonResource
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
            'jornada' => $this->jornada,
            'data' => $this->data->format('Y-m-d H:i:s'),
            'local' => $this->local->nom,
            'visitant' => $this->visitant->nom,
            'gols_local' => $this->gols_local,
            'gols_visitant' => $this->gols_visitant,
            'estadi' => $this->estadi->nom ?? null,
            'arbitre' => $this->arbitre->name ?? null,
        ];
    }
}
