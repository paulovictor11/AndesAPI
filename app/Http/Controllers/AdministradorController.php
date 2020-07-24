<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Traits\CrudGenerator;
use App\Transformers\AdministradorTransformer as Transformer;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    use CrudGenerator;

    public $model;
    public $request;
    public $transformer;

    public function __construct(
        Administrador $model,
        Request $request,
        Transformer $transformer
    )
    {
        $this->model = $model;
        $this->request = $request;
        $this->transformer = $transformer;
    }
}
