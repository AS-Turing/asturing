<?php

namespace App\Controller;

use App\Entity\Faq;
use App\Entity\Price;
use App\Entity\Seo;
use App\Entity\Service;
use App\Repository\ServiceRepository;
use App\Service\EntityHydrator;
use App\Service\SerializerContextBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class ServiceController extends AbstractController
{
    public function __construct(
        private readonly ServiceRepository $serviceRepository,
        private readonly SerializerInterface $serializer,
        private readonly SerializerContextBuilder $serializerContextBuilder,
        private readonly EntityManagerInterface $entityManager,
        private readonly EntityHydrator $entityHydrator
    ){}

    #[Route('/services', name: 'get_services', methods: 'GET')]
    public function index(): JsonResponse {
        $services = $this->serviceRepository->findAll();
        if (!$services) {
            return $this->json([
                'success' => false,
                'message' => 'No services found',
            ]);
        }

        return $this->json([
            'success' => true,
            'data' => json_decode($this->serializer->serialize($services, 'json',
                $this->serializerContextBuilder->buildSerializerContext()), true, 512, JSON_THROW_ON_ERROR)
        ]);
    }

    #[Route('/services/menu', name: 'get_services_menu', methods: 'GET')]
    public function menu(): JsonResponse {
        $services = $this->serviceRepository->findAll();
        $data = array_map(static function (Service $s) {
            return [
                'title' => $s->getTitle(),
                'slug' => $s->getSlug(),
            ];
        }, $services);

        return $this->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    #[Route('/service/{slug}', name: 'app_service_')]
    public function get(string $slug): JsonResponse
    {
        $service = $this->serviceRepository->findOneBy(['slug' => $slug]);

        if (!$service) {
            return $this->json([
                'success' => false,
                'data' => 'Service not found',
            ]);
        }
        return $this->json([
            'success' => true,
            'data' => json_decode($this->serializer->serialize($service, 'json',
                $this->serializerContextBuilder->buildSerializerContext()), true, 512, JSON_THROW_ON_ERROR)
        ]);
    }

    #[Route('/services', name:'create_service', methods: ['POST'])]
    public function post(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $service = new Service();

        if (!empty($data['seo']) && is_array($data['seo'])) {
            $seo = new Seo();
            $this->entityHydrator->hydrate($data['seo'], $seo);

            if (method_exists($seo, 'setService')) {
                $seo->setService($service);
            }
            if (method_exists($service, 'setSeo')) {
                $service->setSeo($seo);
            }

             $this->entityManager->persist($seo);
        }

        if (!empty($data['prices']) && is_array($data['prices'])) {
            foreach ($data['prices'] as $p) {
                $price = new Price();
                $this->entityHydrator->hydrate($p, $price);

                if (method_exists($price, 'setService')) {
                    $price->setService($service);
                }
                if (method_exists($service, 'addPrice')) {
                    $service->addPrice($price);
                }

                 $this->entityManager->persist($price);
            }
        }

        if (!empty($data['faqs']) && is_array($data['faqs'])) {
            foreach ($data['faqs'] as $f) {
                $faq = new Faq();
                $this->entityHydrator->hydrate($f, $faq);

                if (method_exists($faq, 'setService')) {
                    $faq->setService($service);
                }
                if (method_exists($service, 'addFaq')) {
                    $service->addFaq($faq);
                }

                 $this->entityManager->persist($faq);
            }
        }

        $serviceFields = $data;
        unset($serviceFields['prices'], $serviceFields['seo'], $serviceFields['faqs']);
        $this->entityHydrator->hydrate($serviceFields, $service);


        try {
            $this->entityManager->persist($service); // suffisant si cascade persist configurée
            $this->entityManager->flush();

            return $this->json([
                'success' => true,
                'data' => json_decode($this->serializer->serialize(
                    $service,
                    'json',
                    $this->serializerContextBuilder->buildSerializerContext()
                ), true, 512, JSON_THROW_ON_ERROR),
            ], 201);
        } catch (\Throwable $exception) {
            return $this->json([
                'success' => false,
                'data' => $exception->getMessage(),
            ], 500);
        }
    }

}
