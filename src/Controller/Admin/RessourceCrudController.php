<?php

namespace App\Controller\Admin;

use App\Entity\Ressource;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RessourceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ressource::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Ressource')
            ->setEntityLabelInPlural('Ressources')
            // ->setDateFormat('...')
            // ...
        ;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->OnlyOnIndex(),
            TextField::new('title')->setLabel('Nom du fichier'),
            ImageField::new('filename')->setLabel('Fichier')
                ->setBasePath('images/ressources')
                ->setUploadDir('public/images/ressources')
                ->setHelp('Fichier de la ressource')
                ->hideOnForm(),
            DateField::new('createdAt')->setLabel('Crée le')->hideOnForm(),
            DateField::new('updatedAt')->setLabel('Mise à jour le')->hideOnForm(),
            TextField::new('user.username')->setLabel('Auteur')->hideOnForm(),
            TextField::new('alt')->setLabel('Texte alternatif')
                ->setHelp('Texte alternatif pour l\'accessibilité')->hideOnIndex(),
            AssociationField::new('type')->setLabel('Type'),
            AssociationField::new('tags')
            ->setLabel('Étiquettes')
            ->formatValue(function ($value, $entity) {
            return implode(', ', $entity->getTags()->map(fn($tag) => (string) $tag)->toArray());
            })
            ->setFormTypeOptions([
                'by_reference' => false, // important pour ManyToMany
                'multiple' => true,
            ])
        ];
    }

}
