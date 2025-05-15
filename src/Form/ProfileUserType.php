<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProfileUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('picture', FileType::class, [
                'data_class' => null,
                'mapped' => false,
                'required' => false,
                'label' => 'Photo',
                'constraints' => [
                    new File([
                        'maxSize' => '3092k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/webp'
                        ],
                        'mimeTypesMessage' => 'Merci d\'insérer une image valide.',
                    ]),

                ]
            ])
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
            ->add('username', TextType::class, [
                'label' => 'Nom d\'utilisateur',
                'attr' => ['placeholder' => 'Indiquez votre nom d\'utilisateur'],
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Le nom d\'utilisateur doit contenir au moins {{limit}} caractères',
                        'max' => 30,
                        'maxMessage' => 'Le nom d\'utilisateur doit contenir au plus {{limit}} caractères'
                    ])
                ]
            ])
            ->add('birthdate', BirthdayType::class, [
                    'label' => 'Date de naissance',
                    'input' => 'datetime_immutable',
                ])
            ->add('description', TextareaType::class, [
                    'label' => 'Description',
                    'attr' => [
                        'rows' => '5',
                    ]
                ])
            ->add('Submit', SubmitType::class, [

                'label' => 'Enregistrer',
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
