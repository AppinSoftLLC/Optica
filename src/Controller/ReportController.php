<?php

namespace App\Controller;

use App\Repository\RoomsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/report")
 */

class ReportController extends AbstractController
{
    /**
     * @Route("/", name="report")
     */
    public function device(RoomsRepository $roomsRepository): Response
    {
        return $this->render('report/report.html.twig', [
            'rooms' => $roomsRepository->findByAll(),
        ]);
    }

    /**
     * @Route("/single", name="report_single")
     */
    public function single(RoomsRepository $roomsRepository): Response
    {
        return $this->render('report/report.html.twig', [
            'rooms' => $roomsRepository->findByAll(),
        ]);
    }
    
    /**
     * @Route("/single", name="report_all")
     */
    public function all(RoomsRepository $roomsRepository): Response
    {
        return $this->render('report/report.html.twig', [
            'rooms' => $roomsRepository->findByAll(),
        ]);
    }
    
    /**
     * @Route("/single", name="report_abnormal")
     */                
    
    public function abnormal(RoomsRepository $roomsRepository): Response
    {
        return $this->render('report/report.html.twig', [
            'rooms' => $roomsRepository->findByAll(),
        ]);
    }
}
