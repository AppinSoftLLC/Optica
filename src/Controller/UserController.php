<?php

namespace App\Controller;
use App\Entity\Admin;
use App\Custom\html5Upload;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */

 class UserController extends AbstractController
{
    /**
     * @Route("/profile", name="profile", methods={"GET", "POST"})
     */
    public function profile(Request $request, ManagerRegistry $doctrine): Response
    {
        if ($request->getMethod() == Request::METHOD_POST) {
            $em = $doctrine->getManager();
            $erpAdmin = $em->getRepository(Admin::class)->find($this->getUser()->getId());
            $erpAdmin->setImage($request->get('image'));
            $erpAdmin->setUsername($request->get('username'));
            $erpAdmin->setName($request->get('name'));
            $erpAdmin->setEmail($request->get('email'));
            $em->flush();
            return $this->redirectToRoute('profile');
        }

        return $this->render('user/index.html.twig');
    }
    /**
     * @Route("/password", name="password")
     */
    public function password(Request $request, ManagerRegistry $doctrine): Response
    {
        if ($request->getMethod() == Request::METHOD_POST) {
            $em = $doctrine->getManager();
            $erpAdmin = $em->getRepository(Admin::class)->find($this->getUser()->getId());
            $erpAdmin->setPassword(md5($request->get('password')));
            $em->flush();
            $this->addFlash('info', 'Your password changed');
        }
        return $this->render('user/password.html.twig');
    }
    /**
     * @Route("/recovery", name="recovery")
     */
    public function recovery(): Response
    {
        return $this->render('user/recovery.html.twig', [
        ]);
    }

     /**
     * @Route("/upload", name="upload", methods={"POST"})
     */
    public function upload(Request $request): Response
    {
        $image = new html5Upload($_POST);
        $response = $image->uploadBase64();

        return new JsonResponse($response);
    }

    /**
     * @Route("/remove", name="remove", methods={"POST"})
     */
    public function remove(Request $request): Response
    {
        $image = $request->get('image');

        if (file_exists($image)) {
            if ($image != '/user/user-1.jpg') {
                if (unlink($image)) {
                    $response['status'] = 200;
                    $response['error'] = 'Success';
                } else {
                    $response['status'] = 300;
                    $response['error'] = 'Can\'t delete';
                }
            }
        } else {
            $response['status'] = 200;
            $response['error'] = 'File not found';
        }

        return new JsonResponse($response);
    }
}
