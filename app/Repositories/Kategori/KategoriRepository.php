<?php

namespace App\Repositories\Kategori;

use App\Models\Kategori;
use App\Repositories\BaseRepository;

class KategoriRepository extends BaseRepository
{
    public function __construct(Kategori $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }
}
