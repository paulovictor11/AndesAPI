<?php

namespace App\Transformers;

use App\Models\Cliente;
use League\Fractal\TransformerAbstract;

class ClienteTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Cliente $cliente)
    {
        return [
            'id' => $cliente->id,
            'nome' => $cliente->usuario->nome,
            'email' => $cliente->usuario->email,
            'cpf' => $cliente->cpf,
            'telefone' => $cliente->telefone,
            'cep' => $cliente->cep,
            'rua' => $cliente->rua,
            'bairro' => $cliente->bairro,
            'numero' => $cliente->numero,
            'cidade' => $cliente->cidade,
            'estado' => $cliente->estado
        ];
    }
}
