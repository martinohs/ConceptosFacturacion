<?php

namespace App\Services;

use App\Entity\Rubro;
use App\Repository\RubroRepository;

class RubroService
{

    private RubroRepository $repository;
    public function __construct(
        RubroRepository $repository
        )
    {
        $this->repository = $repository;
    }

    /**
     * @return Rubro
     */
    public function findOneById(int $id): Rubro
    {   
        return $this->repository->findOneBy(['id' => $id]);
    }
    
    /**
     * @return Rubro
     */
    public function findOneByCodigo(int $codigo): Rubro
    {   
        return $this->repository->findOneBy(['codigo' => $codigo]);
    }
    
}