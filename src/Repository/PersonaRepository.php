<?php

namespace App\Repository;

use App\Entity\Persona;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Persona|null find($id, $lockMode = null, $lockVersion = null)
 * @method Persona|null findOneBy(array $criteria, array $orderBy = null)
 * @method Persona[]    findAll()
 * @method Persona[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Persona::class);
    }

    // /**
    //  * @return Persona[] Returns an array of Docente objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Docente
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
