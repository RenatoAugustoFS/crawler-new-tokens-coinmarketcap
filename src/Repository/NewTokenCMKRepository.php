<?php

namespace App\Repository;

use App\Entity\NewTokenCMK;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NewTokenCMK|null find($id, $lockMode = null, $lockVersion = null)
 * @method NewTokenCMK|null findOneBy(array $criteria, array $orderBy = null)
 * @method NewTokenCMK[]    findAll()
 * @method NewTokenCMK[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewTokenCMKRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NewTokenCMK::class);
    }

    // /**
    //  * @return NewTokenCMK[] Returns an array of NewTokenCMK objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NewTokenCMK
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
