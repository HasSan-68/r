<?php

namespace App\Repository;

use App\Entity\Medewerker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Medewerker|null find($id, $lockMode = null, $lockVersion = null)
 * @method Medewerker|null findOneBy(array $criteria, array $orderBy = null)
 * @method Medewerker[]    findAll()
 * @method Medewerker[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedewerkerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Medewerker::class);
    }

    // /**
    //  * @return Medewerker[] Returns an array of Medewerker objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Medewerker
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
