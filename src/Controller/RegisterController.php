<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function index(Request $request, UserPasswordHasherInterface $hashedPwd, EntityManagerInterface $entityManager): Response
    {
        $user = new User(); 
        $form = $this->createForm(RegisterType::class, $user);	


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $form->get('password')->getData();
            $userPwd = $hashedPwd->hashPassword($user, $password);
            $user->setPassword($userPwd);

            // dd($user);	
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');


        }

        return $this->render('register/register.html.twig', [
            'registerform' => $form->createView()
        ]);
    }
}
