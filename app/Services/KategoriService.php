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

}
