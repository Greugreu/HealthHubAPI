<?php

namespace App\Repository;

use App\Entity\Consume;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Consume|null find($id, $lockMode = null, $lockVersion = null)
 * @method Consume|null findOneBy(array $criteria, array $orderBy = null)
 * @method Consume[]    findAll()
 * @method Consume[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsumeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Consume::class);
    }

    // /**
    //  * @return Consume[] Returns an array of Consume objects
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
    public function findOneBySomeField($value): ?Consume
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
