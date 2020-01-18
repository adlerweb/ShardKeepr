<?php

namespace App\Repository;

use App\Entity\ManufacturerICLogo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ManufacturerICLogo|null find($id, $lockMode = null, $lockVersion = null)
 * @method ManufacturerICLogo|null findOneBy(array $criteria, array $orderBy = null)
 * @method ManufacturerICLogo[]    findAll()
 * @method ManufacturerICLogo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ManufacturerICLogoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ManufacturerICLogo::class);
    }

    // /**
    //  * @return ManufacturerICLogo[] Returns an array of ManufacturerICLogo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ManufacturerICLogo
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
