<?php

namespace App\Core\Services;

use App\Core\Repositories\UserMenuRepository;

class UserMenuService
{

    protected $repository;

    public function __construct(UserMenuRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list()
    {
        return $this->repository->getAll();
    }

    public function listByUser($userId)
    {
        return $this->repository->getByUser($userId);
    }

    public function detail($id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        return $this->repository->store($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id,$data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}