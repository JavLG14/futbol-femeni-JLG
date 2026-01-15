<?php

namespace App\Livewire;

use App\Models\Partit;
use Livewire\Component;

class HistorialPartits extends Component
{
    use \Livewire\WithPagination;

    public $equip = '';
    public $data = '';
    public $sortField = 'data';
    public $sortDirection = 'asc';

    public function updatingEquip()
    {
        $this->resetPage();
    }

    public function updatingData()
    {
        $this->resetPage();
    }

    public function filtrar()
    {
        $this->resetPage();
    }

    public function reiniciar()
    {
        $this->reset(['equip', 'data']);
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    public function render()
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

        // Get all results to sort in memory (preserving existing logic)
        $collection = $query->get();

        // Custom sorting
        if ($this->sortField === 'resultat') {
            $callback = function ($partit) {
                if (is_null($partit->gols_local) || is_null($partit->gols_visitant)) {
                    return -1;
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
            $callback = $this->sortField; // data, jornada
        }

        if ($this->sortDirection === 'asc') {
            $sorted = $collection->sortBy($callback)->values();
        } else {
            $sorted = $collection->sortByDesc($callback)->values();
        }

        // Manual Pagination
        $perPage = 50;
        $currentPage = \Illuminate\Pagination\Paginator::resolveCurrentPage();
        $currentItems = $sorted->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $partits = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentItems,
            $sorted->count(),
            $perPage,
            $currentPage,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );

        return view('livewire.historial-partits', compact('partits'));
    }
}