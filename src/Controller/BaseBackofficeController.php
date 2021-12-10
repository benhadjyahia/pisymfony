<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseBackofficeController extends AbstractController
{
    /**
     * @Route("/basebackoffice", name="base_backoffice")
     */
    public function index(): Response
    {
        return $this->render('base_backoffice/index.html.twig', [
            'controller_name' => 'BaseBackofficeController',
        ]);
    }
}
