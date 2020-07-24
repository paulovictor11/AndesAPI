<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Traits\CrudGenerator;
use App\Transformers\CompraTransformer as Transformer;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    use CrudGenerator;

    public $model;
    public $request;
    public $transformer;

    public function __construct(
        Compra $model,
        Request $request,
        Transformer $transformer
    )
    {
        $this->model = $model;
        $this->request = $request;
        $this->transformer = $transformer;
    }
}
