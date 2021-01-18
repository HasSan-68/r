<?php

namespace App\Controller;

use App\Entity\Bestellingen;
use App\Form\BestellingenType;
use App\Repository\BestellingenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bestellingen")
 */
class BestellingenController extends AbstractController
{
    /**
     * @Route("/", name="bestellingen_index", methods={"GET"})
     */
    public function index(BestellingenRepository $bestellingenRepository): Response
    {
        return $this->render('bestellingen/index.html.twig', [
            'bestellingens' => $bestellingenRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bestellingen_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bestellingen = new Bestellingen();
        $form = $this->createForm(BestellingenType::class, $bestellingen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bestellingen);
            $entityManager->flush();

            return $this->redirectToRoute('bestellingen_index');
        }

        return $this->render('bestellingen/new.html.twig', [
            'bestellingen' => $bestellingen,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bestellingen_show", methods={"GET"})
     */
    public function show(Bestellingen $bestellingen): Response
    {
        return $this->render('bestellingen/show.html.twig', [
            'bestellingen' => $bestellingen,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bestellingen_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bestellingen $bestellingen): Response
    {
        $form = $this->createForm(BestellingenType::class, $bestellingen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bestellingen_index');
        }

        return $this->render('bestellingen/edit.html.twig', [
            'bestellingen' => $bestellingen,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bestellingen_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Bestellingen $bestellingen): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bestellingen->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bestellingen);
            $entityManager->flush();
        }

        return $this->redirectToRoute('index.html.twig');
    }

}
