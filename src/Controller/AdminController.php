<?php

namespace App\Controller;

use App\Entity\CategoryC;
use App\Repository\PlanningRepository;
use App\Repository\CategoryCRepository;
use App\Form\CategoryCType;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/stats", name="stats")
     */
    public function statistiques(CategoryCRepository $categRepo)
    {
        // On va chercher toutes les catégories
        $categories = $categRepo->findAll();

        $categNom = [];
        $categColor = [];
        $categCount = [];

        // On "démonte" les données pour les séparer tel qu'attendu par ChartJS
        foreach ($categories as $categorie) {
            $categNom[] = $categorie->getLabell();
            $categColor[] = $categorie->getColor();
            $categCount[] = count($categorie->getPlannings());
        }

        return $this->render('admin/stats.html.twig', [
            'categNom' => json_encode($categNom),
            'categColor' => json_encode($categColor),
            'categCount' => json_encode($categCount),

        ]);

    }
}
