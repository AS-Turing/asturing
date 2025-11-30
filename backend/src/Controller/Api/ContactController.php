<?php

namespace App\Controller\Api;

use App\Entity\ContactMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api')]
class ContactController extends AbstractController
{
    #[Route('/contact', name: 'api_contact_create', methods: ['POST'])]
    public function create(
        Request $request,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        // Validation basique
        if (empty($data['name']) || empty($data['email']) || empty($data['subject']) || empty($data['message'])) {
            return $this->json([
                'error' => 'All fields are required',
                'fields' => ['name', 'email', 'subject', 'message']
            ], 400);
        }

        // Validation email
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return $this->json(['error' => 'Invalid email address'], 400);
        }

        // Créer le message de contact
        $contactMessage = new ContactMessage();
        $contactMessage->setName($data['name']);
        $contactMessage->setEmail($data['email']);
        $contactMessage->setSubject($data['subject']);
        $contactMessage->setMessage($data['message']);

        $entityManager->persist($contactMessage);
        $entityManager->flush();

        return $this->json([
            'success' => true,
            'message' => 'Message sent successfully',
            'id' => $contactMessage->getId(),
        ], 201);
    }
}
