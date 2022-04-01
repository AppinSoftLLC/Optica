<?php

namespace App\Controller;

use App\Repository\DevicesRepository;
use App\Repository\RoomsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    public function rooms(RoomsRepository $roomsRepository, DevicesRepository $devicesRepository): Response
    {

        return $this->render('_sidebar.html.twig', [
            'total' => $devicesRepository->findByTotal(),
            'rooms' => $roomsRepository->findByAll(),
        ]);
    }
}
