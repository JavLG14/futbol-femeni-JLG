<?php

namespace App\Services;

use App\Repositories\PartitRepository;
use App\Models\Equip;
use App\Models\Estadi;

class PartitService
{
    private $repo;

    public function __construct(PartitRepository $repo)
    {
        $this->repo = $repo;
    }

    // Obtener todos los partidos
    public function getAll()
    {
        return $this->repo->getAll();
    }

    // Obtener un partido concreto
    public function find($id)
    {
        return $this->repo->find($id);
    }

    // Crear un partido
    public function create(array $data)
    {
        return $this->repo->create($data);
    }

    // Actualizar un partido
    public function update($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    // Eliminar un partido
    public function delete($id)
    {
        return $this->repo->delete($id);
    }

    // Obtener equipos para los selects del formulario
    public function getEquips()
    {
        return Equip::orderBy('nom')->get();
    }

    // Obtener estadios para los selects del formulario
    public function getEstadis()
    {
        return Estadi::orderBy('nom')->get();
    }
}
