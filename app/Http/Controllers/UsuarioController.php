<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Traits\CrudGenerator;
use App\Transformers\UsuarioTransformer as Transformer;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    use CrudGenerator;

    public $model;
    public $request;
    public $transformer;

    public function __construct(
        Usuario $model,
        Request $request,
        Transformer $transformer
    )
    {
        $this->model = $model;
        $this->request = $request;
        $this->transformer = $transformer;
    }
}
