<?php

namespace App\Controller\Api;

use App\Entity\ProcessPage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
class ProcessController extends AbstractController
{
    #[Route('/process/config', name: 'api_process_config', methods: ['GET'])]
    public function getConfig(EntityManagerInterface $entityManager): JsonResponse
    {
        $processPage = $entityManager->getRepository(ProcessPage::class)->findOneBy([]);
        
        if (!$processPage) {
            return $this->json(['error' => 'Process config not found'], 404);
        }
        
        return $this->json([
            'hero' => [
                'badge' => $processPage->getHeroBadge(),
                'title' => $processPage->getHeroTitle(),
                'subtitle' => $processPage->getHeroSubtitle(),
            ],
            'process' => [
                'title' => $processPage->getProcessTitle(),
                'description' => $processPage->getProcessDescription(),
                'steps' => $processPage->getProcessSteps(),
            ],
            'values' => [
                'title' => $processPage->getValuesTitle(),
                'description' => $processPage->getValuesDescription(),
                'items' => $processPage->getValues(),
            ],
            'seo' => [
                'title' => $processPage->getSeoTitle(),
                'description' => $processPage->getSeoDescription(),
            ],
        ]);
    }
}
