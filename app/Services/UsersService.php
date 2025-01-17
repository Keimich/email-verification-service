<?php

namespace App\Services;

use App\Models\ValidationUsers;
use App\Repositories\UsersRepositoryInterface;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersService
{
    private $usersRepository;

    public function __construct(UsersRepositoryInterface $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function get($id)
    {
        try {
            $user = $this->usersRepository->get($id);
            if (!empty($user)) return response()->json($user, Response::HTTP_OK);
            else return response()->json(null, Response::HTTP_OK);
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Erro de conexao com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ValidationUsers::RULE_LEADS);
        if ($validator->fails()) return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);

        try {
            $data2save = $request->all();
            $data2save['ip_address'] = $_SERVER['REMOTE_ADDR'];
            $data2save['user_agent'] = $_SERVER['HTTP_USER_AGENT'] ?? null;

            $user = $this->usersRepository->store($data2save);
            return response()->json($user, Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Erro de conexao com o banco de dados', 'message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), ValidationUsers::RULE_USERS);
        if ($validator->fails()) return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);

        try {
            $user = $this->usersRepository->update($id, $request);
            return response()->json($user, Response::HTTP_OK);
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Erro de conexao com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $this->usersRepository->destroy($id);
            return response()->json(null, Response::HTTP_OK);
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Erro de conexao com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
