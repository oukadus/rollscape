<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Repository\TagRepository;
use App\Repository\TypeRepository;
use App\Repository\RessourceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{
     #[Route('/', name: 'app_home')]
    public function index(RessourceRepository $ressourceRepository, TypeRepository $typeRepository, Request $request, EntityManagerInterface $entityManager, PaginatorInterface $paginator): Response
    {
        // Afficher la liste des ressources
        $user = $this->getUser();
        // Search bar
        $type = $request->query->get('type');
        $types = $typeRepository->findAll();
        $search = $request->query->get('search');
        $tags = $entityManager->getRepository(Tag::class)->findTagsByUsage();

         $query = $ressourceRepository->createQueryForAll();

        $pagination = $paginator->paginate($query, $request->query->getInt('page', 1), 12);

        if ($user) {
            // Utilisateur connecté : on affiche le la page d'accueil"
            return $this->render('home/index.html.twig', [
                'pagination' => $pagination,
                'ressources' => $pagination,
                'search' => $search,
                'types' => $types,
                'type' => $type,
                'tags' => $tags,
            ]);
        }

        // Visiteur : landing page
        return $this->render('home/landing.html.twig');
    }

    #[Route('/tag/{slug}', name: 'app_tag_filter')]
    public function filterByTag(string $slug, TagRepository $tagRepository, RessourceRepository $ressourceRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $tag = $tagRepository->findOneBy(['slug' => $slug]);

        $queryBuilder = $ressourceRepository->getQueryBuilderByTag($tag);

        $pagination = $paginator->paginate(
            $queryBuilder, // ✅ pas un tableau
            $request->query->getInt('page', 1),
            12
        );

        if (!$tag) {
            throw $this->createNotFoundException('Tag introuvable.');
        }

        $ressources = $ressourceRepository->getQueryBuilderByTag($tag); // méthode qu'on crée juste après

        return $this->render('home/index.html.twig', [
            'ressources' => $pagination,
            'selectedTag' => $tag,
            'pagination' => $pagination,  
            'tags' => $tagRepository->findTagsByUsage()
        ]);
    }
}


