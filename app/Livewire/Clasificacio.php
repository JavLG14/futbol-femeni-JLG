<?php

namespace App\Livewire;

use App\Models\Equip;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;

class Clasificacio extends Component
{
    #[On('echo:classificacio,.partit.resultat')]
    public function refreshFromBroadcast()
    {
        // This method will be called when the event is broadcasted.
        // Livewire will automatically re-render the component.
    }

    public $previousPoints = [];

    public function mount()
    {
        $this->updatePointsCache();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        // Calcular puntos actuales
        $equips = Equip::with(['partitsLocal', 'partitsVisitant'])->get();

        $classificacio = $equips->map(function ($equip) {
            $stats = [
                'id' => $equip->id,
                'equip' => $equip->nom,
                'escut' => $equip->escut,
                'punts' => 0,
                'victories' => 0,
                'derrotes' => 0,
                'empats' => 0,
            ];

            foreach ($equip->partitsLocal as $partit) {
                if ($partit->gols_local === null || $partit->gols_visitant === null)
                    continue;

                if ($partit->gols_local > $partit->gols_visitant) {
                    $stats['punts'] += 3;
                    $stats['victories']++;
                } elseif ($partit->gols_local === $partit->gols_visitant) {
                    $stats['punts'] += 1;
                    $stats['empats']++;
                } else {
                    $stats['derrotes']++;
                }
            }

            foreach ($equip->partitsVisitant as $partit) {
                if ($partit->gols_local === null || $partit->gols_visitant === null)
                    continue;

                if ($partit->gols_visitant > $partit->gols_local) {
                    $stats['punts'] += 3;
                    $stats['victories']++;
                } elseif ($partit->gols_visitant === $partit->gols_local) {
                    $stats['punts'] += 1;
                    $stats['empats']++;
                } else {
                    $stats['derrotes']++;
                }
            }

            return $stats;
        });

        // Aplicar lógica de variación visual
        $classificacio = $classificacio->map(function ($item) {
            $oldPoints = $this->previousPoints[$item['id']] ?? $item['punts']; // Si no existe anterior (primer load), asumimos igual

            $item['variation'] = null;
            if ($item['punts'] > $oldPoints) {
                $item['variation'] = 'increase';
            } elseif ($item['punts'] < $oldPoints) {
                $item['variation'] = 'decrease';
            }

            return $item;
        })->sortByDesc('punts')->values();

        // Actualizar caché para la próxima renderización
        $this->previousPoints = $classificacio->pluck('punts', 'id')->toArray();

        return view('livewire.clasificacio', compact('classificacio'));
    }

    private function updatePointsCache()
    {
        // Método auxiliar para inicializar la caché sin marcar variación
        $equips = Equip::with(['partitsLocal', 'partitsVisitant'])->get();

        $data = $equips->map(function ($equip) {
            $punts = 0;
            foreach ($equip->partitsLocal as $partit) {
                if ($partit->gols_local === null || $partit->gols_visitant === null)
                    continue;
                if ($partit->gols_local > $partit->gols_visitant)
                    $punts += 3;
                elseif ($partit->gols_local === $partit->gols_visitant)
                    $punts += 1;
            }
            foreach ($equip->partitsVisitant as $partit) {
                if ($partit->gols_local === null || $partit->gols_visitant === null)
                    continue;
                if ($partit->gols_visitant > $partit->gols_local)
                    $punts += 3;
                elseif ($partit->gols_visitant === $partit->gols_local)
                    $punts += 1;
            }
            return ['id' => $equip->id, 'punts' => $punts];
        });

        $this->previousPoints = $data->pluck('punts', 'id')->toArray();
    }
}
