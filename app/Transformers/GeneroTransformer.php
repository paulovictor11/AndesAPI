<?php

namespace App\Transformers;

use App\Models\Genero;
use League\Fractal\TransformerAbstract;

class GeneroTransformer extends TransformerAbstract
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
    public function transform(Genero $genero)
    {
        return [
            'id' => $genero->id,
            'nome' => $genero->nome,
            'sigla' => $genero->sigla
        ];
    }
}
