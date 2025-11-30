<?php

namespace App\Controller\Api;

use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
class ServiceController extends AbstractController
{
    #[Route('/services', name: 'api_services_list', methods: ['GET'])]
    public function list(ServiceRepository $serviceRepository): JsonResponse
    {
        $services = $serviceRepository->findBy(
            ['isActive' => true],
            ['position' => 'ASC']
        );

        $data = array_map(function($service) {
            return [
                'id' => $service->getId(),
                'title' => $service->getTitle(),
                'slug' => $service->getSlug(),
                'description' => $service->getDescription(),
                'icon' => $service->getIcon(),
                'iconGradient' => $service->getIconGradient(),
                'borderColor' => $service->getBorderColor(),
                'linkColor' => $service->getLinkColor(),
                'position' => $service->getPosition(),
            ];
        }, $services);

        return $this->json($data);
    }

    #[Route('/services/{slug}', name: 'api_services_show', methods: ['GET'])]
    public function show(string $slug, ServiceRepository $serviceRepository): JsonResponse
    {
        $service = $serviceRepository->findOneBy(['slug' => $slug, 'isActive' => true]);

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
            'position' => $service->getPosition(),
            'heroTitle' => $service->getHeroTitle(),
            'heroSubtitle' => $service->getHeroSubtitle(),
            'heroImage' => $service->getHeroImage(),
            'auditDuration' => $service->getAuditDuration(),
            'startingPrice' => $service->getStartingPrice(),
            'deliveryTime' => $service->getDeliveryTime(),
            'metaDescription' => $service->getMetaDescription(),
            'solutions' => array_map(fn($s) => [
                'title' => $s->getTitle(),
                'description' => $s->getDescription(),
                'features' => $s->getFeatures(),
                'position' => $s->getPosition(),
            ], $service->getSolutions()->toArray()),
            'processSteps' => array_map(fn($p) => [
                'title' => $p->getTitle(),
                'description' => $p->getDescription(),
                'position' => $p->getPosition(),
            ], $service->getProcessSteps()->getValues()),
            'technologies' => array_map(fn($t) => [
                'name' => $t->getName(),
                'description' => $t->getDescription(),
                'icon' => $t->getIcon(),
            ], $service->getTechnologies()->toArray()),
            'faqs' => array_map(fn($f) => [
                'question' => $f->getQuestion(),
                'answer' => $f->getAnswer(),
                'position' => $f->getPosition(),
            ], $service->getFaqs()->getValues()),
        ]);
    }
}
