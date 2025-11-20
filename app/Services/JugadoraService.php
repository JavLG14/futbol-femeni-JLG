<?php

namespace App\Services;

use App\Repositories\JugadoraRepository;

class JugadoraService
{
    protected $repository;

    public function __construct(JugadoraRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllJugadores()
    {
        return $this->repository->getAll();
    }

    public function getJugadora($id)
    {
        return $this->repository->find($id);
    }

    public function createJugadora(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateJugadora($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteJugadora($id)
    {
        return $this->repository->delete($id);
    }
}
