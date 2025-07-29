<?php

namespace App\DataFixtures;

use App\Entity\Seo;
use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeoFixtures extends Fixture implements DependentFixtureInterface
{
    // Define constants for SEO data based on frontend/data/services
    const SEOS = [
        'conseil' => [
            'title' => 'Conseil & accompagnement digital | AS-Turing',
            'description' => 'Audit, stratégie, choix techniques et suivi de projet — bénéficiez de conseils personnalisés pour faire les bons choix digitaux avec AS-Turing.',
            'ogTitle' => 'Conseil digital sur mesure | AS-Turing',
            'ogDescription' => 'Freelance web à Libourne, j\'accompagne les professionnels dans leurs décisions techniques, stratégiques et organisationnelles.',
            'ogUrl' => 'https://www.as-turing.fr/services/conseil-accompagnement-digital'
        ],
        'creation' => [
            'title' => 'Création de site internet | AS-Turing',
            'description' => 'Création de sites web professionnels, responsive et optimisés pour le référencement. Sites vitrines, landing pages et sites sur mesure à Libourne et partout en France.',
            'ogTitle' => 'Création de sites web professionnels | AS-Turing',
            'ogDescription' => 'Développeur freelance à Libourne, je crée des sites internet modernes, performants et adaptés à vos objectifs commerciaux.',
            'ogUrl' => 'https://www.as-turing.fr/services/creation-site-internet'
        ],
        'developpement' => [
            'title' => 'Développement sur mesure | AS-Turing',
            'description' => 'Applications web, outils métier et solutions personnalisées pour optimiser vos processus. Développement sur mesure adapté à vos besoins spécifiques.',
            'ogTitle' => 'Développement d\'applications web sur mesure | AS-Turing',
            'ogDescription' => 'Développeur full-stack à Libourne, je conçois des solutions web personnalisées pour répondre précisément à vos besoins métier.',
            'ogUrl' => 'https://www.as-turing.fr/services/developpement-sur-mesure'
        ],
        'formation' => [
            'title' => 'Formation & vulgarisation | AS-Turing',
            'description' => 'Formations personnalisées pour maîtriser vos outils numériques. Gagnez en autonomie avec des sessions adaptées à votre niveau et vos objectifs.',
            'ogTitle' => 'Formations web et numérique | AS-Turing',
            'ogDescription' => 'Formateur à Libourne, je propose des sessions personnalisées pour vous aider à comprendre et maîtriser vos outils digitaux.',
            'ogUrl' => 'https://www.as-turing.fr/services/formation-vulgarisation'
        ],
        'integration' => [
            'title' => 'Intégration de solutions externes | AS-Turing',
            'description' => 'Connectez vos outils et plateformes pour un écosystème digital cohérent. Intégration de CRM, e-commerce, paiement et autres solutions externes.',
            'ogTitle' => 'Intégration d\'outils et API | AS-Turing',
            'ogDescription' => 'Développeur à Libourne, j\'intègre et synchronise vos différents outils pour créer un système d\'information efficace et cohérent.',
            'ogUrl' => 'https://www.as-turing.fr/services/integration-solutions-externes'
        ],
        'maintenance' => [
            'title' => 'Maintenance & support | AS-Turing',
            'description' => 'Assurez la pérennité et la sécurité de vos outils digitaux. Maintenance préventive, support technique et évolutions de vos sites et applications.',
            'ogTitle' => 'Maintenance web et support technique | AS-Turing',
            'ogDescription' => 'Développeur à Libourne, je propose des services de maintenance et support pour garantir la sécurité et le bon fonctionnement de vos outils web.',
            'ogUrl' => 'https://www.as-turing.fr/services/maintenance-support'
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SEOS as $serviceKey => $seoData) {
            /** @var Service $service */
            $service = $this->getReference('service-' . $serviceKey, Service::class);

            $seo = new Seo();
            $seo->setTitle($seoData['title']);
            $seo->setDescription($seoData['description']);
            $seo->setOgTitle($seoData['ogTitle']);
            $seo->setOgDescription($seoData['ogDescription']);
            $seo->setOgUrl($seoData['ogUrl']);
            $seo->setService($service);

            $manager->persist($seo);
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
