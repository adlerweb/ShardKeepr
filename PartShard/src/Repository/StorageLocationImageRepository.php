<?php

namespace App\Repository;

use App\Entity\StorageLocationImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method StorageLocationImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method StorageLocationImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method StorageLocationImage[]    findAll()
 * @method StorageLocationImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StorageLocationImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StorageLocationImage::class);
    }

    // /**
    //  * @return StorageLocationImage[] Returns an array of StorageLocationImage objects
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
    public function findOneBySomeField($value): ?StorageLocationImage
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
