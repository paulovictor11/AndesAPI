<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Traits\CrudGenerator;
use App\Transformers\ProdutoTransformer as Transformer;
use Illuminate\Http\Request;
use App\Services\ProdutoService;

class ProdutoController extends Controller
{
    use CrudGenerator;

    public $model;
    public $request;
    public $transformer;

    public function __construct(
        Produto $model,
        Request $request,
        Transformer $transformer
    )
    {
        $this->model = $model;
        $this->request = $request;
        $this->transformer = $transformer;
    }

    public function list()
    {
        $service = new ProdutoService($this->model);

        return fractal(
            $service->getAll(),
            new Transformer()
        )->respond();
    }

    public function listById($id)
    {
        $service = new ProdutoService($this->model);

        return fractal(
            $service->getById($id),
            new Transformer()
        )->respond();
    }
}
