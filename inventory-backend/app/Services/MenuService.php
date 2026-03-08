<?php

namespace App\Core\Services;

use App\Core\Repositories\MenuRepository;

class MenuService
{

    protected $repository;

    public function __construct(MenuRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list()
    {
        return $this->repository->getAll();
    }

    public function detail($id)
    {
        return $this->repository->find($id);
    }

    public function listByModule($moduleId)
    {
        return $this->repository->getByModule($moduleId);
    }

    public function create(array $data)
    {
        return $this->repository->store($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}