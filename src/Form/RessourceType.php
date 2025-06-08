<?php

namespace App\Form;

use App\Entity\Tag;
use App\Entity\Type;
use App\Entity\User;
use App\Entity\Ressource;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RessourceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de la ressource',
                'attr' => ['placeholder' => 'Indiquez le titre de la ressource'],
                'required' => true,
            ])
            ->add('filename', FileType::class, [
                'data_class' => null,
                'mapped' => false,
                'required' => true,
                'label' => 'Choisissez votre fichier',
                'attr' => ['class' => 'img-upload'],
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
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => true,
                'required' => true,
                'label' => 'Type de ressource',
                'placeholder' => 'Sélectionnez le type de ressource',
                'attr' => [
                    'class' => 'd-flex gap-3',
                ]

            ])
            ->add('tags', TextType::class, [
                'mapped' => false, // car on gère manuellement l'association
                'required' => false,
                'label' => 'Étiquettes (facultatif)',
                'attr' => [
                'class' => 'tagify-input', // on cible ce champ en JS
                'placeholder' => 'Ajoutez une ou des étiquettes',
                ]
            ])
            ->add('alt', TextType::class, [
                'label' => 'Texte alternatif',
                'attr' => ['placeholder' => 'Indiquez un texte alternatif pour l\'accessibilité'],
            ])
            ->add('description', null, [
                'label' => 'Description (optionnelle)',
                'attr' => ['rows' => 3, 'placeholder' => 'Ajoutez une description de la ressource'],
            ])
            -> add('submit', SubmitType::class, [
                'label' => 'Publier',
                'attr' => ['class' => 'btn btn-rs-primary px-4'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ressource::class,
        ]);
    }
}
