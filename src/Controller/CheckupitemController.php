<?php

namespace App\Controller;

use App\Entity\CheckupItem;
use App\Form\CheckupItemType;
use App\Repository\CheckupitemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/checkupitem")
 */
class CheckupItemController extends AbstractController
{
    /**
     * @Route("/", name="checkupitem", methods={"GET"})
     */
    public function index(CheckupitemRepository $checkupitemRepository): Response
    {
        return $this->render('checkupitem/index.html.twig', [
            'checkup_items' => $checkupitemRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="checkupitem_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $checkupItem = new CheckupItem();
        $form = $this->createForm(CheckupItemType::class, $checkupItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($checkupItem);
            $entityManager->flush();

            return $this->redirectToRoute('checkupitem');
        }

        return $this->render('checkupitem/new.html.twig', [
            'checkup_item' => $checkupItem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="checkupitem_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CheckupItem $checkupItem): Response
    {
        $form = $this->createForm(CheckupItemType::class, $checkupItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('checkupitem');
        }

        return $this->render('checkupitem/edit.html.twig', [
            'checkup_item' => $checkupItem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="checkupitem_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CheckupItem $checkupItem): Response
    {
        if ($this->isCsrfTokenValid('delete'.$checkupItem->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($checkupItem);
            $entityManager->flush();
        }

        return $this->redirectToRoute('checkupitem');
    }
}