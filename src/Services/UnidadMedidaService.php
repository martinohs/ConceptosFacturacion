<?php

namespace App\Services;

use App\Entity\UnidadMedida;
use App\Repository\UnidadMedidaRepository;

class UnidadMedidaService
{

    private UnidadMedidaRepository $repository;
    public function __construct(
        UnidadMedidaRepository $repository
        )
    {
        $this->repository = $repository;
    }

    /**
     * @return UnidadMedida
     */
    public function findOneById(int $id): UnidadMedida
    {   
        return $this->repository->findOneBy(['id' => $id]);
    }

    /**
     * @return UnidadMedida
     */
    public function findOneByCodigo(int $codigo): UnidadMedida
    {   
        return $this->repository->findOneBy(['codigo' => $codigo]);
    }

}