<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstname', TextType::class, [
            'label' => 'Prénom',
            'attr' => ['placeholder' => 'Indiquez votre prénom'],
            'constraints' => [
                new NotBlank(['message' => 'Le prénom est obligatoire']),
                new Length([
                    'min' => 3,
                    'minMessage' => 'Le prénom doit contenir au moins {{limit}} caractères',
                    'max' => 30,
                    'maxMessage' => 'Le prénom doit contenir au plus {{limit}} caractères'
                ])
            ]
        ])
        ->add('lastname', TextType::class, [
            'label' => 'Nom',
            'attr' => ['placeholder' => 'Indiquez votre nom'],
            'constraints' => [
                new NotBlank(['message' => 'Le nom est obligatoire']),
                new Length([
                    'min' => 3,
                    'minMessage' => 'Le nom doit contenir au moins {{limit}} caractères',
                    'max' => 30,
                    'maxMessage' => 'Le nom doit contenir au plus {{limit}} caractères'
                ])
            ]
        ])
        ->add('email', EmailType::class, [
            'label' => 'Email',
            'attr' => ['placeholder' => 'Indiquez votre adresse email'],
            'constraints' => [
                new NotBlank(['message' => 'L\'email est obligatoire']),
            ]
        ])
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'required' => true,
            'first_options' => [
                'label' => 'Choississez votre mot de passe',
                'attr' => ['placeholder' => '********'],
                'invalid_message' => 'Les mots de passe ne correspondent pas.',
                'constraints' => [
                    new NotBlank(['message' => 'Le mot de passe est obligatoire']),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Le mot de passe doit contenir au moins 8 caractères',
                        'max' => 14,
                        'maxMessage' => 'Le mot de passe doit contenir au plus 14 caractères',
                    ])

                ]
            ],
            'second_options' => [
                'label' => 'Confirmer votre mot de passe',
                'attr' => ['placeholder' => '********']
            ]
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'S\'inscrire', 
            'attr' => [
                'class' => 'btn btn-rs-primary w-100 mt-2',
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
