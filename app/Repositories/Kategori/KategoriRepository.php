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

    public function select2()
    {
        return $this->model->select('id', 'nama as text')->get();
    }

}
