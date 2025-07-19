<?php

namespace App\DataFixtures;

use App\Entity\MicroService;
use App\Repository\ServiceRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MicroServieFixtures extends Fixture implements DependentFixtureInterface
{
    // Données extraites des fichiers TypeScript dans data/services/
    const MICRO_SERVICES = [
        // conseil-accompagnement-digital
        [
            'service_slug' => 'conseil-accompagnement-digital',
            'micro_services' => [
                "Audit de votre site ou projet existant",
                "Recommandations techniques et stratégiques",
                "Conseils sur l'accessibilité, la performance et l'ergonomie",
                "Choix d'outils et de technologies adaptés à vos besoins",
                "Accompagnement dans la rédaction de cahiers des charges",
                "Suivi de projet ou accompagnement ponctuel sur demande"
            ]
        ],
        // creation-site-internet
        [
            'service_slug' => 'creation-site-internet',
            'micro_services' => [
                'Conception UX/UI avec maquettes sur mesure',
                'Intégration responsive (mobile, tablette, desktop)',
                'Optimisation SEO technique (balises, performance)',
                'Installation sur votre hébergement (OVH, o2switch…)',
                'Formation à la prise en main de votre site'
            ]
        ],
        // developpement-sur-mesure
        [
            'service_slug' => 'developpement-sur-mesure',
            'micro_services' => [
                "Développement de fonctionnalités personnalisées",
                "Création de tableaux de bord / back-office spécifiques",
                "Intégration d'API externes (Stripe, Airtable, Notion, etc.)",
                "Automatisation de processus métiers",
                "Développement d'algorithmes métiers",
                "Mise en place de cron jobs, gestion de flux de données"
            ]
        ],
        // formation-vulgarisation
        [
            'service_slug' => 'formation-vulgarisation',
            'micro_services' => [
                "Sensibilisation aux enjeux du web (SEO, performance, accessibilité)",
                "Initiation à HTML/CSS ou JavaScript",
                "Découverte des CMS (WordPress, Strapi...)",
                "Formation à l'utilisation de votre site ou back-office",
                "Sessions de vulgarisation technique (serveurs, bases de données, etc.)",
                "Coaching sur la gestion de projet web"
            ]
        ],
        // integration-solutions-externes
        [
            'service_slug' => 'integration-solutions-externes',
            'micro_services' => [
                "Connexion à des APIs (Google Maps, Stripe, Mailchimp, etc.)",
                "Ajout de modules de paiement ou de réservation",
                "Mise en place de services tiers (chat en ligne, analytics…)",
                "Synchronisation avec vos outils métiers",
                "Intégration de CRM, newsletters, ERP, etc.",
                "Documentation technique pour l'équipe en interne"
            ]
        ],
        // maintenance-support-technique
        [
            'service_slug' => 'maintenance-support-technique',
            'micro_services' => [
                "Mises à jour de sécurité (CMS, plugins, dépendances)",
                "Sauvegardes régulières",
                "Correction de bugs ou anomalies",
                "Assistance en cas de panne ou d'incident",
                "Optimisation continue des performances",
                "Ajout de contenus ou de fonctionnalités simples"
            ]
        ]
    ];

    private ServiceRepository $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function getDependencies(): array
    {
        return [
            ServiceFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::MICRO_SERVICES as $microServiceData) {
            $service = $this->serviceRepository->findOneBy(['slug' => $microServiceData['service_slug']]);

            if (!$service) {
                throw new \Exception("Service not found with slug: {$microServiceData['service_slug']}");
            }

            foreach ($microServiceData['micro_services'] as $label) {
                $microService = new MicroService();
                $microService->setLabel($label);
                $microService->setService($service);

                $manager->persist($microService);
            }
        }

        $manager->flush();
    }
}
