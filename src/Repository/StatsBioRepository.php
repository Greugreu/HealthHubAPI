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

    public function findByUserId($userId)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.users_idUsers = :val')
            ->setParameter('val', $userId)
            ->getQuery()
            ->getResult()
            ;
    }
}
