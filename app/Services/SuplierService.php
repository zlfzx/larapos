<?php


namespace App\Services;


use App\Repositories\Suplier\SuplierRepository;

class SuplierService
{
    /**
     * @var SuplierRepository
     */
    private $repository;

    public function __construct(SuplierRepository $repository)
    {
        $this->repository = $repository;
    }

}
