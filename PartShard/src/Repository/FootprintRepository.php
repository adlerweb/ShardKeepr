<?php

namespace App\Repository;

use App\Entity\Footprint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Footprint|null find($id, $lockMode = null, $lockVersion = null)
 * @method Footprint|null findOneBy(array $criteria, array $orderBy = null)
 * @method Footprint[]    findAll()
 * @method Footprint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FootprintRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Footprint::class);
    }

    // /**
    //  * @return Footprint[] Returns an array of Footprint objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Footprint
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
