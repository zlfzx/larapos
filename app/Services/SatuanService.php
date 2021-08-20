<?php


namespace App\Services;


use App\Repositories\Satuan\SatuanRepository;

class SatuanService
{
    /**
     * @var SatuanRepository
     */
    private $repository;

    public function __construct(SatuanRepository $repository)
    {
        $this->repository = $repository;
    }

}
