<?php

namespace App\Repository;

use App\Entity\Websites;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Websites|null find($id, $lockMode = null, $lockVersion = null)
 * @method Websites|null findOneBy(array $criteria, array $orderBy = null)
 * @method Websites[]    findAll()
 * @method Websites[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WebsitesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Websites::class);
    }

    // /**
    //  * @return Websites[] Returns an array of Websites objects
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
    public function findOneBySomeField($value): ?Websites
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
