<?php

namespace App\Core\Repositories;

interface MenuRepository
{
    public function getAll();

    public function find($id);

    public function getByModule($moduleId);

    public function store(array $data);

    public function update($id, array $data);

    public function delete($id);
}