<?php

namespace App\Controller;


use App\Entity\Commsales;
use App\Entity\PropertySearch;
use App\Entity\SalleSport;
use App\Form\CommsalesType;
use App\Form\PropertySearchType;

use App\Form\SearchSalleType;
use App\Repository\CommsalesRepository;
use App\Repository\SalleSportRepository;

use Dompdf\Options;
use Dompdf\Dompdf;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Doctrine\Common\Annotations\AnnotationReader;
use Twilio\Rest\Client;

class FhomeSalleController extends Controller

{
    /**
     * @Route("/homeSalle", name="fhomesalle")
     */
    public function index(Request $request): Response
    {

        $sal = $this->getDoctrine()->getRepository(SalleSport::class)->findAll();

        $salles = $this->get('knp_paginator')->paginate(
            $sal,
            $request->query->getInt('page', 1), 6
        );


        return $this->render('fhome_salle/index.html.twig', array('sallesS' => $salles));


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
    public function show(?SalleSport $salle, CommsalesRepository $commsalesRepository, Request $request): Response
    {
        if (!$salle) {
            return $this->redirectToRoute("");
        }
        $commsale = new Commsales();
        $form = $this->createForm(CommsalesType::class, $commsale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commsale);
            $entityManager->flush();

            return $this->redirectToRoute('fhomesalle', [], Response::HTTP_SEE_OTHER);
        }


        return $this->render('fhome_salle/showSalleF.html.twig',
            ['SalleSport' => $salle,
                'commsales' => $commsalesRepository->findAll(),
                'commsale' => $commsale,
                'form' => $form->createView(),


            ]);
    }

//recherche avancéé w rabi ysahal

    /*
    public function searchSalle(Request $request , SalleSportRepository $salleSportRepository){


        $searchSalleForm = $this->createForm(SearchSalleType::class);
        if($searchSalleForm->handleRequest($request)->isSubmitted() && $searchSalleForm->isValid()){
            $ss = $searchSalleForm->getData();
            $salle = $salleSportRepository->searchsalle($ss);
        }
        return $this->render('fhome_salle/searchSalle.html.twig',['search' =>$searchSalleForm->createView()]);

    }
    */
    /*
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $posts =  $em->getRepository('AppBundle:Post')->findEntitiesByString($requestString);
        if(!$posts) {
            $result['posts']['error'] = "Post Not found :( ";
        } else {
            $result['posts'] = $this->getRealEntities($posts);
        }
        return new Response(json_encode($result));
    }
    public function getRealEntities($posts){
        foreach ($posts as $posts){
            $realEntities[$posts->getId()] = [$posts->getPhoto(),$posts->getTitle()];

        }
        return $realEntities;
    }




*/


    /**
     * @Route("/facture", name="facture_pdf", methods={"GET"})
     */
    public function newFacture(SalleSportRepository $salleSportRepository)
    {

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $salles = $salleSportRepository->findAll();
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('fhome_salle/facture.html.twig', ['salles' => $salles,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Store PDF Binary Data
        $output = $dompdf->output();

        // In this case, we want to write the file in the public directory
        $publicDirectory = $this->get('kernel')->getProjectDir() . '/public';
        // e.g /var/www/project/public/mypdf.pdf
        $pdfFilepath = $publicDirectory . '/mypdf.pdf';

        // Write file to the desired path
        file_put_contents($pdfFilepath, $output);

        // Send some text response
        return new Response("The PDF file has been succesfully generated !");
    }



    /**
     * @Route("/search1", name="search1",methods={"POST"})
     */
    public function search(Request $request, PaginatorInterface $paginator): Response
    {
        $nom = $request->request->get('name');
        $donnees = $this->getDoctrine()->getRepository(SalleSport::class)->findByWord($nom);


        $array = [];
        foreach ($donnees as $e) {
            $object = (object)[
                'nomSalle' => $e->getNomSalle(),
                'id' => $e->getId(),
                'adressSalle' => $e->getAdressSalle(),
                'imageName' => $e->getImageName(),
                'price' => $e->getPrice(),
                'empty' => "0"
            ];
            array_push($array, $object);
        }
        if (empty($array)) {
            $don = $this->getDoctrine()->getRepository(SalleSport::class)->findAll();
            foreach ($don as $e) {
                $object = (object)[
                    'nomSalle' => $e->getNomSalle(),
                    'id' => $e->getId(),
                    'adressSalle' => $e->getAdressSalle(),
                    'imageName' => $e->getImageName(),
                    'price' => $e->getPrice(),
                    'empty' => "1"
                ];
                array_push($array, $object);
            }
        }
        return new JsonResponse($array);


    }


    /**
     * @Route("/res/sms", name="reservation", methods={"POST"})
     */
    public function reservation(Request $request): Response
    {
        $num= $request->request->get('numero');


        // Your Account SID and Auth Token from twilio.com/console
        $sid = 'AC9e63e60f8d5b9ac2d7a87fef33b53ab6';
        $token = '334fc4f57c9d84c6f168a06757811eac';
        $client = new Client($sid, $token);

// Use the client to do fun stuff like send text messages!
        $client->messages->create(
        // the number you'd like to send the message to

            $num,
            [
                // A Twilio phone number you purchased at twilio.com/console
                'from' => '+13514449201',

                // the body of the text message you'd like to send
                'body' => 'bonjour votre abonnement est bien recus!'
            ]
        );
        return new Response("true");
    }
}
//return $this->render('fhome_salle/showSalleF.html.twig', array('SalleSport' => $salle));