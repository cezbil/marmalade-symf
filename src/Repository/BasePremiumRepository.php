<?php

namespace App\Repository;

use App\Entity\BasePremium;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BasePremium|null find($id, $lockMode = null, $lockVersion = null)
 * @method BasePremium|null findOneBy(array $criteria, array $orderBy = null)
 * @method BasePremium[]    findAll()
 * @method BasePremium[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BasePremiumRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BasePremium::class);
    }

    // /**
    //  * @return BasePremium[] Returns an array of BasePremium objects
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
    public function findOneBySomeField($value): ?BasePremium
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
