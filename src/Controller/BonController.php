<?php

namespace App\Controller;

use App\Entity\Bestellingen;
use App\Entity\Bon;
use App\Entity\Klant;

use App\Form\BonType;
use App\Repository\BonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Dompdf\Dompdf;
use Dompdf\Options;

use PDFMerger;

/**
 * @Route("/bon")
 */
class BonController extends AbstractController
{
    /**
     * @Route("/", name="bon_index", methods={"GET"})
     */
    public function index(BonRepository $bonRepository): Response
    {
        return $this->render('bon/index.html.twig', [
            'bons' => $bonRepository->findAll(),
        ]);
    }

    /**
     * @Route("/pdf/{id}", name="bon_pdf", methods={"GET"})
     */
    public function streamPDF(Bon $bon): Response{
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        $klant = $this->getDoctrine()->getRepository(Klant::class)->find($bon->getKlantId());
        $bestellingen = $this->getDoctrine()->getRepository(Bestellingen::class)->find($bon->getBestellingId());


        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $pdf = new PDFMerger();



        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('bon/show.html.twig', [
            'bon' => $bon,
            'klant'=> $klant,
            'bestellingen' => $bestellingen,
        ]);
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        ob_end_clean();
        // Output the generated PDF to Browser (force download)
        $dompdf->stream("bon-".$bon->getId().".pdf", [
            "Attachment" => true
        ]);

        exit;
    }

    /**
     * @Route("/bon/verzamelen", name="bon_verzamelen", methods={"GET"})
     */
    public function Verzamelen(BonRepository $bonRepository): Response{
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('bon/verzamelen.html.twig', [
            'bons' => $bonRepository->findAll()
        ]);
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        ob_end_clean();
        // Output the generated PDF to Browser (force download)
        $dompdf->stream("bonVerzamelen.pdf", [
            "Attachment" => true
        ]);

        exit;
    }



    /**
     * @Route("/new", name="bon_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bon = new Bon();
        $form = $this->createForm(BonType::class, $bon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bon);
            $entityManager->flush();

            return $this->redirectToRoute('bon_index');
        }

        return $this->render('bon/new.html.twig', [
            'bon' => $bon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bon_show", methods={"GET"})
     */
    public function show(Bon $bon): Response
    {
        return $this->render('bon/show.html.twig', [
            'bon' => $bon,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bon_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bon $bon): Response
    {
        $form = $this->createForm(BonType::class, $bon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bon_index');
        }

        return $this->render('bon/edit.html.twig', [
            'bon' => $bon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bon_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Bon $bon): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bon->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bon_index');
    }
}

