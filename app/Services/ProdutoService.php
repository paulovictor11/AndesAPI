<?php

namespace App\Services;

use App\Models\Produto;

class ProdutoService
{
    private $model;

    public function __construct(Produto $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function getById(int $id)
    {
        return $this->mdoel->find($id);
    }
}