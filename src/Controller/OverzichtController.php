<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ReserveringRepository;
class OverzichtController extends AbstractController
{
    /**
     * @Route("/overzicht", name="overzicht")
     */
    public function index(ReserveringRepository $reserveringRepository): Response

    {
        return $this->render('overzicht/index.html.twig', [
            'reserverings' => $reserveringRepository->findAll(),
        ]);
    }
}
