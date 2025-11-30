<?php

namespace App\Controller\Api;

use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
class ProjectController extends AbstractController
{
    #[Route('/projects', name: 'api_projects_list', methods: ['GET'])]
    public function list(ProjectRepository $projectRepository): JsonResponse
    {
        $projects = $projectRepository->findBy(
            ['isActive' => true],
            ['position' => 'ASC']
        );

        $data = array_map(function($project) {
            return [
                'id' => $project->getId(),
                'title' => $project->getTitle(),
                'slug' => $project->getSlug(),
                'category' => $project->getCategory(),
                'description' => $project->getDescription(),
                'technologies' => $project->getTechnologies(),
                'imageUrl' => $project->getImageUrl(),
                'imageText' => $project->getImageText(),
                'bgGradient' => $project->getBgGradient(),
                'imageGradient' => $project->getImageGradient(),
                'dotColor' => $project->getDotColor(),
                'categoryColor' => $project->getCategoryColor(),
                'descColor' => $project->getDescColor(),
                'techClass' => $project->getTechClass(),
                'linkColor' => $project->getLinkColor(),
            ];
        }, $projects);

        return $this->json($data);
    }

    #[Route('/projects/{slug}', name: 'api_projects_show', methods: ['GET'])]
    public function show(string $slug, ProjectRepository $projectRepository): JsonResponse
    {
        $project = $projectRepository->findOneBy(['slug' => $slug, 'isActive' => true]);

        if (!$project) {
            return $this->json(['error' => 'Project not found'], 404);
        }

        return $this->json([
            'id' => $project->getId(),
            'title' => $project->getTitle(),
            'slug' => $project->getSlug(),
            'category' => $project->getCategory(),
            'description' => $project->getDescription(),
            'technologies' => $project->getTechnologies(),
            'imageUrl' => $project->getImageUrl(),
            'imageText' => $project->getImageText(),
            'bgGradient' => $project->getBgGradient(),
            'imageGradient' => $project->getImageGradient(),
            'dotColor' => $project->getDotColor(),
            'categoryColor' => $project->getCategoryColor(),
            'descColor' => $project->getDescColor(),
            'techClass' => $project->getTechClass(),
            'linkColor' => $project->getLinkColor(),
        ]);
    }
}
