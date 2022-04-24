<?php

namespace App\Repository;

use App\Entity\DevicesCheck;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DevicesCheck|null find($id, $lockMode = null, $lockVersion = null)
 * @method DevicesCheck|null findOneBy(array $criteria, array $orderBy = null)
 * @method DevicesCheck[]    findAll()
 * @method DevicesCheck[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeviceCheckRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DevicesCheck::class);
    }

    public function findByDeleteByDevice($id) {
        $this->createQueryBuilder('d')
        ->delete()
        ->where('d.deviceid = :id')
        ->setParameter('id', $id)
        ->getQuery()
        ->getResult();
    }

    // /**
    //  * @return DevicesCheck[] Returns an array of DevicesCheck objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DevicesCheck
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
