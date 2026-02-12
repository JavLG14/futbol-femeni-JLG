<?php

namespace App\Livewire;

use App\Models\Partit;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class HistorialPartits extends Component
{
    use WithPagination;

    public $equip = '';
    public $data = '';
    public $sortField = 'data';
    public $sortDirection = 'asc';

    public int $refreshKey = 0;

    #[On('echo:classificacio,.partit.resultat')]
    #[On('classificacio-refresh')]
    public function refreshFromBroadcast(): void
    {
        //logger('REFRESH DISPARADO');
        $this->refreshKey++; // 💥 fuerza reconstrucción del DOM
    }

    public function updatingEquip() { $this->resetPage(); }
    public function updatingData() { $this->resetPage(); }

    public function filtrar() { $this->resetPage(); }

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
            ->when($this->data, fn($query) => $query->whereDate('data', $this->data));

        $collection = $query->get();

        // Ordenación personalizada
        if ($this->sortField === 'resultat') {
            $callback = fn($p) => is_null($p->gols_local) || is_null($p->gols_visitant)
                ? -1
                : abs($p->gols_local - $p->gols_visitant);
        } elseif ($this->sortField === 'local') {
            $callback = 'equipLocal.nom';
        } elseif ($this->sortField === 'visitant') {
            $callback = 'equipVisitant.nom';
        } elseif ($this->sortField === 'estadi') {
            $callback = fn($p) => $p->estadi->nom ?? '';
        } elseif ($this->sortField === 'arbitre') {
            $callback = 'arbitre.name';
        } else {
            $callback = $this->sortField;
        }

        $sorted = $this->sortDirection === 'asc'
            ? $collection->sortBy($callback)->values()
            : $collection->sortByDesc($callback)->values();

        // Paginación manual
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