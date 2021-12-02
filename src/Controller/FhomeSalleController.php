<?php

namespace App\Controller;


use App\Entity\PropertySearch;
use App\Entity\SalleSport;
use App\Form\PropertySearchType;

use App\Repository\SalleSportRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
class FhomeSalleController extends AbstractController
{
    /**
     * @Route("/homeSalle", name="fhomesalle")
     */
    public function index(Request  $request)
    {

 $propertySearch = new PropertySearch();
 $form = $this->createForm(PropertySearchType::class,$propertySearch);
 $form->handleRequest($request);

        $salleSport = [];
        if($form->isSubmitted() && $form->isValid()) {
            $nomSalle = $propertySearch->getNomSalle();
            if ($nomSalle != "")
                $salleSport = $this->getDoctrine()->getRepository(SalleSport::class)->findBy(['nomSalle' => $nomSalle]);
            else
                $salleSport = $this->getDoctrine()->getRepository(SalleSport::class)->findAll();
        }
        return  $this->render('fhome_salle/index.html.twig',[ 'form' =>$form->createView(), 'sallesS' => $salleSport]);
    }








    //    $salleSport = $repoSalle->findAll();
     //   $search = new RechercheSalle();
     //  $form = $this->createForm(RechercheSalleType::class, $search);

 // $form->handleRequest($request);
 // if($form->isSubmitted() && $form->isValid()){
//      $salleSport = $repoSalle->findWithSearch($search);
//  }

//        return $this->render('fhome_salle/index.html.twig', [
 //           'sallesS' => $salleSport,
          //  'search' =>$form->createView()
  //      ]);


    /**
     * @Route("/showSalleFront/{id}", name="salle_detaille")
     */
    public function show(?SalleSport $salle): Response {
           if(!$salle){
               return $this->redirectToRoute("");
           }

           return $this->render('fhome_salle/showSalleF.html.twig',['SalleSport'=>$salle]);
    }
}
//return $this->render('fhome_salle/showSalleF.html.twig', array('SalleSport' => $salle));