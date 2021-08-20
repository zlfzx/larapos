<?php


namespace App\Services;


use App\Repositories\Produk\ProdukFotoRepository;

class ProdukFotoService
{
    /**
     * @var ProdukFotoRepository
     */
    private $repository;

    public function __construct(ProdukFotoRepository $repository)
    {
        $this->repository = $repository;
    }

}
