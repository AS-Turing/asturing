<?php

namespace App\Controller;

use App\Entity\Client;
use App\Repository\ClientRepository;
use App\Service\EntityHydrator;
use App\Service\SerializerContextBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

final class ClientController extends AbstractController
{
    public function __construct(
        private readonly ClientRepository $clientRepository,
        private readonly SerializerInterface $serializer,
        private readonly SerializerContextBuilder $serializerContextBuilder,
        private readonly EntityManagerInterface $entityManager,
        private readonly EntityHydrator $entityHydrator
    ) {}

    #[Route('/clients', name: 'app_clients', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $clients = $this->clientRepository->findAll();

        if (!$clients) {
            return $this->json([
                'success' => false,
                'data' => 'No data found',
            ]);
        }
        return $this->json([
           'success' => true,
            'data' => json_decode($this->serializer->serialize($clients, 'json', $this->serializerContextBuilder->buildSerializerContext()), true, 512, JSON_THROW_ON_ERROR),
        ]);
    }

    #[Route('/client', name: 'app_client', methods: ['POST'])]
    public function post(Request $request): JsonResponse {
        $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $client = new Client();
        $this->entityHydrator->hydrate($data, $client);

        try {
            $this->entityManager->persist($client);
            $this->entityManager->flush();
            return $this->json([
                'success' => true,
                'data' => json_decode($this->serializer->serialize($client, 'json', $this->serializerContextBuilder->buildSerializerContext()), true, 512, JSON_THROW_ON_ERROR),
            ]);
        } catch (\Exception $exception) {
            return $this->json([
                'success' => false,
                'data' => $exception->getMessage(),
            ]);
        }
    }

    #[Route('/client/{id}', name: 'app_client_update', methods: 'PUT')]
    public function patch(Request $request): JsonResponse {
        $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $client = $this->clientRepository->find($data['id']);
        if (!$client) {
            return $this->json([
                'success' => false,
                'data' => 'Client not found',
            ]);
        }

        $this->entityHydrator->hydrate($data, $client);
        try {
            $this->entityManager->persist($client);
            $this->entityManager->flush();
            return $this->json([
                'success' => true,
                'data' => $client,
            ]);
        } catch (\Exception $exception) {
            return $this->json([
                'success' => false,
                'data' => $exception->getMessage(),
            ]);
        }
    }

    #[Route('/client/{id}', name: 'app_client_delete', methods: 'DELETE')]
    public function delete( int $id): JsonResponse {
        $client = $this->clientRepository->find($id);
        if (!$client) {
            return $this->json([
                'success' => false,
                'data' => 'Client not found',
            ]);
        }

        try {
            $this->entityManager->remove($client);
            $this->entityManager->flush();
            return $this->json([
                'success' => true,
                'data' => 'Client deleted successfully',
            ]);
        } catch (\Exception $exception) {
            return $this->json([
                'success' => false,
                'data' => $exception->getMessage(),
            ]);
        }
    }
}
