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

    public function getAll()
    {
        return $this->model->all();
    }

    public function getWhere(array $where)
    {
        return $this->model->where($where)->get();
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update(array $data, int $id)
    {
        $kategori = $this->find($id);
        if ($kategori != null) {
            $kategori->update($data);
        }

        return $kategori;
    }

    public function destroy(int $id)
    {
        return $this->model->destroy($id);
    }
}
