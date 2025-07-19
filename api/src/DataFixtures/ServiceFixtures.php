<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ServiceFixtures extends Fixture
{
    // Données extraites des fichiers TypeScript dans data/services/
    const SERVICES = [
        [
            'slug' => 'conseil-accompagnement-digital',
            'title' => 'Conseil & accompagnement digital',
            'description' => 'Profitez d\'un accompagnement sur mesure pour faire les bons choix techniques et stratégiques dans votre projet web ou digital.'
        ],
        [
            'slug' => 'creation-site-internet',
            'title' => 'Création de site internet',
            'description' => 'Un site à votre image, rapide, élégant et optimisé, pour donner à votre projet digital la visibilité qu\'il mérite.'
        ],
        [
            'slug' => 'developpement-sur-mesure',
            'title' => 'Développement sur mesure',
            'description' => 'Un développement adapté à vos besoins spécifiques : fonctionnalités avancées, automatisation, API, algorithmes... Réalisé avec précision et robustesse.'
        ],
        [
            'slug' => 'formation-vulgarisation',
            'title' => 'Formation et vulgarisation',
            'description' => 'Vous souhaitez mieux comprendre le web, les outils ou le code ? Je vous accompagne avec pédagogie pour démystifier la tech, à votre rythme.'
        ],
        [
            'slug' => 'integration-solutions-externes',
            'title' => 'Intégration de solutions externes',
            'description' => 'Boostez les fonctionnalités de votre site en y intégrant des outils ou services externes adaptés à vos besoins.'
        ],
        [
            'slug' => 'maintenance-support-technique',
            'title' => 'Maintenance & support technique',
            'description' => 'Gagnez en sérénité avec un site toujours fonctionnel, à jour et sécurisé. Je vous accompagne pour assurer sa longévité technique.'
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SERVICES as $serviceData) {
            $service = new Service();
            $service->setSlug($serviceData['slug']);
            $service->setTitle($serviceData['title']);
            $service->setDescription($serviceData['description']);

            $manager->persist($service);
        }

        $manager->flush();
    }
}
