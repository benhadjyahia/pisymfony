<?php

namespace App\Controller;

use App\Entity\CategoryC;
use App\Form\CategoryCType;
use App\Repository\CategoryCRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category")
 */
class CategoryCController extends AbstractController
{
    /**
     * @Route("/", name="category_c_index", methods={"GET"})
     */
    public function index(CategoryCRepository $categoryCRepository): Response
    {
        return $this->render('category_c/index.html.twig', [
            'categories' => $categoryCRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="category_c_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $category = new CategoryC();
        $form = $this->createForm(CategoryCType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('category_c_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('category_c/new.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="category_c_show", methods={"GET"})
     */
    public function show(CategoryC $category): Response
    {
        return $this->render('category_c/show.html.twig', [
            'category' => $category,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="category_c_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CategoryC $category): Response
    {
        $form = $this->createForm(CategoryCType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('category_c_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('category_c/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="category_c_delete", methods={"POST"})
     */
    public function delete(Request $request, CategoryC $category): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('category_c_index', [], Response::HTTP_SEE_OTHER);
    }
}
