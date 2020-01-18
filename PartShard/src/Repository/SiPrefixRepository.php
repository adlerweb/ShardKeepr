<?php

namespace App\Repository;

use App\Entity\SiPrefix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SiPrefix|null find($id, $lockMode = null, $lockVersion = null)
 * @method SiPrefix|null findOneBy(array $criteria, array $orderBy = null)
 * @method SiPrefix[]    findAll()
 * @method SiPrefix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SiPrefixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SiPrefix::class);
    }

    // /**
    //  * @return SiPrefix[] Returns an array of SiPrefix objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SiPrefix
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
