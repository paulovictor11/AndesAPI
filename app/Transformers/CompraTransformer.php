<?php

namespace App\Transformers;

use App\Models\Compra;
use League\Fractal\TransformerAbstract;

class CompraTransformer extends TransformerAbstract
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
    public function transform(Compra $compra)
    {
        return [
            'id' => id,
            'cliente' => $compra->cliente->usuario->nome,
            'produto' => $compra->produto->nome,
        ];
    }
}
