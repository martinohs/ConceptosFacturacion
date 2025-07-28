<?php

namespace App\Dto;

use App\Entity\CondicionIva;
use App\Entity\Rubro;
use App\Entity\UnidadMedida;
use App\Enum\TipoProductoServicio;
use Symfony\Component\Validator\Constraints as Assert;

class ProductoServicioDto
{
    #[Assert\Regex(
        pattern: '/^[a-zA-Z0-9]+$/',
        message: 'El código debe ser alfanumérico. Sin caracteres especiales.'
    )]
    #[Assert\Length(max: 20)]
    #[Assert\NotBlank(message: 'El código es obligatorio.')]
    public string $codigo;

    #[Assert\Length(max: 255)]
    #[Assert\NotBlank(message: 'El Producto / Servicio es obligatorio.')]
    public string $productoServicio;
   
    #[Assert\Regex(
        pattern: '/^\d{1,28}\.\d{1,2}$/',
        message: 'El precio bruto puede tener hasta 28 dígitos enteros, un separador decimal (punto) y exactamente 2 decimales. Ej: 1234.12, 1234567890.12'
    )]
    public ?string $precioBrutoUnitario = null;

    #[Assert\Choice(callback: [\App\Enum\TipoProductoServicio::class, 'cases'])]
    public ?TipoProductoServicio $tipo = null;

    #[Assert\NotBlank]
    public CondicionIva $condicionIva;

    #[Assert\NotBlank]
    public Rubro $rubro;

    #[Assert\NotBlank]
    public UnidadMedida $unidadMedida;
}