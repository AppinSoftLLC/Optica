<?php

namespace App\Controller;

use App\Entity\CheckupComment;
use App\Repository\CheckupCommentRepository;
use App\Repository\CheckupRepository;
use App\Repository\DevicesRepository;
use App\Repository\RoomsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/report")
 */

class ReportController extends AbstractController
{
	/**
	 * @Route("/", name="report")
	 */
	public function device(RoomsRepository $roomsRepository): Response
	{
		return $this->render('report/report.html.twig', [
			'rooms' => $roomsRepository->findByAll(),
		]);
	}

	/**
	 * @Route("/single", name="report_single", methods="POST")
	 */
	public function single(Request $request, CheckupRepository $checkupRepository,  DevicesRepository $deviceRepository): Response
	{
		return $this->render('report/report.single.html.twig', [
			'device' => $deviceRepository->find($request->get('deviceId')),
			'checkups' => $checkupRepository->findBySingleReport($request->get('deviceId'), $request->get('startDate'), $request->get('endDate'))
		]);
	}

	/**
	 * @Route("/abnormal", name="report_abnormal", methods="POST")
	 */
	public function abnormal(Request $request, CheckupCommentRepository $checkupCommentRepository): Response
	{
		return $this->render('report/report.abnormal.html.twig', [
			'checkups' => $checkupCommentRepository->findByAbnormalReport($request->get('startDate'), $request->get('endDate'))
		]);
	}
}
