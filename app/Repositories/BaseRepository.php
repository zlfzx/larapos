<?php


namespace App\Repositories;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function query()
    {
        return $this->model->query();
    }

    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    public function getAll(): ?Collection
    {
        return $this->model->all();
    }

    public function getWhere(array $where): ?Collection
    {
        return $this->model->where($where)->get();
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function update(array $data, int $id): Model
    {
        $model = $this->find($id);
        if ($model != null) {
            $model->update($data);
        }

        return $model;
    }

    public function destroy(int $id)
    {
        return $this->model->destroy($id);
    }
}
