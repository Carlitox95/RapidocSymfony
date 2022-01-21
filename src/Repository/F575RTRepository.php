<?php

namespace App\Repository;

use App\Entity\F575RT;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method F575RT|null find($id, $lockMode = null, $lockVersion = null)
 * @method F575RT|null findOneBy(array $criteria, array $orderBy = null)
 * @method F575RT[]    findAll()
 * @method F575RT[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class F575RTRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, F575RT::class);
    }

    // /**
    //  * @return F575RT[] Returns an array of F575RT objects
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
    public function findOneBySomeField($value): ?F575RT
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
