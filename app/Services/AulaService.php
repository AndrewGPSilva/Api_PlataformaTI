<?php

namespace App\Services;

use App\Repositories\AulaRepository;

class AulaService
{
    protected $repository;

    public function __construct(AulaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function create($dados)
    {
        return $this->repository->create($dados);
    }

    public function update($dados, $id)
    {
        return $this->repository->update($dados, $id);
    }

    public function getById($id)
    {
        return $this->repository->getById($id);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
