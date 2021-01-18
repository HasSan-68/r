<?php

namespace App\Controller;

use App\Entity\Medewerker;
use App\Form\MedewerkerType;
use App\Repository\MedewerkerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/medewerker")
 */
class MedewerkerController extends AbstractController
{
    /**
     * @Route("/", name="medewerker_index", methods={"GET"})
     */
    public function index(MedewerkerRepository $medewerkerRepository): Response
    {
        return $this->render('medewerker/index.html.twig', [
            'medewerkers' => $medewerkerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="medewerker_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $medewerker = new Medewerker();
        $form = $this->createForm(MedewerkerType::class, $medewerker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($medewerker);
            $entityManager->flush();

            return $this->redirectToRoute('medewerker_index');
        }

        return $this->render('medewerker/new.html.twig', [
            'medewerker' => $medewerker,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="medewerker_show", methods={"GET"})
     */
    public function show(Medewerker $medewerker): Response
    {
        return $this->render('medewerker/show.html.twig', [
            'medewerker' => $medewerker,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="medewerker_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Medewerker $medewerker): Response
    {
        $form = $this->createForm(MedewerkerType::class, $medewerker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('medewerker_index');
        }

        return $this->render('medewerker/edit.html.twig', [
            'medewerker' => $medewerker,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="medewerker_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Medewerker $medewerker): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medewerker->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($medewerker);
            $entityManager->flush();
        }

        return $this->redirectToRoute('medewerker_index');
    }
}
