<?php

namespace App\Repositories;
use Illuminate\Http\Request;

interface UsersRepositoryInterface
{
    public function get($id);
    public function store($data2save);
    public function update($id, Request $request);
    public function destroy($id);
}
