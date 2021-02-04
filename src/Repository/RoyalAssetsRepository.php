<?php

namespace App\Repository;

use App\Entity\RoyalAssets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RoyalAssets|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoyalAssets|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoyalAssets[]    findAll()
 * @method RoyalAssets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoyalAssetsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RoyalAssets::class);
    }

    // /**
    //  * @return RoyalAssets[] Returns an array of RoyalAssets objects
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
    public function findOneBySomeField($value): ?RoyalAssets
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
