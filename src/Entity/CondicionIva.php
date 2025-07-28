<?php

namespace App\Entity;

use App\Repository\CondicionIvaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


#[ORM\Entity(repositoryClass: CondicionIvaRepository::class)]
#[ORM\Table(name: 'condicion_iva')] 
#[UniqueEntity(
    fields: ['codigo'], 
    message: 'El codigo de la condición IVA ya se encuentra en uso y no puede ser duplicado.')
    ]
class CondicionIva
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: Types::SMALLINT, unique: true)]
    private int $codigo;

    #[ORM\Column(type: 'string', length: 50)]
    private string $condicionIva;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 3, nullable: true)] 
    private ?string $alicuota = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCodigo(): int
    {
        return $this->codigo;
    }

    public function setCodigo(int $codigo): static
    {
        $this->codigo = $codigo;
        return $this;
    }

    public function getCondicionIva(): string 
    {
        return $this->condicionIva;
    }

    public function setCondicionIva(string $condicionIva): static
    {
        $this->condicionIva = $condicionIva;
        return $this;
    }

    public function getAlicuota(): ?string
    {
        return $this->alicuota;
    }

    public function setAlicuota(?string $alicuota): static
    {
        $this->alicuota = $alicuota;
        return $this;
    }
}