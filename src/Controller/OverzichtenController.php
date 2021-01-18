<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OverzichtenController extends AbstractController
{
    /**
     * @Route("/overzichten", name="overzichten")
     */
    public function index(): Response
    {
        return $this->render('overzichten/index.html.twig', [
            'controller_name' => 'OverzichtenController',
        ]);
    }
}
