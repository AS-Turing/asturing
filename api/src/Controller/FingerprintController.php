<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class FingerprintController extends AbstractController
{
    #[Route('/fingerprint', name: 'app_fingerprint', methods: 'POST')]
    public function index(
        Request $request,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
    ): JsonResponse
    {
        $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        if (!$data['fingerprint']) {
            return $this->json([
                'success' => false,
                'error' => 'No fingerprint value',
            ]);
        }

        $user = $userRepository->findOneBy(['id' => 1]);

        if (!$user) {
            return $this->json([
                'success' => false,
                'error' => 'User not found',
            ]);
        }

        try {
            $user->setFingerprint($data['fingerprint']);
            $entityManager->persist($user);
            $entityManager->flush();
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'error' => $e->getMessage(),
            ]);
        }

        return $this->json([
            'success' => true,
            'message' => 'Fingerprint updated',
        ]);
    }
}
