<?php

namespace App\Implement;

use App\Repositories\UserRepository;
use App\Models\User;

class UserRepositoryImplement implements UserRepository
{

    public function all()
    {
        return User::with('kelompokUser')->get();
    }

    public function find($id)
    {
        return User::with('kelompokUser')->findOrFail($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update($id,array $data)
    {

        $user = User::findOrFail($id);

        $user->update($data);

        return $user;
    }

    public function delete($id)
    {
        return User::findOrFail($id)->delete();
    }

}