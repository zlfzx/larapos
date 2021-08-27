<?php


namespace App\Services;


use App\Repositories\Suplier\SuplierRepository;

class SuplierService extends BaseService
{
    /**
     * @var SuplierRepository
     */
    private $repository;

    public function __construct(SuplierRepository $repository)
    {
        parent::__construct($repository);
        $this->repository = $repository;
    }

}
