<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Traits\CrudGenerator;
use App\Transformers\ClienteTransformer as Transformer;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    use CrudGenerator;

    public $model;
    public $request;
    public $transformer;

    public function __construct(
        Cliente $model,
        Request $request,
        Transformer $transformer
    )
    {
        $this->model = $model;
        $this->request = $request;
        $this->transformer = $transformer;
    }
}
