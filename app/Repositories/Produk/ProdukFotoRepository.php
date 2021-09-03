<?php

namespace App\Repositories\Produk;

use App\Models\ProdukFoto;
use App\Repositories\BaseRepository;

class ProdukFotoRepository extends BaseRepository
{
    public function __construct(ProdukFoto $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function datatable($produkId)
    {
        return $this->model->where('produk_id', $produkId);
    }
}
