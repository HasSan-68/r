<?php

namespace App\Controller;

use App\Entity\Betaalmethode;
use App\Form\BetaalmethodeType;
use App\Repository\BetaalmethodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/betaalmethode")
 */
class BetaalmethodeController extends AbstractController
{
    /**
     * @Route("/", name="betaalmethode_index", methods={"GET"})
     */
    public function index(BetaalmethodeRepository $betaalmethodeRepository): Response
    {
        return $this->render('betaalmethode/index.html.twig', [
            'betaalmethodes' => $betaalmethodeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="betaalmethode_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $betaalmethode = new Betaalmethode();
        $form = $this->createForm(BetaalmethodeType::class, $betaalmethode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($betaalmethode);
            $entityManager->flush();

            return $this->redirectToRoute('betaalmethode_index');
        }

        return $this->render('betaalmethode/new.html.twig', [
            'betaalmethode' => $betaalmethode,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="betaalmethode_show", methods={"GET"})
     */
    public function show(Betaalmethode $betaalmethode): Response
    {
        return $this->render('betaalmethode/show.html.twig', [
            'betaalmethode' => $betaalmethode,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="betaalmethode_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Betaalmethode $betaalmethode): Response
    {
        $form = $this->createForm(BetaalmethodeType::class, $betaalmethode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('betaalmethode_index');
        }

        return $this->render('betaalmethode/edit.html.twig', [
            'betaalmethode' => $betaalmethode,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="betaalmethode_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Betaalmethode $betaalmethode): Response
    {
        if ($this->isCsrfTokenValid('delete'.$betaalmethode->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($betaalmethode);
            $entityManager->flush();
        }

        return $this->redirectToRoute('betaalmethode_index');
    }
}
