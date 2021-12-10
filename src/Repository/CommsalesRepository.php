<?php

namespace App\Repository;

use App\Entity\Commsales;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commsales|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commsales|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commsales[]    findAll()
 * @method Commsales[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommsalesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commsales::class);
    }

    // /**
    //  * @return Commsales[] Returns an array of Commsales objects
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
    public function findOneBySomeField($value): ?Commsales
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
