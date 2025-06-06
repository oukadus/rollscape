<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class PasswordUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('currentPassword', PasswordType::class, [
                'label' => 'Votre mot de passe actuel',
                'attr' => ['placeholder' => 'Indiquez votre mot de passe actuel'],
                'mapped' => false,
            ]) 
            ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'required' => true,
            'mapped' => false,
            'first_options' => [
                'label' => 'Choississez votre nouveau mot de passe',
                'attr' => ['placeholder' => '********'],
                'invalid_message' => 'Les mots de passe ne correspondent pas.',
                'constraints' => [
                    new NotBlank(['message' => 'Le mot de passe est obligatoire']),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Le mot de passe doit contenir au moins {{limit}} caractères',
                        'max' => 14,
                        'maxMessage' => 'Le mot de passe doit contenir au plus {{limit}} caractères',
                    ]),
                    new Regex([
                            'pattern' => '/^(?=.[a-z])(?=.[A-Z])(?=.*\d).+$/',
                            'message' => 'Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule et un chiffre.',
                        ])

                ]
            ],
            'second_options' => [
                'label' => 'Confirmer votre nouveau mot de passe',
                'attr' => ['placeholder' => '********']
            ]
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Modifier mon mot de passe',
            'attr' => ['class' => 'btn btn-primary mt-3']
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
