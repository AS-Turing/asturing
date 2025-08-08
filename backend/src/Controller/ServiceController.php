<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use App\Service\EntityHydrator;
use App\Service\SerializerContextBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class ServiceController extends AbstractController
{
    public function __construct(
        private readonly ServiceRepository $serviceRepository,
        private readonly SerializerInterface $serializer,
        private readonly SerializerContextBuilder $serializerContextBuilder,
        private readonly EntityManagerInterface $entityManager,
        private readonly EntityHydrator $entityHydrator
    ){}

    #[Route('/services', name: 'fingerprint-validator')]
    public function index() {
        $services = $this->serviceRepository->findAll();
        if (!$services) {
            return $this->json([
                'success' => false,
                'message' => 'No services found',
            ]);
        }


        return $this->json([
            'success' => true,
            'data' => json_decode($this->serializer->serialize($services, 'json',
                $this->serializerContextBuilder->buildSerializerContext()), true, 512, JSON_THROW_ON_ERROR)
        ]);
    }

    #[Route('/service/{slug}', name: 'app_service_')]
    public function get(string $slug): JsonResponse
    {
        $service = $this->serviceRepository->findOneBy(['slug' => $slug]);

        if (!$service) {
            return $this->json([
                'success' => false,
                'data' => 'Service not found',
            ]);
        }
        return $this->json([
            'success' => true,
            'data' => json_decode($this->serializer->serialize($service, 'json',
                $this->serializerContextBuilder->buildSerializerContext()), true, 512, JSON_THROW_ON_ERROR)
        ]);
    }
}
