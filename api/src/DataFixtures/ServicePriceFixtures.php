<?php

namespace App\DataFixtures;

use App\Entity\ServicePrice;
use App\Repository\ServiceRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ServicePriceFixtures extends Fixture implements DependentFixtureInterface
{
    // Données extraites des fichiers TypeScript dans data/services/
    const SERVICE_PRICES = [
        // conseil-accompagnement-digital
        [
            'service_slug' => 'conseil-accompagnement-digital',
            'prices' => [
                [
                    'name' => 'Consultation Express',
                    'price' => 90, // "90€ TTC"
                ],
                [
                    'name' => 'Accompagnement Projet',
                    'price' => 350, // "à partir de 350€ TTC"
                ],
                [
                    'name' => 'Coaching Digital',
                    'price' => 600, // "600€ TTC"
                ],
            ]
        ],
        // creation-site-internet
        [
            'service_slug' => 'creation-site-internet',
            'prices' => [
                [
                    'name' => 'Essentiel',
                    'price' => 690, // "À partir de 690€ TTC"
                ],
                [
                    'name' => 'Standard',
                    'price' => 1190, // "À partir de 1 190€ TTC"
                ],
                [
                    'name' => 'Sur-mesure',
                    'price' => 2000, // "Sur devis" - valeur par défaut
                ],
            ]
        ],
        // developpement-sur-mesure
        [
            'service_slug' => 'developpement-sur-mesure',
            'prices' => [
                [
                    'name' => 'Fonctionnalité simple',
                    'price' => 250, // "à partir de 250€ TTC"
                ],
                [
                    'name' => 'Module métier sur mesure',
                    'price' => 800, // "à partir de 800€ TTC"
                ],
                [
                    'name' => 'Pack Dev Premium',
                    'price' => 2200, // "2 200€ TTC"
                ],
            ]
        ],
        // formation-vulgarisation
        [
            'service_slug' => 'formation-vulgarisation',
            'prices' => [
                [
                    'name' => 'Session découverte',
                    'price' => 60, // "60€ TTC"
                ],
                [
                    'name' => 'Pack initiation',
                    'price' => 240, // "240€ TTC"
                ],
                [
                    'name' => 'Formation personnalisée',
                    'price' => 450, // "à partir de 450€ TTC"
                ],
            ]
        ],
        // integration-solutions-externes
        [
            'service_slug' => 'integration-solutions-externes',
            'prices' => [
                [
                    'name' => 'Intégration simple',
                    'price' => 150, // "150€ TTC"
                ],
                [
                    'name' => 'Intégration avancée',
                    'price' => 300, // "300€ TTC"
                ],
                [
                    'name' => 'Intégration sur mesure',
                    'price' => 500, // "Sur devis" - valeur par défaut
                ],
            ]
        ],
        // maintenance-support-technique
        [
            'service_slug' => 'maintenance-support-technique',
            'prices' => [
                [
                    'name' => 'Assistance ponctuelle',
                    'price' => 60, // "60€ TTC / heure"
                ],
                [
                    'name' => 'Maintenance standard',
                    'price' => 90, // "90€ TTC / mois"
                ],
                [
                    'name' => 'Maintenance premium',
                    'price' => 180, // "180€ TTC / mois"
                ],
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
        foreach (self::SERVICE_PRICES as $servicePriceData) {
            $service = $this->serviceRepository->findOneBy(['slug' => $servicePriceData['service_slug']]);

            if (!$service) {
                throw new \Exception("Service not found with slug: {$servicePriceData['service_slug']}");
            }

            foreach ($servicePriceData['prices'] as $priceData) {
                $servicePrice = new ServicePrice();
                $servicePrice->setServiceId($service->getId());
                $servicePrice->setName($priceData['name']);
                $servicePrice->setPrice($priceData['price']);

                $manager->persist($servicePrice);

                // Store reference for ServicePriceIncludeFixtures
                $this->addReference(
                    'service_price_' . $servicePriceData['service_slug'] . '_' . $priceData['name'],
                    $servicePrice
                );
            }
        }

        $manager->flush();
    }
}
