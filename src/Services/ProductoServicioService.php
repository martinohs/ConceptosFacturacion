<?php

namespace App\Services;

use App\Dto\ProductoServicioDto;
use App\Entity\ProductoServicio;
use App\Mapper\ProductoServicioMapper;
use App\Repository\ProductoServicioRepository;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;

class ProductoServicioService
{
    private ProductoServicioRepository $repository;
    private readonly ProductoServicioMapper $mapper;
    private readonly CondicionIvaService $condicionIvaService;
    private readonly RubroService $rubroService;
    private readonly UnidadMedidaService $unidadMedidaService;

    public function __construct(
        ProductoServicioRepository $repository,
        ProductoServicioMapper $mapper,
        CondicionIvaService $condicionIvaService,
        RubroService $rubroService,
        UnidadMedidaService $unidadMedidaService
        )
    {
        $this->repository = $repository;
        $this->mapper = $mapper;
        $this->condicionIvaService = $condicionIvaService;
        $this->rubroService = $rubroService;
        $this->unidadMedidaService = $unidadMedidaService;
    }

    /**
     * Mappea una entidad ProductoServicio auna DTO ProductoServicio
     */
    public function entityToDto(ProductoServicio $productoServicio): ProductoServicioDto
    {
        return $this->mapper->mapEntityToDto($productoServicio);
    }
    /**
     * Mappea una DTO ProductoServicio a una entidad ProductoServicio
     */
    public function dtoToEntity(ProductoServicioDto $productoServicioDto): ProductoServicio
    {
        return $this->mapper->mapDtoToEntity($productoServicioDto);
    }
    
    /**
     * Busca un producto/servicio por su codigo
     */
    public function findOneByCodigo(string $codigo): ProductoServicio
    {   
        return $this->repository->findOneBy(['codigo' => $codigo]);
    }

   /**
     * Crea un producto/servicio a partir de una DTO
     */
    public function createFromDto(ProductoServicioDto $productoServicioDto): ProductoServicio
    {
        $exist = $this->repository->findOneBy(['codigo' => $productoServicioDto->codigo]);
        if($exist) {
            throw new InvalidArgumentException('El código del producto/servicio ya existe.');
        }
        $this->validateAsociations($productoServicioDto);
        $productoServicioEntity = $this->dtoToEntity($productoServicioDto);

        $this->repository->create($productoServicioEntity);
        
        return $productoServicioEntity;
    }

    /**
    * Actualiza un producto/servicio a partir de la entidad y su DTO
    */
    public function updateFromDto(ProductoServicio $productoServicio, ProductoServicioDto $productoServicioDto): ProductoServicio
    {
        if ($productoServicio->getCodigo() !== $productoServicioDto->codigo) {
            $exist = $this->repository->findOneBy(['codigo' => $productoServicioDto->codigo]);
            if($exist) {
                throw new InvalidArgumentException('El código del producto/servicio ya existe.');
            }
        }
        $this->validateAsociations($productoServicioDto);

        $productoServicio = $this->mapper->updateFromDto($productoServicio, $productoServicioDto);

        $this->repository->flush($productoServicio);
        
        return $productoServicio;
    }
    
    /**
    * Devuelve todos los los productos/servicios y sus relaciones.
    */
    public function findAll(): array
    {
        return $this->repository->findAllWithRelations();
    }

    /**
     * Funcion auxiliar para validar que las asociaciones existan
     */
    private function validateAsociations(ProductoServicioDto $productoServicioDto): void
    {
        //Verifico que las asociaciones existan
        $checkUnidadMedida = $this->unidadMedidaService->findOneById($productoServicioDto->unidadMedida->getId());
        if (!$checkUnidadMedida) {
            throw new InvalidArgumentException('La unidad de medida no existe.');
        }

        $checkRubro = $this->rubroService->findOneById($productoServicioDto->rubro->getId());
        if (!$checkRubro) {
            throw new InvalidArgumentException('El rubro no existe.');
        }

        $checkCondicionIva = $this->condicionIvaService->findOneById($productoServicioDto->condicionIva->getId());
        if (!$checkCondicionIva) {
            throw new InvalidArgumentException('La condición de IVA no existe.');
        }   
    }

    //>>: En caso de que quiera implementarse una baja, lo mas recomendado es por soft delete (agregar una columna activo: true o false)
    // private function gestionarBaja(ProductoServicio $productoServicio): void
    // {
    //     $productoServicio->setActivo(false);
    //     $this->repository->flush($productoServicio);  
    // }
}   