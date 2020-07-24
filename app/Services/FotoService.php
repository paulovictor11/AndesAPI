<?php

namespace App\Services;

use App\Models\Fotos;

class FotoService
{
    private $model;

    public function __construct(Fotos $model)
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