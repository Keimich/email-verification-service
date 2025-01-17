<?php

namespace App\Repositories;

use App\Models\Users;
use App\Repositories\UsersRepositoryInterface;
use Illuminate\Http\Request;

class UsersRepositoryEloquent implements UsersRepositoryInterface
{
    private $model;

    public function __construct(Users $users)
    {
        $this->model = $users;
    }

    public function get($id)
    {
        return $this->model->find($id);
    }

    public function store($data2save)
    {
        return $this->model->create($data2save);
    }

    public function update($id, Request $request)
    {
        return $this->model->find($id)->update($request->all());
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }
}
