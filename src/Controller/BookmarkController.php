<?php

namespace App\Controller;

use App\Repository\TypeRepository;
use App\Repository\RessourceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class BookmarkController extends AbstractController
{
    #[Route('/bookmarks', name: 'app_bookmark')]
    public function index(RessourceRepository $ressourceRepository, TypeRepository $typeRepository, Request $request): Response
    {
        // Search bar
        $type = $request->query->get('type');
        $types = $typeRepository->findAll();
        $search = $request->query->get('search');

        return $this->render('bookmark/index.html.twig',[
            'search' => $search,
            'types' => $types,
            'type' => $type,
        ]);
    }

    #[Route('/bookmark/add/{id}', name: 'app_bookmark_add')]
    public function addBookmark(RessourceRepository $RessourceRepository, int $id, EntityManagerInterface $entityManager, Request $request ): Response
    {
        $user = $this->getUser();
        $ressource = $RessourceRepository->findOneById($id); 

        if ($ressource) {
            $user->addBookmark($ressource);
            $entityManager->flush();
        } 
        
        else {
            $this->addFlash('danger', 'Ressource non trouvée.');
        }

            return $this->redirect($request->headers->get('referer'));



    }


    #[Route('/bookmark/remove/{id}', name: 'app_bookmark_remove')]
    public function removeBookmark(RessourceRepository $RessourceRepository, int $id, EntityManagerInterface $entityManager, Request $request): Response
    {
        $user = $this->getUser();
        $ressource = $RessourceRepository->findOneById($id); 

        if ($ressource) {
            $user->removeBookmark($ressource);
            $entityManager->flush();
        } 
        
        else {
            $this->addFlash('danger', 'Ressource non trouvée.');
        }

        $referer = $request->headers->get('referer');

        if ($referer && str_contains($referer, '/bookmarks')) {
            $this->addFlash('success', 'Favori supprimé avec succès.');
        }
        
        return $this->redirect($request->headers->get('referer'));

    }
}


    



