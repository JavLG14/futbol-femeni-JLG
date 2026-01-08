<?php

namespace App\Livewire;

use App\Models\Partit;
use Livewire\Component;

class HistorialPartits extends Component
{
    public $partits;
    public $equip = '';
    public $data = '';

    public function mount()
    {
        $this->partits = Partit::with(['equipLocal', 'equipVisitant', 'estadi', 'arbitre'])->get();
    }


    public function filtrar()
    {
        $this->partits = Partit::with(['equipLocal', 'equipVisitant', 'estadi', 'arbitre'])
            ->when($this->equip, function ($query) {
                $query->where(function ($q) {
                    $q->whereHas('equipLocal', fn($sub) => $sub->where('nom', 'like', "%{$this->equip}%"))
                        ->orWhereHas('equipVisitant', fn($sub) => $sub->where('nom', 'like', "%{$this->equip}%"));
                });
            })
            ->when($this->data, function ($query) {
                $query->whereDate('data', $this->data);
            })
            ->get();
    }

    public function render()
    {
        return view('livewire.historial-partits', ['partits' => $this->partits]);
    }
}