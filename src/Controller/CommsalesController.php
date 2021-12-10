<?php

namespace App\Controller;

use App\Entity\Commsales;
use App\Form\CommsalesType;
use App\Repository\CommsalesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commsales")
 */
class CommsalesController extends AbstractController
{
    /**
     * @Route("/", name="commsales_index", methods={"GET"})
     */
    public function index(CommsalesRepository $commsalesRepository): Response
    {
        return $this->render('fhome_salle/showSalleF.html.twig', [
            'commsales' => $commsalesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="commsales_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $commsale = new Commsales();
        $form = $this->createForm(CommsalesType::class, $commsale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commsale);
            $entityManager->flush();

            return $this->redirectToRoute('commsales_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commsales/new.html.twig', [
            'commsale' => $commsale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commsales_show", methods={"GET"})
     */
    public function show(Commsales $commsale): Response
    {
        return $this->render('commsales/show.html.twig', [
            'commsale' => $commsale,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commsales_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Commsales $commsale): Response
    {
        $form = $this->createForm(CommsalesType::class, $commsale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commsales_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commsales/edit.html.twig', [
            'commsale' => $commsale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commsales_delete", methods={"POST"})
     */
    public function delete(Request $request, Commsales $commsale): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commsale->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commsale);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commsales_index', [], Response::HTTP_SEE_OTHER);
    }
}
