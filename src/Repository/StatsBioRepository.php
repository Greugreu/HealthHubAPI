<?php

namespace App\Repository;

use App\Entity\StatsBio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StatsBio|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatsBio|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatsBio[]    findAll()
 * @method StatsBio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatsBioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatsBio::class);
    }

    // /**
    //  * @return StatsBio[] Returns an array of StatsBio objects
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
    public function findOneBySomeField($value): ?StatsBio
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
