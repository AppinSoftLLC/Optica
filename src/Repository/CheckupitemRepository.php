<?php

namespace App\Repository;

use App\Entity\CheckupItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CheckupItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method CheckupItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method CheckupItem[]    findAll()
 * @method CheckupItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CheckupitemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CheckupItem::class);
    }

    public function findyByTotal() {
        return $this->createQueryBuilder('c')
            ->select('Count(c.id) ')
            ->getQuery()
            ->getSingleScalarResult();
    }

    // /**
    //  * @return CheckupItem[] Returns an array of CheckupItem objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CheckupItem
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
