<?php

namespace App\Services;

use App\Entity\CondicionIva;
use App\Repository\CondicionIvaRepository;
use Doctrine\ORM\EntityManagerInterface;


class CondicionIvaService
{

    private CondicionIvaRepository $repository;

    public function __construct(
            CondicionIvaRepository $repository,
        )
    {
            $this->repository = $repository;
    }
    
    /**
     * @return CondicionIva
     */
    public function findOneById(int $id): CondicionIva
    {   
        return $this->repository->findOneBy(['id' => $id]);
    }

    /**
     * @return CondicionIva
     */
    public function findOneByCodigo(int $codigo): CondicionIva
    {   
        return $this->repository->findOneBy(['codigo' => $codigo]);
    }

    /**
     * @return CondicionIva
     */
    // public function createFromDto(CreateCondicionIvaDto $condicionIvaDto): CondicionIva
    // {
    // }
}