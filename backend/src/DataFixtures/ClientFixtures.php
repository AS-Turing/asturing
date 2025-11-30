<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Persistence\ObjectManager;

class ClientFixtures
{
    public function load(ObjectManager $manager): void
    {
        $jsonPath = __DIR__ . '/data/clients.json';
        $jsonData = json_decode(file_get_contents($jsonPath), true);

        foreach ($jsonData['clients'] as $data) {
            $client = new Client();
            $client->setName($data['name']);
            $client->setLogo($data['logo']);
            $client->setWebsite($data['website']);
            $client->setDescription($data['description']);
            $client->setPosition($data['position']);
            $client->setIsActive($data['isActive']);

            $manager->persist($client);
        }

        $manager->flush();
    }
}
