<?php

namespace App\Core\Repositories;

interface UserMenuRepository
{
    public function getAll();

    public function getByUser($userId);

    public function find($id);

    public function store(array $data);

    public function update($id, array $data);

    public function delete($id);
}