<?php

namespace App\DataFixtures;

use App\Entity\ProcessPage;
use Doctrine\Persistence\ObjectManager;

class ProcessPageFixtures
{
    public function load(ObjectManager $manager): void
    {
        $jsonPath = __DIR__ . '/data/process.json';
        $jsonData = json_decode(file_get_contents($jsonPath), true);
        $data = $jsonData['process'];

        $processPage = new ProcessPage();
        
        // Hero
        $processPage->setHeroBadge($data['hero']['badge']);
        $processPage->setHeroTitle($data['hero']['title']);
        $processPage->setHeroSubtitle($data['hero']['subtitle']);
        
        // Process
        $processPage->setProcessTitle($data['process']['title']);
        $processPage->setProcessDescription($data['process']['description']);
        $processPage->setProcessSteps($data['process']['steps']);
        
        // Values
        $processPage->setValuesTitle($data['values']['title']);
        $processPage->setValuesDescription($data['values']['description']);
        $processPage->setValues($data['values']['items']);
        
        // SEO
        $processPage->setSeoTitle($data['seo']['title']);
        $processPage->setSeoDescription($data['seo']['description']);

        $manager->persist($processPage);
        $manager->flush();
    }
}
