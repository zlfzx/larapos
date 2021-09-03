<?php


namespace App\Services;


use App\Repositories\Produk\ProdukFotoRepository;

class ProdukFotoService extends BaseService
{
    /**
     * @var ProdukFotoRepository
     */
    private $repository;

    public function __construct(ProdukFotoRepository $repository)
    {
        parent::__construct($repository);
        $this->repository = $repository;
    }

    public function datatable($produkId)
    {
        return $this->repository->datatable($produkId);
    }

}
