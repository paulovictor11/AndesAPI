<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    private function mapUserType(Usuario $usuario)
    {
        $result = [];
        switch ($usuario) {
            case $usuario->administrador !== null:
                $result = [
                    'tipo' => 'administrador',
                    'data' => $usuario->administrador
                ];
                break;

            case $usuario->cliente !== null:
                $result = [
                    'tipo' => 'cliente',
                    'data' => $usuario->cliente
                ];
                break;
        }

        return $result;
    }

    public function getCredentials(Request $request)
    {
        return [
            'email' => $request->email,
            'password' => $request->password
        ];
    }

    public function login(Request $request)
    {
        $credentials = $this->getCredentials($request);

        try {
            $token = JWTAuth::attempt($credentials);
            if (!$token) {
                throw new \Exception("Credenciais Inválidas", 401);
            }

            $user = $this->mapUserType(JWTAuth::user());
            return response()->json(compact('token', 'user'), 201);
        } catch (JWTException $exception) {
            return response()->json(
                [
                    'error' => 'Não foi possível criar o token',
                    'message' => $exception->getMessage()
                ],
                500
            );
        }
    }

    public function updatePass($id, Request $request)
    {
        $user = Usuario::find($id);

        if (!$user->update(['senha' => bcrypt($request->pass)])) {
            throw new \Exception(
                'Não foi possível atualizar a senha do usuário',
                500
            );
        }

        return response()->json(
            [
                'status' => 'sucesso',
                'message' => 'Senha atualizada com sucesso'
            ],
            201
        );
    }

    public function refresh()
    {
        $token = JWTAuth::getToken();
        $token = JWTAuth::refresh($token);

        return response()->json(compact('token'), 201);
    }

    public function logout()
    {
        $token = JWTAuth::getToken();
        JWTAuth::invalidate($token);

        return response()->json(['status' => 'sucesso'], 201);
    }
}
