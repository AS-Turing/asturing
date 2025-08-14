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
use JsonException;
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
            $this->entityManager->persist($service);
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

    #[Route('/services/{id}', name: 'update_service', methods: ['PUT'])]
    public function patch(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $service = $this->serviceRepository->find($id);
        if (!$service) {
            return $this->json(['success' => false, 'data' => 'Service not found'], Response::HTTP_NOT_FOUND);
        }

        if (array_key_exists('seo', $data)) {
            if (is_array($data['seo']) && !empty($data['seo'])) {
                $seoFields = array_diff_key($data['seo'], array_flip(['id', 'service']));

                $seo = $service->getSeo();
                if ($seo) {
                    $this->entityHydrator->hydrate($seoFields, $seo);
                } else {
                    $seo = new Seo();
                    $this->entityHydrator->hydrate($seoFields, $seo);
                    $seo->setService($service);
                    $service->setSeo($seo);
                    $this->entityManager->persist($seo);
                }
            } else {
                if ($service->getSeo()) {
                    $service->setSeo(null);
                }
            }
        }

        if (array_key_exists('prices', $data) && is_array($data['prices'])) {
            $existingPricesById = [];
            foreach ($service->getPrices() as $pr) {
                if (null !== $pr->getId()) {
                    $existingPricesById[$pr->getId()] = $pr;
                }
            }

            $seenPriceIds = [];

            foreach ($data['prices'] as $p) {
                $p = is_array($p) ? $p : [];
                $pFiltered = array_diff_key($p, array_flip(['id', 'service']));

                if (isset($p['id']) && isset($existingPricesById[(int)$p['id']])) {
                    $entity = $existingPricesById[(int)$p['id']];
                    $this->entityHydrator->hydrate($pFiltered, $entity);
                    $seenPriceIds[] = (int)$p['id'];
                } else {
                    $price = new Price();
                    $this->entityHydrator->hydrate($pFiltered, $price);
                    $price->setService($service);
                    $service->addPrice($price);
                     $this->entityManager->persist($price);
                }
            }

            foreach ($service->getPrices()->toArray() as $pr) {
                if ($pr->getId() !== null && !in_array($pr->getId(), $seenPriceIds, true)) {
                    if (method_exists($service, 'removePrice')) {
                        $service->removePrice($pr);
                    } else {
                        $service->getPrices()->removeElement($pr);
                        $pr->setService(null);
                         $this->entityManager->remove($pr);
                    }
                }
            }
        }

        if (array_key_exists('faqs', $data) && is_array($data['faqs'])) {
            $existingFaqsById = [];
            foreach ($service->getFaqs() as $fq) {
                if (null !== $fq->getId()) {
                    $existingFaqsById[$fq->getId()] = $fq;
                }
            }

            $seenFaqIds = [];

            foreach ($data['faqs'] as $f) {
                $f = is_array($f) ? $f : [];
                $fFiltered = array_diff_key($f, array_flip(['id', 'service']));

                if (isset($f['id']) && isset($existingFaqsById[(int)$f['id']])) {
                    $entity = $existingFaqsById[(int)$f['id']];
                    $this->entityHydrator->hydrate($fFiltered, $entity);
                    $seenFaqIds[] = (int)$f['id'];
                } else {
                    $faq = new Faq();
                    $this->entityHydrator->hydrate($fFiltered, $faq);
                    $faq->setService($service);
                    $service->addFaq($faq);
                     $this->entityManager->persist($faq);
                }
            }

            foreach ($service->getFaqs()->toArray() as $fq) {
                if ($fq->getId() !== null && !in_array($fq->getId(), $seenFaqIds, true)) {
                    if (method_exists($service, 'removeFaq')) {
                        $service->removeFaq($fq);
                    } else {
                        $service->getFaqs()->removeElement($fq);
                        $fq->setService(null);
                         $this->entityManager->remove($fq);
                    }
                }
            }
        }

        $serviceFields = $data;
        unset($serviceFields['prices'], $serviceFields['seo'], $serviceFields['faqs']);
        if (!empty($serviceFields)) {
            $serviceFields = array_diff_key($serviceFields, array_flip(['prices','faqs','seo','id']));
            $this->entityHydrator->hydrate($serviceFields, $service);
        }

        try {
            $this->entityManager->persist($service);
            $this->entityManager->flush();

            return $this->json([
                'success' => true,
                'data' => json_decode($this->serializer->serialize(
                    $service,
                    'json',
                    $this->serializerContextBuilder->buildSerializerContext()
                ), true, 512, JSON_THROW_ON_ERROR),
            ]);
        } catch (\Throwable $e) {
            return $this->json(['success' => false, 'data' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
