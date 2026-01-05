<?php

namespace App\Controller\Admin;

use App\Entity\Specification;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class SpecificationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Specification::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Question')
            ->setEntityLabelInPlural('Questions')
            ->setDefaultSort(['displayOrder' => 'ASC']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('displayOrder', 'Ordre')->setHelp('Ordre d\'affichage de la question'),
            TextField::new('label', 'Question'),
            ChoiceField::new('type', 'Type de champ')
                ->setChoices([
                    'Texte court' => 'text',
                    'Texte long' => 'textarea',
                    'Email' => 'email',
                    'Téléphone' => 'tel',
                    'Nombre' => 'number',
                    'Date' => 'date',
                    'Sélection' => 'select',
                    'Radio' => 'radio',
                    'Checkbox' => 'checkbox',
                ]),
            TextField::new('placeholder', 'Placeholder'),
            BooleanField::new('required', 'Obligatoire'),
            TextField::new('pattern', 'Pattern de validation'),
            IntegerField::new('min', 'Min')->hideOnIndex(),
            IntegerField::new('max', 'Max')->hideOnIndex(),
            TextareaField::new('errorMessage', 'Message d\'erreur')->hideOnIndex(),
            TextareaField::new('tooltip', 'Tooltip')->hideOnIndex(),
            TextareaField::new('typeOptions', 'Options (JSON)')->hideOnIndex()
                ->setHelp('Format: [{"label": "Option 1", "value": "val1"}]'),
        ];
    }
}
