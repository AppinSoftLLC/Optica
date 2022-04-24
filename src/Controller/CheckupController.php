<?php

namespace App\Controller;

use App\Entity\Checkup;
use App\Entity\CheckupComment;
use App\Entity\CheckupItem;
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

        $checkup = new Checkup();
        $form = $this->createForm(CheckupType::class, $checkup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $checks = $request->get('checks');

            foreach($checks as $i => $check) {
                $checkup = new Checkup();
                $checkup->setDates(new \DateTime());
                $checkup->setDeviceid($device);
                $checkup->setCheckupitemid($entityManager->getRepository(CheckupItem::class)->find($i));
                $checkup->setState($check);
                $entityManager->persist($checkup);
            }

            if($request->get('comment') && strlen(trim($request->get('comment'))) > 0) {
                $comment = new CheckupComment();
                $comment->setDates(new \DateTime());
                $comment->setDeviceid($device);
                $comment->setComments(trim($request->get('comment')));
                $entityManager->persist($comment);
            }
            $entityManager->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('checkup/new.html.twig', [
            'device' => $device,
            'checks' => $checks,
            'form' => $form->createView(),
        ]);
    }
}