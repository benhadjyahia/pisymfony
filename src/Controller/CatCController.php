<?php

namespace App\Controller;

use App\Entity\Category2;
use App\Form\Category2Type;
use App\Repository\Category2Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cat/c")
 */
class CatCController extends AbstractController
{
    /**
     * @Route("/", name="cat_c_index", methods={"GET"})
     */
    public function index(Category2Repository $category2Repository): Response
    {
        return $this->render('cat_c/index.html.twig', [
            'category2s' => $category2Repository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cat_c_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $category2 = new Category2();
        $form = $this->createForm(Category2Type::class, $category2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category2);
            $entityManager->flush();

            return $this->redirectToRoute('cat_c_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cat_c/new.html.twig', [
            'category2' => $category2,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cat_c_show", methods={"GET"})
     */
    public function show(Category2 $category2): Response
    {
        return $this->render('cat_c/show.html.twig', [
            'category2' => $category2,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cat_c_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Category2 $category2): Response
    {
        $form = $this->createForm(Category2Type::class, $category2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cat_c_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cat_c/edit.html.twig', [
            'category2' => $category2,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cat_c_delete", methods={"POST"})
     */
    public function delete(Request $request, Category2 $category2): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category2->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($category2);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cat_c_index', [], Response::HTTP_SEE_OTHER);
    }
}
