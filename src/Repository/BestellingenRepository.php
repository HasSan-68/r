<?php

namespace App\Repository;

use App\Entity\Bestellingen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bestellingen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bestellingen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bestellingen[]    findAll()
 * @method Bestellingen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BestellingenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bestellingen::class);
    }

    // /**
    //  * @return Bestellingen[] Returns an array of Bestellingen objects
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
    public function findOneBySomeField($value): ?Bestellingen
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
