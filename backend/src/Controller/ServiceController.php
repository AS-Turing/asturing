<?php

namespace App\Controller;

use App\Entity\Faq;
use App\Entity\Price;
use App\Entity\Seo;
use App\Entity\Service;
use App\Repository\ServiceRepository;
use App\Service\EntityHydrator;
use App\Service\SerializerContextBuilder;
use Doctrine\Common\Collections\ArrayCollection;
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
    public function index() {
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

        // --- SEO (OneToOne) ---
        if (!empty($data['seo']) && is_array($data['seo'])) {
            $seo = new Seo();
            $this->entityHydrator->hydrate($data['seo'], $seo);

            // établis la relation des deux côtés si nécessaire
            if (method_exists($seo, 'setService')) {
                $seo->setService($service);
            }
            if (method_exists($service, 'setSeo')) {
                $service->setSeo($seo);
            }

            // si pas de cascade persist sur Service->seo :
             $this->entityManager->persist($seo);
        }

        // --- Prices (OneToMany) ---
        if (!empty($data['prices']) && is_array($data['prices'])) {
            foreach ($data['prices'] as $p) {
                $price = new Price();
                $this->entityHydrator->hydrate($p, $price);

                // relation propriétaire
                if (method_exists($price, 'setService')) {
                    $price->setService($service);
                }
                if (method_exists($service, 'addPrice')) {
                    $service->addPrice($price); // ajoute dans la Collection<Price>
                }

                // si pas de cascade persist sur Service->prices :
                 $this->entityManager->persist($price);
            }
        }

        // --- FAQs (OneToMany) ---
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

                // si pas de cascade persist :
                 $this->entityManager->persist($faq);
            }
        }

        // --- Hydrate les champs simples du service (sans les relations) ---
        $serviceFields = $data;
        unset($serviceFields['prices'], $serviceFields['seo'], $serviceFields['faqs']);
        $this->entityHydrator->hydrate($serviceFields, $service);

        // dd($service); // -> tu verras une Collection<Price> peuplée d'entités Price

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
