<?php

namespace App\Controller;

use App\Entity\CategoryE;
use App\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cat")
 */
class CatEventController extends AbstractController
{
    /**
     * @Route("/evenetCategorie", name="evenetCategorie")
     */
    public function index(): Response
    {
        $Category= $this->getDoctrine()->getRepository(CategoryE::class)->findAll();
        return $this->render('homecat/index.html.twig', array('CategoryE' => $Category));
    }


    /**
     * @Route("/newCategorieE", name="new_categorieE")
     * Method({"GET", "POST"})
     */
    public function newCategrie(Request $request)
    {
        $categorie = new CategoryE();

        $form = $this->createFormBuilder( $categorie)
            ->add('titre', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('description', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Create', 'attr' => array('class' => 'btn btn-primary mt-3')))
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $categorie = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('evenetCategorie');
        }

        return $this->render('homecat/addCategorie.html.twig', array(
            'form' => $form->createView()
        ));
    }




    /**
     * @Route("/editCat/{id}", name="edit_classroom")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id) {
        $Categoy= new CategoryE();
        $Category = $this->getDoctrine()->getRepository(CategoryE::class)->find($id);

        $form = $this->createFormBuilder($salle)
            ->add('titre', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('description', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Create', 'attr' => array('class' => 'btn btn-primary mt-3')))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // $salle = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirectToRoute('evenetCategorie');
        }

        return $this->render('fdashbord_cat_salle/addCategorie.html.twig', array(
            'form' => $form->createView()
        ));

    }




    /**
     * @Route("/{id}", name="cat_delete", methods={"POST"})
     */
    public function delete(Request $request, CategoryE $category): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($category);
            $entityManager->flush();
        }




        return $this->redirectToRoute('evenetCategorie' , [], Response::HTTP_SEE_OTHER);
    }
}
