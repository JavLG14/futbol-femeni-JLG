<?php
namespace App\Services;

use App\Repositories\EquipRepository;
use App\Models\Equip;
use App\Models\Partit;
use Carbon\Carbon;

class EquipService {
    public function __construct(private EquipRepository $repo) {}

    public function llistar() {
        return $this->repo->getAll();
    }

    public function trobar($id){
        return $this->repo->find($id);
    }

    public function guardar(array $data) {
        return $this->repo->create($data);
    }

    public function actualitzar($id, array $data) {
        return $this->repo->update($id, $data);
    }

    public function eliminar($id) {
        return $this->repo->delete($id);
    }

    /**
     * Calcular la edad media (en años, con decimales) de las jugadoras del equipo
     * Devuelve null si no hay jugadoras
     */
    public function edatMitjana($equipId): ?float
    {
        $equip = Equip::with('jugadores')->find($equipId);
        if (!$equip || $equip->jugadores->isEmpty()) {
            return null;
        }

        $now = Carbon::now();
        $sum = 0;
        $count = 0;
        foreach ($equip->jugadores as $jugadora) {
            if (empty($jugadora->data_naixement)) {
                continue;
            }

            try {
                $dob = Carbon::parse($jugadora->data_naixement);
            } catch (\Exception $e) {
                continue;
            }

            // Ignorar fechas de nacimiento futuras (datos erróneos)
            if ($dob->isFuture()) {
                continue;
            }

            // Calcular edad como días entre dob y ahora, dividido por 365.25
            $ageYears = $dob->diffInDays($now) / 365.25;
            $sum += $ageYears;
            $count++;
        }

        if ($count === 0) return null;
        return round($sum / $count, 1);
    }

    /**
     * Obtener los últimos partidos jugados por el equipo (hasta hoy), ordenados por fecha descendente
     * Devuelve una colección de Partit (con relaciones local, visitant y estadi)
     */
    public function ultimsPartits($equipId, $limit = 5)
    {
        return Partit::with(['local', 'visitant', 'estadi'])
            ->where(function($q) use ($equipId) {
                $q->where('local_id', $equipId)->orWhere('visitant_id', $equipId);
            })
            ->where('data', '<=', Carbon::now())
            ->orderBy('data', 'desc')
            ->limit($limit)
            ->get();
    }
}