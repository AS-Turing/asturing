<?php

namespace App\Controller;

use App\Entity\Specification;
use App\Repository\SpecificationBookRepository;
use App\Repository\SpecificationRepository;
use App\Service\SerializerContextBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;


final class SpecificationsController extends AbstractController
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly SerializerContextBuilder $serializerContextBuilder
    )
    {
    }

    #[Route('/specifications', name: 'app_specifications', methods: ['GET'])]
    public function index(SpecificationBookRepository $specificationBookRepository): JsonResponse
    {
        $specificationBooks = $specificationBookRepository->createQueryBuilder('sb')
            ->addSelect('c')
            ->leftJoin('sb.client', 'c')
            ->getQuery()
            ->getResult();

        if (empty($specificationBooks)) {
            return new JsonResponse([
                'success' => false,
                'message' => 'No specification books found',
            ]);
        }

        $jsonContent = $this->serializer->serialize(
            $specificationBooks, 'json', $this->serializerContextBuilder->buildSerializerContext()
        );

        return $this->json([
            'success' => true,
            'data' => json_decode($jsonContent)
            ,
        ]);
    }

    #[Route('/specifications/questions', name:'app_specifications_questions', methods: ['GET'])]
    public function getQuestions(SpecificationRepository $specificationRepository): JsonResponse
    {
        $specificationList = $specificationRepository->findAll();

        return $this->json([
            'success' => true,
            'data' => json_decode($this->serializer->serialize($specificationList, 'json',
                $this->serializerContextBuilder->buildSerializerContext()), true)
        ]);
    }
}
