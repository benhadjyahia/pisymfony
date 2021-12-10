<?php

namespace App\Repository;

use App\Entity\Category11;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Category11|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category11|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category11[]    findAll()
 * @method Category11[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Category1Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category11::class);
    }

    // /**
    //  * @return Category11[] Returns an array of Category11 objects
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
    public function findOneBySomeField($value): ?Category11
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
