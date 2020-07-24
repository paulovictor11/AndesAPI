<?php

namespace App\Http\Controllers;

use App\Models\Fotos;
use App\Traits\CrudGenerator;
use App\Transformers\FotosTransformer as Transformer;
use Illuminate\Http\Request;
use App\Services\FotoService;

class FotoController extends Controller
{
    use CrudGenerator;

    public $model;
    public $request;
    public $transformer;

    public function __construct(
        Fotos $model,
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
        $service = new FotoService($this->model);

        return fractal(
            $service->getAll(),
            new Transformer()
        )->respond();
    }

    public function listById($id)
    {
        $service = new FotoService($this->model);

        return fractal(
            $service->getById($id),
            new Transformer()
        )->respond();
    }
}
