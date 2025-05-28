<?php

namespace App\Controller;

use App\Repository\RessourceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ExploreController extends AbstractController
{
    #[Route('/discover', name: 'app_discover')]
    public function index(RessourceRepository $ressourceRepository): Response
{
    $ressources = $ressourceRepository->findLatestPublic(10);

    return $this->render('explore/index.html.twig', [
        'ressources' => $ressources,
    ]);
}
}
