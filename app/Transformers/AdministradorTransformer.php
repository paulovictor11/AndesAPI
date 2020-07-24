<?php

namespace App\Transformers;

use App\Models\Administrador;
use League\Fractal\TransformerAbstract;

class AdministradorTransformer extends TransformerAbstract
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
    public function transform(Administrador $administrador)
    {
        return [
            'id' => $administrador->id,
            'nome' => $administrador->usuario->nome,
            'email' => $administrador->usuario->email
        ];
    }
}
