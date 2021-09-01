<?php

namespace App\Repositories\Produk;

use App\Models\Produk;
use App\Repositories\BaseRepository;

class ProdukRepository extends BaseRepository
{
    public function __construct(Produk $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function datatable()
    {
        return $this->model->with([
            'foto',
            'kategori',
            'satuan'
        ]);
    }
}
