<?php

namespace App\Core\Repositories;

class BaseRepository
{

    protected $model;

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function all()
    {
        return $this->model->get();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $record = $this->model->findOrFail($id);

        $record->update($data);

        return $record;
    }

    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

}