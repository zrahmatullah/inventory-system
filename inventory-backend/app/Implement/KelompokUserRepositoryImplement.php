<?php

namespace App\Implement;

use App\Repositories\KelompokUserRepository;
use App\Models\KelompokUser;

class KelompokUserRepositoryImplement implements KelompokUserRepository
{

    public function all()
    {
        return KelompokUser::all();
    }

    public function find($id)
    {
        return KelompokUser::findOrFail($id);
    }

    public function create(array $data)
    {
        return KelompokUser::create($data);
    }

    public function update($id, array $data)
    {
        $model = KelompokUser::findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        return KelompokUser::findOrFail($id)->delete();
    }
}