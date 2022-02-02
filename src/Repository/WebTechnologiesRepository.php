<?php

namespace App\Repository;

use App\Entity\WebTechnologies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WebTechnologies|null find($id, $lockMode = null, $lockVersion = null)
 * @method WebTechnologies|null findOneBy(array $criteria, array $orderBy = null)
 * @method WebTechnologies[]    findAll()
 * @method WebTechnologies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WebTechnologiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebTechnologies::class);
    }

    // /**
    //  * @return WebTechnologies[] Returns an array of WebTechnologies objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WebTechnologies
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
