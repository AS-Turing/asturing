<?php

namespace App\Controller\Api;

use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
class ClientController extends AbstractController
{
    #[Route('/clients', name: 'api_clients_list', methods: ['GET'])]
    public function list(ClientRepository $clientRepository): JsonResponse
    {
        $clients = $clientRepository->findActiveOrderedByPosition();
        
        $data = array_map(function($client) {
            return [
                'id' => $client->getId(),
                'name' => $client->getName(),
                'logo' => $client->getLogo(),
                'website' => $client->getWebsite(),
                'description' => $client->getDescription(),
            ];
        }, $clients);
        
        return $this->json($data);
    }
}
