<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/status")
 */
class StatusController extends AbstractController
{
    /**
     * @Route("/", name="status")
     */
    public function index(): Response
    {
        return $this->render('status/index.html.twig', [
            'controller_name' => 'StatusController',
        ]);
    }
}
