<?php

namespace App\Controller;

use App\Repository\CheckupCommentRepository;
use App\Repository\CheckupitemRepository;
use App\Repository\CheckupRepository;
use App\Repository\DeviceCheckRepository;
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
    public function index(RoomsRepository $roomsRepository, DevicesRepository $devicesRepository, CheckupitemRepository $checkupitemRepository, CheckupCommentRepository $checkupCommentRepository, CheckupRepository $checkupRepository): Response
    {
        $device_total = $devicesRepository->findByTotal();
        $today_total = $checkupRepository->findByTodayTotal();
        $progress = $today_total * 100 / $device_total;

        return $this->render('dashboard/index.html.twig', [
            'room_total' => $roomsRepository->findByTotal(),
            'device_total' => $device_total,
            'today_total' => $today_total,
            'progress' => $progress,
            'checkup_total' => $checkupitemRepository->findyByTotal(),
            'checkupcomments' => $checkupCommentRepository->findByToday(),
        ]);
    }
}
