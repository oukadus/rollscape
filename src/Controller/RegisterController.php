<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function index(Request $request, UserPasswordHasherInterface $hashedPwd, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $user = new User(); 
        $form = $this->createForm(RegisterType::class, $user);	


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $form->get('password')->getData();
            $userPwd = $hashedPwd->hashPassword($user, $password);
            $user->setPassword($userPwd);

            $firstname = $form->get('firstname')->getData();
            $lastname = $form->get('lastname')->getData();
            $annee= Date('Y');
            // Générer un slug unique pour le nom d'utilisateur
            $slugUsername = strtolower($slugger->slug($firstname . $lastname . $annee));

            $user->setUsername($slugUsername);

            // Ajouter une image de profil par défaut
            $user->setPicture('default.png'); // Assure-toi que le fichier existe dans ton dossier public/images/profils/


            // dd($user);	
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.');
            return $this->redirectToRoute('app_login');


        }

        return $this->render('register/register.html.twig', [
            'registerform' => $form->createView()
        ]);
    }
}
