<?php

namespace App\Entity;

use App\Repository\ProductoServicioRepository;
use App\Enum\TipoProductoServicio;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductoServicioRepository::class)]
#[UniqueEntity('codigo')]
class ProductoServicio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id ;

    #[ORM\ManyToOne(targetEntity: Rubro::class)]
    #[ORM\JoinColumn(name: "id_rubro", referencedColumnName: "id", nullable: false)]
    private Rubro $rubro;

    #[ORM\Column(length:1, type: 'string', enumType: TipoProductoServicio::class, nullable: true)]
    private ?TipoProductoServicio $tipo = null;

    #[ORM\ManyToOne(targetEntity: UnidadMedida::class)]
    #[ORM\JoinColumn(name: "id_unidad_medida", referencedColumnName: "id", nullable: false)]
    private UnidadMedida $unidadMedida; 

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    #[Assert\Unique()]
    #[Assert\NotNull()]
    private ?string $codigo = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $productoServicio = null;

    #[ORM\ManyToOne(targetEntity: CondicionIva::class)]
    #[ORM\JoinColumn(name: "id_condicion_iva", referencedColumnName: "id", nullable: false)]
    private CondicionIva $condicionIva;

    #[ORM\Column(type: Types::DECIMAL, precision: 30, scale: 2, nullable: true)]
    private ?string $precioBrutoUnitario = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE,  nullable: true )]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRubro(): Rubro
    {
        return $this->rubro;
    }

    public function setRubro(Rubro $rubro): static
    {
        $this->rubro = $rubro;

        return $this;
    }

    public function getTipo(): ?TipoProductoServicio
    {
        return $this->tipo;
    }

    public function setTipo(?TipoProductoServicio $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getUnidadMedida(): UnidadMedida
    {
        return $this->unidadMedida;
    }

    public function setUnidadMedida(UnidadMedida $unidadMedida): static
    {
        $this->unidadMedida = $unidadMedida;

        return $this;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(?string $codigo): static
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getProductoServicio(): ?string
    {
        return $this->productoServicio;
    }

    public function setProductoServicio(?string $productoServicio): static
    {
        $this->productoServicio = $productoServicio;

        return $this;
    }

    public function getCondicionIva(): CondicionIva
    {
        return $this->condicionIva;
    }

    public function setCondicionIva(CondicionIva $condicionIva): static
    {
        $this->condicionIva = $condicionIva;

        return $this;
    }

    public function getPrecioBrutoUnitario(): ?string
    {
        return $this->precioBrutoUnitario;
    }

    public function setPrecioBrutoUnitario(?string $precioBrutoUnitario): static
    {
        $this->precioBrutoUnitario = $precioBrutoUnitario;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
