<?php

namespace App\Repository;

use App\Entity\UpdateWebsites;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UpdateWebsites|null find($id, $lockMode = null, $lockVersion = null)
 * @method UpdateWebsites|null findOneBy(array $criteria, array $orderBy = null)
 * @method UpdateWebsites[]    findAll()
 * @method UpdateWebsites[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UpdateWebsitesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UpdateWebsites::class);
    }

    // /**
    //  * @return UpdateWebsites[] Returns an array of UpdateWebsites objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UpdateWebsites
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
