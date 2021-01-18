<?php

namespace App\Repository;

use App\Entity\Betaalmethode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Betaalmethode|null find($id, $lockMode = null, $lockVersion = null)
 * @method Betaalmethode|null findOneBy(array $criteria, array $orderBy = null)
 * @method Betaalmethode[]    findAll()
 * @method Betaalmethode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BetaalmethodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Betaalmethode::class);
    }

    // /**
    //  * @return Betaalmethode[] Returns an array of Betaalmethode objects
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
    public function findOneBySomeField($value): ?Betaalmethode
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
