<?php

namespace App\Repository;

use App\Entity\Presentations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Presentations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Presentations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Presentations[]    findAll()
 * @method Presentations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PresentationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Presentations::class);
    }

    // /**
    //  * @return Presentations[] Returns an array of Presentations objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Presentations
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function presentation_show ()
    {
        $today = date('Y/m/d');
        return $this->createQueryBuilder('p')
            ->andWhere('p.isPubished = true' and 'p.publicationDate<$today')
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }

}
