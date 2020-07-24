<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use App\Traits\CrudGenerator;
use App\Transformers\GeneroTransformer as Transformer;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    use CrudGenerator;

    public $model;
    public $request;
    public $transformer;

    public function __construct(
        Genero $model,
        Request $request,
        Transformer $transformer
    )
    {
        $this->model = $model;
        $this->request = $request;
        $this->transformer = $transformer;
    }
}
