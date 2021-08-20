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

    public function getAll()
    {
        return $this->model->all();
    }

    public function getWhere(array $where)
    {
        return $this->model->where($where)->get();
    }
}
