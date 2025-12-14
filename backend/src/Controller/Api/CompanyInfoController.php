<?php

namespace App\Controller\Api;

use App\Repository\CompanyInfoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/company', name: 'api_company_')]
class CompanyInfoController extends AbstractController
{
    #[Route('/info', name: 'info', methods: ['GET'])]
    public function info(CompanyInfoRepository $repository): JsonResponse
    {
        $companyInfo = $repository->findCompanyInfo();

        if (!$companyInfo) {
            return $this->json([
                'error' => 'Company information not found'
            ], 404);
        }

        return $this->json([
            'id' => $companyInfo->getId(),
            'companyName' => $companyInfo->getCompanyName(),
            'tagline' => $companyInfo->getTagline(),
            'description' => $companyInfo->getDescription(),
            'phone' => $companyInfo->getPhone(),
            'email' => $companyInfo->getEmail(),
            'address' => $companyInfo->getAddress(),
            'city' => $companyInfo->getCity(),
            'zipCode' => $companyInfo->getZipCode(),
            'region' => $companyInfo->getRegion(),
            'country' => $companyInfo->getCountry(),
            'socialNetworks' => $companyInfo->getSocialNetworks(),
            'logoPath' => $companyInfo->getLogoPath(),
            'siret' => $companyInfo->getSiret(),
            'tva' => $companyInfo->getTva(),
            'businessHours' => $companyInfo->getBusinessHours(),
        ]);
    }
}
