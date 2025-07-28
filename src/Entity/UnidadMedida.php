<?php

namespace App\Entity;

use App\Repository\UnidadMedidaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UnidadMedidaRepository::class)]
#[UniqueEntity(
    fields: ['codigo'], 
    message: 'El código de unidad medida ya se encuentra en uso y no puede ser duplicado.')
    ]
class UnidadMedida
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: 'string', length: 5, unique: true)]
    private string $codigo;

    #[ORM\Column(type: 'string', length: 50)]
    private string $unidadMedida;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getCodigo(): string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): static
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getUnidadMedida(): string
    {
        return $this->unidadMedida;
    }

    public function setUnidadMedida(string $unidadMedida): static
    {
        $this->unidadMedida = $unidadMedida;

        return $this;
    }
}
