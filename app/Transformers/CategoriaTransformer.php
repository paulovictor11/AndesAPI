<?php

namespace App\Transformers;

use App\Models\Categoria;
use League\Fractal\TransformerAbstract;

class CategoriaTransformer extends TransformerAbstract
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
    public function transform(Categoria $categoria)
    {
        return [
            'id' => $categoria->id,
            'nome' => $categoria->nome
        ];
    }
}
