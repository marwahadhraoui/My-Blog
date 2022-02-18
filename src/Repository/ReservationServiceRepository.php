<?php

namespace App\Repository;

use App\Entity\ReservationService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReservationService|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationService|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationService[]    findAll()
 * @method ReservationService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationService::class);
    }

    // /**
    //  * @return ReservationService[] Returns an array of ReservationService objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReservationService
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
