<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Attribute\Route;

final class FileController extends AbstractController
{

    #[Route('/file/upload/cdc/{filename}', name: 'app_file_show', methods: ['GET'])]
    public function show(string $filename, KernelInterface $kernel): BinaryFileResponse | JsonResponse
    {
        $path = $kernel->getProjectDir() . '/upload/cdc/' . $filename;

        if (!file_exists($path)) {
            return $this->json([
                'success' => false,
                'message' => 'File not found',
            ]);
        }

        return new BinaryFileResponse($path);
    }
}
