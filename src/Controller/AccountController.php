<?php

namespace App\Controller;

use App\Form\ProfileUserType;
use App\Form\PasswordUserType;
use Symfony\Component\Form\FormError;
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
    public function index(): Response
    {
        return $this->render('account/index.html.twig');
    }

    #[Route('/account/password', name: 'app_account_password')]
    public function password(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {

        $user = $this->getUser();
        $form = $this->createForm(PasswordUserType::class, $user);
        $form->handleRequest($request);

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
        ]);
    }

    #[Route('/account/profile', name: 'app_account_profile')]
    public function profile(Request $request, EntityManagerInterface $entityManager,  SluggerInterface $slugger): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(ProfileUserType::class, $user);
        $form->handleRequest($request);
        $picture = $form->get('picture')->getData();

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
            'form' => $form
        ]);
    }
}

