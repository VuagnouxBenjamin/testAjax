<?php

namespace App\Repository;

use App\Entity\HelloLike;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HelloLike|null find($id, $lockMode = null, $lockVersion = null)
 * @method HelloLike|null findOneBy(array $criteria, array $orderBy = null)
 * @method HelloLike[]    findAll()
 * @method HelloLike[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HelloLikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HelloLike::class);
    }

    // /**
    //  * @return HelloLike[] Returns an array of HelloLike objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HelloLike
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
