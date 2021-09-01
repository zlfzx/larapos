<?php


namespace App\Services;


use App\Repositories\Produk\ProdukRepository;

class ProdukService extends BaseService
{
    /**
     * @var ProdukRepository
     */
    private $repository;

    public function __construct(ProdukRepository $repository)
    {
        parent::__construct($repository);
        $this->repository = $repository;
    }

    public function datatable()
    {
        return $this->repository->datatable();
    }

}
