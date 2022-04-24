<?php

namespace App\Controller;

use App\Entity\CheckupItem;
use App\Entity\Devices;
use App\Entity\DevicesCheck;
use App\Form\DevicesType;
use App\Repository\CheckupitemRepository;
use App\Repository\DeviceCheckRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

/**
 * @Route("/devices")
 */
class DevicesController extends AbstractController
{
    /**
     * @Route("/", name="devices", methods={"GET"})
     */
    public function index(): Response
    {
        $devices = $this->getDoctrine()
            ->getRepository(Devices::class)
            ->findAll();

        return $this->render('devices/index.html.twig', [
            'devices' => $devices,
        ]);
    }

    /**
     * @Route("/new", name="devices_new", methods={"GET","POST"})
     */
    public function new(Request $request, CheckupitemRepository $checkupitemRepository): Response
    {
        $device = new Devices();
        $form = $this->createForm(DevicesType::class, $device)
            ->add('items', HiddenType::class, [
                'mapped' => false
            ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $items = explode(':', $form->get('items')->getData());
            $em = $this->getDoctrine()->getManager();
            $em->persist($device);
            foreach ($items as $item) {
                $devicesCheck = new DevicesCheck();
                $devicesCheck->setDeviceid($device);
                $devicesCheck->setCheckitemid($em->getRepository(CheckupItem::class)->find($item));
                $em->persist($devicesCheck);
            }

            $em->flush();

            return $this->redirectToRoute('devices');
        }

        return $this->render('devices/new.html.twig', [
            'device' => $device,
            'checkitems' => $checkupitemRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="devices_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Devices $device, CheckupitemRepository $checkupitemRepository, DeviceCheckRepository $devicesCheckRepository): Response
    {
        $items = array();
        foreach ($device->getDevicescheck() as $item) {
            $items[] =  $item->getCheckitemid()->getId();
        }

        $form = $this->createForm(DevicesType::class, $device)
            ->add('items', HiddenType::class, [
                'mapped' => false,
                'attr' => ['value' => implode(':', $items)]
            ]);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $items = explode(':', $form->get('items')->getData());
            $devicesCheckRepository->findByDeleteByDevice($device->getId());
            $em = $this->getDoctrine()->getManager();

            foreach ($items as $item) {
                $devicesCheck = new DevicesCheck();
                $devicesCheck->setDeviceid($device);
                $devicesCheck->setCheckitemid($em->getRepository(CheckupItem::class)->find($item));
                $em->persist($devicesCheck);
            }

            $em->flush();

            return $this->redirectToRoute('devices');
        }

        return $this->render('devices/edit.html.twig', [
            'device' => $device,
            'checkitems' => $checkupitemRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="devices_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Devices $device): Response
    {
        if ($this->isCsrfTokenValid('delete' . $device->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($device);
            $entityManager->flush();
        }

        return $this->redirectToRoute('devices');
    }
}
