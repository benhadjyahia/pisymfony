<?php

namespace App\Controller;

use App\Entity\Category11;
use App\Form\Category1Type;
use App\Repository\Category1Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category/controllers")
 */
class CategoryControllersController extends AbstractController
{
    /**
     * @Route("/", name="category_controllers_index", methods={"GET"})
     */
    public function index(Category1Repository $categoryRepository): Response
    {
        return $this->render('category_controllers/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="category_controllers_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $category = new Category11();
        $form = $this->createForm(Category1Type::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('category_controllers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('category_controllers/new.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="category_controllers_show", methods={"GET"})
     */
    public function show(Category11 $category): Response
    {
        return $this->render('category_controllers/show.html.twig', [
            'category' => $category,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="category_controllers_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Category11 $category): Response
    {
        $form = $this->createForm(Category1Type::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('category_controllers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('category_controllers/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="category_controllers_delete", methods={"POST"})
     */
    public function delete(Request $request, Category11 $category): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('category_controllers_index', [], Response::HTTP_SEE_OTHER);
    }
}
