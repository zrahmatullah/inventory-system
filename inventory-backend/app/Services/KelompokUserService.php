<?php

namespace App\Services;

use App\Repositories\KelompokUserRepository;

class KelompokUserService
{

    protected $repository;

    public function __construct(KelompokUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list()
    {
        return $this->repository->all();
    }

    public function detail($id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($id,array $data)
    {
        return $this->repository->update($id,$data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

}