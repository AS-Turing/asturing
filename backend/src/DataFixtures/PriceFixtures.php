<?php

namespace App\DataFixtures;

use App\Entity\Price;
use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PriceFixtures extends Fixture implements DependentFixtureInterface
{
    // Define constants for price data based on frontend/data/services
    const PRICES = [
        'conseil' => [
            [
                'name' => 'Consultation Express',
                'includes' => [
                    "Échange d'une heure (visio ou téléphone)",
                    'Compte rendu synthétique avec recommandations',
                    'Support par mail pendant 7 jours'
                ],
                'price' => '90€ TTC'
            ],
            [
                'name' => 'Accompagnement Projet',
                'includes' => [
                    'Audit approfondi',
                    'Sessions régulières de suivi',
                    'Conseils techniques personnalisés',
                    'Rédaction de livrables (cahier des charges, roadmap...)'
                ],
                'price' => 'à partir de 350€ TTC'
            ],
            [
                'name' => 'Coaching Digital',
                'includes' => [
                    "10h d'accompagnement à utiliser librement",
                    'Support continu pendant 30 jours',
                    'Sessions planifiées selon votre planning',
                    "Suivi d'avancement et conseils actionnables"
                ],
                'price' => '600€ TTC'
            ]
        ],
        'creation' => [
            [
                'name' => 'Site Vitrine Essentiel',
                'includes' => [
                    'Site responsive jusqu\'à 5 pages',
                    'Design moderne et personnalisé',
                    'Formulaire de contact',
                    'Optimisation SEO de base',
                    'Formation à l\'utilisation'
                ],
                'price' => 'à partir de 1200€ TTC'
            ],
            [
                'name' => 'Site Pro',
                'includes' => [
                    'Site responsive jusqu\'à 10 pages',
                    'Design sur mesure',
                    'Formulaires avancés',
                    'Optimisation SEO complète',
                    'Intégration de médias riches',
                    'Formation et support 30 jours'
                ],
                'price' => 'à partir de 2500€ TTC'
            ],
            [
                'name' => 'Landing Page',
                'includes' => [
                    'Page unique optimisée conversion',
                    'Design persuasif',
                    'Formulaire de capture',
                    'Optimisation performance',
                    'Compatibilité tous appareils'
                ],
                'price' => 'à partir de 600€ TTC'
            ]
        ],
        'developpement' => [
            [
                'name' => 'Développement Fonctionnalité',
                'includes' => [
                    'Analyse des besoins',
                    'Développement sur mesure',
                    'Tests et déploiement',
                    'Documentation technique',
                    'Garantie 3 mois'
                ],
                'price' => 'sur devis'
            ],
            [
                'name' => 'Application Web Complète',
                'includes' => [
                    'Cahier des charges détaillé',
                    'Développement full-stack',
                    'Interface administration',
                    'Tests et optimisation',
                    'Formation utilisateurs',
                    'Support technique 6 mois'
                ],
                'price' => 'sur devis'
            ]
        ],
        'formation' => [
            [
                'name' => 'Formation Individuelle',
                'includes' => [
                    'Session personnalisée 3h',
                    'Support de formation',
                    'Exercices pratiques',
                    'Suivi post-formation'
                ],
                'price' => '250€ TTC'
            ],
            [
                'name' => 'Pack Formation Équipe',
                'includes' => [
                    'Formation sur site 1 journée',
                    'Jusqu\'à 5 participants',
                    'Supports personnalisés',
                    'Ateliers pratiques',
                    'Assistance 30 jours'
                ],
                'price' => 'à partir de 800€ TTC'
            ]
        ],
        'integration' => [
            [
                'name' => 'Intégration Simple',
                'includes' => [
                    'Configuration d\'un outil externe',
                    'Connexion à votre site/application',
                    'Tests de fonctionnement',
                    'Documentation utilisateur'
                ],
                'price' => 'à partir de 400€ TTC'
            ],
            [
                'name' => 'Intégration Complexe',
                'includes' => [
                    'Analyse workflow existant',
                    'Intégration multi-plateformes',
                    'Synchronisation de données',
                    'Automatisation de processus',
                    'Formation et documentation'
                ],
                'price' => 'sur devis'
            ]
        ],
        'maintenance' => [
            [
                'name' => 'Maintenance Essentielle',
                'includes' => [
                    'Mises à jour de sécurité',
                    'Sauvegardes régulières',
                    'Surveillance uptime',
                    'Support email'
                ],
                'price' => 'à partir de 40€ TTC/mois'
            ],
            [
                'name' => 'Maintenance Premium',
                'includes' => [
                    'Toutes les prestations Essentielles',
                    'Mises à jour fonctionnelles',
                    'Optimisation performances',
                    'Temps de développement mensuel (2h)',
                    'Support prioritaire'
                ],
                'price' => 'à partir de 120€ TTC/mois'
            ],
            [
                'name' => 'Intervention Ponctuelle',
                'includes' => [
                    'Diagnostic de problème',
                    'Correction de bugs',
                    'Petites modifications',
                    'Rapport d\'intervention'
                ],
                'price' => '90€ TTC/heure'
            ]
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PRICES as $serviceKey => $prices) {
            /** @var Service $service */
            $service = $this->getReference('service-' . $serviceKey, Service::class);

            foreach ($prices as $priceData) {
                $price = new Price();
                $price->setName($priceData['name']);
                $price->setIncludes($priceData['includes']);
                $price->setPrice($priceData['price']);
                $price->setService($service);

                $manager->persist($price);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ServiceFixtures::class,
        ];
    }
}
