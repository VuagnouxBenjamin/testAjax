<?php

namespace App\Repository;

use App\Entity\ByeLikes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ByeLikes|null find($id, $lockMode = null, $lockVersion = null)
 * @method ByeLikes|null findOneBy(array $criteria, array $orderBy = null)
 * @method ByeLikes[]    findAll()
 * @method ByeLikes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ByeLikesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ByeLikes::class);
    }

    // /**
    //  * @return ByeLikes[] Returns an array of ByeLikes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ByeLikes
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
