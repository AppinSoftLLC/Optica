<?php

namespace App\Controller;

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
    public function device(): Response
    {
        return $this->render('report/report.html.twig', [
            'controller_name' => 'ReportController',
        ]);
    }
}
