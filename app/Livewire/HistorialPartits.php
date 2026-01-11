<?php

namespace App\Livewire;

use App\Models\Partit;
use Livewire\Component;

class HistorialPartits extends Component
{
    public $partits;
    public $equip = '';
    public $data = '';
    public $sortField = 'data';
    public $sortDirection = 'asc';

    public function mount()
    {
        $this->filterAndSort();
    }

    public function filtrar()
    {
        $this->filterAndSort();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->filterAndSort();
    }

    private function filterAndSort()
    {
        $query = Partit::with(['equipLocal', 'equipVisitant', 'estadi', 'arbitre'])
            ->when($this->equip, function ($query) {
                $query->where(function ($q) {
                    $q->whereHas('equipLocal', fn($sub) => $sub->where('nom', 'like', "%{$this->equip}%"))
                        ->orWhereHas('equipVisitant', fn($sub) => $sub->where('nom', 'like', "%{$this->equip}%"));
                });
            })
            ->when($this->data, function ($query) {
                $query->whereDate('data', $this->data);
            });

        $collection = $query->get();

        // Custom sorting
        if ($this->sortField === 'resultat') {
            $callback = function ($partit) {
                if (is_null($partit->gols_local) || is_null($partit->gols_visitant)) {
                    return -1; // Treat pending matches as lowest diff
                }
                return abs($partit->gols_local - $partit->gols_visitant);
            };
        } elseif ($this->sortField === 'local') {
            $callback = 'equipLocal.nom';
        } elseif ($this->sortField === 'visitant') {
            $callback = 'equipVisitant.nom';
        } elseif ($this->sortField === 'estadi') {
            $callback = function ($partit) {
                return $partit->estadi->nom ?? '';
            };
        } elseif ($this->sortField === 'arbitre') {
            $callback = 'arbitre.name';
        } else {
            $callback = $this->sortField; // data
        }

        if ($this->sortDirection === 'asc') {
            $this->partits = $collection->sortBy($callback)->values();
        } else {
            $this->partits = $collection->sortByDesc($callback)->values();
        }
    }

    public function render()
    {
        return view('livewire.historial-partits');
    }
}