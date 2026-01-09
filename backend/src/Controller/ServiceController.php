<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/services', name: 'api_services_')]
class ServiceController extends AbstractController
{
    public function __construct(
        private ServiceRepository $serviceRepository
    ) {
    }

    #[Route('', name: 'list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $services = $this->serviceRepository->findBy(['isActive' => true], ['position' => 'ASC']);
        
        return $this->json(array_map(function($service) {
            return [
                'id' => $service->getId(),
                'title' => $service->getTitle(),
                'slug' => $service->getSlug(),
                'description' => $service->getDescription(),
                'icon' => $service->getIcon(),
                'iconGradient' => $service->getIconGradient(),
                'borderColor' => $service->getBorderColor(),
                'linkColor' => $service->getLinkColor(),
            ];
        }, $services));
    }

    #[Route('/{slug}', name: 'show', methods: ['GET'])]
    public function show(string $slug): JsonResponse
    {
        $service = $this->serviceRepository->findOneBy(['slug' => $slug, 'isActive' => true]);
        
        if (!$service) {
            return $this->json(['error' => 'Service not found'], 404);
        }

        return $this->json([
            'id' => $service->getId(),
            'title' => $service->getTitle(),
            'slug' => $service->getSlug(),
            'description' => $service->getDescription(),
            'longDescription' => $service->getLongDescription(),
            'icon' => $service->getIcon(),
            'iconGradient' => $service->getIconGradient(),
            'borderColor' => $service->getBorderColor(),
            'linkColor' => $service->getLinkColor(),
            'heroImage' => $service->getHeroImage(),
            'heroTitle' => $service->getHeroTitle(),
            'heroSubtitle' => $service->getHeroSubtitle(),
            'auditDuration' => $service->getAuditDuration(),
            'startingPrice' => $service->getStartingPrice(),
            'deliveryTime' => $service->getDeliveryTime(),
            'priceRange' => $service->getPriceRange(),
            'areaServed' => $service->getAreaServed(),
            'solutions' => array_map(fn($s) => [
                'id' => $s->getId(),
                'title' => $s->getTitle(),
                'description' => $s->getDescription(),
                'features' => $s->getFeatures(),
                'icon' => $s->getIcon(),
            ], $service->getSolutions()->toArray()),
            'processSteps' => array_map(fn($p) => [
                'id' => $p->getId(),
                'title' => $p->getTitle(),
                'description' => $p->getDescription(),
            ], $service->getProcessSteps()->toArray()),
            'technologies' => array_map(fn($t) => [
                'id' => $t->getId(),
                'name' => $t->getName(),
                'description' => $t->getDescription(),
                'icon' => $t->getIcon(),
            ], $service->getTechnologies()->toArray()),
            'faqs' => array_map(fn($f) => [
                'id' => $f->getId(),
                'question' => $f->getQuestion(),
                'answer' => $f->getAnswer(),
            ], $service->getFaqs()->toArray()),
        ]);
    }
}
