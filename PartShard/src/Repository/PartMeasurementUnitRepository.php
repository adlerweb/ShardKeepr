<?php

namespace App\Repository;

use App\Entity\PartMeasurementUnit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class PartMeasurementUnitRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, PartMeasurementUnit::class);
    }
}