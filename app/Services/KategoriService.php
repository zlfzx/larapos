<?php


namespace App\Services;


use App\Repositories\Kategori\KategoriRepository;

class KategoriService
{
    /**
     * @var KategoriRepository
     */
    private $repository;

    public function __construct(KategoriRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function create (array $data)
    {
        return $this->repository->create($data);
    }

    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    public function update(array $data, int $id)
    {
        return $this->repository->update($data, $id);
    }

    public function delete(int $id)
    {
        return $this->repository->destroy($id);
    }
}
