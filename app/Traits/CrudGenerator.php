<?php

namespace App\Traits;

use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

trait CrudGenerator
{
    public function index(Request $request): JsonResponse
    {
        if ($request->method() == 'POST') {
            return $this->store($request->all());
        }

        return $this->all();
    }

    public function detail(Request $request, string $id): JsonResponse
    {
        switch ($request->method()) {
            case 'PUT':
                return $this->update($request->all(), $id);
                break;

            case 'DELETE':
                return $this->destroy($id);
                break;
            
            default:
                return $this->show($id);
                break;
        }
    }

    public function all(): JsonResponse
    {
        try {
            return fractal(
                $this->model->get(),
                $this->transformer
            )->respond();
        } catch (\Exception $exception) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $exception->getMessage()
                ]
            );
        }
    }

    public function store(array $request) {
        try {
            if (Arr::has($request, ['nome', 'email', 'senha'])) {
                $user = $this->checaUsuario($request);

                if ($user !== null) {
                    $data = [
                        'status' => 'error',
                        'message' => 'Usuário já cadastrado'
                    ];

                    return response()->json($data, 500);
                }

                $usuario = $this->criaUsuario($request);
                $request['usuario_id'] = $usuario->id;
            }

            $instance = $this->model->create($request);

            $data = [
                'status' => 'created',
                'message' => $this->model->getTable() . ' cadastrado com sucesso',
                'data' => $instance
            ];

            return response()->json($data, 201);
        } catch (\Exception $exception) {
            $data = [
                'status' => 'error',
                'message' => $exception->getMessage()
            ];

            return response()->json($data, 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $model = $this->modelById($id);

            if (!$model instanceof $this->model) {
                $data = [
                    'status' => 'not found',
                    'message' => 'Objeto não encontrado'
                ];

                return response()->json($data, 204);
            }

            return fractal($model, $this->transformer)->respond();
        } catch(\Exception $exception) {
            $data = [
                'status' => 'error',
                'message' => $exception->getMessage(),
                'more' => $exception->getTrace()
            ];

            return response()->json($data, 404);
        }
    }

    public function update(array $request, string $id): JsonResponse
    {
        try {
            $model = $this->modelById($id);

            if ($model->usuario !== null) {
                $this->atualizaUsuario($request, $id);
            }

            foreach ($model->getAttributes() as $key => $value) {
                $dados[$key] = $request[$key] ?? $value;
            }

            $model->update($dados);

            $data = [
                'status' => 'edited',
                'message' => $this->model->getTable() . ' editado com sucesso',
                $this->model->getTable() => $model
            ];

            return response()->json($data, 201);
        } catch (\Exception $exception) {
            $data = [
                'status' => 'error',
                'message' => $exception->getMessage()
            ];

            return response()->json($data, 500);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $model = $this->modelById($id);

            if (!is_null($model->delete())) {
                return response()->json(
                    [
                        'status' => 'deleted',
                        'message' => 'Data deleted'
                    ],
                    204
                );
            }
        } catch (\Exception $exception) {
            $data = [
                'status' => 'error',
                'message' => $exception->getMessage()
            ];

            return response()->json($data, 404);
        }
    }

    private function criaUsuario(array $data)
    {
        $usuario = new Usuario();
        $data['senha'] = bcrypt($data['senha']);

        return $usuario->create($data);
    }

    private function atualizaUsuario(array $request, string $id)
    {
        $model = $this->modelById($id);
        $usuario = Usuario::find($model->usuario_id);

        $senha = bcrypt($request['senha']);

        $data = [
            'nome' => $request['nome'] ?? $usuario->nome,
            'email' => $request['email'] ?? $usuario->email,
            'senha' => $senha ?? $usuario->senha
        ];

        $usuario->update($data);
    }

    private function checaUsuario(array $request)
    {
        return Usuario::where('email', $request['email'])->first();
    }

    private function modelById(string $id): Object
    {
        try {
            return $this->model->where('id', $id)->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $exception->getMessage()
                ],
                404
            );
        }
    }
}
