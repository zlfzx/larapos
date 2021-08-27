<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface RepositoryInterface
{
    /**
     * @return mixed
     */
    public function query();

    /**
     * Find by id
     * @param $id
     * @return Model|null
     */
    public function find($id): ?Model;

    /**
     * Get all data
     * @return Model|null
     */
    public function getAll(): ?Collection;

    /**
     * Get data with condition
     * @param array $where
     * @return Collection|null
     */
    public function getWhere(array $where): ?Collection;

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param array $data
     * @param int $id
     * @return Model
     */
    public function update(array $data, int $id): Model;

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id);
}
