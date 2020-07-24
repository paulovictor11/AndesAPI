<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Traits\CrudGenerator;
use App\Transformers\CategoriaTransformer as Transformer;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    use CrudGenerator;

    public $model;
    public $request;
    public $transformer;

    public function __construct(
        Categoria $model,
        Request $request,
        Transformer $transformer
    )
    {
        $this->model = $model;
        $this->request = $request;
        $this->transformer = $transformer;
    }
}
