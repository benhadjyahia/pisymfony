<?php

namespace App\Repository;

use App\Entity\Category2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Category2|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category2|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category2[]    findAll()
 * @method Category2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Category2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category2::class);
    }

    // /**
    //  * @return Category2[] Returns an array of Category2 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Category2
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
