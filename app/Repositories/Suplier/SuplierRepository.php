<?php


namespace App\Repositories\Suplier;


use App\Models\Suplier;
use App\Repositories\BaseRepository;

class SuplierRepository extends BaseRepository
{
    public function __construct(Suplier $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
}
