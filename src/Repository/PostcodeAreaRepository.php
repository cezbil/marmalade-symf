<?php

namespace App\Repository;

use App\Entity\PostcodeArea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PostcodeArea|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostcodeArea|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostcodeArea[]    findAll()
 * @method PostcodeArea[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostcodeAreaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostcodeArea::class);
    }

    // /**
    //  * @return PostcodeArea[] Returns an array of PostcodeArea objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PostcodeArea
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
