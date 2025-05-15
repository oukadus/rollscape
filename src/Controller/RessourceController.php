<?php

namespace App\Controller;

use App\Entity\Tag;
use DateTimeImmutable;
use App\Entity\Ressource;
use App\Form\RessourceForm;
use App\Form\RessourceType;
use App\Repository\RessourceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/ressource')]
final class RessourceController extends AbstractController
{
    #[Route(name: 'app_ressource_index', methods: ['GET'])]
    public function index(RessourceRepository $ressourceRepository, Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        return $this->render('ressource/index.html.twig', [
            'ressources' => $ressourceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ressource_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $ressource = new Ressource();
        $form = $this->createForm(RessourceType::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Associer l'utilisateur connecté
            $ressource->setUser($this->getUser());

            // Gérer l'upload du fichier
            $uploadedFile = $form->get('filename')->getData();
            if ($uploadedFile) {
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename)->lower();
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $uploadedFile->guessExtension();

                try {
                    $uploadedFile->move(
                        $this->getParameter('ressource_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('danger', 'Erreur lors de l\'upload du fichier.');
                    return $this->redirectToRoute('app_ressource_new');
                }

                $ressource->setFilename($newFilename);
            }

            
            // Ajout à la collection du type (bidirectionnel)
            $type = $ressource->getType();
            $type->addRessource($ressource);

            // Gestion des tags
            $tagsInput = $form->get('tags')->getData(); // "dnd, fantasy"
            $tagNames = array_filter(array_map('trim', explode(',', $tagsInput)));

            foreach ($tagNames as $name) {
                $tag = $entityManager->getRepository(Tag::class)->findOneBy(['name' => $name]);
                if ($tag) {
                    $ressource->addTag($tag);
                }
            }

            // Enregistrement en base
            $ressource->setCreatedAt(new DateTimeImmutable());
            $entityManager->persist($ressource);
            $entityManager->flush();

            

            $this->addFlash('success', 'Ressource créée avec succès.');
            return $this->redirectToRoute('app_ressource_index');
        }


        $allTags = $entityManager->getRepository(Tag::class)->findAll();
        $tagNames = array_map(fn($tag) => $tag->getName(), $allTags);

        return $this->render('ressource/new.html.twig', [
            'ressource' => $ressource,
            'form' => $form,
            'tags' => $tagNames, // envoyé au JavaScript
        ]);
    }

    #[Route('/{id}', name: 'app_ressource_show', methods: ['GET'])]
    public function show(Ressource $ressource): Response
    {
        return $this->render('ressource/show.html.twig', [
            'ressource' => $ressource,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ressource_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ressource $ressource, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(RessourceType::class, $ressource);
        $form->handleRequest($request);
        // Tous les tags possibles pour la whitelist Tagify
        $allTags = $entityManager->getRepository(Tag::class)->findAll();
        $tagNames = array_map(fn($tag) => $tag->getName(), $allTags);

        // Tags déjà liés à la ressource
        $existingTagNames = $ressource->getTags()->map(fn($tag) => $tag->getName())->toArray();

        if ($form->isSubmitted() && $form->isValid()) {
            // Gérer les tags
            // Supprimer les anciens tags pour éviter les doublons
            foreach ($ressource->getTags() as $existingTag) {
            $ressource->removeTag($existingTag);
            }
            // Récupérer les nouveaux tags depuis le champ texte
            $tagsInput = $form->get('tags')->getData(); 
            $tagNamesInput = array_filter(array_map('trim', explode(',', $tagsInput)));


            // Traitement du fichier
            // Gérer le fichier uniquement s’il est remplacé
            $uploadedFile = $form->get('filename')->getData();
            if ($uploadedFile) {
                // 1. Supprimer l’ancien fichier s’il existe
                $oldFilename = $ressource->getFilename();
                if ($oldFilename) {
                    $oldFilePath = $this->getParameter('ressource_directory') . '/' . $oldFilename;
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename)->lower();
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $uploadedFile->guessExtension();

                try {
                    $uploadedFile->move(
                        $this->getParameter('ressource_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('error', 'Erreur lors de l\'upload du fichier.');
                    return $this->redirectToRoute('app_ressource_edit', ['id' => $ressource->getId()]);
                }

                $ressource->setFilename($newFilename);
            }

            // Mise à jour du type (facultatif mais sûr pour synchronisation)
            $type = $ressource->getType();
            $type->addRessource($ressource);

            // Mise à jour des tags
            foreach ($tagNamesInput as $name) {
                $tag = $entityManager->getRepository(Tag::class)->findOneBy(['name' => $name]);
                if ($tag) {
                    $ressource->addTag($tag);
                }
            }

            // Date de mise à jour
            $ressource->setUpdatedAt(new \DateTimeImmutable());

            $entityManager->flush();

            $this->addFlash('success', 'Ressource modifiée avec succès.');
            return $this->redirectToRoute('app_ressource_index');
        }

        $allTags = $entityManager->getRepository(Tag::class)->findAll();
        $tagNames = array_map(fn($tag) => $tag->getName(), $allTags);

        return $this->render('ressource/edit.html.twig', [
            'ressource' => $ressource,
            'form' => $form,
            'tags' => $tagNames,
            'selectedTags' => $existingTagNames,
        ]);
    }

    #[Route('/{id}', name: 'app_ressource_delete', methods: ['POST'])]
    public function delete(Request $request, Ressource $ressource, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ressource->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($ressource);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_ressource_index', [], Response::HTTP_SEE_OTHER);
    }
}
