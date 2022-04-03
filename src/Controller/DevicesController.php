<?php

namespace App\Controller;

use App\Entity\Devices;
use App\Form\DevicesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/check/{id}", name="device_check", methods={"GET"})
     */
    public function show(): Response
    {
        return $this->render('dashboard/device.html.twig');
    }

    /**
     * @Route("/new", name="devices_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $device = new Devices();
        $form = $this->createForm(DevicesType::class, $device);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($device);
            $entityManager->flush();

            return $this->redirectToRoute('devices');
        }

        return $this->render('devices/new.html.twig', [
            'device' => $device,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="devices_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Devices $device): Response
    {
        $form = $this->createForm(DevicesType::class, $device);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('devices_index');
        }

        return $this->render('devices/edit.html.twig', [
            'device' => $device,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="devices_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Devices $device): Response
    {
        if ($this->isCsrfTokenValid('delete'.$device->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($device);
            $entityManager->flush();
        }

        return $this->redirectToRoute('devices');
    }
}