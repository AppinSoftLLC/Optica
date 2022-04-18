<?php

namespace App\Controller;

use App\Repository\CheckupCommentRepository;
use App\Repository\CheckupitemRepository;
use App\Repository\DevicesRepository;
use App\Repository\RoomsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(RoomsRepository $roomsRepository, DevicesRepository $devicesRepository, CheckupitemRepository $checkupitemRepository, CheckupCommentRepository $checkupCommentRepository): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'room_total' => $roomsRepository->findByTotal(),
            'device_total' => $devicesRepository->findByTotal(),
            'checkup_total' => $checkupitemRepository->findyByTotal(),
            'checkupcomments' => $checkupCommentRepository->findByToday(),
        ]);
    }
}

?>