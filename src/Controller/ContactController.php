<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\EmailModel;
use App\Entity\User;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use App\services\EmailSender;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/contacti")
 */
class ContactController extends AbstractController
{


    /**
     * @Route("/new", name="contact_new", methods={"GET","POST"})
     */
    public function new(Request $request, EmailSender $emailSender): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //var_dump('malek');die();
            $user = (new User())
                ->setEmail('mohamedmalek.saidi@esprit.tn');
            $email = (new EmailModel())
                ->setTitle("hello")
                ->setContent('content')
                ->setSubject('subject');
            $emailSender->sendEmailByMailJet($user,$email);



        }

        return $this->render('contact/new.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/", name="contact_index", methods={"GET","POST"})
     */
    public function index(Request $request): Response
    {
        var_dump('hello');die();
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('contact_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('contact/new.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }


}
