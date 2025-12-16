<?php

namespace App\DataFixtures;

use App\Entity\Location;
use Doctrine\Persistence\ObjectManager;

class LocationFixtures
{
    public function load(ObjectManager $manager): void
    {
        $locationsDir = __DIR__ . '/data/locations';
        
        if (!is_dir($locationsDir)) {
            return;
        }
        
        $files = glob($locationsDir . '/*.json');
        
        foreach ($files as $file) {
            $jsonData = json_decode(file_get_contents($file), true);
            
            if (!$jsonData) {
                continue;
            }
            
            $location = new Location();
            $location->setVille($jsonData['ville']);
            $location->setSlug($jsonData['slug']);
            $location->setDepartement($jsonData['departement']);
            $location->setCodePostal($jsonData['codePostal']);
            $location->setRegion($jsonData['region']);
            $location->setCoordinates($jsonData['coordinates'] ?? null);
            $location->setMeta($jsonData['meta']);
            $location->setHero($jsonData['hero']);
            $location->setWhyChoose($jsonData['whyChoose']);
            $location->setServices($jsonData['services']);
            $location->setSectors($jsonData['sectors'] ?? null);
            $location->setProjects($jsonData['projects'] ?? null);
            $location->setProcess($jsonData['process']);
            $location->setFaq($jsonData['faq']);
            $location->setCta($jsonData['cta']);
            $location->setContact($jsonData['contact'] ?? null);
            $location->setIsActive(true);

            $manager->persist($location);
        }
        
        $manager->flush();
    }
}
