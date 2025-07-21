<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class AuthController extends AbstractController
{
    #[Route('/auth', name: 'app_auth', methods: ['POST'])]
    public function index(
        Request $request,
        UserRepository $userRepository,
        JWTTokenManagerInterface $JWTManager
): JsonResponse
    {
        // Password & Fingerprint in D$data
        $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $user = $userRepository->findOneBy(['id' => 1]);

        if (!$user) {
            return $this->json(['success' => false, 'error' => 'Utilisateur non trouvé'], 401);
        }


        if (!password_verify($data['password'], $user->getPassword())) {
            return $this->json(['success' => false, 'error' => 'Mot de passe invalide'], 401);
        }

        if ($user->getFingerprint() !== ($data['fingerprint'] ?? null)) {
            return $this->json(['success' => false, 'error' => 'Empreinte invalide'], 401);
        }

        $token = $JWTManager->create($user);

        return $this->json([
            'success' => true,
            'token' => $token,
        ]);
    }
}
