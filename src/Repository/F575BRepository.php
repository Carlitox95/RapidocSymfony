<?php

namespace App\Repository;

use App\Entity\F575B;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method F575B|null find($id, $lockMode = null, $lockVersion = null)
 * @method F575B|null findOneBy(array $criteria, array $orderBy = null)
 * @method F575B[]    findAll()
 * @method F575B[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class F575BRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, F575B::class);
    }

    // /**
    //  * @return F575B[] Returns an array of F575B objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?F575B
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
