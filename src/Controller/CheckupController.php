<?php

namespace App\Controller;

use App\Entity\Checkup;
use App\Entity\Devices;
use App\Entity\DevicesCheck;
use App\Form\CheckupType;
use App\Repository\DeviceCheckRepository;
use App\Repository\DevicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/checkup")
 */
class CheckupController extends AbstractController
{
    /**
     * @Route("/{id}", name="check_up_device", methods={"GET","POST"})
     */
    public function new(Request $request, DevicesRepository $devicesRepository, DeviceCheckRepository $deviceCheckRepository): Response
    {
        $device = $devicesRepository->findOneBy(array('id' => $request->get('id')));

        $checks = $deviceCheckRepository->findBy(array('deviceid' => $request->get('id')));

        foreach($checks as $check) {
            echo $check->getCheckitemid()->getTitle() . '<br />';
        }

        $checkup = new Checkup();
        $form = $this->createForm(CheckupType::class, $checkup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($checkup);
            $entityManager->flush();

            return $this->redirectToRoute('checkup_index');
        }

        return $this->render('checkup/new.html.twig', [
            'device' => $device,
            'form' => $form->createView(),
        ]);
    }
}