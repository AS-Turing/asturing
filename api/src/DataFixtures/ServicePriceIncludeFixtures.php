<?php

namespace App\DataFixtures;

use App\Entity\ServicePrice;
use App\Entity\ServicePriceInclude;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ServicePriceIncludeFixtures extends Fixture implements DependentFixtureInterface
{
    // Données extraites des fichiers TypeScript dans data/services/
    const SERVICE_PRICE_INCLUDES = [
        // conseil-accompagnement-digital
        [
            'service_slug' => 'conseil-accompagnement-digital',
            'price_includes' => [
                'Consultation Express' => [
                    "Échange d'une heure (visio ou téléphone)",
                    "Compte rendu synthétique avec recommandations",
                    "Support par mail pendant 7 jours"
                ],
                'Accompagnement Projet' => [
                    "Audit approfondi",
                    "Sessions régulières de suivi",
                    "Conseils techniques personnalisés",
                    "Rédaction de livrables (cahier des charges, roadmap...)"
                ],
                'Coaching Digital' => [
                    "10h d'accompagnement à utiliser librement",
                    "Support continu pendant 30 jours",
                    "Sessions planifiées selon votre planning",
                    "Suivi d'avancement et conseils actionnables"
                ]
            ]
        ],
        // creation-site-internet
        [
            'service_slug' => 'creation-site-internet',
            'price_includes' => [
                'Essentiel' => [
                    "One page vitrine",
                    "Responsive mobile/tablette",
                    "Nom de domaine + hébergement 1 an",
                    "Formulaire de contact"
                ],
                'Standard' => [
                    "Jusqu'à 5 pages",
                    "Blog ou section actualités",
                    "Optimisation SEO complète"
                ],
                'Sur-mesure' => [
                    "Nombre de pages illimité",
                    "Développement spécifique (formulaires avancés, animations...)",
                    "Maintenance 3 mois offerte"
                ]
            ]
        ],
        // developpement-sur-mesure
        [
            'service_slug' => 'developpement-sur-mesure',
            'price_includes' => [
                'Fonctionnalité simple' => [
                    "Analyse rapide du besoin (échange + cadrage léger)",
                    "Développement d'une fonctionnalité simple (formulaire, calcul, affichage spécifique…)",
                    "Petite intégration ou interaction avec un service/API existant",
                    "Recette technique et retour client",
                    "Livraison documentée (si nécessaire)"
                ],
                'Module métier sur mesure' => [
                    "Spécification technique détaillée",
                    "Développement complet d'un module",
                    "Tests unitaires et validation",
                    "Documentation utilisateur (si besoin)"
                ],
                'Pack Dev Premium' => [
                    "10 jours de développement à répartir sur 2 mois",
                    "Suivi hebdomadaire de l'avancement",
                    "Livraisons itératives et ajustements",
                    "Support technique inclus"
                ]
            ]
        ],
        // formation-vulgarisation
        [
            'service_slug' => 'formation-vulgarisation',
            'price_includes' => [
                'Session découverte' => [
                    "1h de session en visio ou en présentiel",
                    "Sujet au choix (technique, outils, projet)",
                    "Support de formation fourni",
                    "Échange libre et questions"
                ],
                'Pack initiation' => [
                    "3 sessions de 1h30",
                    "Parcours adapté à votre niveau",
                    "Supports + exercices pratiques",
                    "Suivi par email entre les sessions"
                ],
                'Formation personnalisée' => [
                    "Programme défini sur mesure",
                    "Sessions en visio ou en présentiel",
                    "Supports adaptés à votre usage (slides, vidéos, démonstrations)",
                    "Accès à un espace de ressources dédié"
                ]
            ]
        ],
        // integration-solutions-externes
        [
            'service_slug' => 'integration-solutions-externes',
            'price_includes' => [
                'Intégration simple' => [
                    "Connexion à une API ou un outil tiers",
                    "Configuration de base",
                    "Test de bon fonctionnement",
                    "Documentation rapide d'utilisation"
                ],
                'Intégration avancée' => [
                    "Connexion à plusieurs services",
                    "Synchronisation automatisée (webhooks, scripts…)",
                    "Interface personnalisée pour l'administration",
                    "Support après livraison inclus (7 jours)"
                ],
                'Intégration sur mesure' => [
                    "Analyse du besoin technique",
                    "Conception de middleware ou passerelle personnalisée",
                    "Interconnexion avec systèmes internes",
                    "Suivi et tests approfondis"
                ]
            ]
        ],
        // maintenance-support-technique
        [
            'service_slug' => 'maintenance-support-technique',
            'price_includes' => [
                'Assistance ponctuelle' => [
                    "Analyse rapide de la demande",
                    "Correction de bugs ou ajout simple si possible",
                    "Rapport d'intervention détaillé",
                    "Délais rapides selon disponibilité"
                ],
                'Maintenance standard' => [
                    "1 intervention par mois",
                    "Mises à jour de sécurité incluses",
                    "Sauvegarde mensuelle",
                    "Support technique par email"
                ],
                'Maintenance premium' => [
                    "3 interventions par mois",
                    "Mises à jour + sauvegardes hebdomadaires",
                    "Monitoring de disponibilité",
                    "Support prioritaire (email + téléphone)",
                    "Rapport mensuel d'activité"
                ]
            ]
        ]
    ];

    public function getDependencies(): array
    {
        return [
            ServicePriceFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        // Note: L'entité ServicePriceInclude ne possède pas de propriété pour stocker le texte de l'inclusion
        // Cette fixture crée les entités mais ne peut pas stocker le texte des inclusions

        foreach (self::SERVICE_PRICE_INCLUDES as $servicePriceIncludeData) {
            $serviceSlug = $servicePriceIncludeData['service_slug'];

            foreach ($servicePriceIncludeData['price_includes'] as $priceName => $includes) {
                $servicePrice = $this->getReference('service_price_' . $serviceSlug . '_' . $priceName, ServicePrice::class);

                foreach ($includes as $includeText) {
                    $servicePriceInclude = new ServicePriceInclude();
                    $servicePriceInclude->setServicePriceId($servicePrice);

                    // Note: Il n'y a pas de propriété pour stocker le texte de l'inclusion
                    // Idéalement, l'entité devrait avoir une propriété 'label' ou 'text'

                    $manager->persist($servicePriceInclude);
                }
            }
        }

        $manager->flush();
    }
}
