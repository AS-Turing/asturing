<?php

namespace App\Controller;

use App\Repository\LocationRepository;
use App\Service\SerializerContextBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class LocationController extends AbstractController
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly SerializerContextBuilder $serializerContextBuilder
    )
    {
    }

    #[Route('/location/{slug}', name: 'app_location_show', methods: ['GET'])]
    public function show(string $slug, LocationRepository $locationRepository): JsonResponse
    {
        $location = $locationRepository->findOneBy(['slug' => $slug]);

        if (!$location) {
            return $this->json([
                'success' => false,
                'message' => 'Location not found',
            ]);
        }

        $jsonContent = $this->serializer->serialize(
            $location, 'json', $this->serializerContextBuilder->buildSerializerContext()
        );

        return $this->json([
            'success' => true,
            'data' => json_decode($jsonContent),
        ]);
    }
}
