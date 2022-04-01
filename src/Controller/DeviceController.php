<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/device")
 */

class DeviceController extends AbstractController
{
    /**
     * @Route("/", name="device")
     */
    public function index(): Response
    {
        return $this->render('device/index.html.twig', [
            'controller_name' => 'DeviceController :: Check View',
        ]);
    }
    /**
     * @Route("/check/{id}", name="device_check", methods={"GET"})
     */
    public function check(): Response
    {
        return $this->render('device/check.html.twig', [
            'controller_name' => 'DeviceController :: Check View',
        ]);
    }
}
