<?php

namespace App\Controller\Api;

use App\Repository\LocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
class LocationController extends AbstractController
{
    #[Route('/locations/{slug}', name: 'api_location_show', methods: ['GET'])]
    public function show(string $slug, LocationRepository $locationRepository): JsonResponse
    {
        $location = $locationRepository->findBySlug($slug);
        
        if (!$location) {
            throw new NotFoundHttpException('Location not found');
        }
        
        return $this->json($location->toArray(), Response::HTTP_OK, [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET',
            'Cache-Control' => 'public, max-age=3600'
        ]);
    }
    
    #[Route('/locations', name: 'api_location_list', methods: ['GET'])]
    public function list(LocationRepository $locationRepository): JsonResponse
    {
        $locations = $locationRepository->findAllActive();
        
        $result = array_map(fn($location) => [
            'slug' => $location->getSlug(),
            'ville' => $location->getVille(),
            'departement' => $location->getDepartement(),
            'url' => '/creation-site-internet-' . $location->getSlug()
        ], $locations);
        
        return $this->json($result, Response::HTTP_OK, [
            'Access-Control-Allow-Origin' => '*',
            'Cache-Control' => 'public, max-age=3600'
        ]);
    }
}
