<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
     #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        if ($this->getUser()) {
            // Utilisateur connecté : on affiche le la page d'accueil"
            return $this->render('home/index.html.twig');
        }

        // Visiteur : landing page
        return $this->render('home/landing.html.twig');
    }
}


