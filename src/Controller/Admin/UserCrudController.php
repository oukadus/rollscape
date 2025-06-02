<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Utilisateur')
            ->setEntityLabelInPlural('Utilisateurs')
            // ->setDateFormat('...')
            // ...
        ;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('email')->setLabel('Email'),
            textField::new('firstname')->setLabel('Prénom'),
            textField::new('lastname')->setLabel('Nom'),
            TextField::new('username')->setLabel('Nom d\'utilisateur')->hideOnForm(),
            ChoiceField::new('roles', 'Roles')->setLabel('Permissions') ->setChoices(
                [
                    'USER' => 'ROLE_USER',
                    'ADMIN' => 'ROLE_ADMIN'
                ]
            )->allowMultipleChoices()
        ];
    }
    
}
