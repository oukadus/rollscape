<?php

namespace App\Controller;

use App\Form\ProfileUserType;
use App\Form\PasswordUserType;
use App\Repository\TypeRepository;
use Symfony\Component\Form\FormError;
use App\Controller\RessourceController;
use App\Repository\RessourceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(RessourceRepository $ressourcerepository, TypeRepository $typeRepository, Request $request): Response
    {
        // Search bar
        $type = $request->query->get('type');
        $types = $typeRepository->findAll();
        $search = $request->query->get('search');
        return $this->render('account/index.html.twig', [
            'user' => $this->getUser(),
            'search' => $search,
            'types' => $types,
            'type' => $type,
        ]);
    }

    #[Route('/account/password', name: 'app_account_password')]
    public function password(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager, RessourceRepository $ressourcerepository, TypeRepository $typeRepository): Response
    {
        

        $user = $this->getUser();
        $form = $this->createForm(PasswordUserType::class, $user);
        $form->handleRequest($request);

        // Search bar
        $type = $request->query->get('type');
        $types = $typeRepository->findAll();
        $search = $request->query->get('search');

        if ($form->isSubmitted() && $form->isValid()) {
            $currentPassword = $form->get('currentPassword')->getData();
            $newPassword = $form->get('password')->getData();

            $isValid = $passwordHasher->isPasswordValid($user, $currentPassword);
            
            if (!$isValid) {
                $form->get('currentPassword')->addError(new FormError('Le mot de passe actuel est incorrect. Veuillez réessayer.'));
            } else { 
                $hashed = $passwordHasher->hashPassword($user, $newPassword);
                $user->setPassword($hashed);
                $entityManager->flush();

                $this->addFlash('success', 'Mot de passe modifié avec succès.');
                return $this->redirectToRoute('app_account');
            }

        
        }

        return $this->render('account/password.html.twig', [
            'modifyPwd' => $form->createView(),
            'types' => $types,
            'type' => $type,
            'search' => $search,
        ]);
    }

    #[Route('/account/profile', name: 'app_account_profile')]
    public function profile(Request $request, EntityManagerInterface $entityManager,  SluggerInterface $slugger, RessourceRepository $ressourcerepository, TypeRepository $typeRepository): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(ProfileUserType::class, $user);
        $form->handleRequest($request);
        $picture = $form->get('picture')->getData();

        // Search bar
        $type = $request->query->get('type');
        $types = $typeRepository->findAll();
        $search = $request->query->get('search');

        if ($form->isSubmitted() && $form->isValid()) {
            if ($picture) {
                // Supprimer l'ancienne image si elle existe
                $oldPicture = $user->getPicture();
                if ($oldPicture && file_exists($this->getParameter('profile_directory') . '/' . $oldPicture)) {
                    unlink($this->getParameter('profile_directory') . '/' . $oldPicture);
                }


                $originalPicture = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                $safePicture = $slugger->slug($originalPicture);
                $newPicture = $safePicture . '-' . uniqid() . '.' . $picture->guessExtension();
                $picture->move($this->getParameter('profile_directory'), $newPicture);
                $user->setPicture($newPicture);
            }
            // dd($user);

            $entityManager->flush();
            $this->addFlash('success', 'Votre profil a été modifié avec succès.');
            return $this->redirectToRoute('app_account');
        }






        return $this->render('account/modify.html.twig', [
            'modifyProfile' => $form->createView(),
            'form' => $form,
            'types' => $types,
            'type' => $type,
            'search' => $search,
        ]);
    }
}

