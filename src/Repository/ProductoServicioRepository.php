<?php

namespace App\Repository;

use App\Entity\ProductoServicio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductoServicio>
 */
class ProductoServicioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductoServicio::class);
    }

    /**
     * Flush action
     */
    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }

    /**
     * Crea y guarda la entidad en la base de datos.
     */
    public function create(ProductoServicio $productoServicio): void
    {
        $this->getEntityManager()->persist($productoServicio);
        $this->getEntityManager()->flush();
    }
    
    /**
     * FindAll Optimizado
     *
     * @param int $id
     * @return ProductoServicio[]
     */
    public function findAllWithRelations() : array
    {
       return $this->createQueryBuilder('ps') 
           ->addSelect('r', 'um', 'ci') 
           ->innerJoin('ps.rubro', 'r')
           ->innerJoin('ps.unidadMedida', 'um')
           ->innerJoin('ps.condicionIva', 'ci')
           ->orderBy('ps.productoServicio', 'ASC')
           ->getQuery()
           ->getResult();
    }

    public function countByTime(string $time): int
    {
        return $this->createQueryBuilder('ps')
            ->select('COUNT(ps.id)')
            ->where('ps.createdAt >= :time')
            ->setParameter('time', $time)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
