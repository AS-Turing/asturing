<?php

namespace App\Controller\Admin;

use App\Entity\CompanyInfo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;

class CompanyInfoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CompanyInfo::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('companyName', 'Nom de l\'entreprise'),
            TextField::new('tagline', 'Slogan'),
            TextareaField::new('description', 'Description'),
            
            TextField::new('phone', 'Téléphone'),
            EmailField::new('email', 'Email'),
            
            TextareaField::new('address', 'Adresse'),
            TextField::new('city', 'Ville'),
            TextField::new('zipCode', 'Code postal'),
            TextField::new('region', 'Région'),
            TextField::new('country', 'Pays'),
            
            ArrayField::new('socialNetworks', 'Réseaux sociaux')
                ->setHelp('Format: {"github": "https://...", "linkedin": "https://..."}'),
            
            TextField::new('logoPath', 'Chemin du logo'),
            TextField::new('siret', 'SIRET'),
            TextField::new('tva', 'TVA'),
            
            ArrayField::new('businessHours', 'Horaires')
                ->setHelp('Format JSON: {"monday": {"open": "09:00", "close": "18:00"}}'),
        ];
    }
}
