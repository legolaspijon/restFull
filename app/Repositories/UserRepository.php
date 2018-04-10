<?php

namespace App\Repositories;

use App\User;
use Illuminate\Database\Query\Expression;

class UserRepository
{
    /**
     * @var \Illuminate\Database\Eloquent\Builder
     */
    public $model;

    public function __construct(User $user)
    {
        $this->model = $user->newQuery();
    }

    /**
     * @param $q
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function search($q)
    {
        return $this->model
            ->orWhere('email', '=', (string) $q)
            ->orWhere('description', 'like', "%$q%")
            ->orWhere(new Expression('CAST(status AS CHAR)'), '=', $q)
            ->get();
    }

    /**
     * @param $dara
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public function create($dara)
    {
        return $this->model->create($dara);
    }

    /**
     * @param $data
     * @param User $user
     * @return bool
     */
    public function update($data, User $user)
    {
        return $user->update($data);
    }

    /**
     * @param User $user
     * @return bool|null
     * @throws \Exception
     */
    public function delete(User $user)
    {
        return $user->delete();
    }

    /**
     * Get all Users
     * @return mixed
     */
    public function all()
    {
        return $this->model->get()->all();
    }
}