<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/checkupitem")
 */
class CheckupitemController extends AbstractController
{
    /**
     * @Route("/", name="checkupitem")
     */
    public function index(): Response
    {
        return $this->render('checkupitem/index.html.twig', [
            'controller_name' => 'CheckupitemController',
        ]);
    }
}

?>