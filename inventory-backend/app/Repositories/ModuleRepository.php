<?php

namespace App\Core\Repositories;

interface ModuleRepository
{
    public function getAll();

    public function find($id);

    public function store(array $data);

    public function update($id, array $data);

    public function delete($id);
}