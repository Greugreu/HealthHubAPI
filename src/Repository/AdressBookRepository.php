<?php

namespace App\Repository;

use App\Entity\AdressBook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AdressBook|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdressBook|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdressBook[]    findAll()
 * @method AdressBook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdressBookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdressBook::class);
    }

    // /**
    //  * @return AdressBook[] Returns an array of AdressBook objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AdressBook
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
