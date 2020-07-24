<?php

namespace App\Transformers;

use App\Models\Fotos;
use League\Fractal\TransformerAbstract;

class FotosTransformer extends TransformerAbstract
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
    public function transform(Fotos $foto)
    {
        return [
            'id' => $foto->id,
            'produto' => $foto->produto->nome,
            'foto' => $foto->foto
        ];
    }
}
