<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\SalleSport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FdashboardSalleController extends AbstractController
{
    /**
     * @Route("/FdashboardSalle", name="Fdashboard_salle")
     */
    public function index(): Response
    {
        $salles= $this->getDoctrine()->getRepository(SalleSport::class)->findAll();
        return $this->render('fdashboard_salle/index.html.twig', array('sallesS' => $salles));
    }

    /**
     * @Route("/dashboardASnew", name="new_salleA")
     * Method({"GET", "POST"})
     */
    public function newSalle(Request $request)
    {
        $salleS = new SalleSport();

        $form = $this->createFormBuilder( $salleS)
            ->add('nom_salle', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('adress_salle', TextareaType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
            ->add('description_salle',TextType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
            ->add('price',TextType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
           ->add('imageFile', FileType::class)
            ->add('category', EntityType::class,['class'=>Category::class,'choice_label'=>'titre','label'=>'Categories'])
            ->add('save', SubmitType::class, array('label' => 'Create', 'attr' => array('class' => 'btn btn-primary mt-3')))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $salleS = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($salleS);
            $entityManager->flush();

            return $this->redirectToRoute('Fdashboard_salle');
        }

        return $this->render('fdashboard_salle/addSalleSF.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/editSalle/{id}", name="edit")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id) {
        $salle = new SalleSport();
        $salle = $this->getDoctrine()->getRepository(SalleSport::class)->find($id);

        $form = $this->createFormBuilder($salle)
            ->add('nom_salle', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('adress_salle', TextareaType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
            ->add('description_salle',TextType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
            ->add('price',TextType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
            ->add('imageFile', FileType::class)
            ->add('category', EntityType::class,['class'=>Category::class,'choice_label'=>'titre','label'=>'Categories'])
            ->add('save', SubmitType::class, array(
                'label' => 'Update',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
           // $salle = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirectToRoute('Fdashboard_salle');
        }

        return $this->render('fdashboard_salle/EditSalleSF.html.twig', array(
            'form' => $form->createView()
        ));

    }


    /**
     * @Route("/showSalle/{id}", name="article_show")
     */
    public function show($id) {
        $salle= $this->getDoctrine()->getRepository(SalleSport::class)->find($id);

        return $this->render('fdashboard_salle/showSalle.html.twig', array('SalleSport' => $salle));
    }

    /**
     * @Route("/deleteSalle/{id}" ,name="delete")
     * Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $salle = $this->getDoctrine()->getRepository(SalleSport::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($salle);
        $entityManager->flush();

        $response = new Response();
        $response->send();

        return $this->redirectToRoute('Fdashboard_salle');
    }
















}
