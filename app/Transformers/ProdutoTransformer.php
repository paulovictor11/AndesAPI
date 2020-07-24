<?php

namespace App\Transformers;

use App\Models\Produto;
use League\Fractal\TransformerAbstract;

class ProdutoTransformer extends TransformerAbstract
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
    public function transform(Produto $produto)
    {
        return [
            'id' => $produto->id,
            'categoria' => $produto->categoria->nome,
            'nome' => $produto->nome,
            'descricao' => $produto->descricao,
            'quantidade' => $produto->quantidade,
            'cor' => $produto->cor,
            'genero' => $produto->genero->nome,
            'marca' => $produto->marca,
            'preco' => $produto->preco
        ];
    }
}
