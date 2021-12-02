<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\SalleSport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FdashbordCatSalleController extends AbstractController
{
    /**
     * @Route("/dashbordCategorie", name="dashbordCatSalle")
     */
    public function index(): Response
    {
        $Category= $this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render('fdashbord_cat_salle/index.html.twig', array('Category' => $Category));
    }


    /**
     * @Route("/newCategorie", name="new_categorie")
     * Method({"GET", "POST"})
     */
    public function newCategrie(Request $request)
    {
        $categorie = new Category();

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

            return $this->redirectToRoute('dashbordCatSalle');
        }

        return $this->render('fdashbord_cat_salle/addCategorie.html.twig', array(
            'form' => $form->createView()
        ));
    }




    /**
     * @Route("/editcatSalle/{id}", name="edit_classroom")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id) {
        $Category = new Category();
        $Category = $this->getDoctrine()->getRepository(Category::class)->find($id);

        $form = $this->createFormBuilder($Category)
            ->add('titre', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('description', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Create', 'attr' => array('class' => 'btn btn-primary mt-3')))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // $salle = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirectToRoute('dashbordCatSalle');
        }

        return $this->render('fdashbord_cat_salle/EditCat.html.twig', array(
            'form' => $form->createView()
        ));

    }




    /**
     * @Route("/deleteCat/{id}" ,name="delete_salle")
     * Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $categorie = $this->getDoctrine()->getRepository(Category::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($categorie);
        $entityManager->flush();

        $response = new Response();
        $response->send();

        return $this->redirectToRoute('dashbordCatSalle');
    }






}
