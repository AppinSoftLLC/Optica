<?php

namespace App\Repository;

use App\Entity\CheckupComment;
use DateInterval;
use DatePeriod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CheckupComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method CheckupComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method CheckupComment[]    findAll()
 * @method CheckupComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CheckupCommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CheckupComment::class);
    }

    public function findByToday()
    {
        $today = new \DateTime();

        return $this->createQueryBuilder('c')
            ->where('c.dates LIKE :t')
            ->setParameter('t', '%' . $today->format('Y-m-d') . '%')
            ->getQuery()
            ->getResult();
    }

    public function findByAbnormalReport($start, $end)
    {
        return $this->createQueryBuilder('c')
            ->where('c.dates BETWEEN :cdate and :edate')
            ->setParameter('cdate', $start)
            ->setParameter('edate', $end)
            ->orderBy('c.dates, c.deviceid')
            ->getQuery()
            ->getResult();

        // foreach ($q as $s) {
        //     $tmp = array();
        //     $tmp['day'] = $s->getDates();
        //     $tmp['device'] = $s->getDeviceId()->getName();
        //     $tmp['comment'] = $s->getComments();
        //     $data[] = $tmp;
        // }
        // return $data;
    }

    // /**
    //  * @return CheckupComment[] Returns an array of CheckupComment objects
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
    public function findOneBySomeField($value): ?CheckupComment
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
