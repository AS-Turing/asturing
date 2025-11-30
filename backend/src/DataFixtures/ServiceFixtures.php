<?php

namespace App\DataFixtures;

use App\Entity\Service;
use App\Entity\ServiceSolution;
use App\Entity\ServiceProcessStep;
use App\Entity\ServiceTechnology;
use App\Entity\ServiceFaq;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ServiceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $jsonPath = __DIR__ . '/data/services.json';
        $jsonData = json_decode(file_get_contents($jsonPath), true);

        foreach ($jsonData['services'] as $serviceData) {
            $service = new Service();
            $service->setTitle($serviceData['title']);
            $service->setSlug($serviceData['slug']);
            $service->setDescription($serviceData['shortDescription']);
            $service->setLongDescription($serviceData['description']);
            $service->setIcon($serviceData['icon']);
            $service->setIconGradient($serviceData['iconGradient']);
            $service->setBorderColor($serviceData['borderColor']);
            $service->setLinkColor($serviceData['linkColor']);
            $service->setPosition($serviceData['position']);
            $service->setIsActive(true);
            $service->setHeroTitle($serviceData['heroTitle']);
            $service->setHeroSubtitle($serviceData['heroSubtitle']);
            $service->setAuditDuration($serviceData['auditDuration']);
            
            if (isset($serviceData['deliveryTime'])) {
                $service->setDeliveryTime($serviceData['deliveryTime']);
            }
            if (isset($serviceData['startingPrice'])) {
                $service->setStartingPrice($serviceData['startingPrice']);
            }
            
            $manager->persist($service);

            // Solutions
            foreach ($serviceData['solutions'] as $index => $solutionData) {
                $solution = new ServiceSolution();
                $solution->setTitle($solutionData['title']);
                $solution->setDescription($solutionData['description']);
                $solution->setFeatures($solutionData['features']);
                $solution->setPosition($index);
                $solution->setService($service);
                $manager->persist($solution);
            }

            // Process steps
            foreach ($serviceData['process'] as $index => $processData) {
                $step = new ServiceProcessStep();
                $step->setTitle($processData['title']);
                $step->setDescription($processData['description']);
                $step->setPosition($index);
                $step->setService($service);
                $manager->persist($step);
            }

            // Technologies
            if (isset($serviceData['technologies'])) {
                foreach ($serviceData['technologies'] as $techData) {
                    $tech = new ServiceTechnology();
                    $tech->setName($techData['name']);
                    $tech->setDescription($techData['description']);
                    if (isset($techData['icon'])) {
                        $tech->setIcon($techData['icon']);
                    }
                    $tech->setService($service);
                    $manager->persist($tech);
                }
            }

            // FAQs
            foreach ($serviceData['faqs'] as $index => $faqData) {
                $faq = new ServiceFaq();
                $faq->setQuestion($faqData['question']);
                $faq->setAnswer($faqData['answer']);
                $faq->setPosition($index);
                $faq->setService($service);
                $manager->persist($faq);
            }
        }

        $manager->flush();
    }
}


