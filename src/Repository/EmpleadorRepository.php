<?php

namespace App\Repository;

use App\Entity\Empleador;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Empleador|null find($id, $lockMode = null, $lockVersion = null)
 * @method Empleador|null findOneBy(array $criteria, array $orderBy = null)
 * @method Empleador[]    findAll()
 * @method Empleador[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmpleadorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Empleador::class);
    }

    // /**
    //  * @return Empleador[] Returns an array of Empleador objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Empleador
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
