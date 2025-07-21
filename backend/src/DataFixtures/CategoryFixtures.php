<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    CONST categories = [
        'Informations personnelles',
        'Entreprise',
        'Objectifs du projet',
        'Cibles & utilisateurs',
        'Contenu',
        'Design & expérience utilisateur',
        'Fonctionnalités attendues',
        'Marketing & référencement',
        'Technique & infrastructure',
        'Sécurité & conformité',
        'Collaboration & suivi',
        'Maintenance & évolution',
        'Contraintes & remarques',
        'Budget',
        'Planification',
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::categories as $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
        }
        $manager->flush();
    }
}
