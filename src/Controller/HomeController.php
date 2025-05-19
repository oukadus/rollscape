<?php

namespace App\Controller;

use App\Repository\TypeRepository;
use App\Repository\RessourceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{
     #[Route('/', name: 'app_home')]
    public function index(RessourceRepository $ressourceRepository, TypeRepository $typeRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Afficher la liste des ressources
        $user = $this->getUser();
        // Search bar
        $type = $request->query->get('type');
        $types = $typeRepository->findAll();
        $search = $request->query->get('search');


        if ($user) {
            // Utilisateur connecté : on affiche le la page d'accueil"
            return $this->render('home/index.html.twig', [
                'ressources' => $ressourceRepository->findAll(),
                'search' => $search,
                'types' => $types,
                'type' => $type,
            ]);
        }

        // Visiteur : landing page
        return $this->render('home/landing.html.twig');
    }
}


