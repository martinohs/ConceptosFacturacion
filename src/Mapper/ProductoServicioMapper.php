<?php

namespace App\Mapper;

use App\Entity\ProductoServicio;
use App\Dto\ProductoServicioDto;

class ProductoServicioMapper
{
    /**
     * Mapea una DTO ProductoServicio a una entidad ProductoServicio
     */
    public function mapDtoToEntity(ProductoServicioDto $dto): ProductoServicio
    {
        $entity = new ProductoServicio();
        $entity->setCodigo($dto->codigo);
        $entity->setPrecioBrutoUnitario($dto->precioBrutoUnitario);
        $entity->setProductoServicio($dto->productoServicio);
        $entity->setTipo($dto->tipo);
        $entity->setCondicionIva($dto->condicionIva);
        $entity->setRubro($dto->rubro);
        $entity->setUnidadMedida($dto->unidadMedida);

        return $entity;
    }

    /**
     * Mapea una entidad ProductoServicio a una DTO ProductoServicio
     */
    public function mapEntityToDto(ProductoServicio $productoServicio): ProductoServicioDto
    {
        $dto = new ProductoServicioDto();
        $dto->codigo = $productoServicio->getCodigo();
        $dto->precioBrutoUnitario = $productoServicio->getPrecioBrutoUnitario();
        $dto->productoServicio = $productoServicio->getProductoServicio();
        $dto->tipo = $productoServicio->getTipo();
        $dto->condicionIva = $productoServicio->getCondicionIva();
        $dto->rubro = $productoServicio->getRubro();
        $dto->unidadMedida = $productoServicio->getUnidadMedida();

        return $dto;
    }

    /**
     * Actualiza la entidad producto/servicio a partir de la DTO 
     */
    public function updateFromDto(ProductoServicio $productoServicio, ProductoServicioDto $dto): ProductoServicio
    {
        $productoServicio->setCodigo($dto->codigo);
        $productoServicio->setPrecioBrutoUnitario($dto->precioBrutoUnitario);
        $productoServicio->setProductoServicio($dto->productoServicio);
        $productoServicio->setTipo($dto->tipo);
        $productoServicio->setCondicionIva($dto->condicionIva);
        $productoServicio->setRubro($dto->rubro);
        $productoServicio->setUnidadMedida($dto->unidadMedida);
        return $productoServicio;
    }
}