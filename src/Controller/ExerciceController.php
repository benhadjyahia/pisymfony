<?php

namespace App\Controller;

use App\Entity\Exercice;
use App\Form\Exercice1Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;



/**
 * @Route("/exercice")
 */
class ExerciceController extends AbstractController
{
    /**
     * @Route("/", name="exercice_index", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()
            ->getRepository(Exercice::class)
            ->findAll();

        $exercices = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            3 // Nombre de résultats par page
        );

        return $this->render('exercice/index.html.twig', [
            'exercices' => $exercices,
        ]);
    }
    /**
     * @Route("/1", name="exercice_index1", methods={"GET"})
     */
    public function index1(): Response
    {
        $exercices = $this->getDoctrine()
            ->getRepository(Exercice::class)
            ->findAll();

        return $this->render('exercice/index1.html.twig', [
            'exercices' => $exercices,
        ]);
    }

    /**
     * @Route("/new", name="exercice_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $exercice = new Exercice();
        $form = $this->createForm(Exercice1Type::class, $exercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($exercice);
            $entityManager->flush();

            return $this->redirectToRoute('exercice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('exercice/new.html.twig', [
            'exercice' => $exercice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idEx}", name="exercice_show", methods={"GET"})
     */
    public function show(Exercice $exercice): Response
    {
        return $this->render('exercice/show.html.twig', [
            'exercice' => $exercice,
        ]);
    }

    /**
     * @Route("/{idEx}/edit", name="exercice_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Exercice $exercice): Response
    {
        $form = $this->createForm(Exercice1Type::class, $exercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('exercice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('exercice/edit.html.twig', [
            'exercice' => $exercice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idEx}", name="exercice_delete", methods={"POST"})
     */
    public function delete(Request $request, Exercice $exercice): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exercice->getIdEx(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($exercice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('exercice_index', [], Response::HTTP_SEE_OTHER);
    }
}
