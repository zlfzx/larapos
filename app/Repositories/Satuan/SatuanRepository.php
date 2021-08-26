<?php

namespace App\Repositories\Satuan;

use App\Models\Satuan;
use App\Repositories\BaseRepository;

class SatuanRepository extends BaseRepository
{
    public function __construct(Satuan $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function query()
    {
        return $this->model->query();
    }
}
