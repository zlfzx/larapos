<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    /**
     * Find by id
     * @param $id
     * @return Model|null
     */
    public function find($id): ?Model;

}
