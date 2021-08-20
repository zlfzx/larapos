<?php


namespace App\Services;


use App\Repositories\Produk\ProdukRepository;

class ProdukService
{
    /**
     * @var ProdukRepository
     */
    private $repository;

    public function __construct(ProdukRepository $repository)
    {
        $this->repository = $repository;
    }

}
