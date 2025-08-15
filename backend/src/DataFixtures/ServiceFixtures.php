<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ServiceFixtures extends Fixture
{
    // Define constants for service data based on frontend/data/services
    const SERVICES = [
        'conseil' => [
            'slug' => 'conseil-accompagnement-digital',
            'title' => 'Conseil & accompagnement digital',
            'description' => "Profitez d'un accompagnement sur mesure pour faire les bons choix techniques et stratégiques dans votre projet web ou digital.",
            'microServices' => [
                'Audit de votre site ou projet existant',
                'Recommandations techniques et stratégiques',
                "Conseils sur l'accessibilité, la performance et l'ergonomie",
                "Choix d'outils et de technologies adaptés à vos besoins",
                'Accompagnement dans la rédaction de cahiers des charges',
                'Suivi de projet ou accompagnement ponctuel sur demande'
            ],
            'img' => '/images/cons-accomp.png',
            'icon' => 'lucide:messages-square'
        ],
        'creation' => [
            'slug' => 'creation-site-internet',
            'title' => 'Création de site internet',
            'description' => "Un site internet professionnel, performant et adapté à vos besoins, pour valoriser votre activité et atteindre vos objectifs.",
            'microServices' => [
                'Sites vitrines pour présenter votre activité',
                'Sites institutionnels pour votre entreprise',
                'Landing pages pour vos campagnes marketing',
                'Blogs et sites de contenu',
                'Sites sur-mesure selon vos besoins spécifiques',
                'Intégration de solutions de paiement, formulaires, etc.'
            ],
            'img' => '/images/crea-web.png',
            'icon' => 'lucide:layout-template'
        ],
        'developpement' => [
            'slug' => 'developpement-sur-mesure',
            'title' => 'Développement sur mesure',
            'description' => "Des solutions web personnalisées pour répondre précisément à vos besoins spécifiques et optimiser vos processus métier.",
            'microServices' => [
                'Applications web sur mesure',
                "Interfaces d'administration personnalisées",
                'Intégration de systèmes tiers (API, services externes)',
                'Automatisation de tâches et de processus',
                'Développement de fonctionnalités spécifiques',
                'Solutions de gestion de contenu adaptées à vos besoins'
            ],
            'img' => '/images/dev-surmesur.png',
            'icon' => 'lucide:code-2'
        ],
        'formation' => [
            'slug' => 'formation-vulgarisation',
            'title' => 'Formation & vulgarisation',
            'description' => "Apprenez à maîtriser vos outils numériques et comprenez les enjeux techniques pour gagner en autonomie et faire les bons choix.",
            'microServices' => [
                "Formation à l'utilisation de votre site ou application",
                "Ateliers d'initiation aux technologies web",
                "Accompagnement à la prise en main d'outils numériques",
                'Vulgarisation de concepts techniques complexes',
                'Documentation personnalisée et supports de formation',
                'Conseils pour votre montée en compétences digitales'
            ],
            'img' => '/images/form-vulga.png',
            'icon' => 'lucide:book-open-check'
        ],
        'integration' => [
            'slug' => 'integration-solutions-externes',
            'title' => 'Intégration de solutions externes',
            'description' => "Connectez et synchronisez vos différents outils et plateformes pour un écosystème digital cohérent et efficace.",
            'microServices' => [
                'Intégration de CRM, ERP et autres logiciels métier',
                'Mise en place de solutions e-commerce',
                "Configuration d'outils marketing et d'analyse",
                'Synchronisation de données entre différentes plateformes',
                'Intégration de systèmes de paiement et de réservation',
                'Mise en place de workflows automatisés entre vos outils'
            ],
            'img' => '/images/inte-ext.png',
            'icon' => 'lucide:plug'
        ],
        'maintenance' => [
            'slug' => 'maintenance-support-technique',
            'title' => 'Maintenance & support',
            'description' => "Un accompagnement continu pour garantir le bon fonctionnement, la sécurité et l'évolution de vos outils digitaux.",
            'microServices' => [
                'Mises à jour régulières de sécurité',
                'Surveillance et optimisation des performances',
                "Sauvegardes et plans de reprise d'activité",
                'Support technique et résolution de problèmes',
                'Évolutions et améliorations continues',
                'Maintenance préventive et corrective'
            ],
            'img' => '/images/maint-st.png',
            'icon' => 'lucide:settings'
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SERVICES as $key => $serviceData) {
            $service = new Service();
            $service->setSlug($serviceData['slug']);
            $service->setTitle($serviceData['title']);
            $service->setDescription($serviceData['description']);
            $service->setMicroServices($serviceData['microServices']);
            $service->setImg($serviceData['img']);
            $service->setIcon($serviceData['icon']);
            $manager->persist($service);

            // Add a reference to this service for other fixtures to use
            $this->addReference('service-' . $key, $service);
        }

        $manager->flush();
    }
}
