<?php

namespace App\Controller;

use App\Entity\Service;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class NavigationController extends AbstractController
{
    public function __construct(
        private readonly ServiceRepository $serviceRepository,
    ){}

    #[Route('/navigation/footer', name: 'get_footer_navigation', methods: ['GET'])]
    public function footer(): JsonResponse
    {
        // Services from DB (title + slug)
        $services = $this->serviceRepository->findAll();
        $serviceLinks = array_map(static function (Service $s) {
            return [
                'label' => $s->getTitle(),
                'to' => '/services/' . $s->getSlug(),
                'title' => $s->getTitle(),
            ];
        }, $services);

        // Other static sections (can be moved to DB later)
        $mainLinks = [
            ['label' => "À propos", 'to' => '/about'],
            ['label' => 'Contact', 'to' => '/contact'],
        ];

        $legalLinks = [
            ['label' => 'Conditions générales de ventes', 'to' => '/conditions-generales-de-ventes'],
            [
                'label' => "La charte d'engagement d'AS-Turing",
                'to' => '/engagements',
            ],
        ];

        $locationLinks = [
            ['label' => 'Création site Web à Libourne', 'to' => '/localisation/libourne', 'title' => 'Développeur Web freelance à Libourne'],
            ['label' => 'Création site Web à Bordeaux', 'to' => '/localisation/bordeaux', 'title' => 'Développeur Web freelance à Bordeaux'],
            ['label' => 'Création site Web à Saint-Émilion', 'to' => '/localisation/saint-emilion', 'title' => 'Développeur Web freelance à Saint-Émilion'],
            ['label' => 'Création site Web à Sauveterre-de-Guyenne', 'to' => '/localisation/sauveterre-de-guyenne', 'title' => 'Développeur Web freelance à Sauveterre-de-Guyenne'],
            ['label' => 'Création site Web à Créon', 'to' => '/localisation/creon', 'title' => 'Développeur Web freelance à Créon'],
        ];

        return $this->json([
            'success' => true,
            'data' => [
                'services' => $serviceLinks,
                'main' => $mainLinks,
                'legal' => $legalLinks,
                'locations' => $locationLinks,
            ],
        ]);
    }
}
