<?php

namespace App\Repository;

use App\Entity\SalleSport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SalleSport|null find($id, $lockMode = null, $lockVersion = null)
 * @method SalleSport|null findOneBy(array $criteria, array $orderBy = null)
 * @method SalleSport[]    findAll()
 * @method SalleSport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalleSportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SalleSport::class);
    }


   // /**
   //  * @return SalleSport[] Returns an array of SalleSport objects
    // */
  /*  public function findWithSearch($search){
        $query = $this->createQueryBuilder('p');
          if($search->getMinPrice()){
              $query = $query->andWhere('p.price > '.$search->getMinPrice());

          }
          if($search->getMaxPrice()){
              $query = $query->andWhere('p.price > '.$search->getMinPrice());
          }
          return $query->getQuery()->getResult();



    }*/






    // /**
    //  * @return SalleSport[] Returns an array of SalleSport objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SalleSport
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
