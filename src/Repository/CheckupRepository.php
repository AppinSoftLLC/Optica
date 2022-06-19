<?php

namespace App\Repository;

use App\Entity\Checkup;
use DateInterval;
use DatePeriod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Checkup|null find($id, $lockMode = null, $lockVersion = null)
 * @method Checkup|null findOneBy(array $criteria, array $orderBy = null)
 * @method Checkup[]    findAll()
 * @method Checkup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CheckupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Checkup::class);
    }

    public function findByTodayTotal()
    {
        $today = new \DateTime();

        // $sub =  $this->createQueryBuilder('d')
        //     ->select('d.deviceid')
        //     ->where('d.dates LIKE :t')
        //     ->setParameter('t', $today->format('Y-m-d'))
        //     ->groupBy('d.deviceid')
        //     ->getSQL();

        //     echo $sub;


        // $q=  $this->createQueryBuilder('s')
        //     ->select('count(s.id)')
        //     // ->from($sub)
        //     ->getQuery();
        //     // ->getSingleScalarResult();

        //     echo $q->getSql();
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT count(*) as t FROM (SELECT deviceid FROM checkup WHERE dates LIKE '%" . $today->format('Y-m-d') . "%' GROUP BY DeviceID) as checkuptoday;";
        $stsm = $conn->prepare($sql);
        $resultSet = $stsm->executeQuery();
        $result = $resultSet->fetchAllAssociative();

        return $result[0]['t'];
    }

    public function findBySingleReport($device, $start, $end)
    {
        $data = array();
        $sDate = new \DateTime($start);
        $eDate = new \DateTime($end);

        $interval = DateInterval::createFromDateString(('1 day'));
        $period = new DatePeriod($sDate, $interval, $eDate);

        foreach ($period as $dt) {
            $tmp = array();
            $tmp['day'] = $dt->format('Y-m-d');
            $tmp['comment'] = null;

            $q = $this->createQueryBuilder('d')
                ->where('d.deviceid = :device')
                ->andWhere('d.dates LIKE :cdate')
                ->setParameter('device', $device)
                ->setParameter('cdate', '%' . $dt->format('Y-m-d') . '%')
                ->orderBy('d.dates, d.deviceid, d.checkupitemid')
                ->getQuery()
                ->getResult();

            foreach ($q as $i => $s) {
                $tmp['data'][$i] = array('name' => $s->getCheckupitemid()->getTitle(), 'status' => $s->getState() ? 'normal' : 'abnormal');
            }

            $conn = $this->getEntityManager()->getConnection();
            $sql = "SELECT comments FROM checkup_comment WHERE deviceid = '{$device}' AND dates LIKE '%{$dt->format('Y-m-d')}%'";
            $stsm = $conn->prepare($sql);
            $resultSet = $stsm->executeQuery();
            $result = $resultSet->fetchAllAssociative();

            if($result) {
                $tmp['comment'] = $result[0]['comments'];
            }
            
            if (isset($tmp['data']) && count($tmp['data']) > 0) {
                $data[] = $tmp;
            }
        }

        return $data;
    }

    // /**
    //  * @return Checkup[] Returns an array of Checkup objects
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
    public function findOneBySomeField($value): ?Checkup
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
